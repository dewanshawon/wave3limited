<?php
// Database configuration and initialization
$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'wave3limited'
];

// Initialize message and error variables for contact form submission
$message = '';
$error = '';

// Sanitize and validate POST data for contact form submission
function sanitize_post_data($data) {
    return htmlspecialchars(trim($data ?? ''), ENT_QUOTES, 'UTF-8');
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_post_data($_POST['name'] ?? '');
    $email = $_POST['email'] ?? '';
    $subject = sanitize_post_data($_POST['subject'] ?? '');
    $message_content = sanitize_post_data($_POST['message'] ?? '');

    if ($name && is_valid_email($email) && $subject && $message_content) {
        $to = 'support@wave3limited.com, wave3limited@gmail.com';
        $headers = [
            'From' => $name . ' <' . $email . '>',
            'Reply-To' => $email,
            'Content-Type' => 'text/plain; charset=UTF-8',
            'X-Mailer' => 'PHP/' . phpversion()
        ];
        $mail_subject = "Contact Form: " . $subject;
        $mail_body = "Name: $name\nEmail: $email\n\nMessage:\n$message_content";
        
        $headers_str = '';
        foreach ($headers as $key => $value) {
            $headers_str .= "$key: $value\r\n";
        }
        
        if (mail($to, $mail_subject, $mail_body, $headers_str)) {
            $message = "Thank you for your message! We'll get back to you soon.";
        } else {
            $error = "Sorry, there was an error sending your message. Please try again later.";
        }
    } else {
        $error = "Please fill in all required fields with valid data.";
    }
}

// Services data
$services = [
    ['id' => 1, 'title' => 'Web Development', 'description' => 'Custom web applications tailored to your needs', 'icon' => 'lucide:code'],
    ['id' => 2, 'title' => 'Mobile App Development', 'description' => 'iOS and Android apps with cutting-edge features', 'icon' => 'lucide:smartphone'],
    ['id' => 3, 'title' => 'Cloud Solutions', 'description' => 'Scalable and secure cloud infrastructure', 'icon' => 'lucide:cloud'],
    ['id' => 4, 'title' => 'Data Analytics', 'description' => 'Insights from your data to drive business decisions', 'icon' => 'lucide:bar-chart'],
    ['id' => 5, 'title' => 'UI/UX Design', 'description' => 'Beautiful and intuitive user interfaces', 'icon' => 'lucide:palette'],
    ['id' => 6, 'title' => 'Cybersecurity', 'description' => 'Protect your digital assets with our security solutions', 'icon' => 'lucide:shield']
];

// Child companies data
$companies = [
    [
        'key' => 'ruposhee',
        'name' => 'Ruposhee.com',
        'logo' => 'assets/companies/ruposhee.png',
        'tagline' => 'Premier destination for women\'s fashion and beauty products.',
        'website' => 'https://ruposhee.com',
        'image' => 'assets/companies/ruposhee-banner.jpg',
        'description' => 'Your one-stop destination for trendy fashion, beauty products, and lifestyle essentials. Discover a curated collection of products that enhance your beauty and style.'
    ],
    [
        'key' => 'scholarhaat',
        'name' => 'Scholarhaat.com',
        'logo' => 'assets/companies/scholarhaat.png',
        'tagline' => 'Innovative educational platform for quality learning resources.',
        'website' => 'https://scholarhaat.com',
        'image' => 'assets/companies/scholarhaat-banner.jpg',
        'description' => 'Empowering students with comprehensive learning resources, test preparation materials, and educational guidance for academic excellence.'
    ],
    [
        'key' => 'medeasy',
        'name' => 'MediFast.com',
        'logo' => 'assets/companies/medifast.png',
        'tagline' => 'Revolutionary telemedicine platform for healthcare services.',
        'website' => 'https://medeasy.com',
        'image' => 'assets/companies/medifast-banner.jpg',
        'description' => 'Access quality healthcare services from the comfort of your home. Connect with experienced doctors, get prescriptions, and manage your health efficiently.'
    ]
];

// Team members data by categories with phone and WhatsApp
$team = [
    'admin' => [
        [
            'name' => 'Kazi Abu Taher',
            'role' => 'Chairman',
            'photo' => 'assets/adminimg/kazi-abu-taher.png',
            'bio' => 'Visionary leader with over 15 years of experience driving innovation.',
            'linkedin' => 'https://linkedin.com/in/kazi-abu-taher',
            'twitter' => 'https://twitter.com/kaziabutaher',
            'phone' => '+8801711001122',
            'whatsapp' => '+8801711001122'
        ],
        [
            'name' => 'A K M Shafiudduza',
            'role' => 'Managing Director',
            'photo' => 'assets/adminimg/shafiudduza.png',
            'bio' => 'Operations expert ensuring seamless business performance.',
            'linkedin' => 'https://linkedin.com/in/shafiudduza',
            'twitter' => 'https://twitter.com/shafiudduza',
            'phone' => '+8801711003344',
            'whatsapp' => '+8801711003344'
        ],
        [
            'name' => 'Sumona Akter',
            'role' => 'Director, Admin & Finance',
            'photo' => 'assets/adminimg/Shumona.png',
            'bio' => 'Financial strategist with a keen eye for fiscal responsibility.',
            'linkedin' => 'https://linkedin.com/in/sumona-akter',
            'twitter' => 'https://twitter.com/sumonaakter',
            'phone' => '+8801711005566',
            'whatsapp' => '+8801711005566'
        ]
    ],
    'marketing' => [
        [
            'name' => 'Ishtiak Ahmed Anik',
            'role' => 'Marketing Manager',
            'photo' => 'assets/team/ishtiak.png',
            'bio' => 'Creative marketer driving brand growth and engagement.',
            'linkedin' => 'https://linkedin.com/in/ishtiak-anik',
            'twitter' => 'https://twitter.com/ishtiakanik',
            'phone' => '+8801646313137',
            'whatsapp' => '+8801646313137'
        ],
        [
            'name' => 'Shopnil',
            'role' => 'Business Strategist',
            'photo' => 'assets/team/shopnil.png',
            'bio' => 'Crafting compelling content to connect with audiences.',
            'linkedin' => 'https://linkedin.com/in/shopnil',
            'twitter' => 'https://twitter.com/shopnil',
            'phone' => '+8801711009900',
            'whatsapp' => '+8801711009900'
        ],
        [
            'name' => 'Alex Kim',
            'role' => 'Social Media Specialist',
            'photo' => 'assets/team/alex-kim.png',
            'bio' => 'Engaging communities through strategic social channels.',
            'linkedin' => 'https://linkedin.com/in/alexkim',
            'twitter' => 'https://twitter.com/alexkim',
            'phone' => '+8801711011122',
            'whatsapp' => '+8801711011122'
        ]
    ],
    'developer' => [
        [
            'name' => 'Md. Yeasine Dewan Shawon',
            'role' => 'Lead Developer',
            'photo' => 'assets/team/shawon.png',
            'bio' => 'Leading development teams and guiding architecture design.',
            'linkedin' => 'https://bd.linkedin.com/in/md-yeasine-dewan-shawon-07a383210',
            'twitter' => 'https://x.com/yeasinedeawanshawon',
            'phone' => '+8801793244543',
            'whatsapp' => '+8801793244543'
        ],
        [
            'name' => 'Michael Brown',
            'role' => 'Frontend Developer',
            'photo' => 'assets/team/michael-brown.png',
            'bio' => 'Building stunning user experiences and interfaces.',
            'linkedin' => 'https://linkedin.com/in/michaelbrown',
            'twitter' => 'https://twitter.com/michaelbrown',
            'phone' => '+8801711015566',
            'whatsapp' => '+8801711015566'
        ],
        [
            'name' => 'Pavel Bodda',
            'role' => 'Designer(Learner)',
            'photo' => 'assets/team/pavel.png',
            'bio' => 'Developing scalable and robust server-side solutions.',
            'linkedin' => 'https://linkedin.com/in/pavelbodda',
            'twitter' => 'https://twitter.com/pavelbodda',
            'phone' => '+8801711017788',
            'whatsapp' => '+8801711017788'
        ],
        [
            'name' => 'Emma Wilson',
            'role' => 'Backend Developer',
            'photo' => 'assets/team/emma-wilson.png',
            'bio' => 'Developing scalable and robust server-side solutions.',
            'linkedin' => 'https://linkedin.com/in/emmawilson',
            'twitter' => 'https://twitter.com/emmawilson',
            'phone' => '+8801711017788',
            'whatsapp' => '+8801711017788'
        ]
    ]
];

// Function to check if image exists and return default if not
function getTeamMemberImage($photo_path) {
    if (file_exists($photo_path)) {
        return $photo_path;
    }
    return 'assets/team/default-avatar.png'; // Default avatar image
}

// Function to get company logo
function getCompanyLogo($company_key) {
    $logo_path = "assets/companies/{$company_key}-logo.png";
    if (file_exists($logo_path)) {
        return $logo_path;
    }
    return 'assets/WAVElogo01.png'; // Default company logo
}

// Function to get service icon
function getServiceIcon($icon_name) {
    return $icon_name; // Return the iconify icon name
}

// Function to optimize image path
function optimizeImagePath($path) {
    // Remove any leading slashes
    $path = ltrim($path, '/');
    
    // Ensure the path exists
    if (!file_exists($path)) {
        return 'assets/team/default-avatar.png';
    }
    
    return $path;
}

// Sanitize 'page' query parameter and default to 'home'
$current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) ?? 'home';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Wave 3 Limited</title>
  
  <!-- Primary Meta Tags -->
  <meta name="title" content="Wave 3 Limited | Leading IT Solutions & Digital Services in Bangladesh">
  <meta name="description" content="Wave 3 Limited is a premier technology company in Bangladesh, specializing in web development, mobile apps, cloud solutions, data analytics, UI/UX design, and cybersecurity. Transform your business with our innovative digital solutions.">
  <meta name="keywords" content="Wave 3 Limited, web development Bangladesh, mobile app development, cloud solutions, data analytics, UI/UX design, cybersecurity, IT company Dhaka, software development, digital transformation, e-commerce solutions, enterprise software, Bangladesh technology, Dhaka IT services">
  <meta name="author" content="Wave 3 Limited">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="language" content="English">
  <meta name="revisit-after" content="7 days">
  <meta name="distribution" content="global">
  <meta name="rating" content="general">
  <meta name="theme-color" content="#2563eb">
  <meta name="msapplication-TileColor" content="#2563eb">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="Wave 3 Limited">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://www.wave3limited.com/" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Wave 3 Limited">
  <meta property="og:url" content="https://www.wave3limited.com/">
  <meta property="og:title" content="Wave 3 Limited | Leading IT Solutions & Digital Services in Bangladesh">
  <meta property="og:description" content="Transform your business with Wave 3 Limited's cutting-edge technology solutions. Web development, mobile apps, cloud solutions, and more. Leading IT company in Bangladesh.">
  <meta property="og:image" content="https://www.wave3limited.com/assets/WAVElogo01.png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Wave 3 Limited - Leading Technology Solutions">
  <meta property="og:locale" content="en_US">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@wave3limited">
  <meta name="twitter:creator" content="@wave3limited">
  <meta name="twitter:url" content="https://www.wave3limited.com/">
  <meta name="twitter:title" content="Wave 3 Limited | Leading IT Solutions & Digital Services in Bangladesh">
  <meta name="twitter:description" content="Transform your business with Wave 3 Limited's cutting-edge technology solutions. Web development, mobile apps, cloud solutions, and more.">
  <meta name="twitter:image" content="https://www.wave3limited.com/assets/WAVElogo01.png">
  <meta name="twitter:image:alt" content="Wave 3 Limited - Leading Technology Solutions">

  <!-- Additional SEO Meta Tags -->
  <meta name="geo.region" content="BD">
  <meta name="geo.placename" content="Dhaka">
  <meta name="geo.position" content="23.8103;90.4125">
  <meta name="ICBM" content="23.8103, 90.4125">
  <meta name="DC.title" content="Wave 3 Limited - IT Solutions Bangladesh">
  <meta name="DC.creator" content="Wave 3 Limited">
  <meta name="DC.subject" content="Information Technology, Software Development, Digital Solutions">
  <meta name="DC.description" content="Leading technology company providing comprehensive IT solutions in Bangladesh">
  <meta name="DC.publisher" content="Wave 3 Limited">
  <meta name="DC.contributor" content="Wave 3 Limited Team">
  <meta name="DC.date" content="2024">
  <meta name="DC.type" content="Service">
  <meta name="DC.format" content="text/html">
  <meta name="DC.identifier" content="https://www.wave3limited.com/">
  <meta name="DC.language" content="en">
  <meta name="DC.coverage" content="Bangladesh">
  <meta name="DC.rights" content="Copyright 2024 Wave 3 Limited">

  <!-- Schema.org Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Wave 3 Limited",
    "alternateName": "Wave3 Limited",
    "url": "https://www.wave3limited.com/",
    "logo": {
      "@type": "ImageObject",
      "url": "https://www.wave3limited.com/assets/WAVElogo01.png",
      "width": 300,
      "height": 100
    },
    "image": "https://www.wave3limited.com/assets/WAVElogo01.png",
    "description": "Wave 3 Limited is a leading technology company in Bangladesh, offering comprehensive IT solutions including web development, mobile app development, cloud solutions, data analytics, UI/UX design, and cybersecurity services.",
    "foundingDate": "2020",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "1188/2/B East Shewrapara, Kafrul, Mirpur",
      "addressLocality": "Dhaka",
      "postalCode": "1216",
      "addressCountry": "BD",
      "addressRegion": "Dhaka"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 23.8103,
      "longitude": 90.4125
    },
    "contactPoint": [
      {
        "@type": "ContactPoint",
        "telephone": "+8801711019152",
        "contactType": "customer service",
        "areaServed": "BD",
        "availableLanguage": ["English", "Bengali"],
        "hoursAvailable": {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          "opens": "09:00",
          "closes": "18:00"
        }
      },
      {
        "@type": "ContactPoint",
        "telephone": "+8801711019152",
        "contactType": "sales",
        "areaServed": "BD"
      }
    ],
    "email": "info@wave3limited.com",
    "sameAs": [
      "https://linkedin.com/company/wave3limited",
      "https://twitter.com/wave3limited",
      "https://facebook.com/wave3limited"
    ],
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "IT Services",
      "itemListElement": [
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Web Development",
            "description": "Custom web applications and websites tailored to business needs"
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Mobile App Development",
            "description": "iOS and Android mobile applications with cutting-edge features"
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Cloud Solutions",
            "description": "Scalable and secure cloud infrastructure services"
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Data Analytics",
            "description": "Business intelligence and data analytics solutions"
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "UI/UX Design",
            "description": "User interface and user experience design services"
          }
        },
        {
          "@type": "Offer",
          "itemOffered": {
            "@type": "Service",
            "name": "Cybersecurity",
            "description": "Comprehensive cybersecurity and data protection solutions"
          }
        }
      ]
    },
    "areaServed": {
      "@type": "Country",
      "name": "Bangladesh"
    },
    "serviceArea": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 23.8103,
        "longitude": 90.4125
      },
      "geoRadius": "50000"
    }
  }
  </script>

  <!-- Additional Structured Data for Local Business -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "Wave 3 Limited",
    "image": "https://www.wave3limited.com/assets/WAVElogo01.png",
    "description": "Leading technology company providing IT solutions in Bangladesh",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "1188/2/B East Shewrapara, Kafrul, Mirpur",
      "addressLocality": "Dhaka",
      "postalCode": "1216",
      "addressCountry": "BD"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 23.8103,
      "longitude": 90.4125
    },
    "url": "https://www.wave3limited.com/",
    "telephone": "+8801711019152",
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday", 
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
      ],
      "opens": "09:00",
      "closes": "18:00"
    },
    "priceRange": "$$",
    "currenciesAccepted": "BDT, USD",
    "paymentAccepted": "Cash, Credit Card, Bank Transfer"
  }
  </script>

  <!-- WebSite Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Wave 3 Limited",
    "url": "https://www.wave3limited.com/",
    "description": "Official website of Wave 3 Limited - Leading IT Solutions in Bangladesh",
    "publisher": {
      "@type": "Organization",
      "name": "Wave 3 Limited"
    },
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://www.wave3limited.com/?s={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>

  <!-- Performance Optimizations -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link rel="preconnect" href="https://code.iconify.design">
  <link rel="dns-prefetch" href="//images.unsplash.com">
  
  <!-- Preload Critical Resources -->
  <link rel="preload" href="assets/WAVElogo01.png" as="image" type="image/png">
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/@heroui/react@2.7.9/dist/index.css" as="style">
  <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
  
  <!-- Font Optimization -->
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"></noscript>

  <!-- Favicon and App Icons -->
  <link rel="icon" type="image/png" sizes="32x32" href="assets/WAVElogo01.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/WAVElogo01.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/WAVElogo01.png">
  <link rel="manifest" href="/manifest.json">
  
  <!-- Security Headers -->
  <meta http-equiv="X-Content-Type-Options" content="nosniff">
  <meta http-equiv="X-Frame-Options" content="DENY">
  <meta http-equiv="X-XSS-Protection" content="1; mode=block">
  <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
  <meta http-equiv="Permissions-Policy" content="camera=(), microphone=(), geolocation=()">
  
  <!-- Viewport and Mobile Optimizations -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta name="format-detection" content="telephone=no">
  <meta name="mobile-web-app-capable" content="yes">
  
  <!-- PWA Meta Tags -->
  <meta name="application-name" content="Wave 3 Limited">
  <meta name="msapplication-TileImage" content="assets/WAVElogo01.png">
  <meta name="msapplication-config" content="/browserconfig.xml">
  
  <!-- Social Media Verification -->
  <meta name="google-site-verification" content="your-google-verification-code">
  <meta name="facebook-domain-verification" content="your-facebook-verification-code">
  <meta name="twitter:site" content="@wave3limited">
  
  <!-- Analytics and Tracking -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'GA_MEASUREMENT_ID', {
      'page_title': 'Wave 3 Limited - IT Solutions Bangladesh',
      'page_location': window.location.href
    });
  </script>
  
  <!-- Facebook Pixel -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', 'YOUR_PIXEL_ID');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=YOUR_PIXEL_ID&ev=PageView&noscript=1"/></noscript>

  <link href="https://cdn.jsdelivr.net/npm/@heroui/react@2.7.9/dist/index.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="assets/WAVElogo01.png" />
  <style>
    /* CSS Containment for Performance */
    :root {
      --primary: #2563eb;
      --primary-dark: #1e40af;
      --primary-light: #3b82f6;
      --background: #ffffff;
      --foreground: #1f2937;
      --content1: #f9fafb;
      --content2: #ffffff;
      --content3: #d1d5db;
      --header-height: 80px;
      --header-bg: rgba(255, 255, 255, 0.85);
      --header-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      --header-blur: saturate(180%) blur(12px);
      --mobile-menu-width: 280px;
      --mobile-menu-padding: 1rem;
      --mobile-menu-item-height: 3.5rem;
      --transition-fast: 0.2s ease;
      --transition-normal: 0.3s ease;
      --transition-slow: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
      --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.15);
      --shadow-xl: 0 12px 32px rgba(0, 0, 0, 0.2);
    }
    
    [data-theme="dark"] {
      --primary: #3b82f6;
      --primary-dark: #2563eb;
      --primary-light: #60a5fa;
      --background: #111827;
      --foreground: #f3f4f6;
      --content1: #1e293b;
      --content2: #1f2937;
      --content3: #374151;
      --header-bg: rgba(17, 24, 39, 0.85);
      --header-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
    }
    
    /* Performance Optimizations */
    * {
      box-sizing: border-box;
    }
    
    html {
      scroll-behavior: smooth;
      scroll-padding-top: var(--header-height);
    }
    
    body {
      background-color: var(--background);
      color: var(--foreground);
      font-family: 'Inter', 'SF Pro', 'Segoe UI', -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
      transition: background-color var(--transition-normal), color var(--transition-normal);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-rendering: optimizeLegibility;
      contain: layout style paint;
    }
    
    /* Header Optimizations */
    header {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: var(--header-height);
      background: var(--header-bg);
      backdrop-filter: var(--header-blur);
      -webkit-backdrop-filter: var(--header-blur);
      box-shadow: var(--header-shadow);
      z-index: 1000;
      transition: all var(--transition-slow);
      contain: layout style paint;
      will-change: transform, background-color, box-shadow;
    }
    
    header.scrolled {
      --header-bg: rgba(255, 255, 255, 0.95);
      --header-shadow: 0 6px 30px rgba(0, 0, 0, 0.15);
    }
    
    [data-theme="dark"] header.scrolled {
      --header-bg: rgba(17, 24, 39, 0.95);
    }
    
    nav {
      max-width: 1280px;
      height: 100%;
      margin: 0 auto;
      padding: 0 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      contain: layout style;
    }
    
    .logo {
      font-size: 1.75rem;
      font-weight: 800;
      color: var(--primary);
      text-decoration: none;
      user-select: none;
      transition: all var(--transition-normal);
      display: flex;
      align-items: center;
      gap: 0.75rem;
      contain: layout style;
      will-change: transform, color;
    }
    
    .logo:hover,
    .logo:focus {
      color: var(--primary-dark);
      transform: translateY(-1px);
      outline: none;
    }
    
    .logo img {
      height: 55px;
      width: auto;
      object-fit: contain;
      contain: layout style paint;
    }
    
    .nav-links-desktop {
      display: flex;
      gap: 2rem;
      align-items: center;
      contain: layout style;
    }
    
    .nav-link {
      position: relative;
      font-weight: 600;
      font-size: 1.05rem;
      color: var(--foreground);
      text-decoration: none;
      padding: 0.5rem 0;
      transition: color var(--transition-normal);
      user-select: none;
      cursor: pointer;
      contain: layout style;
      will-change: color;
    }
    
    .nav-link::after {
      content: '';
      position: absolute;
      left: 0; bottom: 0;
      width: 0;
      height: 2px;
      background-color: var(--primary);
      border-radius: 2px;
      transition: width var(--transition-slow);
      will-change: width;
    }
    
    .nav-link:hover,
    .nav-link:focus {
      color: var(--primary);
      outline: none;
    }
    
    .nav-link:hover::after,
    .nav-link:focus::after,
    .nav-link.active::after {
      width: 100%;
    }
    
    /* Mobile Menu Optimizations */
    .mobile-menu-toggle {
      display: none;
      background: none;
      border: none;
      cursor: pointer;
      color: var(--foreground);
      padding: 0.75rem;
      border-radius: 0.5rem;
      transition: all var(--transition-normal);
      position: relative;
      z-index: 1001;
      contain: layout style;
      will-change: transform, background-color;
    }
    
    .mobile-menu-toggle:hover,
    .mobile-menu-toggle:focus {
      color: var(--primary);
      background-color: rgba(59, 130, 246, 0.1);
      outline: none;
      transform: scale(1.05);
    }
    
    .mobile-menu-toggle .iconify {
      transition: transform var(--transition-normal);
      will-change: transform;
    }
    
    .mobile-menu-toggle[aria-expanded="true"] .iconify {
      transform: rotate(90deg);
    }
    
    #dark-mode-toggle {
      color: var(--foreground);
      box-shadow: 0 0 8px 2px var(--primary);
      transition: box-shadow var(--transition-normal), transform var(--transition-normal);
      animation: pulse 2.5s infinite;
      contain: layout style;
      will-change: transform, box-shadow;
    }
    
    #dark-mode-toggle:hover,
    #dark-mode-toggle:focus {
      background-color: rgba(59, 130, 246, 0.15);
      outline: none;
      box-shadow: 0 0 12px 4px var(--primary);
      transform: scale(1.1);
    }
    
    #mobile-menu {
      position: fixed;
      top: 0;
      right: -100%;
      width: var(--mobile-menu-width);
      height: 100vh;
      background: var(--header-bg);
      backdrop-filter: var(--header-blur);
      -webkit-backdrop-filter: var(--header-blur);
      box-shadow: -4px 0 30px rgba(0, 0, 0, 0.15);
      z-index: 1000;
      transition: right var(--transition-slow);
      overflow-y: auto;
      padding: calc(var(--header-height) + 1rem) var(--mobile-menu-padding) var(--mobile-menu-padding);
      contain: layout style paint;
      will-change: right;
    }
    
    #mobile-menu.show {
      right: 0;
    }
    
    #mobile-menu a {
      display: block;
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--content3);
      font-weight: 600;
      font-size: 1.1rem;
      color: var(--foreground);
      text-decoration: none;
      transition: all var(--transition-normal);
      border-radius: 0.5rem;
      margin-bottom: 0.5rem;
      contain: layout style;
      will-change: transform, background-color;
    }
    
    #mobile-menu a:hover,
    #mobile-menu a:focus {
      background-color: var(--content1);
      color: var(--primary);
      transform: translateX(0.5rem);
      outline: none;
    }
    
    #mobile-menu a.active {
      background-color: var(--primary);
      color: white;
    }
    
    /* Hero Section Optimizations */
    .hero-section {
      position: relative;
      background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1950&amp;q=80');
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      color: white;
      text-align: center;
      padding: 8rem 1rem 12rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 1.25rem;
      user-select: none;
      contain: layout style paint;
      will-change: transform;
    }
    
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.55);
      z-index: 1;
      contain: layout style;
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 900px;
      animation: fadeInSlideUp 0.8s ease forwards;
      contain: layout style;
    }
    
    .hero-title {
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      font-weight: 900;
      text-shadow: 0 4px 12px rgba(0,0,0,0.7);
      margin-bottom: 0.25rem;
      user-select: text;
      line-height: 1.2;
    }
    
    .hero-subtitle {
      font-size: clamp(1.1rem, 2.5vw, 1.375rem);
      opacity: 0.85;
      margin-bottom: 2.5rem;
      user-select: text;
      line-height: 1.5;
    }
    
    .hero-button {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      font-weight: 700;
      font-size: 1.2rem;
      padding: 1.2rem 3rem;
      border-radius: 9999px;
      text-decoration: none;
      transition: all var(--transition-slow);
      box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
      border: 2px solid transparent;
      user-select: none;
      position: relative;
      overflow: hidden;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      contain: layout style;
      will-change: transform, box-shadow;
    }
    
    .hero-button:hover,
    .hero-button:focus {
      background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 12px 28px rgba(37, 99, 235, 0.4);
      outline: none;
    }
    
    .hero-button:active {
      transform: translateY(-1px) scale(0.98);
    }
    
    /* Section Title Optimizations */
    .section-title {
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 900;
      text-align: center;
      margin-bottom: 3rem;
      text-shadow: 0 2px 6px rgba(0,0,0,0.1);
      color: var(--foreground);
      cursor: default;
      position: relative;
      display: inline-block;
      user-select: none;
      transition: color var(--transition-normal);
      contain: layout style;
      will-change: color;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      width: 50%;
      height: 3px;
      background: var(--primary);
      bottom: -8px;
      left: 25%;
      border-radius: 2px;
      transition: width var(--transition-normal);
      will-change: width;
    }
    
    .section-title:hover,
    .section-title:focus {
      color: var(--primary);
      outline: none;
    }
    
    .section-title:hover::after,
    .section-title:focus::after {
      width: 100%;
      left: 0;
    }
    
    /* Grid Layouts with Performance */
    .grid-services,
    .grid-companies,
    .grid-team-members {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto 4rem;
      padding: 0 1rem;
      contain: layout style;
    }
    
    /* Card Optimizations */
    .service-card,
    .company-card,
    .team-member,
    .sister-card-custom {
      background: var(--content2);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: var(--shadow-md);
      transition: transform var(--transition-slow), box-shadow var(--transition-slow);
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      cursor: default;
      user-select: none;
      contain: layout style;
      will-change: transform, box-shadow;
    }
    
    .service-card:hover,
    .service-card:focus-within,
    .company-card:hover,
    .company-card:focus-within,
    .team-member:hover,
    .team-member:focus-within,
    .sister-card-custom:hover,
    .sister-card-custom:focus-within {
      box-shadow: var(--shadow-xl);
      transform: translateY(-12px) scale(1.03);
      outline: none;
      z-index: 2;
    }
    
    /* Image Optimizations */
    .team-photo,
    .sister-card-image,
    .sister-card-logo {
      object-fit: cover;
      border-radius: 50%;
      transition: transform var(--transition-normal);
      contain: layout style paint;
      will-change: transform;
    }
    
    .team-photo:hover,
    .sister-card-image:hover {
      transform: scale(1.05);
    }
    
    /* Form Optimizations */
    form {
      max-width: 500px;
      margin: auto;
      contain: layout style;
    }
    
    input, textarea {
      width: 100%;
      padding: 0.75rem 1.25rem;
      border: 1.5px solid var(--content3);
      border-radius: 0.75rem;
      font-size: 1.05rem;
      color: var(--foreground);
      background-color: var(--content2);
      transition: border-color var(--transition-normal), box-shadow var(--transition-normal);
      font-family: inherit;
      resize: vertical;
      contain: layout style;
      will-change: border-color, box-shadow;
    }
    
    input:focus, textarea:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3.5px rgba(59, 130, 246, 0.35);
    }
    
    button[type="submit"] {
      margin-top: 1rem;
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1rem;
      border-radius: 0.75rem;
      font-weight: 700;
      font-size: 1.1rem;
      cursor: pointer;
      width: 100%;
      box-shadow: 0 8px 20px rgba(59, 130, 246, 0.75);
      transition: background-color var(--transition-normal), box-shadow var(--transition-normal), transform var(--transition-normal);
      user-select: none;
      contain: layout style;
      will-change: transform, box-shadow;
    }
    
    button[type="submit"]:hover,
    button[type="submit"]:focus {
      background-color: var(--primary-dark);
      box-shadow: 0 12px 28px rgba(59, 130, 246, 0.95);
      outline: none;
      transform: scale(1.05);
    }
    
    /* Footer Optimizations */
    footer {
      background-color: var(--content2);
      padding-top: 3rem;
      padding-bottom: 3rem;
      box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
      user-select: none;
      contain: layout style;
    }
    
    .footer-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 1.5rem;
      contain: layout style;
    }
    
    .footer-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 2.5rem;
      margin-bottom: 3rem;
      color: var(--foreground);
      contain: layout style;
    }
    
    /* Responsive Design Optimizations */
    @media (max-width: 1024px) {
      .nav-links-desktop {
        gap: 1.5rem;
      }
      .nav-link {
        font-size: 1rem;
      }
    }
    
    @media (max-width: 768px) {
      .nav-links-desktop {
        display: none;
      }
      .mobile-menu-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .logo {
        font-size: 1.5rem;
      }
      header {
        --header-height: 70px;
      }
      .hero-section {
        background-attachment: scroll;
      }
    }
    
    @media (max-width: 480px) {
      nav {
        padding: 0 1rem;
      }
      .logo {
        font-size: 1.25rem;
      }
      header {
        --header-height: 60px;
      }
      #mobile-menu {
        width: 100%;
        --mobile-menu-padding: 0.75rem;
      }
      #mobile-menu a {
        height: 3rem;
        font-size: 1rem;
      }
    }
    
    /* Animation Optimizations */
    @keyframes fadeInSlideUp {
      0% {
        opacity: 0;
        transform: translateY(32px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes pulse {
      0% {
        box-shadow: 0 0 8px 2px var(--primary);
      }
      50% {
        box-shadow: 0 0 12px 4px var(--primary);
      }
      100% {
        box-shadow: 0 0 8px 2px var(--primary);
      }
    }
    
    @keyframes fadeInSlideDown {
      0% {
        opacity: 0;
        transform: translateY(-20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInSlideRight {
      0% {
        opacity: 0;
        transform: translateX(-20px);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    @keyframes fadeInSlideLeft {
      0% {
        opacity: 0;
        transform: translateX(20px);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    /* Header animation */
    header {
      animation: fadeInSlideDown 1s ease forwards;
    }
    
    /* Logo animation */
    .logo {
      animation: fadeInSlideRight 1s ease forwards;
      opacity: 0;
    }
    
    /* Nav links animation */
    .nav-links-desktop {
      animation: fadeInSlideLeft 1s ease forwards;
      opacity: 0;
      animation-delay: 0.3s;
    }
    
    /* Loading States */
    .loading {
      opacity: 0.7;
      pointer-events: none;
    }
    
    .loading::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 20px;
      height: 20px;
      margin: -10px 0 0 -10px;
      border: 2px solid var(--primary);
      border-top-color: transparent;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
    
    /* Focus Management */
    .focus-visible {
      outline: 2px solid var(--primary);
      outline-offset: 2px;
    }
    
    /* Print Styles */
    @media print {
      header, footer, #dark-mode-toggle {
        display: none !important;
      }
      
      body {
        background: white !important;
        color: black !important;
      }
      
      .hero-section {
        background: none !important;
        color: black !important;
      }
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- Header -->
  <header role="banner" tabindex="0">
    <nav>
      <a href="?page=home" class="logo" aria-label="Wave 3 Limited homepage" tabindex="0">
        <img src="assets/WAVElogo01.png" alt="Wave 3 Limited logo" style="height: 55px; width: auto; margin-right: 0.75rem; object-fit: contain;" loading="lazy" decoding="async" />
        <!--<span class="iconify logo-icon" data-icon="lucide:waves" aria-hidden="true"></span>-->
        Wave 3 Limited
      </a>
      <div class="nav-links-desktop" role="menubar" aria-label="Primary navigation">
        <?php
          $nav_items = [
            'home' => 'Home',
            'services' => 'Services',
            'companies' => 'Sister Concern',
            'team' => 'Team',
            'contact' => 'Contact'
          ];
          foreach ($nav_items as $page => $label) {
            $active = ($current_page === $page) ? 'active' : '';
            echo '<a href="?page='.$page.'" class="nav-link '.$active.'" role="menuitem" tabindex="0">'.htmlspecialchars($label).'</a>';
          }
        ?>
      </div>
      <button
        class="mobile-menu-toggle"
        aria-controls="mobile-menu"
        aria-expanded="false"
        aria-label="Toggle menu"
        onclick="toggleMenu()"
        tabindex="0"
      >
        <span class="iconify" data-icon="lucide:menu" style="font-size: 24px;"></span>
      </button>
    </nav>
    <div id="mobile-menu" role="menu" aria-label="Mobile navigation" tabindex="-1">
      <?php
        foreach ($nav_items as $page => $label) {
          $active = ($current_page === $page) ? 'active' : '';
          echo '<a href="?page='.$page.'" class="nav-link '.$active.'" role="menuitem" tabindex="-1">'.htmlspecialchars($label).'</a>';
        }
      ?>
    </div>
  </header>

  <!-- Main Content -->
  <main role="main">

  <?php if ($current_page === 'home'): ?>
    <section class="hero-section" aria-label="Homepage hero">
      <div class="hero-overlay" aria-hidden="true"></div>
      <div class="hero-content" tabindex="0">
        <h1 class="hero-title">Welcome to Wave 3 Limited</h1>
        <p class="hero-subtitle">Innovative solutions for your modern business needs.</p>
        <a href="?page=services" class="hero-button" role="button" >Explore Our Services</a>
      </div>
    </section>

  <?php elseif ($current_page === 'services'): ?>
    <section aria-label="Our services" class="py-16">
      <h2 class="section-title" tabindex="0">Our Services</h2>
      <div class="grid-services">
        <?php foreach ($services as $service): ?>
          <article class="service-card" tabindex="0" aria-labelledby="service-title-<?php echo $service['id']; ?>">
            <span class="iconify service-icon" data-icon="<?php echo getServiceIcon($service['icon']); ?>" aria-hidden="true"></span>
            <h3 id="service-title-<?php echo $service['id']; ?>" class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
            <p class="service-description"><?php echo htmlspecialchars($service['description']); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <?php elseif ($current_page === 'companies'): ?>
    <section aria-label="Sister Concern" class="py-20 bg-content1">
      <h2 class="section-title" tabindex="0">Our Sister Concerns</h2>
      <div class="sister-cards-container">
        <?php foreach ($companies as $company): ?>
            <div class="sister-card sister-card-custom">
              <div class="sister-card-img">
                <img src="<?php echo htmlspecialchars($company['image']); ?>" alt="<?php echo htmlspecialchars($company['name']); ?> banner" loading="lazy" class="sister-card-image" />
                <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="<?php echo htmlspecialchars($company['name']); ?> logo" loading="lazy" class="sister-card-logo" />
              </div>
              <div class="sister-card-body">
                <h3 class="sister-card-title"><?php echo htmlspecialchars($company['name']); ?></h3>
                <p class="sister-card-tagline"><?php echo htmlspecialchars($company['tagline']); ?></p>
                <p class="sister-card-description"><?php echo htmlspecialchars($company['description']); ?></p>
                <a href="<?php echo htmlspecialchars($company['website']); ?>" target="_blank" rel="noopener" class="sister-card-btn">
                  Visit for more
                  <span class="iconify sister-card-btn-arrow" data-icon="lucide:arrow-right" aria-hidden="true"></span>
                </a>
              </div>
            </div>
        <?php endforeach; ?>
      </div>
    </section>

  <?php elseif ($current_page === 'team'): ?>
    <section class="team-tabs" aria-label="Meet our team" tabindex="0">
      <h2 class="section-title">Meet Our Team</h2>
      <div class="tabs-buttons" role="tablist" aria-label="Team categories">
        <button role="tab" id="tab-admin" aria-controls="panel-admin" aria-selected="true" tabindex="0" class="tab-button focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary">Admin Team</button>
        <button role="tab" id="tab-marketing" aria-controls="panel-marketing" aria-selected="false" tabindex="-1" class="tab-button focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary">Marketing Team</button>
        <button role="tab" id="tab-developer" aria-controls="panel-developer" aria-selected="false" tabindex="-1" class="tab-button focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary">Developer Team</button>
      </div>
      <div id="panel-admin" role="tabpanel" aria-labelledby="tab-admin" tabindex="0">
        <div class="grid-team-members">
          <?php foreach ($team['admin'] as $member): ?>
            <article class="team-member" tabindex="0" aria-labelledby="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>">
              <img src="<?php echo getTeamMemberImage($member['photo']); ?>" alt="Photo of <?php echo htmlspecialchars($member['name']); ?>, <?php echo htmlspecialchars($member['role']); ?>" class="team-photo" loading="lazy" decoding="async" />
              <h3 id="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>" class="team-name"><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role"><?php echo htmlspecialchars($member['role']); ?></p>
              <p class="team-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="contact-icons" aria-label="Contact phone and WhatsApp for <?php echo htmlspecialchars($member['name']); ?>">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" aria-label="Phone number <?php echo htmlspecialchars($member['phone']); ?>" title="Call <?php echo htmlspecialchars($member['name']); ?>">
                  <span class="iconify" data-icon="lucide:phone" aria-hidden="true"></span>
                </a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp number <?php echo htmlspecialchars($member['whatsapp']); ?>" title="WhatsApp <?php echo htmlspecialchars($member['name']); ?>">
                  <span class="iconify" data-icon="lucide:message-square" aria-hidden="true"></span>
                </a>
              </div>
              <div class="social-links" aria-label="Social profiles of <?php echo htmlspecialchars($member['name']); ?>">
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile" tabindex="0">
                    <span class="iconify" data-icon="lucide:linkedin" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter profile" tabindex="0">
                    <span class="iconify" data-icon="lucide:twitter" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="panel-marketing" role="tabpanel" aria-labelledby="tab-marketing" tabindex="-1" hidden>
        <div class="grid-team-members">
          <?php foreach ($team['marketing'] as $member): ?>
            <article class="team-member" tabindex="0" aria-labelledby="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>">
              <img src="<?php echo getTeamMemberImage($member['photo']); ?>" alt="Photo of <?php echo htmlspecialchars($member['name']); ?>, <?php echo htmlspecialchars($member['role']); ?>" class="team-photo" loading="lazy" decoding="async" />
              <h3 id="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>" class="team-name"><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role"><?php echo htmlspecialchars($member['role']); ?></p>
              <p class="team-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="contact-icons" aria-label="Contact phone and WhatsApp for <?php echo htmlspecialchars($member['name']); ?>">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" aria-label="Phone number <?php echo htmlspecialchars($member['phone']); ?>" title="Call <?php echo htmlspecialchars($member['name']); ?>">
                  <span class="iconify" data-icon="lucide:phone" aria-hidden="true"></span>
                </a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp number <?php echo htmlspecialchars($member['whatsapp']); ?>" title="WhatsApp <?php echo htmlspecialchars($member['name']); ?>">
                  <span class="iconify" data-icon="lucide:message-square" aria-hidden="true"></span>
                </a>
              </div>
              <div class="social-links" aria-label="Social profiles of <?php echo htmlspecialchars($member['name']); ?>">
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile" tabindex="0">
                    <span class="iconify" data-icon="lucide:linkedin" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter profile" tabindex="0">
                    <span class="iconify" data-icon="lucide:twitter" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="panel-developer" role="tabpanel" aria-labelledby="tab-developer" tabindex="-1" hidden>
        <div class="grid-team-members">
          <?php foreach ($team['developer'] as $member): ?>
            <article class="team-member" tabindex="0" aria-labelledby="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>">
              <img src="<?php echo getTeamMemberImage($member['photo']); ?>" alt="Photo of <?php echo htmlspecialchars($member['name']); ?>, <?php echo htmlspecialchars($member['role']); ?>" class="team-photo" loading="lazy" decoding="async" />
              <h3 id="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>" class="team-name"><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role"><?php echo htmlspecialchars($member['role']); ?></p>
              <p class="team-bio"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="contact-icons" aria-label="Contact phone and WhatsApp for <?php echo htmlspecialchars($member['name']); ?>">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" aria-label="Phone number <?php echo htmlspecialchars($member['phone']); ?>" title="Call <?php echo htmlspecialchars($member['name']); ?>">
                  <span class="iconify" data-icon="lucide:phone" aria-hidden="true"></span>
                </a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp number <?php echo htmlspecialchars($member['whatsapp']); ?>" title="WhatsApp <?php echo htmlspecialchars($member['name']); ?>">
                  <span class="iconify" data-icon="lucide:message-square" aria-hidden="true"></span>
                </a>
              </div>
              <div class="social-links" aria-label="Social profiles of <?php echo htmlspecialchars($member['name']); ?>">
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile" tabindex="0">
                    <span class="iconify" data-icon="lucide:linkedin" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter profile" tabindex="0">
                    <span class="iconify" data-icon="lucide:twitter" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  <?php elseif ($current_page === 'contact'): ?>
    <section aria-label="Contact us" class="py-16 bg-content1">
      <h2 class="section-title" tabindex="0">Contact Us</h2>
      <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 px-4">
        <div>
          <h3 class="text-2xl font-semibold mb-6" tabindex="0">Get in Touch</h3>
          <p class="text-foreground/80 mb-8" tabindex="0">
            Have a question or want to work together? We'd love to hear from you.
            Fill out the form and we'll get back to you as soon as possible.
          </p>
          <address class="not-italic space-y-5 mb-8" aria-label="Contact information for Wave 3 Limited">
            <div class="flex items-center gap-3">
              <span class="iconify text-primary w-6 h-6" data-icon="lucide:map-pin" aria-hidden="true"></span>
              <span>1188/2/B East Shewrapara, Kafrul, Mirpur, Dhaka-1216, Bangladesh</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="iconify text-primary w-6 h-6" data-icon="lucide:phone" aria-hidden="true"></span>
              <a href="tel:+8801711019152" class="hover:text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">+880 1711-019152</a>
              <a href="https://wa.me/8801711019152" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Chat" class="hover:text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <span class="iconify w-6 h-6" data-icon="lucide:message-square"></span>
              </a>
            </div>
            <div class="flex items-center gap-3">
              <span class="iconify text-primary w-6 h-6" data-icon="lucide:mail" aria-hidden="true"></span>
              <a href="mailto:info@wave3limited.com" class="hover:text-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">info@wave3limited.com</a>
            </div>
          </address>
        </div>
        <div>
          <form method="POST" action="?page=contact#contact" class="hero-card" aria-describedby="form-message" novalidate>
            <?php if ($message): ?>
              <div id="form-message" class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg" role="alert" tabindex="0">
                <?php echo htmlspecialchars($message); ?>
              </div>
            <?php endif; ?>
            <?php if ($error): ?>
              <div id="form-message" class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg" role="alert" tabindex="0">
                <?php echo htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autocomplete="name" aria-required="true" class="hero-input mb-6" />
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email" aria-required="true" class="hero-input mb-6" />
            
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required aria-required="true" class="hero-input mb-6" />
            
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4" required aria-required="true" class="hero-input mb-6"></textarea>
            
            <button type="submit" class="hero-button w-full" aria-label="Send message">Send Message</button>
          </form>
        </div>
      </div>
    </section>

  <?php else: ?>
    <section class="min-h-screen flex items-center justify-center">
      <h2 class="text-3xl font-bold">Page Not Found</h2>
    </section>
  <?php endif; ?>
  </main>

  <footer role="contentinfo" class="footer-advanced">
    <div class="footer-main-adv">
      <div class="footer-grid-adv">
        <section class="footer-brand-adv">
          <img src="assets/WAVElogo01.png" alt="Wave 3 Limited logo" class="footer-logo-adv" loading="lazy" />
          <div>
            <p class="footer-desc-adv">Wave 3 Limited delivers innovative IT solutions with integrity and passion, empowering businesses in Bangladesh and beyond.</p>
            <span class="footer-tagline-adv">Professional IT Solutions for a Digital World</span>
          </div>
        </section>
        <nav class="footer-links-adv" aria-label="Footer quick links">
          <h3 class="footer-title-adv">Quick Links</h3>
          <ul>
            <?php foreach ($nav_items as $page => $label): ?>
              <li><a href="?page=<?php echo $page; ?>" class="footer-link-adv"><?php echo htmlspecialchars($label); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </nav>
        <section class="footer-contact-adv">
          <h3 class="footer-title-adv">Contact</h3>
          <ul class="footer-contact-list-adv">
            <li><span class="iconify" data-icon="lucide:map-pin"></span> 1188/2/B East Shewrapara, Kafrul, Mirpur, Dhaka-1216</li>
            <li><span class="iconify" data-icon="lucide:phone"></span> <a href="tel:+8801711019152">+880 1711-019152</a></li>
            <li><span class="iconify" data-icon="lucide:mail"></span> <a href="mailto:info@wave3limited.com">info@wave3limited.com</a></li>
          </ul>
        </section>
        <section class="footer-newsletter-adv" aria-label="Newsletter subscription">
          <h3 class="footer-title-adv">Newsletter</h3>
          <form class="newsletter-form-adv" autocomplete="off" onsubmit="event.preventDefault(); showNewsletterSuccess(this);">
            <label for="newsletter-email-adv" class="sr-only">Email address</label>
            <input type="email" id="newsletter-email-adv" name="email" placeholder="Your email address" required aria-required="true" />
            <input type="text" name="website" class="newsletter-honeypot" tabindex="-1" autocomplete="off" style="display:none;" aria-hidden="true" />
            <button type="submit" aria-label="Subscribe">
              <span class="iconify" data-icon="lucide:send"></span>
            </button>
          </form>
          <div class="newsletter-success-adv" style="display:none;">Thank you for subscribing!</div>
          <p class="newsletter-hint-adv">Get updates & offers. No spam.</p>
        </section>
        <section class="footer-social-adv">
          <h3 class="footer-title-adv">Follow Us</h3>
          <div class="footer-socials-adv" aria-label="Social media links">
            <a href="https://facebook.com/wave3limited" aria-label="Facebook" target="_blank" rel="noopener" title="Facebook"><span class="iconify" data-icon="lucide:facebook"></span></a>
            <a href="https://twitter.com/wave3limited" aria-label="Twitter" target="_blank" rel="noopener" title="Twitter"><span class="iconify" data-icon="lucide:twitter"></span></a>
            <a href="https://instagram.com/wave3limited" aria-label="Instagram" target="_blank" rel="noopener" title="Instagram"><span class="iconify" data-icon="lucide:instagram"></span></a>
            <a href="https://linkedin.com/company/wave3limited" aria-label="LinkedIn" target="_blank" rel="noopener" title="LinkedIn"><span class="iconify" data-icon="lucide:linkedin"></span></a>
          </div>
        </section>
      </div>
    </div>
    <div class="footer-divider-adv" aria-hidden="true"></div>
    <div class="footer-bottom-bar-adv">
      <div class="footer-bottom-content-adv">
        <span>&copy; <?php echo date('Y'); ?> Wave 3 Limited. All rights reserved.</span>
        <span class="footer-legal-links-adv">
          <a href="#" tabindex="0">Privacy Policy</a>
          <span aria-hidden="true">|</span>
          <a href="#" tabindex="0">Terms of Service</a>
        </span>
      </div>
    </div>
  </footer>

  <!-- Floating Dark Mode Toggle Button -->
  <button id="dark-mode-toggle" aria-label="Toggle dark mode" title="Toggle dark mode" class="dark-toggle-adv" type="button">
    <span id="dark-mode-icon" class="iconify" data-icon="lucide:moon" style="font-size: 24px;"></span>
  </button>

  <style>
    .footer-advanced {
      background: linear-gradient(135deg, var(--content2) 60%, var(--primary-light) 100%);
      color: var(--foreground);
      box-shadow: 0 -4px 24px rgba(0,0,0,0.08);
      margin-top: 4rem;
      font-size: 1rem;
      font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
    }
    .footer-main-adv {
      max-width: 1280px;
      margin: 0 auto;
      padding: 3rem 1.5rem 1.5rem 1.5rem;
    }
    .footer-grid-adv {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 2.5rem;
      align-items: flex-start;
      border-bottom: 1px solid var(--content3);
      animation: fadeInSlideUp 0.8s;
    }
    .footer-brand-adv {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 1.2rem;
      min-width: 220px;
    }
    .footer-logo-adv {
      width: 70px;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(37,99,235,0.08);
      margin-bottom: 0.5rem;
      background: #fff;
      transition: box-shadow 0.3s;
    }
    .footer-logo-adv:hover, .footer-logo-adv:focus {
      box-shadow: 0 4px 16px rgba(37,99,235,0.18);
    }
    .footer-desc-adv {
      font-size: 1.05rem;
      color: var(--foreground);
      opacity: 0.85;
      margin-bottom: 0.5rem;
      line-height: 1.6;
    }
    .footer-tagline-adv {
      font-size: 0.98rem;
      color: var(--primary);
      font-weight: 600;
      letter-spacing: 0.01em;
      margin-top: 0.2rem;
      display: block;
    }
    .footer-title-adv {
      font-size: 1.15rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--primary);
      letter-spacing: 0.01em;
    }
    .footer-links-adv ul, .footer-contact-list-adv {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .footer-link-adv {
      color: var(--foreground);
      text-decoration: none;
      display: block;
      margin-bottom: 0.5rem;
      transition: color 0.2s, background 0.2s, padding 0.2s;
      font-weight: 500;
      border-radius: 0.3rem;
      padding: 0.2rem 0.1rem;
      position: relative;
    }
    .footer-link-adv:hover, .footer-link-adv:focus {
      color: var(--primary-dark);
      background: rgba(37,99,235,0.08);
      outline: none;
      text-decoration: underline;
      padding-left: 0.5rem;
    }
    .footer-contact-list-adv li {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      margin-bottom: 0.5rem;
      color: var(--foreground);
      opacity: 0.9;
      font-size: 1rem;
    }
    .footer-contact-list-adv a {
      color: var(--primary);
      text-decoration: none;
      transition: color 0.2s;
    }
    .footer-contact-list-adv a:hover, .footer-contact-list-adv a:focus {
      color: var(--primary-dark);
      text-decoration: underline;
    }
    .footer-newsletter-adv {
      display: flex;
      flex-direction: column;
      gap: 0.7rem;
    }
    .newsletter-form-adv {
      display: flex;
      gap: 0.5rem;
      align-items: center;
      background: var(--content1);
      border-radius: 0.7rem;
      padding: 0.3rem 0.5rem;
      box-shadow: 0 1px 4px rgba(37,99,235,0.07);
      border: 1px solid var(--content3);
      position: relative;
      animation: fadeInSlideUp 0.8s;
    }
    .newsletter-form-adv input[type="email"] {
      border: none;
      background: transparent;
      padding: 0.6rem 0.5rem;
      font-size: 1rem;
      color: var(--foreground);
      flex: 1;
      outline: none;
    }
    .newsletter-form-adv input[type="email"]:invalid {
      box-shadow: none;
    }
    .newsletter-form-adv button {
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 0.5rem;
      padding: 0.5rem 0.7rem;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(37,99,235,0.08);
    }
    .newsletter-form-adv button:hover, .newsletter-form-adv button:focus {
      background: var(--primary-dark);
      transform: scale(1.08);
      outline: none;
    }
    .newsletter-hint-adv {
      font-size: 0.95rem;
      color: var(--foreground);
      opacity: 0.7;
      margin-top: 0.2rem;
    }
    .newsletter-success-adv {
      background: #d1fae5;
      color: #065f46;
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
      margin-top: 0.5rem;
      font-size: 1rem;
      text-align: left;
      animation: fadeInSlideUp 0.5s;
    }
    .newsletter-honeypot { display: none !important; }
    .footer-socials-adv {
      display: flex;
      gap: 1rem;
      margin-top: 0.5rem;
    }
    .footer-socials-adv a {
      color: var(--primary);
      font-size: 1.5rem;
      transition: color 0.2s, transform 0.2s, background 0.2s;
      border-radius: 50%;
      padding: 0.3rem;
      background: var(--content1);
      box-shadow: 0 1px 4px rgba(37,99,235,0.07);
      position: relative;
      outline: none;
    }
    .footer-socials-adv a:hover, .footer-socials-adv a:focus {
      color: #fff;
      background: var(--primary-dark);
      transform: scale(1.12) rotate(-8deg);
      outline: 2px solid var(--primary-dark);
    }
    .footer-socials-adv a[title]:hover::after, .footer-socials-adv a[title]:focus::after {
      content: attr(title);
      position: absolute;
      left: 50%;
      bottom: 120%;
      transform: translateX(-50%);
      background: var(--primary-dark);
      color: #fff;
      padding: 0.2rem 0.7rem;
      border-radius: 0.3rem;
      font-size: 0.95rem;
      white-space: nowrap;
      opacity: 0.95;
      pointer-events: none;
      z-index: 10;
    }
    .footer-divider-adv {
      width: 100%;
      height: 1px;
      background: var(--content3);
      margin: 0 auto;
      opacity: 0.5;
    }
    .footer-bottom-bar-adv {
      background: transparent;
      color: var(--foreground);
      padding: 0.7rem 0;
      font-size: 0.98rem;
      text-align: center;
    }
    .footer-bottom-content-adv {
      max-width: 1280px;
      margin: 0 auto;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      padding: 0 1.5rem;
    }
    .footer-legal-links-adv {
      color: var(--primary);
      font-size: 0.98rem;
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }
    .footer-legal-links-adv a {
      color: var(--primary);
      opacity: 0.85;
      margin: 0 0.1rem;
      text-decoration: underline;
      transition: opacity 0.2s;
    }
    .footer-legal-links-adv a:hover, .footer-legal-links-adv a:focus {
      opacity: 1;
      text-decoration: none;
      outline: none;
    }
    @media (max-width: 900px) {
      .footer-main-adv {
        padding: 2rem 1rem 1rem 1rem;
      }
      .footer-grid-adv {
        gap: 1.5rem;
      }
      .footer-bottom-content-adv {
        flex-direction: column;
        gap: 0.5rem;
        padding: 0 1rem;
      }
    }
    @media (max-width: 600px) {
      .footer-main-adv {
        padding: 1.5rem 0.5rem 0.5rem 0.5rem;
      }
      .footer-grid-adv {
        grid-template-columns: 1fr;
        gap: 1.2rem;
      }
      .footer-brand-adv {
        align-items: center;
        text-align: center;
      }
    }
    [data-theme="dark"] .footer-advanced {
      background: linear-gradient(135deg, var(--content2) 60%, var(--primary-dark) 100%);
      color: var(--foreground);
    }
    [data-theme="dark"] .footer-link-adv {
      color: var(--foreground);
    }
    [data-theme="dark"] .footer-link-adv:hover, [data-theme="dark"] .footer-link-adv:focus {
      color: var(--primary-light);
      background: rgba(59,130,246,0.08);
    }
    [data-theme="dark"] .footer-bottom-bar-adv {
      background: transparent;
      color: var(--foreground);
    }
    /* Floating Dark Mode Toggle */
    .dark-toggle-adv {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      z-index: 1200;
      background: var(--content2);
      color: var(--foreground);
      border: none;
      border-radius: 50%;
      box-shadow: 0 4px 24px rgba(37,99,235,0.18);
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s, color 0.3s, box-shadow 0.3s, transform 0.2s;
      cursor: pointer;
      font-size: 1.5rem;
      outline: none;
      animation: fadeInSlideUp 0.7s;
    }
    .dark-toggle-adv:hover, .dark-toggle-adv:focus {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 8px 32px rgba(37,99,235,0.28);
      transform: scale(1.08);
      outline: 2px solid var(--primary-dark);
    }
    [data-theme="dark"] .dark-toggle-adv {
      background: var(--content1);
      color: var(--primary-light);
    }
    [data-theme="dark"] .dark-toggle-adv:hover, [data-theme="dark"] .dark-toggle-adv:focus {
      background: var(--primary-dark);
      color: #fff;
    }
    @media (max-width: 600px) {
      .dark-toggle-adv {
        bottom: 1rem;
        right: 1rem;
        width: 48px;
        height: 48px;
        font-size: 1.2rem;
      }
    }
    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0,0,0,0);
      border: 0;
    }
  </style>
  <script>
    // Newsletter success message handler
    function showNewsletterSuccess(form) {
      const input = form.querySelector('input[type="email"]');
      const honeypot = form.querySelector('input[name="website"]');
      const success = form.parentElement.querySelector('.newsletter-success-adv');
      if (honeypot && honeypot.value) return; // bot detected
      if (input && input.value && input.validity.valid) {
        success.style.display = 'block';
        setTimeout(() => { success.style.display = 'none'; }, 3500);
        form.reset();
      } else {
        input.focus();
      }
    }
    // Floating dark mode toggle logic
    (function() {
      const toggle = document.getElementById('dark-mode-toggle');
      const htmlEl = document.documentElement;
      const icon = document.getElementById('dark-mode-icon');
      function setTheme(theme) {
        htmlEl.setAttribute('data-theme', theme);
        if (theme === 'dark') {
          icon.setAttribute('data-icon', 'lucide:sun');
          toggle.setAttribute('aria-label', 'Switch to light mode');
          toggle.title = 'Switch to light mode';
        } else {
          icon.setAttribute('data-icon', 'lucide:moon');
          toggle.setAttribute('aria-label', 'Switch to dark mode');
          toggle.title = 'Switch to dark mode';
        }
        localStorage.setItem('theme', theme);
        // Update meta theme-color
        const metaThemeColor = document.querySelector('meta[name="theme-color"]');
        if (metaThemeColor) {
          metaThemeColor.setAttribute('content', theme === 'dark' ? '#111827' : '#2563eb');
        }
      }
      toggle.addEventListener('click', () => {
        const currentTheme = htmlEl.getAttribute('data-theme');
        setTheme(currentTheme === 'dark' ? 'light' : 'dark');
      });
      // Initialize theme
      try {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
          setTheme(savedTheme);
        } else {
          setTheme(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        }
      } catch (e) {}
    })();
  </script>

    <script>
      // Performance and UX Optimizations
      'use strict';
      
      // Service Worker Registration for PWA
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
          navigator.serviceWorker.register('/sw.js')
            .then(registration => {
              console.log('SW registered: ', registration);
            })
            .catch(registrationError => {
              console.log('SW registration failed: ', registrationError);
            });
        });
      }
      
      // Intersection Observer for animations
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, observerOptions);
      
      // Observe all cards and sections
      document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.service-card, .company-card, .team-member, .sister-card-custom');
        cards.forEach(card => {
          card.style.opacity = '0';
          card.style.transform = 'translateY(30px)';
          card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
          observer.observe(card);
        });
      });
      
      // Header scroll effect with throttling
      const header = document.querySelector('header');
      let ticking = false;
      
      function updateHeader() {
        if (window.scrollY > 50) {
          header.classList.add('scrolled');
        } else {
          header.classList.remove('scrolled');
        }
        ticking = false;
      }
      
      window.addEventListener('scroll', () => {
        if (!ticking) {
          requestAnimationFrame(updateHeader);
          ticking = true;
        }
      });
      
      // Mobile menu with improved accessibility
      function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        const button = document.querySelector('[aria-controls="mobile-menu"]');
        const isShown = menu.classList.toggle('show');
        
        button.setAttribute('aria-expanded', isShown.toString());
        document.body.style.overflow = isShown ? 'hidden' : '';
        
        if (isShown) {
          menu.querySelector('a')?.focus();
          // Trap focus in mobile menu
          const focusableElements = menu.querySelectorAll('a, button, input, textarea, select');
          const firstElement = focusableElements[0];
          const lastElement = focusableElements[focusableElements.length - 1];
          
          menu.addEventListener('keydown', trapFocus);
          
          function trapFocus(e) {
            if (e.key === 'Tab') {
              if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                  e.preventDefault();
                  lastElement.focus();
                }
              } else {
                if (document.activeElement === lastElement) {
                  e.preventDefault();
                  firstElement.focus();
                }
              }
            }
          }
        } else {
          menu.removeEventListener('keydown', trapFocus);
        }
      }
      
      // Close mobile menu on outside click
      document.addEventListener('click', (e) => {
        const menu = document.getElementById('mobile-menu');
        const button = document.querySelector('[aria-controls="mobile-menu"]');
        if (menu.classList.contains('show') && !menu.contains(e.target) && !button.contains(e.target)) {
          toggleMenu();
        }
      });
      
      // Close mobile menu on escape key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && document.getElementById('mobile-menu').classList.contains('show')) {
          toggleMenu();
        }
      });
      
      // Close mobile menu on link click
      document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => toggleMenu());
      });
      
      // Tab functionality with keyboard navigation
      document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab-button');
        const tabPanels = document.querySelectorAll('[role="tabpanel"]');
        
        tabs.forEach((tab, i) => {
          tab.addEventListener('click', () => activateTab(i));
          tab.addEventListener('keydown', e => {
            if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
              e.preventDefault();
              let newIndex = e.key === 'ArrowRight' ? i + 1 : i - 1;
              if (newIndex < 0) newIndex = tabs.length - 1;
              if (newIndex >= tabs.length) newIndex = 0;
              tabs[newIndex].focus();
              activateTab(newIndex);
            }
          });
        });
        
        function activateTab(activeIndex) {
          tabs.forEach((tab, i) => {
            const selected = i === activeIndex;
            tab.setAttribute('aria-selected', selected);
            tab.setAttribute('tabindex', selected ? '0' : '-1');
            tabPanels[i].hidden = !selected;
            tabPanels[i].setAttribute('tabindex', selected ? '0' : '-1');
          });
        }
      });
      
      // Active navigation highlighting
      const navLinks = [...document.querySelectorAll('.nav-link')];
      const currentUrl = new URL(window.location.href);
      const currentPage = currentUrl.searchParams.get('page') || 'home';
      
      navLinks.forEach(link => {
        const hrefPage = new URL(link.href).searchParams.get('page') || 'home';
        if (hrefPage === currentPage) link.classList.add('active');
      });
      
      // Dark mode toggle with localStorage persistence
      const toggle = document.getElementById('dark-mode-toggle');
      const htmlEl = document.documentElement;
      const icon = document.getElementById('dark-mode-icon');
      
      function setTheme(theme) {
        try {
          htmlEl.setAttribute('data-theme', theme);
          if (theme === 'dark') {
            icon.setAttribute('data-icon', 'lucide:sun');
            toggle.setAttribute('aria-label', 'Switch to light mode');
          } else {
            icon.setAttribute('data-icon', 'lucide:moon');
            toggle.setAttribute('aria-label', 'Switch to dark mode');
          }
          localStorage.setItem('theme', theme);
          
          // Update meta theme-color
          const metaThemeColor = document.querySelector('meta[name="theme-color"]');
          if (metaThemeColor) {
            metaThemeColor.setAttribute('content', theme === 'dark' ? '#111827' : '#2563eb');
          }
        } catch (e) {
          console.error('Error setting theme:', e);
        }
      }
      
      // Debounced theme toggle
      let debounceTimeout = null;
      toggle.addEventListener('click', () => {
        if (debounceTimeout) return;
        debounceTimeout = setTimeout(() => {
          debounceTimeout = null;
        }, 300);
        
        const currentTheme = htmlEl.getAttribute('data-theme');
        setTheme(currentTheme === 'dark' ? 'light' : 'dark');
      });
      
      // Initialize theme
      (function() {
        try {
          const savedTheme = localStorage.getItem('theme');
          if (savedTheme) {
            setTheme(savedTheme);
          } else {
            setTheme(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
          }
        } catch (e) {
          console.error('Error loading theme:', e);
        }
      })();
      
      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      });
      
      // Form validation and submission
      const contactForm = document.querySelector('form[method="POST"]');
      if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
          const submitBtn = this.querySelector('button[type="submit"]');
          const originalText = submitBtn.textContent;
          
          // Show loading state
          submitBtn.textContent = 'Sending...';
          submitBtn.disabled = true;
          submitBtn.classList.add('loading');
          
          // Re-enable after 3 seconds if no response
          setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            submitBtn.classList.remove('loading');
          }, 3000);
        });
      }
      
      // Lazy loading for images
      if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              const img = entry.target;
              img.src = img.dataset.src;
              img.classList.remove('lazy');
              imageObserver.unobserve(img);
            }
          });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
          imageObserver.observe(img);
        });
      }
      
      // Performance monitoring
      window.addEventListener('load', () => {
        if ('performance' in window) {
          const perfData = performance.getEntriesByType('navigation')[0];
          const loadTime = perfData.loadEventEnd - perfData.loadEventStart;
          console.log(`Page load time: ${loadTime}ms`);
          
          // Send to analytics if needed
          if (typeof gtag !== 'undefined') {
            gtag('event', 'timing_complete', {
              name: 'load',
              value: loadTime
            });
          }
        }
      });
      
      // Error tracking
      window.addEventListener('error', (e) => {
        console.error('JavaScript error:', e.error);
        // Send to error tracking service if needed
      });
      
      // Smooth transition for theme change
      document.documentElement.style.transition = 'background-color 0.3s ease, color 0.3s ease';
      
      // Preload critical resources
      function preloadResource(href, as) {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.href = href;
        link.as = as;
        document.head.appendChild(link);
      }
      
      // Preload next page resources
      const currentPage = window.location.search.includes('page=') ? 
        window.location.search.split('page=')[1].split('&')[0] : 'home';
      
      if (currentPage === 'home') {
        preloadResource('?page=services', 'fetch');
      }
    </script>
</body>
</html>

