# Wave 3 Limited - SQL Server Database Program

A comprehensive SQL Server database management system for the Wave 3 Limited website, featuring advanced analytics, content management, and administrative controls.

## 🚀 Features

### Database Schema
- **Website Content Management**: Services, companies, team members, and contact submissions
- **User Authentication**: Secure admin user management with role-based access
- **Analytics System**: Page views, user interactions, and performance metrics tracking
- **Activity Logging**: Comprehensive audit trail for all database operations
- **Settings Management**: Configurable website settings and preferences

### Stored Procedures
- **CRUD Operations**: Complete Create, Read, Update, Delete functionality
- **Analytics Procedures**: Dashboard data, performance metrics, and user behavior tracking
- **Admin Functions**: User authentication, session management, and activity logging
- **Maintenance Procedures**: Database optimization, cleanup, and backup operations

### Admin Panel
- **Modern Dashboard**: Real-time statistics and system health monitoring
- **Content Management**: Easy management of services, companies, and team members
- **Contact Management**: Handle and respond to contact form submissions
- **Analytics Dashboard**: Visual charts and reports for website performance
- **Database Tools**: Backup, restore, and optimization utilities

## 📋 Prerequisites

- **SQL Server**: 2016 or later (Express, Standard, or Enterprise)
- **PHP**: 8.0 or later with PDO and SQL Server drivers
- **Web Server**: Apache or Nginx
- **PHP Extensions**: 
  - `pdo_sqlsrv`
  - `sqlsrv`
  - `mbstring`
  - `json`

## 🛠️ Installation

### 1. Database Setup

```sql
-- Run the schema file to create the database
sqlcmd -S localhost -i database/schema.sql

-- Run stored procedures
sqlcmd -S localhost -i database/stored_procedures.sql
```

### 2. PHP Configuration

Update your `php.ini` file to enable SQL Server extensions:

```ini
extension=pdo_sqlsrv
extension=sqlsrv
```

### 3. Database Connection

Configure the database connection in `includes/Database.php`:

```php
$config = [
    'server' => 'localhost',
    'database' => 'wave3limited',
    'username' => 'your_username',
    'password' => 'your_password',
    'charset' => 'utf8'
];
```

### 4. Admin Panel Setup

1. Navigate to `/admin/` in your browser
2. Login with default credentials:
   - **Username**: `admin`
   - **Password**: `admin123`
3. Change the default password immediately

## 📊 Database Schema Overview

### Website Schema
- `services` - Company services and offerings
- `companies` - Sister companies and partnerships
- `team_members` - Team member profiles and contact information
- `contact_submissions` - Contact form submissions and responses

### Admin Schema
- `users` - Admin user accounts and authentication
- `user_sessions` - User session management
- `activity_log` - Comprehensive audit trail
- `website_settings` - Configurable website settings

### Analytics Schema
- `page_views` - Website traffic and page view tracking
- `user_interactions` - User behavior and interaction data
- `performance_metrics` - Website performance monitoring

## 🔧 Usage

### Database Operations

```php
// Get database instance
$db = getDB();

// Execute stored procedure
$services = $db->executeStoredProcedure('website.GetActiveServices');

// Execute query
$result = $db->query("SELECT * FROM website.services WHERE is_active = 1");

// Execute single row query
$service = $db->querySingle("SELECT * FROM website.services WHERE service_id = ?", [1]);

// Execute scalar query
$count = $db->queryScalar("SELECT COUNT(*) FROM website.services");

// Execute non-query
$db->execute("UPDATE website.services SET is_active = 0 WHERE service_id = ?", [1]);
```

### Admin Panel Features

#### Dashboard
- Real-time statistics and system health
- Recent contact submissions
- Performance metrics and charts
- Quick action buttons

#### Content Management
- **Services**: Add, edit, and manage company services
- **Companies**: Manage sister companies and partnerships
- **Team Members**: Handle team profiles and contact information
- **Contact Submissions**: Process and respond to inquiries

#### Analytics
- Page view tracking and trends
- User interaction analysis
- Performance metrics monitoring
- Device and browser statistics

#### Database Tools
- Database backup and restore
- Performance optimization
- Session cleanup
- Statistics generation

## 🔒 Security Features

### Authentication & Authorization
- Secure password hashing with bcrypt
- Session-based authentication
- Role-based access control (admin, editor, viewer)
- Login attempt limiting and account locking

### Data Protection
- SQL injection prevention with prepared statements
- XSS protection with output encoding
- CSRF protection for forms
- Input validation and sanitization

### Audit Trail
- Comprehensive activity logging
- User action tracking
- Database change monitoring
- Security event recording

## 📈 Analytics & Monitoring

### Page Views Tracking
```php
// Log page view
$db->executeStoredProcedure('analytics.LogPageView', [
    'PageUrl' => '/services',
    'PageTitle' => 'Our Services',
    'IpAddress' => $_SERVER['REMOTE_ADDR'],
    'UserAgent' => $_SERVER['HTTP_USER_AGENT'],
    'SessionId' => session_id()
]);
```

### User Interactions
```php
// Log user interaction
$db->executeStoredProcedure('analytics.LogUserInteraction', [
    'SessionId' => session_id(),
    'InteractionType' => 'click',
    'ElementId' => 'contact-form',
    'PageUrl' => '/contact'
]);
```

### Performance Metrics
```php
// Log performance metric
$db->executeStoredProcedure('analytics.LogPerformanceMetric', [
    'PageUrl' => '/',
    'MetricType' => 'LCP',
    'MetricValue' => 2.5,
    'DeviceType' => 'desktop'
]);
```

## 🛠️ Maintenance

### Regular Maintenance Tasks

```sql
-- Clean expired sessions
EXEC admin.CleanExpiredSessions

-- Get database statistics
EXEC admin.GetDatabaseStats

-- Optimize database
-- (Run during maintenance window)
```

### Backup Procedures

```php
// Create database backup
$backup = $db->backupDatabase('backups/wave3limited_' . date('Y-m-d_H-i-s') . '.bak');

// Restore database
$restore = $db->restoreDatabase('backups/wave3limited_2024-01-01_12-00-00.bak');
```

### Performance Optimization

```php
// Update statistics
$db->optimizeDatabase();

// Get database size
$size = $db->getDatabaseSize();

// Get slow queries
$slowQueries = $db->getSlowQueries(10);
```

## 📝 API Endpoints

### AJAX Endpoints
- `?ajax=dashboard_stats` - Get dashboard statistics
- `?ajax=services` - Get all services
- `?ajax=companies` - Get all companies
- `?ajax=team_members` - Get all team members
- `?ajax=contact_submissions` - Get contact submissions with pagination
- `?ajax=analytics` - Get analytics data

### Form Actions
- `action=add_service` - Add new service
- `action=update_service` - Update existing service
- `action=add_company` - Add new company
- `action=add_team_member` - Add new team member
- `action=update_submission_status` - Update submission status

## 🔧 Configuration

### Website Settings
Manage website settings through the admin panel or directly in the database:

```sql
-- Update website setting
EXEC admin.UpdateWebsiteSetting 
    @SettingKey = 'site_title',
    @SettingValue = 'Wave 3 Limited - Updated Title',
    @UpdatedBy = 'admin'
```

### Database Configuration
Configure database connection parameters in `includes/Database.php`:

```php
$config = [
    'server' => 'localhost',
    'database' => 'wave3limited',
    'username' => 'sa',
    'password' => 'your_secure_password',
    'charset' => 'utf8',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
];
```

## 🚨 Troubleshooting

### Common Issues

#### Connection Issues
```php
// Test database connection
$test = $db->testConnection();
if (!$test['success']) {
    echo "Connection failed: " . $test['message'];
}
```

#### Performance Issues
```php
// Check database statistics
$stats = $db->getDatabaseStats();
foreach ($stats as $stat) {
    echo "{$stat['table_name']}: {$stat['record_count']} records\n";
}
```

#### Authentication Issues
- Verify SQL Server authentication mode
- Check user permissions
- Ensure SQL Server service is running
- Verify firewall settings

### Error Logging
All database errors are logged to the PHP error log. Check your server's error log for detailed information.

## 📚 Documentation

### Stored Procedures Reference
See `database/stored_procedures.sql` for complete stored procedure documentation.

### Database Schema Reference
See `database/schema.sql` for complete table structure and relationships.

### Admin Panel Guide
The admin panel includes built-in help and tooltips for all features.

## 🤝 Support

For technical support or questions:
- **Email**: support@wave3limited.com
- **Phone**: +880 1711-019152
- **Documentation**: Check this README and inline code comments

## 📄 License

This database program is proprietary software developed for Wave 3 Limited. All rights reserved.

## 🔄 Version History

- **v1.0.0** (2024) - Initial release with complete database schema and admin panel
- Features: Full CRUD operations, analytics, user management, and security features

---

**Developed by Wave 3 Limited Development Team**
*Leading technology solutions in Bangladesh* 