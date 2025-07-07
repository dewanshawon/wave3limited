-- Wave 3 Limited Database Schema
-- SQL Server Database for Website Management
-- Version: 1.0.0
-- Created: 2024

USE master;
GO

-- Create database if it doesn't exist
IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = 'wave3limited')
BEGIN
    CREATE DATABASE wave3limited;
END
GO

USE wave3limited;
GO

-- Enable full-text search
IF NOT EXISTS (SELECT 1 FROM sys.fulltext_catalogs WHERE name = 'Wave3Catalog')
BEGIN
    CREATE FULLTEXT CATALOG Wave3Catalog AS DEFAULT;
END
GO

-- Create schemas for organization
IF NOT EXISTS (SELECT * FROM sys.schemas WHERE name = 'website')
BEGIN
    EXEC('CREATE SCHEMA website');
END

IF NOT EXISTS (SELECT * FROM sys.schemas WHERE name = 'admin')
BEGIN
    EXEC('CREATE SCHEMA admin');
END

IF NOT EXISTS (SELECT * FROM sys.schemas WHERE name = 'analytics')
BEGIN
    EXEC('CREATE SCHEMA analytics');
END
GO

-- =============================================
-- WEBSITE CONTENT TABLES
-- =============================================

-- Services table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.services') AND type in (N'U'))
BEGIN
    CREATE TABLE website.services (
        service_id INT IDENTITY(1,1) PRIMARY KEY,
        title NVARCHAR(255) NOT NULL,
        description NVARCHAR(MAX),
        icon_name NVARCHAR(100),
        display_order INT DEFAULT 0,
        is_active BIT DEFAULT 1,
        created_at DATETIME2 DEFAULT GETDATE(),
        updated_at DATETIME2 DEFAULT GETDATE(),
        created_by NVARCHAR(100),
        updated_by NVARCHAR(100)
    );
END

-- Sister companies table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.companies') AND type in (N'U'))
BEGIN
    CREATE TABLE website.companies (
        company_id INT IDENTITY(1,1) PRIMARY KEY,
        company_key NVARCHAR(50) UNIQUE NOT NULL,
        name NVARCHAR(255) NOT NULL,
        tagline NVARCHAR(500),
        description NVARCHAR(MAX),
        website_url NVARCHAR(500),
        logo_path NVARCHAR(500),
        banner_image_path NVARCHAR(500),
        display_order INT DEFAULT 0,
        is_active BIT DEFAULT 1,
        created_at DATETIME2 DEFAULT GETDATE(),
        updated_at DATETIME2 DEFAULT GETDATE(),
        created_by NVARCHAR(100),
        updated_by NVARCHAR(100)
    );
END

-- Team members table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.team_members') AND type in (N'U'))
BEGIN
    CREATE TABLE website.team_members (
        member_id INT IDENTITY(1,1) PRIMARY KEY,
        name NVARCHAR(255) NOT NULL,
        role NVARCHAR(255) NOT NULL,
        bio NVARCHAR(MAX),
        photo_path NVARCHAR(500),
        linkedin_url NVARCHAR(500),
        twitter_url NVARCHAR(500),
        phone NVARCHAR(20),
        whatsapp NVARCHAR(20),
        email NVARCHAR(255),
        department NVARCHAR(100) NOT NULL, -- 'admin', 'marketing', 'developer'
        display_order INT DEFAULT 0,
        is_active BIT DEFAULT 1,
        created_at DATETIME2 DEFAULT GETDATE(),
        updated_at DATETIME2 DEFAULT GETDATE(),
        created_by NVARCHAR(100),
        updated_by NVARCHAR(100)
    );
END

-- Contact form submissions table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.contact_submissions') AND type in (N'U'))
BEGIN
    CREATE TABLE website.contact_submissions (
        submission_id INT IDENTITY(1,1) PRIMARY KEY,
        name NVARCHAR(255) NOT NULL,
        email NVARCHAR(255) NOT NULL,
        subject NVARCHAR(255) NOT NULL,
        message NVARCHAR(MAX) NOT NULL,
        ip_address NVARCHAR(45),
        user_agent NVARCHAR(500),
        status NVARCHAR(20) DEFAULT 'pending', -- 'pending', 'read', 'replied', 'spam'
        is_processed BIT DEFAULT 0,
        processed_at DATETIME2,
        processed_by NVARCHAR(100),
        created_at DATETIME2 DEFAULT GETDATE()
    );
END

-- =============================================
-- ADMINISTRATION TABLES
-- =============================================

-- Users table for admin access
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.users') AND type in (N'U'))
BEGIN
    CREATE TABLE admin.users (
        user_id INT IDENTITY(1,1) PRIMARY KEY,
        username NVARCHAR(100) UNIQUE NOT NULL,
        email NVARCHAR(255) UNIQUE NOT NULL,
        password_hash NVARCHAR(255) NOT NULL,
        first_name NVARCHAR(100),
        last_name NVARCHAR(100),
        role NVARCHAR(50) DEFAULT 'editor', -- 'admin', 'editor', 'viewer'
        is_active BIT DEFAULT 1,
        last_login DATETIME2,
        login_attempts INT DEFAULT 0,
        locked_until DATETIME2,
        password_reset_token NVARCHAR(255),
        password_reset_expires DATETIME2,
        created_at DATETIME2 DEFAULT GETDATE(),
        updated_at DATETIME2 DEFAULT GETDATE(),
        created_by NVARCHAR(100),
        updated_by NVARCHAR(100)
    );
END

-- User sessions table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.user_sessions') AND type in (N'U'))
BEGIN
    CREATE TABLE admin.user_sessions (
        session_id NVARCHAR(255) PRIMARY KEY,
        user_id INT NOT NULL,
        ip_address NVARCHAR(45),
        user_agent NVARCHAR(500),
        created_at DATETIME2 DEFAULT GETDATE(),
        expires_at DATETIME2 NOT NULL,
        is_active BIT DEFAULT 1
    );
END

-- Activity log table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.activity_log') AND type in (N'U'))
BEGIN
    CREATE TABLE admin.activity_log (
        log_id INT IDENTITY(1,1) PRIMARY KEY,
        user_id INT,
        action NVARCHAR(100) NOT NULL,
        table_name NVARCHAR(100),
        record_id INT,
        old_values NVARCHAR(MAX),
        new_values NVARCHAR(MAX),
        ip_address NVARCHAR(45),
        user_agent NVARCHAR(500),
        created_at DATETIME2 DEFAULT GETDATE()
    );
END

-- =============================================
-- ANALYTICS TABLES
-- =============================================

-- Page views table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'analytics.page_views') AND type in (N'U'))
BEGIN
    CREATE TABLE analytics.page_views (
        view_id INT IDENTITY(1,1) PRIMARY KEY,
        page_url NVARCHAR(500) NOT NULL,
        page_title NVARCHAR(255),
        referrer_url NVARCHAR(500),
        ip_address NVARCHAR(45),
        user_agent NVARCHAR(500),
        session_id NVARCHAR(255),
        device_type NVARCHAR(50), -- 'desktop', 'mobile', 'tablet'
        browser NVARCHAR(100),
        os NVARCHAR(100),
        country NVARCHAR(100),
        city NVARCHAR(100),
        load_time_ms INT,
        created_at DATETIME2 DEFAULT GETDATE()
    );
END

-- User interactions table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'analytics.user_interactions') AND type in (N'U'))
BEGIN
    CREATE TABLE analytics.user_interactions (
        interaction_id INT IDENTITY(1,1) PRIMARY KEY,
        session_id NVARCHAR(255),
        interaction_type NVARCHAR(100), -- 'click', 'scroll', 'form_submit', 'download'
        element_id NVARCHAR(100),
        element_text NVARCHAR(255),
        page_url NVARCHAR(500),
        ip_address NVARCHAR(45),
        created_at DATETIME2 DEFAULT GETDATE()
    );
END

-- Performance metrics table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'analytics.performance_metrics') AND type in (N'U'))
BEGIN
    CREATE TABLE analytics.performance_metrics (
        metric_id INT IDENTITY(1,1) PRIMARY KEY,
        page_url NVARCHAR(500),
        metric_type NVARCHAR(50), -- 'LCP', 'FID', 'CLS', 'TTFB'
        metric_value DECIMAL(10,2),
        device_type NVARCHAR(50),
        browser NVARCHAR(100),
        created_at DATETIME2 DEFAULT GETDATE()
    );
END

-- =============================================
-- SETTINGS TABLES
-- =============================================

-- Website settings table
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.website_settings') AND type in (N'U'))
BEGIN
    CREATE TABLE admin.website_settings (
        setting_id INT IDENTITY(1,1) PRIMARY KEY,
        setting_key NVARCHAR(100) UNIQUE NOT NULL,
        setting_value NVARCHAR(MAX),
        setting_type NVARCHAR(50) DEFAULT 'text', -- 'text', 'number', 'boolean', 'json'
        description NVARCHAR(500),
        is_public BIT DEFAULT 0,
        created_at DATETIME2 DEFAULT GETDATE(),
        updated_at DATETIME2 DEFAULT GETDATE(),
        updated_by NVARCHAR(100)
    );
END

-- =============================================
-- INDEXES FOR PERFORMANCE
-- =============================================

-- Services indexes
IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_services_active')
BEGIN
    CREATE INDEX IX_services_active ON website.services(is_active, display_order);
END

IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_services_created')
BEGIN
    CREATE INDEX IX_services_created ON website.services(created_at);
END

-- Companies indexes
IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_companies_active')
BEGIN
    CREATE INDEX IX_companies_active ON website.companies(is_active, display_order);
END

IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_companies_key')
BEGIN
    CREATE INDEX IX_companies_key ON website.companies(company_key);
END

-- Team members indexes
IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_team_department')
BEGIN
    CREATE INDEX IX_team_department ON website.team_members(department, is_active, display_order);
END

IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_team_active')
BEGIN
    CREATE INDEX IX_team_active ON website.team_members(is_active);
END

-- Contact submissions indexes
IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_contact_status')
BEGIN
    CREATE INDEX IX_contact_status ON website.contact_submissions(status, created_at);
END

IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_contact_email')
BEGIN
    CREATE INDEX IX_contact_email ON website.contact_submissions(email);
END

-- Users indexes
IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_users_username')
BEGIN
    CREATE INDEX IX_users_username ON admin.users(username);
END

IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_users_email')
BEGIN
    CREATE INDEX IX_users_email ON admin.users(email);
END

-- Analytics indexes
IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_pageviews_url')
BEGIN
    CREATE INDEX IX_pageviews_url ON analytics.page_views(page_url, created_at);
END

IF NOT EXISTS (SELECT * FROM sys.indexes WHERE name = 'IX_pageviews_session')
BEGIN
    CREATE INDEX IX_pageviews_session ON analytics.page_views(session_id, created_at);
END

-- =============================================
-- DEFAULT DATA INSERTION
-- =============================================

-- Insert default admin user (password: admin123)
IF NOT EXISTS (SELECT * FROM admin.users WHERE username = 'admin')
BEGIN
    INSERT INTO admin.users (username, email, password_hash, first_name, last_name, role)
    VALUES ('admin', 'admin@wave3limited.com', 
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'System', 'Administrator', 'admin');
END

-- Insert default services
IF NOT EXISTS (SELECT * FROM website.services WHERE title = 'Web Development')
BEGIN
    INSERT INTO website.services (title, description, icon_name, display_order) VALUES
    ('Web Development', 'Custom web applications tailored to your needs', 'lucide:code', 1),
    ('Mobile App Development', 'iOS and Android apps with cutting-edge features', 'lucide:smartphone', 2),
    ('Cloud Solutions', 'Scalable and secure cloud infrastructure', 'lucide:cloud', 3),
    ('Data Analytics', 'Insights from your data to drive business decisions', 'lucide:bar-chart', 4),
    ('UI/UX Design', 'Beautiful and intuitive user interfaces', 'lucide:palette', 5),
    ('Cybersecurity', 'Protect your digital assets with our security solutions', 'lucide:shield', 6);
END

-- Insert default companies
IF NOT EXISTS (SELECT * FROM website.companies WHERE company_key = 'ruposhee')
BEGIN
    INSERT INTO website.companies (company_key, name, tagline, description, website_url, logo_path, banner_image_path, display_order) VALUES
    ('ruposhee', 'Ruposhee.com', 'Premier destination for women''s fashion and beauty products.', 
     'Your one-stop destination for trendy fashion, beauty products, and lifestyle essentials. Discover a curated collection of products that enhance your beauty and style.',
     'https://ruposhee.com', 'assets/companies/ruposhee.png', 'assets/companies/ruposhee-banner.jpg', 1),
    ('scholarhaat', 'Scholarhaat.com', 'Innovative educational platform for quality learning resources.',
     'Empowering students with comprehensive learning resources, test preparation materials, and educational guidance for academic excellence.',
     'https://scholarhaat.com', 'assets/companies/scholarhaat.png', 'assets/companies/scholarhaat-banner.jpg', 2),
    ('medeasy', 'MediFast.com', 'Revolutionary telemedicine platform for healthcare services.',
     'Access quality healthcare services from the comfort of your home. Connect with experienced doctors, get prescriptions, and manage your health efficiently.',
     'https://medeasy.com', 'assets/companies/medifast.png', 'assets/companies/medifast-banner.jpg', 3);
END

-- Insert default team members
IF NOT EXISTS (SELECT * FROM website.team_members WHERE name = 'Kazi Abu Taher')
BEGIN
    INSERT INTO website.team_members (name, role, bio, photo_path, linkedin_url, twitter_url, phone, whatsapp, department, display_order) VALUES
    ('Kazi Abu Taher', 'Chairman', 'Visionary leader with over 15 years of experience driving innovation.', 
     'assets/adminimg/kazi-abu-taher.png', 'https://linkedin.com/in/kazi-abu-taher', 'https://twitter.com/kaziabutaher', 
     '+8801711001122', '+8801711001122', 'admin', 1),
    ('A K M Shafiudduza', 'Managing Director', 'Operations expert ensuring seamless business performance.', 
     'assets/adminimg/shafiudduza.png', 'https://linkedin.com/in/shafiudduza', 'https://twitter.com/shafiudduza', 
     '+8801711003344', '+8801711003344', 'admin', 2),
    ('Sumona Akter', 'Director, Admin & Finance', 'Financial strategist with a keen eye for fiscal responsibility.', 
     'assets/adminimg/Shumona.png', 'https://linkedin.com/in/sumona-akter', 'https://twitter.com/sumonaakter', 
     '+8801711005566', '+8801711005566', 'admin', 3);
END

-- Insert default website settings
IF NOT EXISTS (SELECT * FROM admin.website_settings WHERE setting_key = 'site_title')
BEGIN
    INSERT INTO admin.website_settings (setting_key, setting_value, setting_type, description, is_public) VALUES
    ('site_title', 'Wave 3 Limited', 'text', 'Website title', 1),
    ('site_description', 'Leading technology company providing comprehensive IT solutions in Bangladesh', 'text', 'Website description', 1),
    ('contact_email', 'info@wave3limited.com', 'text', 'Primary contact email', 1),
    ('contact_phone', '+8801711019152', 'text', 'Primary contact phone', 1),
    ('company_address', '1188/2/B East Shewrapara, Kafrul, Mirpur, Dhaka-1216, Bangladesh', 'text', 'Company address', 1),
    ('google_analytics_id', '', 'text', 'Google Analytics tracking ID', 0),
    ('facebook_pixel_id', '', 'text', 'Facebook Pixel tracking ID', 0),
    ('maintenance_mode', '0', 'boolean', 'Enable maintenance mode', 0);
END

-- =============================================
-- COMPLETION MESSAGE
-- =============================================

PRINT 'Wave 3 Limited Database Schema Created Successfully!';
PRINT 'Database: wave3limited';
PRINT 'Default admin credentials:';
PRINT 'Username: admin';
PRINT 'Password: admin123';
PRINT 'Please change the default password after first login.';
GO 