<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wave 3 Limited - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --sidebar-width: 250px;
        }
        
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 1100;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 2rem;
            min-height: 64px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .admin-logo {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .admin-logo img {
            height: 38px;
            width: 38px;
            border-radius: 8px;
            object-fit: contain;
            background: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,0.08);
        }
        
        .admin-nav-quick {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .admin-nav-quick .nav-link {
            color: var(--primary-color);
            font-weight: 500;
            font-size: 1.05rem;
            text-decoration: none;
            padding: 0.3rem 0.7rem;
            border-radius: 0.4rem;
            transition: background 0.2s, color 0.2s;
        }
        
        .admin-nav-quick .nav-link.active,
        .admin-nav-quick .nav-link:hover {
            background: var(--primary-color);
            color: #fff;
        }
        
        .admin-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        
        .admin-bell {
            color: var(--primary-color);
            font-size: 1.3rem;
            position: relative;
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .admin-bell:hover {
            color: var(--secondary-color);
        }
        
        .admin-bell[data-has="1"]::after {
            content: '';
            position: absolute;
            top: 2px;
            right: 2px;
            width: 8px;
            height: 8px;
            background: var(--danger-color);
            border-radius: 50%;
            border: 2px solid #fff;
        }
        
        .admin-user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        
        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(37,99,235,0.10);
        }
        
        .admin-user-dropdown .dropdown-toggle {
            background: none;
            border: none;
            color: var(--dark-color);
            font-weight: 600;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.2rem 0.7rem;
            border-radius: 0.4rem;
            transition: background 0.2s;
        }
        
        .admin-user-dropdown .dropdown-toggle:hover,
        .admin-user-dropdown .dropdown-toggle:focus {
            background: var(--primary-color);
            color: #fff;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 12px rgba(37,99,235,0.08);
        }
        
        .sidebar-header {
            padding: 1.5rem 1.2rem 1rem 1.2rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        
        .sidebar-brand {
            font-size: 1.3rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.3rem;
            margin-left: auto;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .sidebar-toggle:hover {
            color: var(--warning-color);
        }
        
        .sidebar-nav {
            padding: 1.2rem 0.5rem 0.5rem 0.5rem;
        }
        
        .nav-group {
            margin-bottom: 1.2rem;
        }
        
        .nav-group-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #c7d2fe;
            margin: 0.7rem 0 0.3rem 1.2rem;
            letter-spacing: 0.01em;
        }
        
        .nav-item {
            margin-bottom: 0.15rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.65rem 1.2rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 1.05rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }
        
        .nav-link.active,
        .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.13);
            transform: translateX(6px);
        }
        
        .nav-link i {
            margin-right: 0.8rem;
            width: 22px;
            text-align: center;
            font-size: 1.15rem;
        }
        
        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        @media (max-width: 991px) {
            .main-content {
                margin-left: 0;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
        
        @media (max-width: 768px) {
            .admin-topbar {
                padding: 0.7rem 1rem;
            }
            .sidebar {
                width: 210px;
            }
        }
        
        /* Loading spinner */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['admin_user_id'])): ?>
    <div class="admin-topbar">
        <a href="?page=dashboard" class="admin-logo">
            <img src="/assets/WAVElogo01.png" alt="Wave 3 Limited Logo" />
            <span>Wave 3 Admin</span>
        </a>
        <div class="admin-nav-quick d-none d-md-flex">
            <a href="?page=dashboard" class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
            <a href="?page=services" class="nav-link <?php echo $page === 'services' ? 'active' : ''; ?>">Services</a>
            <a href="?page=companies" class="nav-link <?php echo $page === 'companies' ? 'active' : ''; ?>">Companies</a>
            <a href="?page=team" class="nav-link <?php echo $page === 'team' ? 'active' : ''; ?>">Team</a>
        </div>
        <div class="admin-actions">
            <button class="admin-bell" aria-label="Notifications" data-has="0"><i class="fas fa-bell"></i></button>
            <div class="dropdown admin-user-dropdown">
                <div class="admin-avatar">
                    <?php echo strtoupper(substr($userInfo['username'] ?? 'A', 0, 1)); ?>
                </div>
                <button class="dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($userInfo['username'] ?? 'Admin'); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="?page=profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="?page=settings"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="?action=logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="?page=dashboard" class="sidebar-brand">
                <i class="fas fa-wave-square"></i> Wave 3 Admin
            </a>
            <button class="sidebar-toggle d-md-none" id="sidebarToggle" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></button>
        </div>
        <div class="sidebar-nav">
            <div class="nav-group">
                <div class="nav-group-title">Main</div>
                <div class="nav-item"><a href="?page=dashboard" class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a></div>
                <div class="nav-item"><a href="?page=analytics" class="nav-link <?php echo $page === 'analytics' ? 'active' : ''; ?>"><i class="fas fa-chart-bar"></i>Analytics</a></div>
            </div>
            <div class="nav-group">
                <div class="nav-group-title">Management</div>
                <div class="nav-item"><a href="?page=services" class="nav-link <?php echo $page === 'services' ? 'active' : ''; ?>"><i class="fas fa-cogs"></i>Services</a></div>
                <div class="nav-item"><a href="?page=companies" class="nav-link <?php echo $page === 'companies' ? 'active' : ''; ?>"><i class="fas fa-building"></i>Companies</a></div>
                <div class="nav-item"><a href="?page=team" class="nav-link <?php echo $page === 'team' ? 'active' : ''; ?>"><i class="fas fa-users"></i>Team Members</a></div>
            </div>
            <div class="nav-group">
                <div class="nav-group-title">Other</div>
                <div class="nav-item"><a href="?page=submissions" class="nav-link <?php echo $page === 'submissions' ? 'active' : ''; ?>"><i class="fas fa-envelope"></i>Contact Submissions</a></div>
                <div class="nav-item"><a href="?page=settings" class="nav-link <?php echo $page === 'settings' ? 'active' : ''; ?>"><i class="fas fa-cog"></i>Settings</a></div>
                <div class="nav-item"><a href="?page=database" class="nav-link <?php echo $page === 'database' ? 'active' : ''; ?>"><i class="fas fa-database"></i>Database</a></div>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="content-area">
            <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo htmlspecialchars($success); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

<?php else: ?>
    <!-- Login page doesn't need sidebar -->
    <div class="main-content" style="margin-left: 0;">
        <div class="content-area">
<?php endif; ?> 