# Wave 3 Limited - Advanced IT Solutions Platform

# website link: wave3limited.com

A modern, robust, and scalable PHP-based website for Wave 3 Limited, a leading technology company in Bangladesh. This platform showcases IT services, team profiles, and business units, with advanced performance, security, and PWA features.

---

## 🚀 Key Features

- **Progressive Web App (PWA):** Installable, offline-capable, and mobile-friendly
- **Advanced SEO:** Semantic HTML, meta tags, Open Graph, Twitter Cards, and Schema.org
- **Performance Optimized:** Lazy loading, image optimization, caching, and Core Web Vitals
- **Accessibility:** WCAG 2.1 compliance, keyboard navigation, and ARIA labels
- **Dark/Light Mode:** User theme preference with smooth transitions
- **Interactive UI:** Animations, micro-interactions, and responsive layouts
- **Admin Panel:** Secure admin dashboard for content and team management
- **Contact & Team:** Dynamic team section, contact forms, and social integrations
- **Security:** Hardened headers, input sanitization, and best practices
- **Database Ready:** SQL schema and stored procedures for scalable data management

---

## 📱 Mobile Responsive Design

### **🎯 Professional Hamburger Menu**
- **Smooth Slide-in Animation:** Right-to-left slide with backdrop blur effect
- **Complete Navigation:** All pages (Home, Services, Sister Concern, Team, Contact) accessible
- **Contact Integration:** Direct phone and email links in mobile menu
- **Social Media Links:** Facebook, Twitter, Instagram, WhatsApp, LinkedIn with branded colors
- **Overlay Effect:** Semi-transparent overlay when menu is open
- **Staggered Animations:** Menu items appear with sequential delays for professional feel
- **Touch-Friendly:** Minimum 44px touch targets for optimal mobile interaction

### **📐 Responsive Breakpoints**
- **Desktop (1024px+):** Full navigation bar with hover effects
- **Tablet (768px - 1024px):** Optimized layouts with adjusted spacing
- **Mobile (480px - 768px):** Hamburger menu with touch-optimized interactions
- **Small Mobile (360px - 480px):** Compact design with enhanced readability
- **Extra Small (< 360px):** Minimalist layout for very small screens

### **🎨 Mobile Optimizations**
- **Typography Scaling:** Responsive font sizes using `clamp()` for optimal readability
- **Touch Targets:** All interactive elements meet 44px minimum size requirement
- **Form Optimization:** 16px font size prevents iOS zoom on input focus
- **Card Layouts:** Flexible grid systems that adapt to screen size
- **Image Optimization:** Responsive images with proper aspect ratios
- **Landscape Support:** Optimized layouts for mobile landscape orientation

### **⚡ Performance Features**
- **CSS Containment:** Optimized rendering performance with layout/style containment
- **Will-change Properties:** GPU acceleration for smooth animations
- **Lazy Loading:** Images and non-critical resources loaded on demand
- **Minimal Repaints:** Efficient CSS transitions and transforms
- **Touch Device Detection:** Specific optimizations for touch vs mouse interactions

### **♿ Accessibility Enhancements**
- **Keyboard Navigation:** Full keyboard support for mobile menu
- **Focus Management:** Proper focus trapping and restoration
- **ARIA Labels:** Comprehensive screen reader support
- **High Contrast:** Maintained accessibility in both light and dark modes
- **Touch Feedback:** Visual feedback for all touch interactions

### **🔧 Technical Implementation**
- **CSS Grid to Flexbox:** Responsive layout system that adapts to screen size
- **CSS Custom Properties:** Theme-aware responsive design variables
- **JavaScript Enhancements:** Smooth animations and interaction handling
- **Progressive Enhancement:** Core functionality works without JavaScript
- **Cross-browser Compatibility:** Tested across all modern browsers and devices

### **📊 Mobile-First Features**
- **Hero Section:** Responsive background images and text scaling
- **Service Cards:** Adaptive grid layouts for different screen sizes
- **Team Section:** Optimized member cards with touch-friendly contact buttons
- **Contact Forms:** Mobile-optimized input fields and submission
- **Footer:** Responsive grid layout with accessible social links

---

## 📁 Project Structure

```
wave3v3/
├── index.php                # Main entry point, homepage, and router
├── manifest.json            # PWA manifest
├── sw.js                    # Service worker for offline/PWA
├── robots.txt               # SEO robots file
├── sitemap.xml              # XML sitemap for search engines
├── browserconfig.xml        # Windows tile configuration
├── README.md                # Project documentation
├── assets/                  # Static assets (images, icons, banners)
│   ├── adminimg/            # Admin team member photos
│   ├── devimg/              # Developer team member photos
│   ├── icons/               # Social and contact icons (PNG)
│   ├── marketimg/           # Marketing images
│   ├── sisters/             # Sister concern banners/logos
│   ├── team/                # Default and other team avatars
│   └── ...                  # Other images (banners, logos)
├── admin/
│   ├── includes/
│   │   ├── header.php       # Admin header
│   │   └── footer.php       # Admin footer
│   ├── index.php            # Admin dashboard entry
│   └── pages/
│       └── dashboard.php    # Admin dashboard page
├── includes/
│   ├── contact-section.php  # Contact section logic/UI
│   ├── data.php             # Data arrays for team, companies, etc.
│   ├── Database.php         # Database connection and helpers
│   ├── form-handler.php     # Contact form processing
│   └── team-section.php     # Team section logic/UI
├── database/
│   ├── README.md            # Database setup instructions
│   ├── schema.sql           # SQL schema for tables
│   ├── setup.php            # PHP script for DB setup
│   └── stored_procedures.sql# SQL stored procedures
└── cgi-bin/                 # (Optional) CGI scripts
```

---

## 🛠️ Setup & Deployment

### Prerequisites
- PHP 7.4+
- Apache/Nginx web server (mod_rewrite enabled for Apache)
- MySQL/MariaDB (for database features)
- SSL certificate (recommended for production)

### Installation Steps
1. **Clone the Repository**
   ```bash
   git clone [repository-url]
   cd wave3v3
   ```
2. **Configure Web Server**
   - For Apache: ensure `.htaccess` is set up for clean URLs
   - For Nginx: configure `try_files` for index.php routing
   - Enable HTTPS/SSL
3. **Database Setup (Optional)**
   - Import `database/schema.sql` and `database/stored_procedures.sql` into your MySQL/MariaDB instance
   - Update DB credentials in `includes/Database.php`
   - Run `database/setup.php` if needed
4. **Environment Configuration**
   - Set analytics IDs, verification codes, and environment variables in `index.php` or a `.env` file
   - Update company/team data in `includes/data.php` as needed
5. **Assets**
   - Place your images/logos in the appropriate `assets/` subfolders
6. **PWA & SEO**
   - Update `manifest.json` and `sw.js` for your brand/app
   - Submit `sitemap.xml` to Google Search Console
   - Update meta tags and verification codes in `index.php`

### Local Development
- Use PHP built-in server:
  ```bash
  php -S localhost:8000
  ```
- Or use XAMPP/WAMP/LAMP and place files in the web root

### Testing
- Test PWA installability and offline mode in Chrome DevTools
- Validate SEO with Lighthouse and PageSpeed Insights
- Check accessibility and responsive design on multiple devices
- Test contact forms and admin panel features

---

## 🗄️ Database Structure

- **Tables:** `team_members`, `companies`, `contact_messages`, etc.
- **Stored Procedures:** For CRUD operations (see `database/stored_procedures.sql`)
- **Setup:**
  - Import SQL files
  - Use `includes/Database.php` for DB connection
- **Admin Panel:**
  - Manage team, companies, and content via `admin/pages/dashboard.php`

---

## 👥 Team & Admin Features

- **Team Section:**
  - Dynamic, categorized (Admin, Marketing, Developer)
  - Contact icons: Phone, WhatsApp, Email, LinkedIn, Twitter, Facebook, Instagram
  - Data-driven from `includes/data.php` or database
- **Admin Panel:**
  - Secure login (expandable)
  - Dashboard for managing team, companies, and site content
  - Modular includes for easy extension
- **Contact Section:**
  - Advanced contact form with validation and anti-spam
  - Social/contact icons and company info

---

## 🌐 SEO & PWA

- **SEO:**
  - Meta tags, Open Graph, Twitter Cards, Schema.org
  - XML sitemap, robots.txt, canonical URLs
  - Image alt tags, semantic HTML, fast loading
- **PWA:**
  - `manifest.json` for app install
  - `sw.js` for offline and caching
  - App-like experience on mobile

---

## 🔒 Security & Best Practices

- Input sanitization and validation
- Secure headers (CSP, X-Frame-Options, etc.)
- File upload restrictions (if enabled)
- Regular dependency and code updates
- Error handling and custom error pages

---

## 🧩 Customization & Extensibility

- **Branding:**
  - Update logos, colors, and banners in `assets/`
  - Edit CSS variables for theme changes
- **Content:**
  - Update team, services, and companies in `includes/data.php` or via admin panel
- **Features:**
  - Add new sections/pages by extending `index.php` and `includes/`
  - Expand database and admin features as needed

---

## 🧪 Troubleshooting & FAQ

- **Blank Page/Error:** Check PHP error logs and file permissions
- **PWA Not Installing:** Ensure HTTPS and valid `manifest.json`
- **Contact Form Not Sending:** Check mail server config and `includes/form-handler.php`
- **Database Issues:** Verify DB credentials and import status
- **Asset Not Loading:** Confirm file paths and case sensitivity

---

## 🤝 Contributing

- Fork the repository and create a feature branch
- Follow PSR-12 coding standards for PHP
- Use clear, descriptive commit messages
- Submit pull requests with detailed descriptions
- For major changes, open an issue first to discuss

---

## 📞 Support & Contact

- Email: info@wave3limited.com
- Phone: +880 1711-019152
- Website: [https://www.wave3limited.com](https://www.wave3limited.com)

---

## 📄 License

This project is proprietary software owned by Wave 3 Limited. All rights reserved.

---

## 🕒 Version History

### v1.0.0 (Current)
- Initial release with advanced features
- PWA, SEO, and performance optimizations
- Modular admin and team management
- Security and accessibility enhancements

---

**Developed with ❤️ by the Wave 3 Limited Lead developer Md. Yeaasine Dewan Shawon** 
