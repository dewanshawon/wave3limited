<?php
/**
 * Wave 3 Limited - Database Setup Script
 * Automated database installation and configuration
 * Version: 1.0.0
 * Created: 2024
 */

// Prevent direct access if not running from command line or admin
if (!isset($_GET['setup']) && php_sapi_name() !== 'cli') {
    die('Access denied. This script can only be run from the admin panel or command line.');
}

// Configuration
$config = [
    'server' => 'localhost',
    'database' => 'wave3limited',
    'username' => 'sa',
    'password' => '',
    'charset' => 'utf8'
];

// Override config from environment or GET parameters
if (isset($_GET['server'])) $config['server'] = $_GET['server'];
if (isset($_GET['username'])) $config['username'] = $_GET['username'];
if (isset($_GET['password'])) $config['password'] = $_GET['password'];

// Output function
function output($message, $type = 'info') {
    $colors = [
        'info' => '36',
        'success' => '32',
        'warning' => '33',
        'error' => '31'
    ];
    
    if (php_sapi_name() === 'cli') {
        echo "\033[{$colors[$type]}m{$message}\033[0m\n";
    } else {
        $class = $type === 'error' ? 'danger' : $type;
        echo "<div class='alert alert-{$class}'>{$message}</div>";
    }
}

// Test connection function
function testConnection($config) {
    try {
        $dsn = "sqlsrv:Server={$config['server']};Database=master;CharacterSet={$config['charset']}";
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ['success' => true, 'connection' => $pdo];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Execute SQL file function
function executeSqlFile($pdo, $filename) {
    if (!file_exists($filename)) {
        return ['success' => false, 'error' => "File not found: {$filename}"];
    }
    
    try {
        $sql = file_get_contents($filename);
        $statements = explode('GO', $sql);
        
        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (!empty($statement)) {
                $pdo->exec($statement);
            }
        }
        
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Main setup process
function runSetup($config) {
    output("Starting Wave 3 Limited Database Setup...", 'info');
    output("Server: {$config['server']}", 'info');
    output("Database: {$config['database']}", 'info');
    output("Username: {$config['username']}", 'info');
    
    // Step 1: Test connection to master database
    output("\nStep 1: Testing database connection...", 'info');
    $connection = testConnection($config);
    
    if (!$connection['success']) {
        output("❌ Connection failed: {$connection['error']}", 'error');
        return false;
    }
    
    output("✅ Connection successful", 'success');
    
    // Step 2: Create database if it doesn't exist
    output("\nStep 2: Creating database...", 'info');
    try {
        $pdo = $connection['connection'];
        $pdo->exec("IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = '{$config['database']}') CREATE DATABASE [{$config['database']}]");
        output("✅ Database created/verified", 'success');
    } catch (PDOException $e) {
        output("❌ Database creation failed: {$e->getMessage()}", 'error');
        return false;
    }
    
    // Step 3: Connect to the new database
    output("\nStep 3: Connecting to {$config['database']}...", 'info');
    try {
        $dsn = "sqlsrv:Server={$config['server']};Database={$config['database']};CharacterSet={$config['charset']}";
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        output("✅ Connected to {$config['database']}", 'success');
    } catch (PDOException $e) {
        output("❌ Connection to {$config['database']} failed: {$e->getMessage()}", 'error');
        return false;
    }
    
    // Step 4: Execute schema file
    output("\nStep 4: Creating database schema...", 'info');
    $schemaResult = executeSqlFile($pdo, __DIR__ . '/schema.sql');
    
    if (!$schemaResult['success']) {
        output("❌ Schema creation failed: {$schemaResult['error']}", 'error');
        return false;
    }
    
    output("✅ Database schema created", 'success');
    
    // Step 5: Execute stored procedures
    output("\nStep 5: Creating stored procedures...", 'info');
    $proceduresResult = executeSqlFile($pdo, __DIR__ . '/stored_procedures.sql');
    
    if (!$proceduresResult['success']) {
        output("❌ Stored procedures creation failed: {$proceduresResult['error']}", 'error');
        return false;
    }
    
    output("✅ Stored procedures created", 'success');
    
    // Step 6: Verify installation
    output("\nStep 6: Verifying installation...", 'info');
    try {
        $tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'")->fetchAll(PDO::FETCH_COLUMN);
        $procedures = $pdo->query("SELECT ROUTINE_NAME FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_TYPE = 'PROCEDURE'")->fetchAll(PDO::FETCH_COLUMN);
        
        output("✅ Found " . count($tables) . " tables", 'success');
        output("✅ Found " . count($procedures) . " stored procedures", 'success');
        
        // Check for key tables
        $requiredTables = ['website.services', 'website.companies', 'website.team_members', 'admin.users'];
        foreach ($requiredTables as $table) {
            $exists = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA + '.' + TABLE_NAME = '{$table}'")->fetchColumn();
            if ($exists) {
                output("✅ Table {$table} exists", 'success');
            } else {
                output("❌ Table {$table} missing", 'error');
                return false;
            }
        }
        
    } catch (PDOException $e) {
        output("❌ Verification failed: {$e->getMessage()}", 'error');
        return false;
    }
    
    // Step 7: Create configuration file
    output("\nStep 7: Creating configuration file...", 'info');
    $configContent = "<?php\n// Wave 3 Limited Database Configuration\n// Auto-generated on " . date('Y-m-d H:i:s') . "\n\n";
    $configContent .= "\$db_config = " . var_export($config, true) . ";\n";
    $configContent .= "\n// Test connection\n";
    $configContent .= "try {\n";
    $configContent .= "    \$dsn = \"sqlsrv:Server={\$db_config['server']};Database={\$db_config['database']};CharacterSet={\$db_config['charset']}\";\n";
    $configContent .= "    \$pdo = new PDO(\$dsn, \$db_config['username'], \$db_config['password']);\n";
    $configContent .= "    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n";
    $configContent .= "    echo \"Database connection successful!\\n\";\n";
    $configContent .= "} catch (PDOException \$e) {\n";
    $configContent .= "    echo \"Database connection failed: \" . \$e->getMessage() . \"\\n\";\n";
    $configContent .= "}\n";
    
    $configFile = __DIR__ . '/../includes/db_config.php';
    if (file_put_contents($configFile, $configContent)) {
        output("✅ Configuration file created: {$configFile}", 'success');
    } else {
        output("⚠️  Could not create configuration file", 'warning');
    }
    
    // Step 8: Final verification
    output("\nStep 8: Final verification...", 'info');
    try {
        // Test stored procedures
        $services = $pdo->query("EXEC website.GetActiveServices")->fetchAll();
        output("✅ Stored procedures working", 'success');
        
        // Check default data
        $userCount = $pdo->query("SELECT COUNT(*) FROM admin.users")->fetchColumn();
        $serviceCount = $pdo->query("SELECT COUNT(*) FROM website.services")->fetchColumn();
        $companyCount = $pdo->query("SELECT COUNT(*) FROM website.companies")->fetchColumn();
        
        output("✅ Default data loaded: {$userCount} users, {$serviceCount} services, {$companyCount} companies", 'success');
        
    } catch (PDOException $e) {
        output("❌ Final verification failed: {$e->getMessage()}", 'error');
        return false;
    }
    
    output("\n🎉 Database setup completed successfully!", 'success');
    output("\nDefault admin credentials:", 'info');
    output("Username: admin", 'info');
    output("Password: admin123", 'info');
    output("\n⚠️  IMPORTANT: Change the default password immediately!", 'warning');
    
    output("\nNext steps:", 'info');
    output("1. Update the database configuration in includes/Database.php", 'info');
    output("2. Access the admin panel at /admin/", 'info');
    output("3. Change the default admin password", 'info');
    output("4. Configure website settings", 'info');
    
    return true;
}

// CLI mode
if (php_sapi_name() === 'cli') {
    output("Wave 3 Limited Database Setup", 'info');
    output("=============================", 'info');
    
    // Get configuration from command line arguments
    $options = getopt('', ['server:', 'username:', 'password:', 'database:']);
    
    if (isset($options['server'])) $config['server'] = $options['server'];
    if (isset($options['username'])) $config['username'] = $options['username'];
    if (isset($options['password'])) $config['password'] = $options['password'];
    if (isset($options['database'])) $config['database'] = $options['database'];
    
    runSetup($config);
    exit;
}

// Web mode
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wave 3 Limited - Database Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .setup-container { max-width: 800px; margin: 50px auto; }
        .setup-form { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>
    <div class="setup-container">
        <div class="text-center mb-4">
            <h1>Wave 3 Limited</h1>
            <h3>Database Setup</h3>
        </div>
        
        <?php if (!isset($_GET['setup'])): ?>
            <div class="setup-form">
                <h4 class="mb-4">Database Configuration</h4>
                <form method="GET" action="">
                    <input type="hidden" name="setup" value="1">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="server" class="form-label">Server</label>
                            <input type="text" class="form-control" id="server" name="server" value="localhost" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="database" class="form-label">Database Name</label>
                            <input type="text" class="form-control" id="database" name="database" value="wave3limited" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="sa" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Note:</strong> Make sure SQL Server is running and the user has sufficient permissions to create databases and tables.
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg">Start Setup</button>
                </form>
            </div>
        <?php else: ?>
            <div class="setup-form">
                <h4 class="mb-4">Setup Progress</h4>
                <div id="setup-output">
                    <?php runSetup($config); ?>
                </div>
                
                <div class="mt-4">
                    <a href="../admin/" class="btn btn-success">Go to Admin Panel</a>
                    <a href="../" class="btn btn-secondary">Go to Website</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 