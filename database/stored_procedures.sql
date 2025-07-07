-- Wave 3 Limited - Stored Procedures
-- SQL Server Stored Procedures for Website Management
-- Version: 1.0.0
-- Created: 2024

USE wave3limited;
GO

-- =============================================
-- SERVICES STORED PROCEDURES
-- =============================================

-- Get all active services
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetActiveServices') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetActiveServices
GO

CREATE PROCEDURE website.GetActiveServices
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        service_id,
        title,
        description,
        icon_name,
        display_order,
        created_at,
        updated_at
    FROM website.services 
    WHERE is_active = 1 
    ORDER BY display_order, title;
END;
GO

-- Get service by ID
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetServiceById') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetServiceById
GO

CREATE PROCEDURE website.GetServiceById
    @ServiceId INT
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        service_id,
        title,
        description,
        icon_name,
        display_order,
        is_active,
        created_at,
        updated_at,
        created_by,
        updated_by
    FROM website.services 
    WHERE service_id = @ServiceId;
END;
GO

-- Insert new service
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.InsertService') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.InsertService
GO

CREATE PROCEDURE website.InsertService
    @Title NVARCHAR(255),
    @Description NVARCHAR(MAX),
    @IconName NVARCHAR(100),
    @DisplayOrder INT = 0,
    @CreatedBy NVARCHAR(100) = NULL,
    @ServiceId INT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO website.services (title, description, icon_name, display_order, created_by)
    VALUES (@Title, @Description, @IconName, @DisplayOrder, @CreatedBy);
    
    SET @ServiceId = SCOPE_IDENTITY();
END;
GO

-- Update service
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.UpdateService') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.UpdateService
GO

CREATE PROCEDURE website.UpdateService
    @ServiceId INT,
    @Title NVARCHAR(255),
    @Description NVARCHAR(MAX),
    @IconName NVARCHAR(100),
    @DisplayOrder INT,
    @IsActive BIT,
    @UpdatedBy NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE website.services 
    SET 
        title = @Title,
        description = @Description,
        icon_name = @IconName,
        display_order = @DisplayOrder,
        is_active = @IsActive,
        updated_at = GETDATE(),
        updated_by = @UpdatedBy
    WHERE service_id = @ServiceId;
END;
GO

-- Delete service (soft delete)
CREATE OR ALTER PROCEDURE website.DeleteService
    @ServiceId INT,
    @UpdatedBy NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE website.services 
    SET 
        is_active = 0,
        updated_at = GETDATE(),
        updated_by = @UpdatedBy
    WHERE service_id = @ServiceId;
END;
GO

-- =============================================
-- COMPANIES STORED PROCEDURES
-- =============================================

-- Get all active companies
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetActiveCompanies') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetActiveCompanies
GO

CREATE PROCEDURE website.GetActiveCompanies
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        company_id,
        company_key,
        name,
        tagline,
        description,
        website_url,
        logo_path,
        banner_image_path,
        display_order,
        created_at,
        updated_at
    FROM website.companies 
    WHERE is_active = 1 
    ORDER BY display_order, name;
END;
GO

-- Get company by key
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetCompanyByKey') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetCompanyByKey
GO

CREATE PROCEDURE website.GetCompanyByKey
    @CompanyKey NVARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        company_id,
        company_key,
        name,
        tagline,
        description,
        website_url,
        logo_path,
        banner_image_path,
        display_order,
        is_active,
        created_at,
        updated_at,
        created_by,
        updated_by
    FROM website.companies 
    WHERE company_key = @CompanyKey;
END;
GO

-- Insert new company
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.InsertCompany') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.InsertCompany
GO

CREATE PROCEDURE website.InsertCompany
    @CompanyKey NVARCHAR(50),
    @Name NVARCHAR(255),
    @Tagline NVARCHAR(500),
    @Description NVARCHAR(MAX),
    @WebsiteUrl NVARCHAR(500),
    @LogoPath NVARCHAR(500),
    @BannerImagePath NVARCHAR(500),
    @DisplayOrder INT = 0,
    @CreatedBy NVARCHAR(100) = NULL,
    @CompanyId INT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO website.companies (company_key, name, tagline, description, website_url, logo_path, banner_image_path, display_order, created_by)
    VALUES (@CompanyKey, @Name, @Tagline, @Description, @WebsiteUrl, @LogoPath, @BannerImagePath, @DisplayOrder, @CreatedBy);
    
    SET @CompanyId = SCOPE_IDENTITY();
END;
GO

-- Update company
CREATE OR ALTER PROCEDURE website.UpdateCompany
    @CompanyId INT,
    @CompanyKey NVARCHAR(50),
    @Name NVARCHAR(255),
    @Tagline NVARCHAR(500),
    @Description NVARCHAR(MAX),
    @WebsiteUrl NVARCHAR(500),
    @LogoPath NVARCHAR(500),
    @BannerImagePath NVARCHAR(500),
    @DisplayOrder INT,
    @IsActive BIT,
    @UpdatedBy NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE website.companies 
    SET 
        company_key = @CompanyKey,
        name = @Name,
        tagline = @Tagline,
        description = @Description,
        website_url = @WebsiteUrl,
        logo_path = @LogoPath,
        banner_image_path = @BannerImagePath,
        display_order = @DisplayOrder,
        is_active = @IsActive,
        updated_at = GETDATE(),
        updated_by = @UpdatedBy
    WHERE company_id = @CompanyId;
END;
GO

-- =============================================
-- TEAM MEMBERS STORED PROCEDURES
-- =============================================

-- Get team members by department
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetTeamMembersByDepartment') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetTeamMembersByDepartment
GO

CREATE PROCEDURE website.GetTeamMembersByDepartment
    @Department NVARCHAR(100)
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        member_id,
        name,
        role,
        bio,
        photo_path,
        linkedin_url,
        twitter_url,
        phone,
        whatsapp,
        email,
        department,
        display_order,
        created_at,
        updated_at
    FROM website.team_members 
    WHERE department = @Department AND is_active = 1 
    ORDER BY display_order, name;
END;
GO

-- Get all team members
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetAllTeamMembers') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetAllTeamMembers
GO

CREATE PROCEDURE website.GetAllTeamMembers
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        member_id,
        name,
        role,
        bio,
        photo_path,
        linkedin_url,
        twitter_url,
        phone,
        whatsapp,
        email,
        department,
        display_order,
        is_active,
        created_at,
        updated_at,
        created_by,
        updated_by
    FROM website.team_members 
    ORDER BY department, display_order, name;
END;
GO

-- Insert team member
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.InsertTeamMember') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.InsertTeamMember
GO

CREATE PROCEDURE website.InsertTeamMember
    @Name NVARCHAR(255),
    @Role NVARCHAR(255),
    @Bio NVARCHAR(MAX),
    @PhotoPath NVARCHAR(500),
    @LinkedinUrl NVARCHAR(500),
    @TwitterUrl NVARCHAR(500),
    @Phone NVARCHAR(20),
    @Whatsapp NVARCHAR(20),
    @Email NVARCHAR(255),
    @Department NVARCHAR(100),
    @DisplayOrder INT = 0,
    @CreatedBy NVARCHAR(100) = NULL,
    @MemberId INT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO website.team_members (name, role, bio, photo_path, linkedin_url, twitter_url, phone, whatsapp, email, department, display_order, created_by)
    VALUES (@Name, @Role, @Bio, @PhotoPath, @LinkedinUrl, @TwitterUrl, @Phone, @Whatsapp, @Email, @Department, @DisplayOrder, @CreatedBy);
    
    SET @MemberId = SCOPE_IDENTITY();
END;
GO

-- Update team member
CREATE OR ALTER PROCEDURE website.UpdateTeamMember
    @MemberId INT,
    @Name NVARCHAR(255),
    @Role NVARCHAR(255),
    @Bio NVARCHAR(MAX),
    @PhotoPath NVARCHAR(500),
    @LinkedinUrl NVARCHAR(500),
    @TwitterUrl NVARCHAR(500),
    @Phone NVARCHAR(20),
    @Whatsapp NVARCHAR(20),
    @Email NVARCHAR(255),
    @Department NVARCHAR(100),
    @DisplayOrder INT,
    @IsActive BIT,
    @UpdatedBy NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE website.team_members 
    SET 
        name = @Name,
        role = @Role,
        bio = @Bio,
        photo_path = @PhotoPath,
        linkedin_url = @LinkedinUrl,
        twitter_url = @TwitterUrl,
        phone = @Phone,
        whatsapp = @Whatsapp,
        email = @Email,
        department = @Department,
        display_order = @DisplayOrder,
        is_active = @IsActive,
        updated_at = GETDATE(),
        updated_by = @UpdatedBy
    WHERE member_id = @MemberId;
END;
GO

-- =============================================
-- CONTACT SUBMISSIONS STORED PROCEDURES
-- =============================================

-- Insert contact submission
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.InsertContactSubmission') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.InsertContactSubmission
GO

CREATE PROCEDURE website.InsertContactSubmission
    @Name NVARCHAR(255),
    @Email NVARCHAR(255),
    @Subject NVARCHAR(255),
    @Message NVARCHAR(MAX),
    @IpAddress NVARCHAR(45) = NULL,
    @UserAgent NVARCHAR(500) = NULL,
    @SubmissionId INT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO website.contact_submissions (name, email, subject, message, ip_address, user_agent)
    VALUES (@Name, @Email, @Subject, @Message, @IpAddress, @UserAgent);
    
    SET @SubmissionId = SCOPE_IDENTITY();
END;
GO

-- Get contact submissions with pagination
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'website.GetContactSubmissions') AND type in (N'P', N'PC'))
    DROP PROCEDURE website.GetContactSubmissions
GO

CREATE PROCEDURE website.GetContactSubmissions
    @Page INT = 1,
    @PageSize INT = 20,
    @Status NVARCHAR(20) = NULL,
    @TotalCount INT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    -- Get total count
    SELECT @TotalCount = COUNT(*) 
    FROM website.contact_submissions 
    WHERE (@Status IS NULL OR status = @Status);
    
    -- Get paginated results
    SELECT 
        submission_id,
        name,
        email,
        subject,
        message,
        ip_address,
        user_agent,
        status,
        is_processed,
        processed_at,
        processed_by,
        created_at
    FROM website.contact_submissions 
    WHERE (@Status IS NULL OR status = @Status)
    ORDER BY created_at DESC
    OFFSET (@Page - 1) * @PageSize ROWS
    FETCH NEXT @PageSize ROWS ONLY;
END;
GO

-- Update submission status
CREATE OR ALTER PROCEDURE website.UpdateSubmissionStatus
    @SubmissionId INT,
    @Status NVARCHAR(20),
    @IsProcessed BIT = 0,
    @ProcessedBy NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE website.contact_submissions 
    SET 
        status = @Status,
        is_processed = @IsProcessed,
        processed_at = CASE WHEN @IsProcessed = 1 THEN GETDATE() ELSE processed_at END,
        processed_by = @ProcessedBy
    WHERE submission_id = @SubmissionId;
END;
GO

-- =============================================
-- ADMIN USER STORED PROCEDURES
-- =============================================

-- Authenticate user
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.AuthenticateUser') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.AuthenticateUser
GO

CREATE PROCEDURE admin.AuthenticateUser
    @Username NVARCHAR(100),
    @PasswordHash NVARCHAR(255),
    @UserId INT OUTPUT,
    @UserRole NVARCHAR(50) OUTPUT,
    @IsActive BIT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        @UserId = user_id,
        @UserRole = role,
        @IsActive = is_active
    FROM admin.users 
    WHERE username = @Username AND password_hash = @PasswordHash;
    
    -- Update last login if authentication successful
    IF @UserId IS NOT NULL
    BEGIN
        UPDATE admin.users 
        SET last_login = GETDATE(), login_attempts = 0
        WHERE user_id = @UserId;
    END
    ELSE
    BEGIN
        -- Increment login attempts
        UPDATE admin.users 
        SET login_attempts = login_attempts + 1
        WHERE username = @Username;
    END
END;
GO

-- Create user session
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.CreateUserSession') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.CreateUserSession
GO

CREATE PROCEDURE admin.CreateUserSession
    @SessionId NVARCHAR(255),
    @UserId INT,
    @IpAddress NVARCHAR(45) = NULL,
    @UserAgent NVARCHAR(500) = NULL,
    @ExpiresAt DATETIME2
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO admin.user_sessions (session_id, user_id, ip_address, user_agent, expires_at)
    VALUES (@SessionId, @UserId, @IpAddress, @UserAgent, @ExpiresAt);
END;
GO

-- Validate session
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.ValidateSession') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.ValidateSession
GO

CREATE PROCEDURE admin.ValidateSession
    @SessionId NVARCHAR(255),
    @UserId INT OUTPUT,
    @IsValid BIT OUTPUT
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT @UserId = user_id
    FROM admin.user_sessions 
    WHERE session_id = @SessionId 
      AND expires_at > GETDATE() 
      AND is_active = 1;
    
    SET @IsValid = CASE WHEN @UserId IS NOT NULL THEN 1 ELSE 0 END;
END;
GO

-- Log activity
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.LogActivity') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.LogActivity
GO

CREATE PROCEDURE admin.LogActivity
    @UserId INT = NULL,
    @Action NVARCHAR(100),
    @TableName NVARCHAR(100) = NULL,
    @RecordId INT = NULL,
    @OldValues NVARCHAR(MAX) = NULL,
    @NewValues NVARCHAR(MAX) = NULL,
    @IpAddress NVARCHAR(45) = NULL,
    @UserAgent NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO admin.activity_log (user_id, action, table_name, record_id, old_values, new_values, ip_address, user_agent)
    VALUES (@UserId, @Action, @TableName, @RecordId, @OldValues, @NewValues, @IpAddress, @UserAgent);
END;
GO

-- =============================================
-- ANALYTICS STORED PROCEDURES
-- =============================================

-- Log page view
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'analytics.LogPageView') AND type in (N'P', N'PC'))
    DROP PROCEDURE analytics.LogPageView
GO

CREATE PROCEDURE analytics.LogPageView
    @PageUrl NVARCHAR(500),
    @PageTitle NVARCHAR(255) = NULL,
    @ReferrerUrl NVARCHAR(500) = NULL,
    @IpAddress NVARCHAR(45) = NULL,
    @UserAgent NVARCHAR(500) = NULL,
    @SessionId NVARCHAR(255) = NULL,
    @DeviceType NVARCHAR(50) = NULL,
    @Browser NVARCHAR(100) = NULL,
    @Os NVARCHAR(100) = NULL,
    @Country NVARCHAR(100) = NULL,
    @City NVARCHAR(100) = NULL,
    @LoadTimeMs INT = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO analytics.page_views (page_url, page_title, referrer_url, ip_address, user_agent, session_id, device_type, browser, os, country, city, load_time_ms)
    VALUES (@PageUrl, @PageTitle, @ReferrerUrl, @IpAddress, @UserAgent, @SessionId, @DeviceType, @Browser, @Os, @Country, @City, @LoadTimeMs);
END;
GO

-- Log user interaction
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'analytics.LogUserInteraction') AND type in (N'P', N'PC'))
    DROP PROCEDURE analytics.LogUserInteraction
GO

CREATE PROCEDURE analytics.LogUserInteraction
    @SessionId NVARCHAR(255) = NULL,
    @InteractionType NVARCHAR(100),
    @ElementId NVARCHAR(100) = NULL,
    @ElementText NVARCHAR(255) = NULL,
    @PageUrl NVARCHAR(500) = NULL,
    @IpAddress NVARCHAR(45) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO analytics.user_interactions (session_id, interaction_type, element_id, element_text, page_url, ip_address)
    VALUES (@SessionId, @InteractionType, @ElementId, @ElementText, @PageUrl, @IpAddress);
END;
GO

-- Log performance metric
CREATE OR ALTER PROCEDURE analytics.LogPerformanceMetric
    @PageUrl NVARCHAR(500),
    @MetricType NVARCHAR(50),
    @MetricValue DECIMAL(10,2),
    @DeviceType NVARCHAR(50) = NULL,
    @Browser NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO analytics.performance_metrics (page_url, metric_type, metric_value, device_type, browser)
    VALUES (@PageUrl, @MetricType, @MetricValue, @DeviceType, @Browser);
END;
GO

-- Get analytics dashboard data
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'analytics.GetDashboardData') AND type in (N'P', N'PC'))
    DROP PROCEDURE analytics.GetDashboardData
GO

CREATE PROCEDURE analytics.GetDashboardData
    @StartDate DATETIME2 = NULL,
    @EndDate DATETIME2 = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    IF @StartDate IS NULL SET @StartDate = DATEADD(day, -30, GETDATE());
    IF @EndDate IS NULL SET @EndDate = GETDATE();
    
    -- Page views by day
    SELECT 
        CAST(created_at AS DATE) as date,
        COUNT(*) as page_views,
        COUNT(DISTINCT session_id) as unique_sessions,
        COUNT(DISTINCT ip_address) as unique_visitors
    FROM analytics.page_views 
    WHERE created_at BETWEEN @StartDate AND @EndDate
    GROUP BY CAST(created_at AS DATE)
    ORDER BY date;
    
    -- Top pages
    SELECT TOP 10
        page_url,
        COUNT(*) as views
    FROM analytics.page_views 
    WHERE created_at BETWEEN @StartDate AND @EndDate
    GROUP BY page_url
    ORDER BY views DESC;
    
    -- Device types
    SELECT 
        device_type,
        COUNT(*) as count
    FROM analytics.page_views 
    WHERE created_at BETWEEN @StartDate AND @EndDate
      AND device_type IS NOT NULL
    GROUP BY device_type
    ORDER BY count DESC;
    
    -- Performance metrics
    SELECT 
        metric_type,
        AVG(metric_value) as avg_value,
        MIN(metric_value) as min_value,
        MAX(metric_value) as max_value
    FROM analytics.performance_metrics 
    WHERE created_at BETWEEN @StartDate AND @EndDate
    GROUP BY metric_type;
END;
GO

-- =============================================
-- SETTINGS STORED PROCEDURES
-- =============================================

-- Get website settings
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.GetWebsiteSettings') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.GetWebsiteSettings
GO

CREATE PROCEDURE admin.GetWebsiteSettings
    @IncludePrivate BIT = 0
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        setting_key,
        setting_value,
        setting_type,
        description,
        is_public,
        updated_at,
        updated_by
    FROM admin.website_settings 
    WHERE @IncludePrivate = 1 OR is_public = 1
    ORDER BY setting_key;
END;
GO

-- Update website setting
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.UpdateWebsiteSetting') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.UpdateWebsiteSetting
GO

CREATE PROCEDURE admin.UpdateWebsiteSetting
    @SettingKey NVARCHAR(100),
    @SettingValue NVARCHAR(MAX),
    @UpdatedBy NVARCHAR(100) = NULL
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE admin.website_settings 
    SET 
        setting_value = @SettingValue,
        updated_at = GETDATE(),
        updated_by = @UpdatedBy
    WHERE setting_key = @SettingKey;
END;
GO

-- =============================================
-- MAINTENANCE STORED PROCEDURES
-- =============================================

-- Clean old sessions
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.CleanExpiredSessions') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.CleanExpiredSessions
GO

CREATE PROCEDURE admin.CleanExpiredSessions
AS
BEGIN
    SET NOCOUNT ON;
    
    DELETE FROM admin.user_sessions 
    WHERE expires_at < GETDATE();
    
    PRINT 'Expired sessions cleaned successfully.';
END;
GO

-- Clean old analytics data (older than 1 year)
CREATE OR ALTER PROCEDURE analytics.CleanOldAnalyticsData
    @DaysToKeep INT = 365
AS
BEGIN
    SET NOCOUNT ON;
    
    DECLARE @CutoffDate DATETIME2 = DATEADD(day, -@DaysToKeep, GETDATE());
    
    DELETE FROM analytics.page_views 
    WHERE created_at < @CutoffDate;
    
    DELETE FROM analytics.user_interactions 
    WHERE created_at < @CutoffDate;
    
    DELETE FROM analytics.performance_metrics 
    WHERE created_at < @CutoffDate;
    
    PRINT 'Old analytics data cleaned successfully.';
END;
GO

-- Get database statistics
IF EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'admin.GetDatabaseStats') AND type in (N'P', N'PC'))
    DROP PROCEDURE admin.GetDatabaseStats
GO

CREATE PROCEDURE admin.GetDatabaseStats
AS
BEGIN
    SET NOCOUNT ON;
    
    SELECT 
        'Services' as table_name,
        COUNT(*) as record_count,
        MAX(updated_at) as last_updated
    FROM website.services
    UNION ALL
    SELECT 
        'Companies' as table_name,
        COUNT(*) as record_count,
        MAX(updated_at) as last_updated
    FROM website.companies
    UNION ALL
    SELECT 
        'Team Members' as table_name,
        COUNT(*) as record_count,
        MAX(updated_at) as last_updated
    FROM website.team_members
    UNION ALL
    SELECT 
        'Contact Submissions' as table_name,
        COUNT(*) as record_count,
        MAX(created_at) as last_updated
    FROM website.contact_submissions
    UNION ALL
    SELECT 
        'Page Views' as table_name,
        COUNT(*) as record_count,
        MAX(created_at) as last_updated
    FROM analytics.page_views
    UNION ALL
    SELECT 
        'Users' as table_name,
        COUNT(*) as record_count,
        MAX(updated_at) as last_updated
    FROM admin.users;
END;
GO

PRINT 'All stored procedures created successfully!';
GO 