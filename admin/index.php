<?php
/**
 * Wave 3 Limited - Admin Panel
 * Database Management and Content Administration
 * Version: 1.0.0
 * Created: 2024
 */

session_start();
require_once '../includes/Database.php';

// Check if user is logged in
if (!isset($_SESSION['admin_user_id']) && $_GET['page'] !== 'login') {
    header('Location: ?page=login');
    exit;
}

// Database connection
$db = getDB();

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: ?page=login');
    exit;
}

// Get current page
$page = $_GET['page'] ?? 'dashboard';

// Handle login
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $result = $db->executeStoredProcedure('admin.AuthenticateUser', [
                'Username' => $username,
                'PasswordHash' => $passwordHash,
                'UserId' => ['value' => null, 'type' => PDO::PARAM_INT],
                'UserRole' => ['value' => null, 'type' => PDO::PARAM_STR],
                'IsActive' => ['value' => null, 'type' => PDO::PARAM_BOOL]
            ]);
            
            if ($result && isset($result[0]['UserId']) && $result[0]['UserId']) {
                $_SESSION['admin_user_id'] = $result[0]['UserId'];
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_role'] = $result[0]['UserRole'];
                
                // Log activity
                $db->executeStoredProcedure('admin.LogActivity', [
                    'UserId' => $result[0]['UserId'],
                    'Action' => 'login',
                    'IpAddress' => $_SERVER['REMOTE_ADDR'],
                    'UserAgent' => $_SERVER['HTTP_USER_AGENT']
                ]);
                
                header('Location: ?page=dashboard');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        } catch (Exception $e) {
            $error = 'Login failed. Please try again.';
        }
    } else {
        $error = 'Please enter username and password';
    }
}

// Get user info
$userInfo = null;
if (isset($_SESSION['admin_user_id'])) {
    $userInfo = $db->querySingle("SELECT * FROM admin.users WHERE user_id = ?", [$_SESSION['admin_user_id']]);
}

// Handle AJAX requests
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    
    switch ($_GET['ajax']) {
        case 'dashboard_stats':
            $stats = $db->getDatabaseStats();
            echo json_encode($stats);
            break;
            
        case 'services':
            $services = $db->executeStoredProcedure('website.GetActiveServices');
            echo json_encode($services);
            break;
            
        case 'companies':
            $companies = $db->executeStoredProcedure('website.GetActiveCompanies');
            echo json_encode($companies);
            break;
            
        case 'team_members':
            $members = $db->executeStoredProcedure('website.GetAllTeamMembers');
            echo json_encode($members);
            break;
            
        case 'contact_submissions':
            $page = $_GET['page'] ?? 1;
            $totalCount = 0;
            $submissions = $db->executeStoredProcedure('website.GetContactSubmissions', [
                'Page' => $page,
                'PageSize' => 20,
                'TotalCount' => ['value' => $totalCount, 'type' => PDO::PARAM_INT]
            ]);
            echo json_encode(['submissions' => $submissions, 'total' => $totalCount]);
            break;
            
        case 'analytics':
            $startDate = $_GET['start_date'] ?? null;
            $endDate = $_GET['end_date'] ?? null;
            $analytics = $db->executeStoredProcedure('analytics.GetDashboardData', [
                'StartDate' => $startDate,
                'EndDate' => $endDate
            ]);
            echo json_encode($analytics);
            break;
    }
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        switch ($action) {
            case 'add_service':
                $serviceId = null;
                $db->executeStoredProcedure('website.InsertService', [
                    'Title' => $_POST['title'],
                    'Description' => $_POST['description'],
                    'IconName' => $_POST['icon_name'],
                    'DisplayOrder' => $_POST['display_order'] ?? 0,
                    'CreatedBy' => $_SESSION['admin_username'],
                    'ServiceId' => ['value' => $serviceId, 'type' => PDO::PARAM_INT]
                ]);
                $success = 'Service added successfully';
                break;
                
            case 'update_service':
                $db->executeStoredProcedure('website.UpdateService', [
                    'ServiceId' => $_POST['service_id'],
                    'Title' => $_POST['title'],
                    'Description' => $_POST['description'],
                    'IconName' => $_POST['icon_name'],
                    'DisplayOrder' => $_POST['display_order'],
                    'IsActive' => $_POST['is_active'] ?? 1,
                    'UpdatedBy' => $_SESSION['admin_username']
                ]);
                $success = 'Service updated successfully';
                break;
                
            case 'add_company':
                $companyId = null;
                $db->executeStoredProcedure('website.InsertCompany', [
                    'CompanyKey' => $_POST['company_key'],
                    'Name' => $_POST['name'],
                    'Tagline' => $_POST['tagline'],
                    'Description' => $_POST['description'],
                    'WebsiteUrl' => $_POST['website_url'],
                    'LogoPath' => $_POST['logo_path'],
                    'BannerImagePath' => $_POST['banner_image_path'],
                    'DisplayOrder' => $_POST['display_order'] ?? 0,
                    'CreatedBy' => $_SESSION['admin_username'],
                    'CompanyId' => ['value' => $companyId, 'type' => PDO::PARAM_INT]
                ]);
                $success = 'Company added successfully';
                break;
                
            case 'add_team_member':
                $memberId = null;
                $db->executeStoredProcedure('website.InsertTeamMember', [
                    'Name' => $_POST['name'],
                    'Role' => $_POST['role'],
                    'Bio' => $_POST['bio'],
                    'PhotoPath' => $_POST['photo_path'],
                    'LinkedinUrl' => $_POST['linkedin_url'],
                    'TwitterUrl' => $_POST['twitter_url'],
                    'Phone' => $_POST['phone'],
                    'Whatsapp' => $_POST['whatsapp'],
                    'Email' => $_POST['email'],
                    'Department' => $_POST['department'],
                    'DisplayOrder' => $_POST['display_order'] ?? 0,
                    'CreatedBy' => $_SESSION['admin_username'],
                    'MemberId' => ['value' => $memberId, 'type' => PDO::PARAM_INT]
                ]);
                $success = 'Team member added successfully';
                break;
                
            case 'update_submission_status':
                $db->executeStoredProcedure('website.UpdateSubmissionStatus', [
                    'SubmissionId' => $_POST['submission_id'],
                    'Status' => $_POST['status'],
                    'IsProcessed' => $_POST['is_processed'] ?? 0,
                    'ProcessedBy' => $_SESSION['admin_username']
                ]);
                $success = 'Submission status updated successfully';
                break;
        }
    } catch (Exception $e) {
        $error = 'Operation failed: ' . $e->getMessage();
    }
}

// Get page data
$pageData = [];
switch ($page) {
    case 'dashboard':
        $pageData['stats'] = $db->getDatabaseStats();
        $pageData['recent_submissions'] = $db->query("SELECT TOP 5 * FROM website.contact_submissions ORDER BY created_at DESC");
        $pageData['db_info'] = $db->getDatabaseInfo();
        break;
        
    case 'services':
        $pageData['services'] = $db->executeStoredProcedure('website.GetActiveServices');
        break;
        
    case 'companies':
        $pageData['companies'] = $db->executeStoredProcedure('website.GetActiveCompanies');
        break;
        
    case 'team':
        $pageData['members'] = $db->executeStoredProcedure('website.GetAllTeamMembers');
        break;
        
    case 'submissions':
        $currentPage = $_GET['p'] ?? 1;
        $totalCount = 0;
        $pageData['submissions'] = $db->executeStoredProcedure('website.GetContactSubmissions', [
            'Page' => $currentPage,
            'PageSize' => 20,
            'TotalCount' => ['value' => $totalCount, 'type' => PDO::PARAM_INT]
        ]);
        $pageData['total_count'] = $totalCount;
        $pageData['current_page'] = $currentPage;
        break;
        
    case 'analytics':
        $pageData['analytics'] = $db->executeStoredProcedure('analytics.GetDashboardData');
        break;
        
    case 'settings':
        $pageData['settings'] = $db->executeStoredProcedure('admin.GetWebsiteSettings', ['IncludePrivate' => 1]);
        break;
}

// Include header
include 'includes/header.php';

// Include page content
$pageFile = "pages/{$page}.php";
if (file_exists($pageFile)) {
    include $pageFile;
} else {
    include 'pages/404.php';
}

// Include footer
include 'includes/footer.php';
?> 