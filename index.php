<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
// Database configuration and initialization
$db_config = [
    'host' => 'wave3limited.com',
    'username' => 'root',
    'password' => '',
    'database' => 'wave3limited'
];

// Initialize message and error variables for contact form submission
$message = '';
$error = '';

// Sanitize and validate POST data for contact form submission
function sanitize_post_data($data)
{
    return htmlspecialchars(trim($data ?? ''), ENT_QUOTES, 'UTF-8');
}

function is_valid_email($email)
{
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
        'logo' => 'assets/sisters/ruposheelogo.jpg',
        'tagline' => 'Premier destination for women\'s fashion and beauty products.',
        'website' => 'https://ruposhee.com',
        'image' => 'assets/sisters/ruposheebanner.png',
        'description' => 'Your one-stop destination for trendy fashion, beauty products, and lifestyle essentials. Discover a curated collection of products that enhance your beauty and style.',
        'banner' => 'assets/sisters/ruposheebanner.png'
    ],
    [
        'key' => 'scholarhaat',
        'name' => 'Scholarhaat.com',
        'logo' => 'assets/sisters/scholarhaatlogo.png',
        'tagline' => 'Innovative educational platform for quality learning resources.',
        'website' => 'https://scholarhaat.com',
        'image' => 'assets/sisters/scholarhaatlogo.png',
        'description' => 'Empowering students with comprehensive learning resources, test preparation materials, and educational guidance for academic excellence.',
        'banner' => 'assets/sisters/scholarhaatbanner.png'
    ],
    [
        'key' => 'medeasy',
        'name' => 'MediFast.com',
        'logo' => 'assets/WAVElogo01.png',
        'tagline' => 'Revolutionary telemedicine platform for healthcare services.',
        'website' => 'https://medeasy.com',
        'image' => 'assets/WAVElogo01.png',
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
            'photo' => 'assets/adminimg/shumona.png',
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
            'photo' => 'assets/team/default-avatar.png',
            'bio' => 'Creative marketer driving brand growth and engagement.',
            'linkedin' => 'https://linkedin.com/in/ishtiak-anik',
            'twitter' => 'https://twitter.com/ishtiakanik',
            'phone' => '+8801646313137',
            'whatsapp' => '+8801646313137'
        ],
        [
            'name' => 'Shopnil',
            'role' => 'Business Strategist',
            'photo' => 'assets/team/default-avatar.png',
            'bio' => 'Crafting compelling content to connect with audiences.',
            'linkedin' => 'https://linkedin.com/in/shopnil',
            'twitter' => 'https://twitter.com/shopnil',
            'phone' => '+8801711009900',
            'whatsapp' => '+8801711009900'
        ],
        [
            'name' => 'Alex Kim',
            'role' => 'Social Media Specialist',
            'photo' => 'assets/team/default-avatar.png',
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
            'photo' => 'assets/devimg/shawon.jpg',
            'bio' => 'Leading development teams and guiding architecture design.',
            'linkedin' => 'https://bd.linkedin.com/in/md-yeasine-dewan-shawon-07a383210',
            'twitter' => 'https://x.com/yeasinedeawanshawon',
            'phone' => '+8801793244543',
            'whatsapp' => '+8801793244543'
        ],
        [
            'name' => 'Michael Brown',
            'role' => 'Frontend Developer',
            'photo' => 'assets/team/default-avatar.png',
            'bio' => 'Building stunning user experiences and interfaces.',
            'linkedin' => 'https://linkedin.com/in/michaelbrown',
            'twitter' => 'https://twitter.com/michaelbrown',
            'phone' => '+8801711015566',
            'whatsapp' => '+8801711015566'
        ],
        [
            'name' => 'Pavel Bodda',
            'role' => 'Designer(Learner)',
            'photo' => 'assets/devimg/pavel.jpeg',
            'bio' => 'Developing scalable and robust server-side solutions.',
            'linkedin' => 'https://linkedin.com/in/pavelbodda',
            'twitter' => 'https://twitter.com/pavelbodda',
            'phone' => '+8801711017788',
            'whatsapp' => '+8801711017788'
        ],
        [
            'name' => 'Emma Wilson',
            'role' => 'Backend Developer',
            'photo' => 'assets/team/default-avatar.png',
            'bio' => 'Developing scalable and robust server-side solutions.',
            'linkedin' => 'https://linkedin.com/in/emmawilson',
            'twitter' => 'https://twitter.com/emmawilson',
            'phone' => '+8801711017788',
            'whatsapp' => '+8801711017788'
        ]
    ]
];

// Function to get service icon
function getServiceIcon($icon_name)
{
    return $icon_name; // Return the iconify icon name
}

// Sanitize 'page' query parameter and default to 'home'
$current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) ?? 'home';

// Home page background image logic
function getHomePageBackground() {
    return 'assets/Wavebanner.png';
}

// Dynamic SEO meta tags
function getPageMeta($page) {
    $meta = [
        'title' => 'Wave 3 Limited | Leading IT Solutions & Digital Services in Bangladesh',
        'description' => "Wave 3 Limited is a premier technology company in Bangladesh, specializing in web development, mobile apps, cloud solutions, data analytics, UI/UX design, and cybersecurity. Transform your business with our innovative digital solutions.",
    ];
    switch ($page) {
        case 'services':
            $meta['title'] = 'Services | Wave 3 Limited - Web, Mobile, Cloud, Data, UI/UX, Cybersecurity';
            $meta['description'] = 'Explore our full range of IT services: web development, mobile apps, cloud solutions, data analytics, UI/UX design, and cybersecurity for businesses in Bangladesh.';
            break;
        case 'companies':
            $meta['title'] = 'Sister Concerns | Wave 3 Limited - Ruposhee, Scholarhaat, MediFast';
            $meta['description'] = 'Discover our sister concerns: Ruposhee.com, Scholarhaat.com, MediFast.com. Leaders in fashion, education, and telemedicine in Bangladesh.';
            break;
        case 'team':
            $meta['title'] = 'Our Team | Wave 3 Limited - Meet Our Experts';
            $meta['description'] = 'Meet the passionate experts behind Wave 3 Limited. Our team specializes in IT, development, design, analytics, and more.';
            break;
        case 'contact':
            $meta['title'] = 'Contact Us | Wave 3 Limited - Get in Touch';
            $meta['description'] = 'Contact Wave 3 Limited for IT solutions, business inquiries, or support. We are here to help you transform your business.';
            break;
        default:
            // Home or unknown
            break;
    }
    return $meta;
}
$pageMeta = getPageMeta($current_page);
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($pageMeta['title']); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($pageMeta['description']); ?>" />
  
  <!-- Primary Meta Tags -->
    <meta name="title" content="Wave 3 Limited | Leading IT Solutions & Digital Services in Bangladesh">
    <meta name="description"
        content="Wave 3 Limited is a premier technology company in Bangladesh, specializing in web development, mobile apps, cloud solutions, data analytics, UI/UX design, and cybersecurity. Transform your business with our innovative digital solutions.">
    <meta name="keywords"
        content="Wave 3 Limited, web development Bangladesh, mobile app development, cloud solutions, data analytics, UI/UX design, cybersecurity, IT company Dhaka, software development, digital transformation, e-commerce solutions, enterprise software, Bangladesh technology, Dhaka IT services">
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
    <meta property="og:description"
        content="Transform your business with Wave 3 Limited's cutting-edge technology solutions. Web development, mobile apps, cloud solutions, and more. Leading IT company in Bangladesh.">
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
    <meta name="twitter:description"
        content="Transform your business with Wave 3 Limited's cutting-edge technology solutions. Web development, mobile apps, cloud solutions, and more.">
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
    "contactPoint": [{
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
            "itemListElement": [{
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
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap">
    </noscript>

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
    <meta name="google-site-verification" content="WKnS7RGd4KH_y8fSLpNoG6L4yGVepnhwgBjt5zrN6x8" />
    <meta name="facebook-domain-verification" content="your-facebook-verification-code">
    <meta name="twitter:site" content="@wave3limited">

    <!-- Analytics and Tracking -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'GA_MEASUREMENT_ID', {
        'page_title': 'Wave 3 Limited - IT Solutions Bangladesh',
        'page_location': window.location.href
    });
    </script>

    <!-- Facebook Pixel -->
    <script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', 'YOUR_PIXEL_ID');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=YOUR_PIXEL_ID&ev=PageView&noscript=1" /></noscript>

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
        top: 0;
        left: 0;
        right: 0;
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
        left: 0;
        bottom: 0;
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
      display: flex;
      flex-direction: column;
      transform: translateX(100%);
    }

    #mobile-menu.show {
      right: 0;
      transform: translateX(0);
    }

    /* Mobile menu overlay */
    .mobile-menu-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: opacity var(--transition-normal), visibility var(--transition-normal);
    }

    .mobile-menu-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    .mobile-menu-header {
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--content3);
    }

    .mobile-menu-links {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      margin-bottom: 2rem;
    }

    .mobile-nav-link {
      display: block;
      padding: 1rem 1.5rem;
      font-weight: 600;
      font-size: 1.1rem;
      color: var(--foreground);
      text-decoration: none;
      transition: all var(--transition-normal);
      border-radius: 0.5rem;
      contain: layout style;
      will-change: transform, background-color;
      transform: translateX(20px);
      opacity: 0;
    }

    .mobile-nav-link:hover,
    .mobile-nav-link:focus {
      background-color: var(--content1);
      color: var(--primary);
      transform: translateX(0.5rem);
      outline: none;
    }

    .mobile-nav-link.active {
      background-color: var(--primary);
      color: white;
    }

    .mobile-menu-footer {
      border-top: 1px solid var(--content3);
      padding-top: 1.5rem;
    }

    .mobile-contact-info {
      margin-bottom: 1.5rem;
    }

    .mobile-contact-info a {
      transition: color var(--transition-normal);
    }

    .mobile-contact-info a:hover {
      color: var(--primary);
    }

    .mobile-social-links {
      text-align: center;
    }

    .mobile-social-link {
      transition: transform var(--transition-normal);
    }

    .mobile-social-link:hover {
      transform: scale(1.1);
    }

    /* Hero Section Optimizations */
    .hero-section {
      position: relative;
      background-image: url('<?php echo getHomePageBackground(); ?>');
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
      min-height: 80vh;
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
        background: rgba(0,0,0,0.4);
      z-index: 1;
        contain: layout style;
      backdrop-filter: blur(2px);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 900px;
      animation: fadeInSlideUp 0.8s ease forwards;
        contain: layout style;
      padding: 3rem 2rem;
    }

    .hero-title {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
      font-weight: 900;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
      margin-bottom: 1.5rem;
      user-select: text;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: clamp(1.2rem, 3vw, 1.6rem);
      opacity: 0.95;
      margin-bottom: 2.5rem;
      user-select: text;
        line-height: 1.6;
      text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .hero-button {
      display: inline-block;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      padding: 1.2rem 3rem;
      border-radius: 9999px;
      text-decoration: none;
        transition: all var(--transition-slow);
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
      border: 2px solid transparent;
      user-select: none;
      position: relative;
      overflow: hidden;
      letter-spacing: 0.5px;
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

    /* Company Banner Enhancements */
    .company-banner {
      transition: all 0.4s ease;
      position: relative;
      height: 250px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .company-banner:hover {
      transform: scale(1.02);
    }

    .company-banner img {
      transition: all 0.3s ease;
      object-fit: cover;
    }

    .company-banner:hover img {
      transform: scale(1.05);
    }

    /* Company Logo Container */
    .company-logo-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 50%;
      padding: 1.2rem;
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
      width: 100px;
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2;
      transition: all 0.3s ease;
    }

    .company-logo-container:hover {
      transform: scale(1.1);
      box-shadow: 0 12px 40px rgba(0,0,0,0.4);
    }

    .company-logo {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
      max-width: 80px;
      max-height: 80px;
      transition: all 0.3s ease;
    }

    /* Section Title Optimizations */
    .section-title {
        font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 900;
      text-align: center;
      margin-bottom: 3rem;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 2.5rem;
      max-width: 1200px;
      margin: 0 auto 4rem;
      padding: 0 2rem;
        contain: layout style;
        justify-content: center;
        align-items: stretch;
    }

    /* Card Optimizations */
    .service-card,
    .company-card,
    .team-member {
      background: var(--content2);
      border-radius: 1rem;
      padding: 2.5rem 2rem;
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
        border: 1px solid transparent;
        min-height: 280px;
        justify-content: flex-start;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .service-card:hover,
    .service-card:focus-within,
    .company-card:hover,
    .company-card:focus-within,
    .team-member:hover,
    .team-member:focus-within {
        box-shadow: var(--shadow-xl);
      transform: translateY(-12px) scale(1.03);
      outline: none;
      z-index: 2;
        border-color: var(--primary-light);
        background: var(--content1);
    }

    /* Image Optimizations */
    .team-photo {
        object-fit: cover;
        border-radius: 50%;
        transition: transform var(--transition-normal);
        contain: layout style paint;
        will-change: transform;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 4px solid var(--primary-light);
        background-color: var(--content2);
        width: 80px;
        height: 80px;
    }

    .team-photo:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        border-color: var(--primary);
    }

    /* Form Optimizations */
    form {
        max-width: 500px;
        margin: auto;
        contain: layout style;
    }

    /* Team Member Card Text */
    .team-name {
        font-size: 1.25rem;
      font-weight: 700;
        color: var(--primary-dark);
        margin-top: 0.5rem;
        margin-bottom: 0.25rem;
      user-select: text;
    }

    .team-role {
      font-size: 1rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
      user-select: text;
    }

    .team-bio {
        font-size: 0.9rem;
      color: var(--foreground);
        opacity: 0.85;
        margin-bottom: 1rem;
      user-select: text;
        min-height: 3.5rem;
    }

    /* Contact and Social Icons */
    .contact-icons a,
    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1.5px solid var(--primary-light);
        color: var(--primary-dark);
        background: var(--content2);
        transition: background-color var(--transition-fast), color var(--transition-fast), border-color var(--transition-fast);
        margin: 0 0.25rem;
      text-decoration: none;
      user-select: none;
    }

    .contact-icons a:hover,
    .social-links a:hover,
    .contact-icons a:focus,
    .social-links a:focus {
      background-color: var(--primary);
      color: white;
      border-color: var(--primary);
      outline: none;
        box-shadow: 0 0 8px var(--primary);
        transform: scale(1.1);
        transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
    }

    /* Sister Concerns Card */
    .sister-card-custom {
        max-width: 360px;
        margin: 0 auto;
        text-align: left;
        padding: 1rem;
      display: flex;
      flex-direction: column;
        border-radius: 1rem;
        background: var(--content2);
        box-shadow: var(--shadow-md);
        transition: box-shadow var(--transition-slow), transform var(--transition-slow);
        cursor: pointer;
      user-select: none;
        border: 1px solid transparent;
    }

    .sister-card-custom:hover,
    .sister-card-custom:focus-within {
        box-shadow: var(--shadow-xl);
        transform: translateY(-10px) scale(1.02);
        border-color: var(--primary-light);
      outline: none;
      z-index: 2;
    }

    .sister-card-img {
        position: relative;
        width: 100%;
        height: 180px;
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .sister-card-image {
        width: 100%;
        height: 100%;
        border-radius: 1rem;
      object-fit: cover;
        transition: transform var(--transition-normal);
        will-change: transform;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .sister-card-logo {
        position: absolute;
        bottom: -20px;
        right: 1rem;
        width: 80px;
        height: 80px;
      border-radius: 50%;
        border: 3px solid var(--content2);
        background: var(--content2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: box-shadow var(--transition-normal);
        object-fit: contain;
        z-index: 10;
    }

    .sister-card-logo:hover,
    .sister-card-logo:focus {
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        outline: none;
    }

    .sister-card-body {
        padding: 0 0.5rem 0.5rem 0.5rem;
    }

    .sister-card-title {
        font-size: 1.3rem;
      font-weight: 700;
        color: var(--primary-dark);
      margin-bottom: 0.25rem;
      user-select: text;
    }

    .sister-card-tagline {
        font-size: 1rem;
      font-weight: 600;
      color: var(--primary);
        margin-bottom: 0.5rem;
      user-select: text;
    }

    .sister-card-description {
        font-size: 0.9rem;
      color: var(--foreground);
        opacity: 0.85;
        margin-bottom: 1rem;
      user-select: text;
        min-height: 4rem;
    }

    .sister-card-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
        gap: 0.25rem;
        padding: 0.5rem 1rem;
        background-color: var(--primary);
        color: white;
        font-weight: 600;
        font-size: 1rem;
      border-radius: 9999px;
      text-decoration: none;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        transition: background-color var(--transition-fast), box-shadow var(--transition-fast), transform var(--transition-fast);
        user-select: none;
    }

    .sister-card-btn:hover,
    .sister-card-btn:focus {
        background-color: var(--primary-dark);
        box-shadow: 0 8px 28px rgba(37, 99, 235, 0.6);
        transform: translateY(-2px) scale(1.05);
      outline: none;
    }

    /* Team Tabs Buttons */
    .tab-button {
        background-color: var(--content2);
        border: 2px solid var(--primary-light);
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
        margin: 0 0.5rem 1rem 0.5rem;
        border-radius: 9999px;
        cursor: pointer;
        transition: background-color var(--transition-fast), color var(--transition-fast), border-color var(--transition-fast), box-shadow var(--transition-fast);
      user-select: none;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
        outline: none;
    }

    .tab-button:hover,
    .tab-button:focus {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary-dark);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        transform: translateY(-2px) scale(1.05);
        outline: none;
    }

    .tab-button[aria-selected="true"] {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary-dark);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.6);
        cursor: default;
        transform: translateY(-2px) scale(1.05);
    }

    input,
    textarea {
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

    input:focus,
    textarea:focus {
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
      
      /* Tablet optimizations */
      .hero-section {
        padding: 3rem 1.5rem;
      }
      
      .section-title {
        font-size: 2rem;
      }
      
      .grid-sister-cards,
      .grid-services,
      .grid-team-members {
        gap: 1.5rem;
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
        padding: 2rem 1rem;
        min-height: 70vh;
      }
      
      .hero-title {
        font-size: clamp(2rem, 5vw, 3rem);
      }
      
      .hero-subtitle {
        font-size: clamp(1rem, 2.5vw, 1.2rem);
      }
      
      .section-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
      }
      
      .home-glow-card,
      .service-card,
      .pro-sister-card,
      .team-member {
        min-width: 280px;
        max-width: 100%;
      }
      
      .grid-sister-cards,
      .grid-services,
      .grid-team-members {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 0 1rem;
      }
      
      .contact-advanced-container {
        flex-direction: column;
        gap: 2rem;
      }
      
      .contact-advanced-info,
      .contact-advanced-form-card {
        max-width: 100%;
        padding: 2rem 1rem;
      }
    }

    @media (max-width: 480px) {
      nav {
        padding: 0 1rem;
      }
      
      .logo {
        font-size: 1.25rem;
      }
      
      .logo img {
        height: 45px;
      }
      
      header {
        --header-height: 60px;
      }
      
      #mobile-menu {
        width: 100%;
        --mobile-menu-padding: 0.75rem;
      }
      
      .mobile-nav-link {
        padding: 0.8rem 1rem;
        font-size: 1rem;
      }
      
      .hero-section {
        padding: 1.5rem 0.5rem;
        min-height: 60vh;
      }
      
      .hero-title {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
      }
      
      .hero-subtitle {
        font-size: clamp(0.9rem, 2vw, 1.1rem);
      }
      
      .section-title {
        font-size: 1.5rem;
        margin-bottom: 1.2rem;
      }
      
      .home-glow-card,
      .service-card,
      .pro-sister-card,
      .team-member {
        min-width: 0;
        max-width: 100%;
        width: 100%;
        padding: 1.2rem 0.7rem;
        min-height: 220px;
      }
      
      .grid-sister-cards,
      .grid-services,
      .grid-team-members {
        padding: 0;
        gap: 1rem;
      }
      
      .contact-advanced-container {
        padding: 1.2rem 0.2rem;
        gap: 1.2rem;
      }
      
      .contact-advanced-info,
      .contact-advanced-form-card {
        padding: 1.2rem 0.5rem;
        border-radius: 1rem;
      }
      
      .contact-advanced-map {
        min-height: 80px;
        font-size: 0.98rem;
      }
      
      .contact-advanced-list li,
      .contact-advanced-list a,
      .contact-advanced-list span {
        font-size: 0.98rem !important;
      }
      
      .contact-advanced-socials {
        gap: 0.7rem !important;
      }
      
      .mobile-social-link {
        width: 35px;
        height: 35px;
      }
      
      .mobile-social-link .iconify {
        font-size: 1rem;
      }
    }

    @media (max-width: 360px) {
      .logo {
        font-size: 1.1rem;
      }
      
      .logo img {
        height: 40px;
        margin-right: 0.5rem;
      }
      
      .hero-title {
        font-size: 1.6rem;
      }
      
      .hero-subtitle {
        font-size: 0.9rem;
      }
      
      .section-title {
        font-size: 1.3rem;
      }
      
      .home-glow-card,
      .service-card,
      .pro-sister-card,
      .team-member {
        padding: 1rem 0.5rem;
        min-height: 200px;
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

        header,
        footer,
        #dark-mode-toggle {
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

    .grid-sister-cards {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
        margin: 0 auto 4rem;
        padding: 0 1rem;
    }

    .sister-card-custom {
        background: var(--content2);
      border-radius: 1rem;
        padding: 2rem 1.5rem 2rem 1.5rem;
        box-shadow: var(--shadow-md);
      display: flex;
      flex-direction: column;
      align-items: center;
        text-align: center;
        width: 340px;
        max-width: 100%;
        margin-bottom: 0;
        position: relative;
      transition: box-shadow 0.3s, transform 0.3s;
    }

    .sister-card-logo {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
      margin-bottom: 1.2rem;
        border: 4px solid var(--primary-light);
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .sister-card-title {
        font-size: 1.3rem;
      font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.25rem;
    }

    .sister-card-tagline {
      font-size: 1rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .sister-card-description {
        font-size: 0.95rem;
        color: var(--foreground);
        opacity: 0.85;
      margin-bottom: 1.2rem;
        min-height: 3.5rem;
    }

    .sister-card-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5em;
        background-color: var(--primary);
      color: #fff;
      font-weight: 600;
        font-size: 1rem;
        border-radius: 9999px;
      text-decoration: none;
        padding: 0.7em 1.5em;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
        border: none;
        margin-top: auto;
    }

    .sister-card-btn:hover,
    .sister-card-btn:focus {
        background-color: var(--primary-dark);
        box-shadow: 0 8px 28px rgba(37, 99, 235, 0.6);
        transform: translateY(-2px) scale(1.05);
      outline: none;
    }

    .pro-sister-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2.5rem;
        max-width: 1200px;
        margin: 0 auto 4rem;
        padding: 0 2rem;
        justify-content: center;
        align-items: stretch;
    }

    .pro-sister-card {
      background: var(--content2);
        border-radius: 1.25rem;
        box-shadow: 0 4px 24px rgba(37,99,235,0.08), 0 1.5px 8px rgba(0,0,0,0.04);
        transition: box-shadow 0.3s, transform 0.3s;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        padding: 2.5rem 2rem 2rem 2rem;
        border: 1px solid var(--content3);
        min-height: 320px;
    }

    .pro-sister-card:hover,
    .pro-sister-card:focus-within {
        box-shadow: 0 8px 32px rgba(37,99,235,0.16), 0 2px 12px rgba(0,0,0,0.08);
        transform: translateY(-8px) scale(1.025);
        border-color: var(--primary-light);
        background: var(--content1);
      z-index: 2;
    }

    .pro-sister-banner-wrapper {
        position: relative;
      width: 100%;
        height: 160px;
        border-radius: 1rem 1rem 0 0;
        overflow: hidden;
        margin-bottom: 2.5rem;
        background: #f3f4f6;
      display: flex;
        align-items: flex-end;
        justify-content: center;
    }

    .pro-sister-banner {
      width: 100%;
        height: 100%;
      object-fit: cover;
        border-radius: 1rem 1rem 0 0;
        display: block;
    }

    .pro-sister-logo {
        position: absolute;
        left: 50%;
        bottom: -40px;
        transform: translateX(-50%);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 4px solid var(--content2);
        background: var(--content2);
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.10);
      object-fit: contain;
        z-index: 10;
        transition: box-shadow 0.2s;
    }

    .pro-sister-logo:hover,
    .pro-sister-logo:focus {
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.18);
    }

    .pro-sister-title {
        font-size: 1.25rem;
      font-weight: 800;
        color: var(--primary-dark);
        margin-top: 2.2rem;
        margin-bottom: 0.2rem;
        letter-spacing: 0.01em;
    }

    .pro-sister-tagline {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.6rem;
    }

    .pro-sister-desc {
        font-size: 0.98rem;
      color: var(--foreground);
        opacity: 0.88;
        margin-bottom: 1.3rem;
        min-height: 3.5rem;
    }

    .pro-sister-btn {
        display: flex;
      align-items: center;
      justify-content: center;
        gap: 0.6em;
        background: var(--primary);
      color: #fff;
        font-weight: 700;
        font-size: 1.05rem;
        border-radius: 9999px;
      text-decoration: none;
        padding: 0.7em 1.7em 0.7em 1.3em;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.13);
        transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
        border: none;
        margin-top: auto;
        outline: none;
        cursor: pointer;
    }

    .pro-sister-btn:hover,
    .pro-sister-btn:focus {
        background: var(--primary-dark);
        box-shadow: 0 10px 32px rgba(37, 99, 235, 0.22);
        transform: translateY(-2px) scale(1.05);
      outline: none;
    }

    .pro-sister-arrow {
        font-size: 1.3em;
        margin-left: 0.2em;
        vertical-align: middle;
        display: inline-block;
    }

    @media (max-width: 900px) {
        .pro-sister-cards,
        .grid-services,
        .grid-team-members {
            padding: 0 0.5rem;
            gap: 1rem;
        }
        .service-card,
        .pro-sister-card,
        .team-member {
            min-width: 0;
            max-width: 100%;
            width: 100%;
            padding: 1.2rem 0.7rem 1.2rem 0.7rem;
            min-height: 220px;
        }
    }
    @media (max-width: 600px) {
        .pro-sister-cards,
        .grid-services,
        .grid-team-members {
            padding: 0;
            gap: 0.7rem;
        }
        .service-card,
        .pro-sister-card,
        .team-member {
            min-width: 0;
            max-width: 100vw;
            width: 100vw;
            padding: 0.7rem 0.2rem 1rem 0.2rem;
            min-height: 160px;
        }
        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1.2rem;
        }
    }

    .team-photo-large {
        width: 120px !important;
        height: 120px !important;
        max-width: 120px;
        max-height: 120px;
        margin-bottom: 1.1rem;
        border-radius: 50%;
        border: 4px solid var(--primary-light);
        box-shadow: 0 8px 32px rgba(37,99,235,0.18);
        background: var(--content2);
        object-fit: cover;
        display: block;
        transition: box-shadow 0.3s, border-color 0.3s;
    }
    .team-member:hover .team-photo-large,
    .team-member:focus-within .team-photo-large {
        box-shadow: 0 12px 40px rgba(37,99,235,0.28);
        border-color: var(--primary);
    }
    .team-contact-row {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1.1rem;
        margin-bottom: 0.7rem;
        opacity: 0.92;
        transform: translateY(10px);
        transition: opacity 0.3s, transform 0.3s;
    }
    .team-member:hover .team-contact-row,
    .team-member:focus-within .team-contact-row {
        opacity: 1;
        transform: translateY(0);
    }
    .team-contact-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 50%;
      background: var(--content1);
        color: var(--primary-dark);
        font-size: 1.55rem;
        box-shadow: 0 2px 8px rgba(37,99,235,0.10);
        border: 2px solid var(--primary-light);
        transition: background 0.2s, color 0.2s, border 0.2s, transform 0.2s, box-shadow 0.2s;
        outline: none;
        text-decoration: none;
        position: relative;
        cursor: pointer;
        overflow: hidden;
    }
    .team-contact-icon:focus-visible {
        outline: 2.5px solid var(--primary-dark);
        outline-offset: 2px;
        z-index: 2;
    }
    .team-contact-icon:hover,
    .team-contact-icon:focus {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        transform: scale(1.13) translateY(-2px) rotate(-6deg);
        box-shadow: 0 6px 24px rgba(37,99,235,0.18);
    }
    .team-contact-icon .iconify {
        pointer-events: none;
    }
    /* Tooltip for icons */
    .team-contact-icon[data-tooltip]:hover::after,
    .team-contact-icon[data-tooltip]:focus::after {
        content: attr(data-tooltip);
        position: absolute;
        left: 50%;
        bottom: 120%;
        transform: translateX(-50%);
        background: var(--primary-dark);
        color: #fff;
        padding: 0.25em 0.8em;
        border-radius: 0.4em;
        font-size: 0.98rem;
        white-space: nowrap;
        opacity: 0.97;
        pointer-events: none;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(37,99,235,0.13);
        animation: fadeInSlideUp 0.3s;
    }
    /* Ripple effect on click */
    .team-contact-icon:active::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        width: 0;
        height: 0;
        background: rgba(59,130,246,0.18);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: ripple 0.5s linear;
        z-index: 1;
    }
    @keyframes ripple {
        0% { width: 0; height: 0; opacity: 0.7; }
        100% { width: 120%; height: 120%; opacity: 0; }
    }
    </style>
    <style>
    html, body {
        width: 100vw;
        min-height: 100vh;
        height: 100%;
        margin: 0;
        padding: 0;
        background: var(--background);
        box-sizing: border-box;
        overflow-x: hidden;
    }
    body {
        background: var(--background);
        min-height: 100vh;
        width: 100vw;
        margin: 0;
        padding: 0;
    }
    main, .main-content, .hero-section, .py-16, .py-20, .footer-advanced {
        width: 100vw;
        margin: 0 !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        background: var(--background) !important;
    }
    .grid-team-members, .grid-services, .grid-companies, .sister-cards-container, .pro-sister-cards {
        width: 100vw;
        max-width: 100vw;
        margin-left: 0 !important;
        margin-right: 0 !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    </style>
    <style>
    /* --- SERVICES PAGE GRID --- */
    .grid-services,
    .grid-team-members,
    .pro-sister-cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
        max-width: 1200px;
        min-width: 340px;
        margin: 0 auto 3rem auto;
        padding: 0 2rem;
        gap: 2.5rem;
        box-sizing: border-box;
    }
    @media (max-width: 900px) {
        .grid-services,
        .grid-team-members,
        .pro-sister-cards {
            padding: 0 1rem;
            gap: 1.5rem;
        }
    }
    @media (max-width: 600px) {
        .grid-services,
        .grid-team-members,
        .pro-sister-cards {
            padding: 0 0.5rem;
            gap: 1rem;
        }
    }
    .service-card,
    .pro-sister-card,
    .team-member {
        background: var(--content2);
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(37,99,235,0.10), 0 1.5px 8px rgba(0,0,0,0.04);
        padding: 2.7rem 2.2rem 2.5rem 2.2rem;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        min-width: 320px;
        max-width: 370px;
        width: 100%;
        min-height: 340px;
        transition: box-shadow 0.3s, transform 0.3s, background 0.2s;
    }
    @media (max-width: 900px) {
        .grid-services,
        .grid-team-members,
        .pro-sister-cards {
            gap: 1.5rem;
            padding: 0 0.5rem;
        }
        .service-card,
        .pro-sister-card,
        .team-member {
            min-width: 90vw;
            max-width: 100vw;
            padding: 1.5rem 0.7rem 1.5rem 0.7rem;
        }
    }
    .service-card:hover, .service-card:focus-within {
        box-shadow: 0 16px 48px rgba(37,99,235,0.22), 0 2px 12px rgba(0,0,0,0.08);
        background: var(--primary-light);
        z-index: 2;
        transform: scale(1.04) translateY(-8px);
        color: #fff;
    }
    .service-card .iconify {
        font-size: 2.7rem;
        color: var(--primary);
        margin-bottom: 1.1rem;
        transition: color 0.2s;
    }
    .service-card:hover .iconify, .service-card:focus-within .iconify {
        color: #fff;
    }
    /* --- SISTER CONCERN CARDS --- */
    .pro-sister-card, .sister-card-custom {
        background: var(--content2);
        border-radius: 1.25rem;
        box-shadow: 0 4px 24px rgba(37,99,235,0.08), 0 1.5px 8px rgba(0,0,0,0.04);
        transition: box-shadow 0.3s, transform 0.3s, background 0.2s;
        width: 350px;
        max-width: 100%;
        margin-bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        padding: 2.2rem 1.5rem 2rem 1.5rem;
        border: 1px solid var(--content3);
    }
    .pro-sister-card:hover, .pro-sister-card:focus-within, .sister-card-custom:hover, .sister-card-custom:focus-within {
        box-shadow: 0 8px 32px rgba(37,99,235,0.16), 0 2px 12px rgba(0,0,0,0.08);
        transform: translateY(-8px) scale(1.025);
        border-color: var(--primary-light);
        background: var(--content1);
        z-index: 2;
    }
    .pro-sister-logo, .sister-card-logo {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .pro-sister-card:hover .pro-sister-logo, .pro-sister-card:focus-within .pro-sister-logo,
    .sister-card-custom:hover .sister-card-logo, .sister-card-custom:focus-within .sister-card-logo {
        box-shadow: 0 8px 32px rgba(37,99,235,0.18);
        transform: scale(1.08) rotate(-6deg);
    }
    /* --- TEAM MEMBER CARDS --- */
    .team-member {
        background: var(--content2);
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(37,99,235,0.08), 0 1.5px 8px rgba(0,0,0,0.04);
        padding: 2.5rem 2rem 2rem 2rem;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        transition: box-shadow 0.3s, transform 0.3s, background 0.2s;
        width: 100%;
        max-width: 350px;
        min-height: 320px;
        justify-content: flex-start;
    }
    .team-member:hover, .team-member:focus-within {
        box-shadow: 0 12px 40px rgba(37,99,235,0.22), 0 2px 12px rgba(0,0,0,0.08);
        background: var(--content1);
        z-index: 2;
        transform: scale(1.05) translateY(-6px);
    }
    .team-photo-large {
        width: 110px !important;
        height: 110px !important;
        max-width: 110px;
        max-height: 110px;
        margin-bottom: 1.1rem;
        border-radius: 50%;
        border: 4px solid var(--primary-light);
        box-shadow: 0 8px 32px rgba(37,99,235,0.18);
        background: var(--content2);
        object-fit: cover;
        display: block;
        transition: box-shadow 0.3s, border-color 0.3s, transform 0.2s;
    }
    .team-member:hover .team-photo-large,
    .team-member:focus-within .team-photo-large {
        box-shadow: 0 16px 48px rgba(37,99,235,0.32);
        border-color: var(--primary);
        transform: scale(1.08) rotate(-4deg);
    }
    @media (max-width: 1200px) {
        .grid-services, .grid-team-members, .pro-sister-cards { 
            max-width: 100%; 
            padding: 0 1.5rem;
        }
        .pro-sister-card, .sister-card-custom, .team-member { 
            width: 100%; 
            max-width: 400px; 
        }
    }
    @media (max-width: 900px) {
        .pro-sister-cards, .grid-services, .grid-team-members { 
            gap: 2rem; 
            padding: 0 1rem;
        }
        .pro-sister-card, .sister-card-custom, .team-member { 
            width: 100%; 
            max-width: 400px; 
        }
    }
    @media (max-width: 600px) {
        .pro-sister-cards, .grid-services, .grid-team-members { 
            grid-template-columns: 1fr;
            gap: 1.5rem; 
            padding: 0 1rem; 
        }
        .pro-sister-card, .sister-card-custom, .team-member { 
            width: 100%; 
            min-width: 0; 
            padding: 2rem 1.5rem 1.5rem 1.5rem; 
        }
        .team-photo-large { 
            width: 80px !important; 
            height: 80px !important; 
        }
    }
    </style>
    <style>
    /* --- CARD COMPONENT SIZE & SPACING ONLY --- */
    .service-card,
    .pro-sister-card,
    .sister-card-custom,
    .team-member {
        width: 100%;
        max-width: 400px;
        min-width: 280px;
        min-height: 280px;
        max-height: 100%;
        margin: 0 auto;
        padding: 2.5rem 2rem;
        box-sizing: border-box;
        border-radius: 1.1rem;
        background: var(--content2);
        box-shadow: 0 4px 16px rgba(37,99,235,0.08), 0 1.5px 8px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        transition: box-shadow 0.3s, transform 0.3s, background 0.2s;
    }
    @media (max-width: 900px) {
        .service-card,
        .pro-sister-card,
        .sister-card-custom,
        .team-member {
            max-width: 100%;
            min-width: 0;
            min-height: 250px;
            padding: 2rem 1.5rem;
        }
    }
    @media (max-width: 600px) {
        .service-card,
        .pro-sister-card,
        .sister-card-custom,
        .team-member {
            max-width: 100vw;
            min-width: 0;
            min-height: 120px;
            padding: 0.7rem 0.2rem 0.9rem 0.2rem;
        }
    }
    </style>
    <style>
    /* --- CARD CENTERING & ICONS --- */
    .grid-services,
    .grid-team-members,
    .pro-sister-cards,
    .sister-cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        max-width: 1200px;
        margin: 0 auto 4rem auto;
        padding: 0 2rem;
        justify-content: center;
        align-items: stretch;
    }
    .service-card,
    .pro-sister-card,
    .sister-card-custom,
    .team-member {
        margin: 0 auto;
    }
    </style>
    <style>
    /* Contact page hover effects */
    .contact-info-card a[href^="tel"],
    .contact-info-card .contact-email-link {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
      transition: color 0.22s, transform 0.22s, text-decoration 0.22s;
      position: relative;
      z-index: 1;
    }
    .contact-info-card a[href^="tel"]:hover,
    .contact-info-card a[href^="tel"]:focus,
    .contact-info-card .contact-email-link:hover,
    .contact-info-card .contact-email-link:focus {
      color: var(--primary-dark);
      text-decoration: underline;
      transform: scale(1.11);
    }
    .contact-socials a {
      color: var(--primary);
      font-size: 1.5rem;
      background: var(--content1);
      border-radius: 50%;
      padding: 0.4rem;
      box-shadow: 0 1px 4px rgba(37,99,235,0.07);
      transition: background 0.22s, color 0.22s, box-shadow 0.22s, transform 0.22s;
      position: relative;
      z-index: 1;
    }
    .contact-socials a:hover,
    .contact-socials a:focus {
      color: #fff;
      background: var(--primary-dark);
      box-shadow: 0 0 18px 6px var(--primary-light), 0 2px 12px rgba(37,99,235,0.22);
      transform: scale(1.15) rotate(-7deg);
      outline: none;
    }
  </style>
    <style>
    .contact-socials a.social-glow:active,
    .contact-socials a.social-glow.glow {
      box-shadow: 0 0 16px 4px var(--primary), 0 0 32px 8px var(--primary-light);
      background: var(--primary);
      color: #fff !important;
      outline: none;
      transform: scale(1.13) rotate(-7deg);
      transition: box-shadow 0.18s, background 0.18s, color 0.18s, transform 0.18s;
    }
    </style>

  <!-- Sitemap Reference -->
  <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml" />

  <!-- Breadcrumb Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "https://www.wave3limited.com/"
      }
      <?php if ($current_page !== 'home'): ?>,
      {
        "@type": "ListItem",
        "position": 2,
        "name": "<?php echo ucfirst($current_page); ?>",
        "item": "https://www.wave3limited.com/?page=<?php echo urlencode($current_page); ?>"
      }
      <?php endif; ?>
    ]
  }
  </script>

  <!-- FAQPage Structured Data (placeholder) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "What services does Wave 3 Limited offer?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "We offer web development, mobile app development, cloud solutions, data analytics, UI/UX design, and cybersecurity."
        }
      },
      {
        "@type": "Question",
        "name": "How can I contact Wave 3 Limited?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "You can contact us via our website contact form, email, or phone. Visit the Contact page for details."
        }
      }
    ]
  }
  </script>

  <!-- Google Site Verification -->
  <meta name="google-site-verification" content="WKnS7RGd4KH_y8fSLpNoG6L4yGVepnhwgBjt5zrN6x8" />

  <style>
  .home-glow-card {
    background: var(--content2);
    border-radius: 1.1rem;
    box-shadow: 0 2px 12px rgba(37,99,235,0.10), 0 1.5px 8px rgba(0,0,0,0.04);
    transition: box-shadow 0.35s, transform 0.35s, background 0.22s, border-color 0.22s;
    border: 1.5px solid transparent;
    position: relative;
    overflow: hidden;
  }
  .home-glow-card:hover, .home-glow-card:focus-within {
    box-shadow: 0 0 0 6px var(--primary-light), 0 8px 32px rgba(37,99,235,0.18), 0 2px 12px rgba(0,0,0,0.08);
    border-color: var(--primary);
    background: var(--content1);
    transform: translateY(-8px) scale(1.06);
    z-index: 2;
  }
  .home-glow-logo {
    transition: box-shadow 0.35s, transform 0.35s, background 0.22s, border-color 0.22s;
    box-shadow: 0 2px 8px rgba(37,99,235,0.10);
    border: 2px solid transparent;
  }
  .home-glow-logo:hover, .home-glow-logo:focus {
    box-shadow: 0 0 0 8px var(--primary-light), 0 8px 32px rgba(37,99,235,0.18);
    border-color: var(--primary);
    background: var(--primary-light);
    transform: scale(1.12) rotate(-4deg);
    z-index: 2;
  }
  </style>

    /* Additional Mobile Enhancements */
    @media (max-width: 768px) {
      /* Touch-friendly button sizes */
      .hero-button,
      .cta-button,
      .contact-submit-btn {
        min-height: 48px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
      }
      
      /* Better touch targets */
      .mobile-nav-link,
      .tab-button,
      .social-link {
        min-height: 44px;
        padding: 0.8rem 1rem;
      }
      
      /* Improved card layouts */
      .service-card,
      .pro-sister-card,
      .team-member {
        margin-bottom: 1rem;
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
      }
      
      /* Better spacing for mobile */
      .section-title {
        margin-bottom: 2rem;
        padding: 0 1rem;
      }
      
      /* Improved form elements */
      input, textarea, select {
        font-size: 16px; /* Prevents zoom on iOS */
        padding: 0.8rem;
        border-radius: 0.5rem;
      }
      
      /* Better grid layouts */
      .grid-sister-cards,
      .grid-services,
      .grid-team-members {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 0 1rem;
      }
      
      /* Enhanced contact section */
      .contact-advanced-container {
        margin: 0 0.5rem;
      }
      
      .contact-advanced-info,
      .contact-advanced-form-card {
        border-radius: 1rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
      }
    }

    @media (max-width: 480px) {
      /* Even more touch-friendly */
      .mobile-nav-link {
        min-height: 48px;
        display: flex;
        align-items: center;
        font-size: 1.1rem;
      }
      
      /* Compact but readable */
      .hero-section {
        padding: 2rem 0.5rem;
      }
      
      .hero-title {
        margin-bottom: 1rem;
      }
      
      .hero-subtitle {
        margin-bottom: 2rem;
      }
      
      /* Better card spacing */
      .home-glow-card,
      .service-card,
      .pro-sister-card,
      .team-member {
        margin-bottom: 1rem;
        border-radius: 0.8rem;
      }
      
      /* Improved mobile menu */
      .mobile-menu-header h3 {
        font-size: 1.1rem;
        margin-bottom: 0.8rem;
      }
      
      .mobile-contact-info h4,
      .mobile-social-links h4 {
        font-size: 0.9rem;
        margin-bottom: 0.6rem;
      }
      
      .mobile-contact-info a {
        font-size: 0.85rem;
      }
      
      /* Better social icons */
      .mobile-social-link {
        width: 38px;
        height: 38px;
      }
      
      .mobile-social-link .iconify {
        font-size: 1.1rem;
      }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
      /* Larger touch targets */
      .nav-link,
      .mobile-nav-link,
      .tab-button {
        min-height: 44px;
      }
      
      /* Remove hover effects on touch devices */
      .nav-link:hover::after,
      .mobile-nav-link:hover,
      .tab-button:hover {
        transform: none;
      }
      
      /* Better focus indicators */
      .nav-link:focus,
      .mobile-nav-link:focus,
      .tab-button:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
      }
    }

    /* Landscape mobile optimizations */
    @media (max-width: 768px) and (orientation: landscape) {
      .hero-section {
        min-height: 50vh;
        padding: 1.5rem 1rem;
      }
      
      .hero-title {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
      }
      
      .hero-subtitle {
        font-size: clamp(0.9rem, 2vw, 1.1rem);
        margin-bottom: 1.5rem;
      }
      
      #mobile-menu {
        padding-top: calc(var(--header-height) + 0.5rem);
      }
      
      .mobile-menu-header {
        margin-bottom: 1rem;
      }
      
      .mobile-menu-links {
        margin-bottom: 1rem;
      }
    }

    /* Mobile menu overlay */
    .mobile-menu-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: opacity var(--transition-normal), visibility var(--transition-normal);
    }

    .mobile-menu-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    /* Enhanced mobile menu animations */
    #mobile-menu {
      transform: translateX(100%);
      transition: transform var(--transition-slow);
    }

    #mobile-menu.show {
      transform: translateX(0);
    }

    .mobile-nav-link {
      transform: translateX(20px);
      opacity: 0;
      transition: all var(--transition-normal);
    }

    #mobile-menu.show .mobile-nav-link {
      transform: translateX(0);
      opacity: 1;
    }

    #mobile-menu.show .mobile-nav-link:nth-child(1) { transition-delay: 0.1s; }
    #mobile-menu.show .mobile-nav-link:nth-child(2) { transition-delay: 0.2s; }
    #mobile-menu.show .mobile-nav-link:nth-child(3) { transition-delay: 0.3s; }
    #mobile-menu.show .mobile-nav-link:nth-child(4) { transition-delay: 0.4s; }
    #mobile-menu.show .mobile-nav-link:nth-child(5) { transition-delay: 0.5s; }
</head>

<body class="min-h-screen">

  <!-- Header -->
  <header role="banner" tabindex="0">
    <nav aria-label="Main navigation">
      <a href="?page=home" class="logo" aria-label="Wave 3 Limited homepage" tabindex="0">
                <img src="assets/WAVElogo01.png" alt="Wave 3 Limited logo"
                    style="height: 55px; width: auto; margin-right: 0.75rem; object-fit: contain;" loading="lazy"
                    decoding="async" />
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
                    echo '<a href="?page=' . $page . '" class="nav-link ' . $active . '" role="menuitem" tabindex="0">' . htmlspecialchars($label) . '</a>';
          }
        ?>
      </div>
            <button class="mobile-menu-toggle" aria-controls="mobile-menu" aria-expanded="false"
                aria-label="Toggle menu" onclick="toggleMenu()" tabindex="0">
        <span class="iconify" data-icon="lucide:menu" style="font-size: 24px;"></span>
      </button>
    </nav>
    <div id="mobile-menu" role="menu" aria-label="Mobile navigation" tabindex="-1">
      <div class="mobile-menu-header">
        <h3 style="font-size: 1.2rem; font-weight: 700; color: var(--primary); margin: 0 0 1rem 0; text-align: center;">Navigation</h3>
      </div>
      
      <div class="mobile-menu-links">
        <?php
          foreach ($nav_items as $page => $label) {
            $active = ($current_page === $page) ? 'active' : '';
            echo '<a href="?page='.$page.'" class="mobile-nav-link '.$active.'" role="menuitem" tabindex="-1">'.htmlspecialchars($label).'</a>';
          }
        ?>
      </div>
      
      <div class="mobile-menu-footer">
        <div class="mobile-contact-info">
          <h4 style="font-size: 1rem; font-weight: 600; color: var(--primary); margin: 0 0 0.8rem 0;">Quick Contact</h4>
          <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
            <span class="iconify" data-icon="lucide:phone" style="font-size: 1rem; color: var(--primary);"></span>
            <a href="tel:+8801711019152" style="color: var(--foreground); text-decoration: none; font-size: 0.9rem;">+880 1711-019152</a>
          </div>
          <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
            <span class="iconify" data-icon="lucide:mail" style="font-size: 1rem; color: var(--primary);"></span>
            <a href="mailto:info@wave3limited.com" style="color: var(--foreground); text-decoration: none; font-size: 0.9rem;">info@wave3limited.com</a>
          </div>
        </div>
        
        <div class="mobile-social-links">
          <h4 style="font-size: 1rem; font-weight: 600; color: var(--primary); margin: 0 0 0.8rem 0;">Follow Us</h4>
          <div style="display: flex; justify-content: center; gap: 1rem;">
            <a href="https://facebook.com/wave3limited" aria-label="Facebook" target="_blank" rel="noopener" class="mobile-social-link" style="background: #1877f2; color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
              <span class="iconify" data-icon="lucide:facebook" style="font-size: 1.2rem;"></span>
            </a>
            <a href="https://twitter.com/wave3limited" aria-label="Twitter" target="_blank" rel="noopener" class="mobile-social-link" style="background: #1da1f2; color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
              <span class="iconify" data-icon="lucide:twitter" style="font-size: 1.2rem;"></span>
            </a>
            <a href="https://instagram.com/wave3limited" aria-label="Instagram" target="_blank" rel="noopener" class="mobile-social-link" style="background: #e1306c; color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
              <span class="iconify" data-icon="lucide:instagram" style="font-size: 1.2rem;"></span>
            </a>
            <a href="https://wa.me/8801711019152" aria-label="WhatsApp" target="_blank" rel="noopener" class="mobile-social-link" style="background: #25d366; color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
              <span class="iconify" data-icon="lucide:message-square" style="font-size: 1.2rem;"></span>
            </a>
            <a href="https://linkedin.com/company/wave3limited" aria-label="LinkedIn" target="_blank" rel="noopener" class="mobile-social-link" style="background: #0a66c2; color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: transform 0.2s;">
              <span class="iconify" data-icon="lucide:linkedin" style="font-size: 1.2rem;"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="mobile-menu-overlay" onclick="toggleMenu()"></div>
    <style>
    @media (max-width: 900px) {
      .contact-advanced-container {
        flex-direction: column;
        gap: 2rem;
      }
      .contact-advanced-info, .contact-advanced-form-card {
        max-width: 100%;
        padding: 2rem 1rem;
      }
    }
    @media (max-width: 600px) {
      .contact-advanced-container {
        padding: 1.2rem 0.2rem 1.2rem 0.2rem;
        gap: 1.2rem;
      }
      .contact-advanced-info, .contact-advanced-form-card {
        padding: 1.2rem 0.5rem;
        border-radius: 1rem;
      }
      .contact-advanced-map {
        min-height: 80px;
        font-size: 0.98rem;
      }
      .contact-advanced-list li, .contact-advanced-list a, .contact-advanced-list span {
        font-size: 0.98rem !important;
      }
      .contact-advanced-socials {
        gap: 0.7rem !important;
      }
    }
    </style>
  </header>

  <!-- Main Content -->
  <main role="main" aria-label="Main content">

  <?php if ($current_page === 'home'): ?>
    <section class="hero-section" aria-label="Homepage hero" style="background-image: url('<?php echo getHomePageBackground(); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 80vh; display: flex; align-items: center; justify-content: center; position: relative; padding: 4rem 2rem;">
      <div class="hero-overlay" aria-hidden="true" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(2px);"></div>
      <div class="hero-content" tabindex="0" style="text-align: center; color: white; max-width: 900px; position: relative; z-index: 2; padding: 3rem 2rem;">
        <h1 class="hero-title" style="font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 900; margin-bottom: 1.5rem; text-shadow: 0 4px 12px rgba(0,0,0,0.5); line-height: 1.2;">Welcome to Wave 3 Limited</h1>
        <p class="hero-subtitle" style="font-size: clamp(1.2rem, 3vw, 1.6rem); opacity: 0.95; margin-bottom: 2.5rem; line-height: 1.6; text-shadow: 0 2px 8px rgba(0,0,0,0.3);">Innovative solutions for your modern business needs.</p>
        <a href="?page=services" class="hero-button" role="button" style="background: var(--primary); color: white; text-decoration: none; padding: 1.2rem 3rem; border-radius: 9999px; font-weight: 700; font-size: 1.1rem; display: inline-block; transition: all 0.3s ease; box-shadow: 0 8px 24px rgba(37,99,235,0.3); border: 2px solid transparent;">Explore Our Services</a>
      </div>
    </section>

    <!-- Who We Are Section -->
    <section class="about-section" style="max-width: 900px; margin: 0 auto 3rem auto; padding: 2.5rem 1.5rem; text-align: center;">
      <h2 class="section-title" tabindex="0">Who We Are</h2>
      <p style="font-size: 1.15rem; color: var(--foreground); opacity: 0.92; margin-bottom: 1.5rem;">
        <strong>Wave 3 Limited</strong> is a leading technology company based in Bangladesh, dedicated to delivering innovative IT solutions that empower businesses to thrive in the digital era. Our team of passionate experts specializes in web and mobile development, cloud solutions, data analytics, UI/UX design, and cybersecurity. We believe in integrity, creativity, and a relentless pursuit of excellence.
      </p>
      <p style="font-size: 1.08rem; color: var(--primary); font-weight: 600;">
        Our mission: <span style="color: var(--foreground); font-weight: 400;">To transform businesses with smart, scalable, and secure digital solutions.</span>
      </p>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section" style="max-width: 1100px; margin: 0 auto 3rem auto; padding: 2.5rem 1.5rem;">
      <h2 class="section-title" tabindex="0">Why Choose Us?</h2>
      <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2.2rem;">
        <div class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center;">
          <span class="iconify" data-icon="lucide:award" style="font-size: 2.2rem; color: var(--primary);"></span>
          <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0.7rem 0 0.3rem 0;">Proven Expertise</h3>
          <p style="font-size: 0.98rem; opacity: 0.85;">Years of experience delivering successful projects for diverse industries.</p>
        </div>
        <div class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center;">
          <span class="iconify" data-icon="lucide:shield-check" style="font-size: 2.2rem; color: var(--primary);"></span>
          <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0.7rem 0 0.3rem 0;">Security First</h3>
          <p style="font-size: 0.98rem; opacity: 0.85;">Robust cybersecurity and data protection at every step.</p>
        </div>
        <div class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center;">
          <span class="iconify" data-icon="lucide:users" style="font-size: 2.2rem; color: var(--primary);"></span>
          <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0.7rem 0 0.3rem 0;">Client-Centric</h3>
          <p style="font-size: 0.98rem; opacity: 0.85;">We listen, adapt, and deliver solutions tailored to your needs.</p>
        </div>
        <div class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center;">
          <span class="iconify" data-icon="lucide:rocket" style="font-size: 2.2rem; color: var(--primary);"></span>
          <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0.7rem 0 0.3rem 0;">Innovation Driven</h3>
          <p style="font-size: 0.98rem; opacity: 0.85;">We embrace the latest technologies to keep you ahead.</p>
        </div>
      </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="stats-section" style="max-width: 1100px; margin: 0 auto 3rem auto; padding: 2.5rem 1.5rem;">
      <h2 class="section-title" tabindex="0">Our Impact</h2>
      <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2.2rem;">
        <div class="home-glow-card" style="flex: 1 1 180px; min-width: 180px; max-width: 220px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.2rem; text-align: center;">
          <span class="iconify" data-icon="lucide:calendar" style="font-size: 2rem; color: var(--primary);"></span>
          <div style="font-size: 2rem; font-weight: 800; color: var(--primary-dark);">5+</div>
          <div style="font-size: 1rem; opacity: 0.8;">Years in Business</div>
        </div>
        <div class="home-glow-card" style="flex: 1 1 180px; min-width: 180px; max-width: 220px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.2rem; text-align: center;">
          <span class="iconify" data-icon="lucide:briefcase" style="font-size: 2rem; color: var(--primary);"></span>
          <div style="font-size: 2rem; font-weight: 800; color: var(--primary-dark);">50+</div>
          <div style="font-size: 1rem; opacity: 0.8;">Projects Delivered</div>
        </div>
        <div class="home-glow-card" style="flex: 1 1 180px; min-width: 180px; max-width: 220px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.2rem; text-align: center;">
          <span class="iconify" data-icon="lucide:users" style="font-size: 2rem; color: var(--primary);"></span>
          <div style="font-size: 2rem; font-weight: 800; color: var(--primary-dark);">30+</div>
          <div style="font-size: 1rem; opacity: 0.8;">Happy Clients</div>
        </div>
        <div class="home-glow-card" style="flex: 1 1 180px; min-width: 180px; max-width: 220px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.2rem; text-align: center;">
          <span class="iconify" data-icon="lucide:trophy" style="font-size: 2rem; color: var(--primary);"></span>
          <div style="font-size: 2rem; font-weight: 800; color: var(--primary-dark);">8</div>
          <div style="font-size: 1rem; opacity: 0.8;">Awards Won</div>
        </div>
      </div>
    </section>

    <!-- What We Offer Section -->
    <section class="offer-section" style="max-width: 1100px; margin: 0 auto 3rem auto; padding: 2.5rem 1.5rem;">
      <h2 class="section-title" tabindex="0">What We Offer</h2>
      <ul style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2.2rem; list-style: none; padding: 0; margin: 0;">
        <li class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center; font-size: 1.05rem; font-weight: 600; color: var(--primary-dark);">Web & Mobile App Development</li>
        <li class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center; font-size: 1.05rem; font-weight: 600; color: var(--primary-dark);">Cloud & DevOps Solutions</li>
        <li class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center; font-size: 1.05rem; font-weight: 600; color: var(--primary-dark);">Data Analytics & BI</li>
        <li class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center; font-size: 1.05rem; font-weight: 600; color: var(--primary-dark);">UI/UX & Digital Design</li>
        <li class="home-glow-card" style="flex: 1 1 220px; min-width: 220px; max-width: 260px; background: var(--content2); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.5rem; text-align: center; font-size: 1.05rem; font-weight: 600; color: var(--primary-dark);">Cybersecurity & Compliance</li>
      </ul>
    </section>

    <!-- Featured Clients Section -->
    <section class="clients-section" style="max-width: 1100px; margin: 0 auto 3rem auto; padding: 2.5rem 1.5rem; text-align: center;">
      <h2 class="section-title" tabindex="0">Our Clients & Partners</h2>
      <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 2.2rem; margin-top: 1.2rem;">
        <img src="assets/WAVElogo01.png" alt="Client 1" class="home-glow-logo" style="height: 48px; width: auto; opacity: 0.7; border-radius: 8px; background: #fff; padding: 0.3rem;" loading="lazy" />
        <img src="assets/WAVElogo01.png" alt="Client 2" class="home-glow-logo" style="height: 48px; width: auto; opacity: 0.7; border-radius: 8px; background: #fff; padding: 0.3rem;" loading="lazy" />
        <img src="assets/WAVElogo01.png" alt="Client 3" class="home-glow-logo" style="height: 48px; width: auto; opacity: 0.7; border-radius: 8px; background: #fff; padding: 0.3rem;" loading="lazy" />
        <img src="assets/WAVElogo01.png" alt="Client 4" class="home-glow-logo" style="height: 48px; width: auto; opacity: 0.7; border-radius: 8px; background: #fff; padding: 0.3rem;" loading="lazy" />
      </div>
      <p style="font-size: 1rem; color: var(--foreground); opacity: 0.7; margin-top: 1.2rem;">We are trusted by startups, enterprises, and industry leaders.</p>
    </section>

  <?php elseif ($current_page === 'services'): ?>
    <!-- Services Hero Section -->
    <section class="services-hero" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 50%, var(--content1) 100%); min-height: 60vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; padding: 6rem 2rem;">
      <div class="hero-content" style="text-align: center; color: white; max-width: 800px; position: relative; z-index: 2;">
        <h1 style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; margin-bottom: 1.5rem; text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Our Professional Services</h1>
        <p style="font-size: clamp(1.1rem, 2.5vw, 1.4rem); opacity: 0.95; margin-bottom: 2rem; line-height: 1.6;">Transform your business with cutting-edge technology solutions. We deliver innovative, scalable, and secure digital experiences that drive growth and success.</p>
        <div class="hero-stats" style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap; margin-top: 3rem;">
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">50+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Projects Delivered</div>
          </div>
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">30+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Happy Clients</div>
          </div>
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">5+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Years Experience</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Overview Section -->
    <section class="services-overview" style="padding: 5rem 2rem; background: var(--content2);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 4rem;">
          <h2 class="section-title" tabindex="0">Comprehensive IT Solutions</h2>
          <p style="font-size: 1.2rem; color: var(--foreground); opacity: 0.8; max-width: 700px; margin: 0 auto;">From concept to deployment, we provide end-to-end technology solutions that empower businesses to thrive in the digital landscape.</p>
        </div>
        
        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2.5rem; margin-bottom: 4rem;">
          <?php foreach ($services as $service): ?>
            <div class="service-card-advanced" style="background: var(--content2); border-radius: 1.5rem; padding: 3rem 2rem; box-shadow: 0 8px 32px rgba(37,99,235,0.08); border: 1px solid var(--content3); transition: all 0.4s ease; position: relative; overflow: hidden;">
              <div class="service-icon-wrapper" style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; box-shadow: 0 8px 24px rgba(37,99,235,0.2);">
                <span class="iconify" data-icon="<?php echo getServiceIcon($service['icon']); ?>" style="font-size: 2.5rem; color: white;"></span>
              </div>
              <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 1rem; text-align: center;"><?php echo htmlspecialchars($service['title']); ?></h3>
              <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6; margin-bottom: 2rem; text-align: center;"><?php echo htmlspecialchars($service['description']); ?></p>
              
              <!-- Service Features -->
              <div class="service-features" style="margin-bottom: 2rem;">
                <?php
                $features = [
                    1 => ['Custom Development', 'Responsive Design', 'Performance Optimization', 'SEO Integration'],
                    2 => ['Native & Hybrid Apps', 'Cross-platform Development', 'App Store Optimization', 'Push Notifications'],
                    3 => ['Cloud Migration', 'DevOps Automation', 'Scalable Infrastructure', '24/7 Monitoring'],
                    4 => ['Data Visualization', 'Business Intelligence', 'Predictive Analytics', 'Real-time Dashboards'],
                    5 => ['User Research', 'Wireframing & Prototyping', 'Usability Testing', 'Design Systems'],
                    6 => ['Security Audits', 'Penetration Testing', 'Compliance Management', 'Incident Response']
                ];
                $serviceFeatures = $features[$service['id']] ?? ['Feature 1', 'Feature 2', 'Feature 3', 'Feature 4'];
                ?>
                <ul style="list-style: none; padding: 0; margin: 0;">
                  <?php foreach ($serviceFeatures as $feature): ?>
                    <li style="display: flex; align-items: center; margin-bottom: 0.8rem; color: var(--foreground); opacity: 0.8;">
                      <span class="iconify" data-icon="lucide:check-circle" style="color: var(--primary); margin-right: 0.8rem; font-size: 1.1rem;"></span>
                      <?php echo htmlspecialchars($feature); ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              
              <div class="service-cta" style="text-align: center;">
                <button class="service-btn" style="background: var(--primary); color: white; border: none; padding: 0.8rem 2rem; border-radius: 9999px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">Learn More</button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Technology Stack Section -->
    <section class="tech-stack" style="padding: 5rem 2rem; background: linear-gradient(135deg, var(--content1) 0%, var(--primary-light) 100%);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 4rem;">
          <h2 class="section-title" tabindex="0">Our Technology Stack</h2>
          <p style="font-size: 1.2rem; color: var(--foreground); opacity: 0.8; max-width: 700px; margin: 0 auto;">We leverage cutting-edge technologies and frameworks to deliver robust, scalable, and future-proof solutions.</p>
        </div>
        
        <div class="tech-categories" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
          <div class="tech-category" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <h3 style="color: var(--primary-dark); margin-bottom: 1.5rem; font-size: 1.3rem;">Frontend</h3>
            <div class="tech-items" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">React</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Vue.js</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Angular</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Next.js</span>
            </div>
          </div>
          
          <div class="tech-category" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <h3 style="color: var(--primary-dark); margin-bottom: 1.5rem; font-size: 1.3rem;">Backend</h3>
            <div class="tech-items" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Node.js</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Python</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">PHP</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Java</span>
            </div>
          </div>
          
          <div class="tech-category" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <h3 style="color: var(--primary-dark); margin-bottom: 1.5rem; font-size: 1.3rem;">Database</h3>
            <div class="tech-items" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">MySQL</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">PostgreSQL</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">MongoDB</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Redis</span>
            </div>
          </div>
          
          <div class="tech-category" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <h3 style="color: var(--primary-dark); margin-bottom: 1.5rem; font-size: 1.3rem;">Cloud & DevOps</h3>
            <div class="tech-items" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">AWS</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Docker</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">Kubernetes</span>
              <span style="background: var(--primary-light); color: white; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem;">CI/CD</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Development Process Section -->
    <section class="development-process" style="padding: 5rem 2rem; background: var(--content2);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 4rem;">
          <h2 class="section-title" tabindex="0">Our Development Process</h2>
          <p style="font-size: 1.2rem; color: var(--foreground); opacity: 0.8; max-width: 700px; margin: 0 auto;">We follow a proven methodology that ensures quality, transparency, and successful project delivery.</p>
        </div>
        
        <div class="process-steps" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
          <div class="process-step" style="text-align: center; position: relative;">
            <div class="step-number" style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">1</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem; font-size: 1.3rem;">Discovery & Planning</h3>
            <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6;">We analyze your requirements, define project scope, and create a detailed roadmap for success.</p>
          </div>
          
          <div class="process-step" style="text-align: center; position: relative;">
            <div class="step-number" style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">2</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem; font-size: 1.3rem;">Design & Prototyping</h3>
            <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6;">We create wireframes, mockups, and interactive prototypes to visualize your solution.</p>
          </div>
          
          <div class="process-step" style="text-align: center; position: relative;">
            <div class="step-number" style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">3</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem; font-size: 1.3rem;">Development</h3>
            <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6;">Our expert developers build your solution using best practices and modern technologies.</p>
          </div>
          
          <div class="process-step" style="text-align: center; position: relative;">
            <div class="step-number" style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">4</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem; font-size: 1.3rem;">Testing & QA</h3>
            <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6;">Rigorous testing ensures your solution is bug-free, secure, and performs optimally.</p>
          </div>
          
          <div class="process-step" style="text-align: center; position: relative;">
            <div class="step-number" style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">5</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem; font-size: 1.3rem;">Deployment</h3>
            <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6;">We deploy your solution to production with zero downtime and comprehensive monitoring.</p>
          </div>
          
          <div class="process-step" style="text-align: center; position: relative;">
            <div class="step-number" style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 1.5rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">6</div>
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem; font-size: 1.3rem;">Support & Maintenance</h3>
            <p style="color: var(--foreground); opacity: 0.8; line-height: 1.6;">Ongoing support, updates, and maintenance to keep your solution running smoothly.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section" style="padding: 5rem 2rem; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1.5rem;">Ready to Transform Your Business?</h2>
        <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 2.5rem; line-height: 1.6;">Let's discuss your project and create something amazing together. Our team is ready to bring your vision to life.</p>
        <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
          <a href="?page=contact" style="background: white; color: var(--primary); padding: 1rem 2.5rem; border-radius: 9999px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">Get Free Consultation</a>
          <a href="tel:+8801711019152" style="background: transparent; color: white; padding: 1rem 2.5rem; border-radius: 9999px; text-decoration: none; font-weight: 600; border: 2px solid white; transition: all 0.3s ease;">Call Us Now</a>
        </div>
      </div>
    </section>

    <style>
    /* Advanced Services Page Styles */
    .service-card-advanced:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 16px 48px rgba(37,99,235,0.15);
        border-color: var(--primary-light);
    }
    
    .service-icon-wrapper:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 32px rgba(37,99,235,0.3);
    }
    
    .service-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,99,235,0.3);
    }
    
    .tech-category:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    }
    
    .process-step:hover .step-number {
        transform: scale(1.1);
        box-shadow: 0 8px 24px rgba(37,99,235,0.3);
    }
    
    @media (max-width: 768px) {
        .services-grid,
        .tech-categories,
        .process-steps {
            grid-template-columns: 1fr;
        }
        
        .hero-stats {
            gap: 2rem;
        }
    }
    </style>
  <?php elseif ($current_page === 'companies'): ?>
    <!-- Companies Hero Section -->
    <section class="companies-hero" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 50%, var(--content1) 100%); min-height: 60vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; padding: 6rem 2rem;">
      <div class="hero-content" style="text-align: center; color: white; max-width: 800px; position: relative; z-index: 2;">
        <h1 style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; margin-bottom: 1.5rem; text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Our Sister Concerns</h1>
        <p style="font-size: clamp(1.1rem, 2.5vw, 1.4rem); opacity: 0.95; margin-bottom: 2rem; line-height: 1.6;">Discover our diverse portfolio of innovative companies, each leading in their respective industries with cutting-edge solutions and exceptional service.</p>
        <div class="hero-stats" style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap; margin-top: 3rem;">
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">3</div>
            <div style="font-size: 1rem; opacity: 0.9;">Sister Companies</div>
          </div>
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">1000+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Happy Customers</div>
          </div>
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">24/7</div>
            <div style="font-size: 1rem; opacity: 0.9;">Support Available</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Companies Overview Section -->
    <section class="companies-overview" style="padding: 5rem 2rem; background: var(--content2);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 4rem;">
          <h2 class="section-title" tabindex="0">Leading Innovation Across Industries</h2>
          <p style="font-size: 1.2rem; color: var(--foreground); opacity: 0.8; max-width: 700px; margin: 0 auto;">Our sister concerns represent excellence in fashion, education, and healthcare, each delivering exceptional value to their customers.</p>
        </div>
        
        <div class="companies-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 3rem; margin-bottom: 4rem;">
          <?php foreach ($companies as $company): ?>
            <div class="company-card-advanced" style="background: var(--content2); border-radius: 1.5rem; padding: 0; box-shadow: 0 8px 32px rgba(37,99,235,0.08); border: 1px solid var(--content3); transition: all 0.4s ease; position: relative; overflow: hidden;">
              <!-- Company Banner -->
              <div class="company-banner">
                <div class="banner-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                <?php if ($company['key'] === 'ruposhee' || $company['key'] === 'scholarhaat'): ?>
                  <!-- Specific banner with logo overlay for Ruposhee and Scholarhaat -->
                  <img src="<?php echo htmlspecialchars($company['banner']); ?>" alt="<?php echo htmlspecialchars($company['name']); ?> banner" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1;">
                  <div class="company-logo-container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 3;">
                    <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="<?php echo htmlspecialchars($company['name']); ?> logo" class="company-logo">
                  </div>
                <?php else: ?>
                  <!-- Default banner for other companies with consistent logo sizing -->
                  <div class="company-logo-container">
                    <img src="<?php echo htmlspecialchars($company['logo']); ?>" alt="<?php echo htmlspecialchars($company['name']); ?> logo" class="company-logo">
                  </div>
                <?php endif; ?>
              </div>
              
              <!-- Company Content -->
              <div class="company-content" style="padding: 2.5rem 2rem 2rem 2rem;">
                <h3 style="font-size: 1.8rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 0.5rem; text-align: center;"><?php echo htmlspecialchars($company['name']); ?></h3>
                <p class="company-tagline" style="font-size: 1.1rem; font-weight: 600; color: var(--primary); margin-bottom: 1.5rem; text-align: center;"><?php echo htmlspecialchars($company['tagline']); ?></p>
                <p class="company-description" style="color: var(--foreground); opacity: 0.8; line-height: 1.6; margin-bottom: 2rem; text-align: center;"><?php echo htmlspecialchars($company['description']); ?></p>
                
                <!-- Company Features -->
                <div class="company-features" style="margin-bottom: 2rem;">
                  <?php
                  $companyFeatures = [
                      'ruposhee' => ['Fashion & Beauty', 'Trendy Products', 'Secure Shopping', 'Fast Delivery'],
                      'scholarhaat' => ['Quality Education', 'Study Materials', 'Expert Guidance', 'Online Learning'],
                      'medeasy' => ['Telemedicine', 'Expert Doctors', '24/7 Support', 'Health Monitoring']
                  ];
                  $features = $companyFeatures[$company['key']] ?? ['Feature 1', 'Feature 2', 'Feature 3', 'Feature 4'];
                  ?>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem;">
                    <?php foreach ($features as $feature): ?>
                      <div style="display: flex; align-items: center; color: var(--foreground); opacity: 0.8; font-size: 0.95rem;">
                        <span class="iconify" data-icon="lucide:check-circle" style="color: var(--primary); margin-right: 0.5rem; font-size: 1rem;"></span>
                        <?php echo htmlspecialchars($feature); ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                
                <!-- Company Stats -->
                <div class="company-stats" style="display: flex; justify-content: space-around; margin-bottom: 2rem; padding: 1rem; background: var(--content1); border-radius: 0.8rem;">
                  <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">500+</div>
                    <div style="font-size: 0.9rem; opacity: 0.7;">Products</div>
                  </div>
                  <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">4.8★</div>
                    <div style="font-size: 0.9rem; opacity: 0.7;">Rating</div>
                  </div>
                  <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">10K+</div>
                    <div style="font-size: 0.9rem; opacity: 0.7;">Users</div>
                  </div>
                </div>
                
                <!-- Company CTA -->
                <div class="company-cta" style="text-align: center;">
                  <a href="<?php echo htmlspecialchars($company['website']); ?>" target="_blank" rel="noopener" class="company-btn" style="background: var(--primary); color: white; text-decoration: none; padding: 1rem 2rem; border-radius: 9999px; font-weight: 600; display: inline-block; transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">
                    <span>Visit Website</span>
                    <span class="iconify" data-icon="lucide:arrow-right" style="margin-left: 0.5rem; font-size: 1.1rem;"></span>
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Company Achievements Section -->
    <section class="achievements" style="padding: 5rem 2rem; background: linear-gradient(135deg, var(--content1) 0%, var(--primary-light) 100%);">
      <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 4rem;">
          <h2 class="section-title" tabindex="0">Our Collective Achievements</h2>
          <p style="font-size: 1.2rem; color: var(--foreground); opacity: 0.8; max-width: 700px; margin: 0 auto;">Together, our sister concerns have achieved remarkable milestones and continue to set new standards in their industries.</p>
        </div>
        
        <div class="achievements-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
          <div class="achievement-card" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="achievement-icon" style="width: 60px; height: 60px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">
              <span class="iconify" data-icon="lucide:users" style="font-size: 1.8rem; color: white;"></span>
            </div>
            <h3 style="color: var(--primary-dark); margin-bottom: 0.5rem; font-size: 1.3rem;">50,000+</h3>
            <p style="color: var(--foreground); opacity: 0.8; font-size: 1rem;">Happy Customers Served</p>
          </div>
          
          <div class="achievement-card" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="achievement-icon" style="width: 60px; height: 60px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">
              <span class="iconify" data-icon="lucide:award" style="font-size: 1.8rem; color: white;"></span>
            </div>
            <h3 style="color: var(--primary-dark); margin-bottom: 0.5rem; font-size: 1.3rem;">15+</h3>
            <p style="color: var(--foreground); opacity: 0.8; font-size: 1rem;">Industry Awards Won</p>
          </div>
          
          <div class="achievement-card" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="achievement-icon" style="width: 60px; height: 60px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">
              <span class="iconify" data-icon="lucide:globe" style="font-size: 1.8rem; color: white;"></span>
            </div>
            <h3 style="color: var(--primary-dark); margin-bottom: 0.5rem; font-size: 1.3rem;">3</h3>
            <p style="color: var(--foreground); opacity: 0.8; font-size: 1rem;">Successful Platforms</p>
          </div>
          
          <div class="achievement-card" style="background: var(--content2); border-radius: 1rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div class="achievement-icon" style="width: 60px; height: 60px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 4px 16px rgba(37,99,235,0.2);">
              <span class="iconify" data-icon="lucide:trending-up" style="font-size: 1.8rem; color: white;"></span>
            </div>
            <h3 style="color: var(--primary-dark); margin-bottom: 0.5rem; font-size: 1.3rem;">300%</h3>
            <p style="color: var(--foreground); opacity: 0.8; font-size: 1rem;">Growth Rate</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section" style="padding: 5rem 2rem; background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); color: white; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; margin-bottom: 1.5rem;">Ready to Experience Our Services?</h2>
        <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 2.5rem; line-height: 1.6;">Explore our sister concerns and discover how we're transforming industries with innovative solutions and exceptional service.</p>
        <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
          <a href="?page=contact" style="background: white; color: var(--primary); padding: 1rem 2.5rem; border-radius: 9999px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">Get in Touch</a>
          <a href="?page=services" style="background: transparent; color: white; padding: 1rem 2.5rem; border-radius: 9999px; text-decoration: none; font-weight: 600; border: 2px solid white; transition: all 0.3s ease;">Our Services</a>
        </div>
      </div>
    </section>

    <style>
    /* Advanced Companies Page Styles */
    .company-card-advanced:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 16px 48px rgba(37,99,235,0.15);
        border-color: var(--primary-light);
    }
    
    .company-banner:hover {
        transform: scale(1.05);
    }
    
    .company-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,99,235,0.3);
    }
    
    .achievement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    }
    
    .achievement-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 24px rgba(37,99,235,0.3);
    }
    
    @media (max-width: 768px) {
        .companies-grid,
        .achievements-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-stats {
            gap: 2rem;
        }
        
        .company-features {
            grid-template-columns: 1fr;
        }
    }
    </style>
  <?php elseif ($current_page === 'team'): ?>
    <!-- Team Hero Section -->
    <section class="team-hero" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 50%, var(--content1) 100%); min-height: 50vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; padding: 5rem 2rem 3rem 2rem;">
      <div class="hero-content" style="text-align: center; color: white; max-width: 800px; position: relative; z-index: 2;">
        <h1 style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; margin-bottom: 1.5rem; text-shadow: 0 4px 12px rgba(0,0,0,0.3);">Meet Our Professional Team</h1>
        <p style="font-size: clamp(1.1rem, 2.5vw, 1.4rem); opacity: 0.95; margin-bottom: 2rem; line-height: 1.6;">Our team is a blend of creative minds, technical experts, and passionate professionals dedicated to delivering excellence in every project.</p>
        <div class="hero-stats" style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap; margin-top: 2rem;">
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem;">15+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Team Members</div>
          </div>
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem;">5+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Years Experience</div>
          </div>
          <div class="stat-item" style="text-align: center;">
            <div style="font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem;">30+</div>
            <div style="font-size: 1rem; opacity: 0.9;">Projects Delivered</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Tabs & Members Section -->
    <section class="team-tabs-section" style="padding: 4rem 0 2rem 0; min-height: 60vh; background: var(--content2);">
      <div class="tabs-buttons d-flex justify-content-center" role="tablist" aria-label="Team categories" style="gap: 1.2rem; margin-bottom: 2.5rem;">
        <button role="tab" id="tab-admin" aria-controls="panel-admin" aria-selected="true" tabindex="0" class="tab-button">Admin Team</button>
        <button role="tab" id="tab-marketing" aria-controls="panel-marketing" aria-selected="false" tabindex="-1" class="tab-button">Marketing Team</button>
        <button role="tab" id="tab-developer" aria-controls="panel-developer" aria-selected="false" tabindex="-1" class="tab-button">Developer Team</button>
      </div>
      <div id="panel-admin" role="tabpanel" aria-labelledby="tab-admin" tabindex="0">
        <div class="grid-team-members-advanced" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
          <?php foreach ($team['admin'] as $member): ?>
            <article class="team-member-advanced" tabindex="0" aria-labelledby="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>">
              <div class="team-photo-wrapper" style="display: flex; justify-content: center; align-items: center; margin-bottom: 1.2rem;">
                <img src="<?php echo $member['photo']; ?>" alt="Photo of <?php echo htmlspecialchars($member['name']); ?>, <?php echo htmlspecialchars($member['role']); ?>" class="team-photo-advanced" loading="lazy" decoding="async" style="width: 110px; height: 110px; border-radius: 50%; box-shadow: 0 8px 32px rgba(37,99,235,0.18); border: 4px solid var(--primary-light); object-fit: cover; background: var(--content2);">
              </div>
              <h3 id="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>" class="team-name-advanced" style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.2rem; text-align: center; letter-spacing: 0.01em;"><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role-advanced" style="font-size: 1.05rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem; text-align: center;"><?php echo htmlspecialchars($member['role']); ?></p>
              <p class="team-bio-advanced" style="font-size: 0.98rem; color: var(--foreground); opacity: 0.88; margin-bottom: 1.3rem; min-height: 3.5rem; text-align: center;"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="team-contact-row-advanced" style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 0.5rem;">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" class="team-contact-icon-advanced" aria-label="Call <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:phone" aria-hidden="true"></span></a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="WhatsApp <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:message-square" aria-hidden="true"></span></a>
                <a href="mailto:<?php echo !empty($member['email']) ? htmlspecialchars($member['email']) : 'info@wave3limited.com'; ?>" class="team-contact-icon-advanced" aria-label="Email <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:mail" aria-hidden="true"></span></a>
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="LinkedIn profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:linkedin" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Twitter profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:twitter" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['facebook'])): ?>
                  <a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Facebook profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:facebook" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['instagram'])): ?>
                  <a href="<?php echo htmlspecialchars($member['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Instagram profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:instagram" aria-hidden="true"></span></a>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="panel-marketing" role="tabpanel" aria-labelledby="tab-marketing" tabindex="-1" hidden>
        <div class="grid-team-members-advanced" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
          <?php foreach ($team['marketing'] as $member): ?>
            <article class="team-member-advanced" tabindex="0" aria-labelledby="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>">
              <div class="team-photo-wrapper" style="display: flex; justify-content: center; align-items: center; margin-bottom: 1.2rem;">
                <img src="<?php echo $member['photo']; ?>" alt="Photo of <?php echo htmlspecialchars($member['name']); ?>, <?php echo htmlspecialchars($member['role']); ?>" class="team-photo-advanced" loading="lazy" decoding="async" style="width: 110px; height: 110px; border-radius: 50%; box-shadow: 0 8px 32px rgba(37,99,235,0.18); border: 4px solid var(--primary-light); object-fit: cover; background: var(--content2);">
              </div>
              <h3 id="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>" class="team-name-advanced" style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.2rem; text-align: center; letter-spacing: 0.01em;"><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role-advanced" style="font-size: 1.05rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem; text-align: center;"><?php echo htmlspecialchars($member['role']); ?></p>
              <p class="team-bio-advanced" style="font-size: 0.98rem; color: var(--foreground); opacity: 0.88; margin-bottom: 1.3rem; min-height: 3.5rem; text-align: center;"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="team-contact-row-advanced" style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 0.5rem;">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" class="team-contact-icon-advanced" aria-label="Call <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:phone" aria-hidden="true"></span></a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="WhatsApp <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:message-square" aria-hidden="true"></span></a>
                <a href="mailto:<?php echo !empty($member['email']) ? htmlspecialchars($member['email']) : 'info@wave3limited.com'; ?>" class="team-contact-icon-advanced" aria-label="Email <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:mail" aria-hidden="true"></span></a>
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="LinkedIn profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:linkedin" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Twitter profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:twitter" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['facebook'])): ?>
                  <a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Facebook profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:facebook" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['instagram'])): ?>
                  <a href="<?php echo htmlspecialchars($member['instagram']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Instagram profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:instagram" aria-hidden="true"></span></a>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="panel-developer" role="tabpanel" aria-labelledby="tab-developer" tabindex="-1" hidden>
        <div class="grid-team-members-advanced" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem;">
          <?php foreach ($team['developer'] as $member): ?>
            <article class="team-member-advanced" tabindex="0" aria-labelledby="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>">
              <div class="team-photo-wrapper" style="display: flex; justify-content: center; align-items: center; margin-bottom: 1.2rem;">
                <img src="<?php echo $member['photo']; ?>" alt="Photo of <?php echo htmlspecialchars($member['name']); ?>, <?php echo htmlspecialchars($member['role']); ?>" class="team-photo-advanced" loading="lazy" decoding="async" style="width: 110px; height: 110px; border-radius: 50%; box-shadow: 0 8px 32px rgba(37,99,235,0.18); border: 4px solid var(--primary-light); object-fit: cover; background: var(--content2);">
              </div>
              <h3 id="tm-<?php echo htmlspecialchars(str_replace(' ', '-', strtolower($member['name']))); ?>" class="team-name-advanced" style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.2rem; text-align: center; letter-spacing: 0.01em;"><?php echo htmlspecialchars($member['name']); ?></h3>
              <p class="team-role-advanced" style="font-size: 1.05rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem; text-align: center;"><?php echo htmlspecialchars($member['role']); ?></p>
              <p class="team-bio-advanced" style="font-size: 0.98rem; color: var(--foreground); opacity: 0.88; margin-bottom: 1.3rem; min-height: 3.5rem; text-align: center;"><?php echo htmlspecialchars($member['bio']); ?></p>
              <div class="team-contact-row-advanced" style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 0.5rem;">
                <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" class="team-contact-icon-advanced" aria-label="Call <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:phone" aria-hidden="true"></span></a>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $member['whatsapp']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="WhatsApp <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:message-square" aria-hidden="true"></span></a>
                <a href="mailto:<?php echo !empty($member['email']) ? htmlspecialchars($member['email']) : 'info@wave3limited.com'; ?>" class="team-contact-icon-advanced" aria-label="Email <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:mail" aria-hidden="true"></span></a>
                <?php if (!empty($member['linkedin'])): ?>
                  <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="LinkedIn profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:linkedin" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['twitter'])): ?>
                  <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Twitter profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:twitter" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['facebook'])): ?>
                  <a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank" rel="noopener noreferrer" class="team-contact-icon-advanced" aria-label="Facebook profile of <?php echo htmlspecialchars($member['name']); ?>" style="color: var(--primary-dark); background: var(--content1); border-radius: 50%; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 8px rgba(37,99,235,0.10); transition: background 0.2s, color 0.2s;"><span class="iconify" data-icon="lucide:facebook" aria-hidden="true"></span></a>
                <?php endif; ?>
                <?php if (!empty($member['instagram'])): ?>
        <?php if ($error): ?>
          <div id="form-message" class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg" role="alert" tabindex="0">
            <?php echo htmlspecialchars($error); ?>
          </div>
                <?php endif; ?>
        <div class="form-floating mb-4 contact-float-group">
          <input type="text" id="name" name="name" required autocomplete="name" aria-required="true" class="form-control contact-float-input" placeholder="Name">
          <label for="name" class="contact-float-label">Name</label>
              </div>
        <div class="form-floating mb-4 contact-float-group">
          <input type="email" id="email" name="email" required autocomplete="email" aria-required="true" class="form-control contact-float-input" placeholder="Email">
          <label for="email" class="contact-float-label">Email</label>
        </div>
        <div class="form-floating mb-4 contact-float-group">
          <input type="tel" id="phone" name="phone" autocomplete="tel" class="form-control contact-float-input" placeholder="Phone">
          <label for="phone" class="contact-float-label">Phone (optional)</label>
        </div>
        <div class="form-floating mb-4 contact-float-group">
          <select id="subject" name="subject" required aria-required="true" class="form-control contact-float-input">
            <option value="" disabled selected hidden>Choose a subject</option>
            <option value="General Inquiry">General Inquiry</option>
            <option value="Project Proposal">Project Proposal</option>
            <option value="Partnership">Partnership</option>
            <option value="Support">Support</option>
            <option value="Other">Other</option>
          </select>
          <label for="subject" class="contact-float-label">Subject</label>
        </div>
        <div class="form-floating mb-4 contact-float-group">
          <textarea id="message" name="message" rows="4" required aria-required="true" class="form-control contact-float-input" placeholder="Message" style="min-height: 100px;"></textarea>
          <label for="message" class="contact-float-label">Message</label>
        </div>
        <div class="mb-4" style="display: flex; align-items: flex-start; gap: 0.7rem;">
          <input type="checkbox" id="consent" name="consent" required aria-required="true" style="margin-top: 0.2rem;">
          <label for="consent" style="font-size: 0.98rem; color: var(--foreground); opacity: 0.8;">I agree to the <a href="#" style="color: var(--primary); text-decoration: underline;">privacy policy</a>.</label>
        </div>
        <button type="submit" class="hero-button w-full contact-advanced-submit" aria-label="Send message" style="width: 100%; font-size: 1.08rem; padding: 0.9rem 0; border-radius: 0.8rem;">Send Message</button>
      </form>
    </div>
  </div>
</section>
<style>
.contact-advanced-section {
  background: linear-gradient(135deg, var(--content1) 60%, var(--primary-light) 100%);
  transition: background 0.3s;
}
[data-theme="dark"] .contact-advanced-section {
  background: linear-gradient(135deg, var(--content1) 60%, var(--primary-dark) 100%);
}
.contact-advanced-info, .contact-advanced-form-card {
  background: var(--content2);
  border-radius: 1.5rem;
  box-shadow: 0 8px 32px rgba(37,99,235,0.10);
  transition: background 0.3s, box-shadow 0.3s;
}
[data-theme="dark"] .contact-advanced-info, [data-theme="dark"] .contact-advanced-form-card {
  background: var(--content1);
}
.contact-advanced-link {
  color: var(--primary);
  font-weight: 600;
  text-decoration: none;
  transition: color 0.22s, transform 0.22s, text-decoration 0.22s;
  position: relative;
  z-index: 1;
}
.contact-advanced-link:hover, .contact-advanced-link:focus {
  color: var(--primary-dark);
  text-decoration: underline;
  transform: scale(1.11);
}
.contact-advanced-socials a.contact-social-glow {
  color: var(--primary);
  font-size: 1.7rem;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--content1);
  border-radius: 50%;
  padding: 0;
  box-shadow: 0 1px 4px rgba(37,99,235,0.07);
  transition: background 0.22s, color 0.22s, box-shadow 0.22s, transform 0.22s;
  position: relative;
  outline: none;
  border: 2px solid var(--primary-light);
}
.contact-advanced-socials a.contact-social-glow:hover, .contact-advanced-socials a.contact-social-glow:focus {
  color: #fff;
  background: var(--primary-dark);
  box-shadow: 0 0 18px 6px var(--primary-light), 0 2px 12px rgba(37,99,235,0.22);
  transform: scale(1.15) rotate(-7deg);
  outline: none;
  border-color: var(--primary);
}
.contact-advanced-socials a.contact-social-glow.glow {
  box-shadow: 0 0 16px 4px var(--primary), 0 0 32px 8px var(--primary-light);
  background: var(--primary);
  color: #fff !important;
  outline: none;
  transform: scale(1.13) rotate(-7deg);
  transition: box-shadow 0.18s, background 0.18s, color 0.18s, transform 0.18s;
}
.contact-advanced-socials a.contact-social-glow[data-tooltip]:hover::after,
.contact-advanced-socials a.contact-social-glow[data-tooltip]:focus::after {
  content: attr(data-tooltip);
  position: absolute;
  left: 50%;
  bottom: 120%;
  transform: translateX(-50%);
  background: var(--primary-dark);
  color: #fff;
  padding: 0.25em 0.8em;
  border-radius: 0.4em;
  font-size: 0.98rem;
  white-space: nowrap;
  opacity: 0.97;
  pointer-events: none;
  z-index: 10;
  box-shadow: 0 2px 8px rgba(37,99,235,0.13);
  animation: fadeInSlideUp 0.3s;
}
.contact-advanced-map {
  background: linear-gradient(135deg, var(--primary-light) 0%, var(--content3) 100%);
  color: var(--primary-dark);
  font-size: 1.1rem;
  opacity: 0.7;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 1rem;
  margin-bottom: 0.5rem;
  min-height: 120px;
}
[data-theme="dark"] .contact-advanced-map {
  background: linear-gradient(135deg, var(--primary-dark) 0%, var(--content3) 100%);
  color: var(--primary-light);
}
.contact-advanced-form-card form {
  width: 100%;
}
.contact-float-group {
  position: relative;
  margin-bottom: 1.5rem;
}
.contact-float-input {
  width: 100%;
  padding: 1.1rem 1.1rem 0.6rem 1.1rem;
  border: 1.5px solid var(--content3);
  border-radius: 0.9rem;
  font-size: 1.08rem;
  color: var(--foreground);
  background: var(--content1);
  transition: border-color 0.22s, box-shadow 0.22s;
  font-family: inherit;
  resize: vertical;
}
[data-theme="dark"] .contact-float-input {
  background: var(--content2);
  color: var(--foreground);
}
.contact-float-input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3.5px rgba(59, 130, 246, 0.35);
}
.contact-float-label {
  position: absolute;
  left: 1.1rem;
  top: 1.1rem;
  color: var(--content3);
  font-size: 1.05rem;
  pointer-events: none;
  transition: all 0.2s;
  background: transparent;
}
.contact-float-input:focus + .contact-float-label,
.contact-float-input:not(:placeholder-shown) + .contact-float-label,
.contact-float-input:valid + .contact-float-label {
  top: -0.7rem;
  left: 0.9rem;
  font-size: 0.92rem;
  color: var(--primary);
  background: var(--content2);
  padding: 0 0.3rem;
  border-radius: 0.3rem;
}
[data-theme="dark"] .contact-float-label {
  color: var(--content3);
  background: var(--content1);
}
[data-theme="dark"] .contact-float-input:focus + .contact-float-label,
[data-theme="dark"] .contact-float-input:not(:placeholder-shown) + .contact-float-label,
[data-theme="dark"] .contact-float-input:valid + .contact-float-label {
  color: var(--primary-light);
  background: var(--content1);
}
.contact-advanced-submit {
  margin-top: 1rem;
  background-color: var(--primary);
  color: white;
  border: none;
  padding: 0.9rem 1rem;
  border-radius: 0.9rem;
  font-weight: 700;
  font-size: 1.1rem;
  cursor: pointer;
  width: 100%;
  box-shadow: 0 8px 20px rgba(59, 130, 246, 0.75);
  transition: background-color 0.22s, box-shadow 0.22s, transform 0.22s;
  user-select: none;
}
.contact-advanced-submit:hover, .contact-advanced-submit:focus {
  background-color: var(--primary-dark);
  box-shadow: 0 12px 28px rgba(59, 130, 246, 0.95);
  outline: none;
  transform: scale(1.05);
}
@media (max-width: 900px) {
  .contact-advanced-container {
    flex-direction: column;
    gap: 2rem;
  }
  .contact-advanced-info, .contact-advanced-form-card {
    max-width: 100%;
    padding: 2rem 1rem;
  }
}
@media (max-width: 600px) {
  .contact-advanced-container {
    padding: 1.2rem 0.2rem 1.2rem 0.2rem;
    gap: 1.2rem;
  }
  .contact-advanced-info, .contact-advanced-form-card {
    padding: 1.2rem 0.5rem;
    border-radius: 1rem;
  }
  .contact-advanced-map {
    min-height: 80px;
    font-size: 0.98rem;
  }
  .contact-advanced-list li, .contact-advanced-list a, .contact-advanced-list span {
    font-size: 0.98rem !important;
  }
  .contact-advanced-socials {
    gap: 0.7rem !important;
  }
}
</style>
<script>
// Social icon glow on click/tap
(function() {
  document.querySelectorAll('.contact-social-glow').forEach(function(el) {
    el.addEventListener('mousedown', function() {
      el.classList.add('glow');
    });
    el.addEventListener('mouseup', function() {
      setTimeout(function() { el.classList.remove('glow'); }, 300);
    });
    el.addEventListener('mouseleave', function() {
      el.classList.remove('glow');
    });
    el.addEventListener('touchstart', function() {
      el.classList.add('glow');
    });
    el.addEventListener('touchend', function() {
      setTimeout(function() { el.classList.remove('glow'); }, 300);
    });
  });
})();
// Floating label for select
(function() {
  document.querySelectorAll('.contact-float-input').forEach(function(input) {
    input.addEventListener('change', function() {
      if (input.value) {
        input.classList.add('has-value');
      } else {
        input.classList.remove('has-value');
      }
    });
  });
})();
// Real-time validation feedback
(function() {
  const form = document.querySelector('.contact-advanced-form');
  if (!form) return;
  form.addEventListener('input', function(e) {
    if (e.target.checkValidity()) {
      e.target.classList.remove('invalid');
    } else {
      e.target.classList.add('invalid');
    }
  });
  form.addEventListener('submit', function(e) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Sending...';
    submitBtn.disabled = true;
    submitBtn.classList.add('loading');
    setTimeout(() => {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
      submitBtn.classList.remove('loading');
    }, 3000);
  });
})();
</script>
  <?php else: ?>
    <section class="min-h-screen flex items-center justify-center">
      <h2 class="text-3xl font-bold">Page Not Found</h2>
    </section>
  <?php endif; ?>
  </main>

    <footer role="contentinfo" class="footer-advanced" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%); color: var(--foreground); box-shadow: 0 -4px 24px rgba(0,0,0,0.08); margin-top: 4rem; font-size: 1rem; font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">
    <div class="footer-main-adv" style="max-width: 1280px; margin: 0 auto; padding: 3rem 1.5rem 1.5rem 1.5rem;">
      <div class="footer-grid-adv" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2.5rem; align-items: flex-start; border-bottom: 1px solid var(--content3);">
        <section class="footer-brand-adv" style="display: flex; flex-direction: column; align-items: flex-start; gap: 1.2rem; min-width: 220px;">
          <img src="assets/WAVElogo01.png" alt="Wave 3 Limited logo" class="footer-logo-adv" loading="lazy" style="width: 70px; height: auto; border-radius: 12px; box-shadow: 0 2px 8px rgba(37,99,235,0.08); margin-bottom: 0.5rem; background: #fff; transition: box-shadow 0.3s;" />
          <div>
            <p class="footer-desc-adv" style="font-size: 1.05rem; color: var(--foreground); opacity: 0.85; margin-bottom: 0.5rem; line-height: 1.6;">Wave 3 Limited delivers innovative IT solutions with integrity and passion, empowering businesses in Bangladesh and beyond.</p>
            <span class="footer-tagline-adv" style="font-size: 0.98rem; color: var(--primary); font-weight: 600; letter-spacing: 0.01em; margin-top: 0.2rem; display: block;">Professional IT Solutions for a Digital World</span>
          </div>
        </section>
        <nav class="footer-links-adv" aria-label="Footer quick links">
          <h3 class="footer-title-adv" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); letter-spacing: 0.01em;">Quick Links</h3>
          <ul style="list-style: none; padding: 0; margin: 0;">
            <?php foreach ($nav_items as $page => $label): ?>
              <li><a href="?page=<?php echo $page; ?>" class="footer-link-adv" style="color: var(--foreground); text-decoration: none; display: block; margin-bottom: 0.5rem; transition: color 0.2s, background 0.2s, padding 0.2s; font-weight: 500; border-radius: 0.3rem; padding: 0.2rem 0.1rem; position: relative;"> <?php echo htmlspecialchars($label); ?> </a></li>
          <?php endforeach; ?>
          </ul>
        </nav>
        <section class="footer-contact-adv">
          <h3 class="footer-title-adv" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); letter-spacing: 0.01em;">Contact</h3>
          <ul class="footer-contact-list-adv" style="list-style: none; padding: 0; margin: 0;">
            <li style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.1rem; color: var(--foreground); opacity: 0.9; font-size: 1rem;">
              <img src="assets/icons/gps.png" alt="Address" style="width: 24px; height: 24px; border-radius: 6px; margin-right: 0.2rem; box-shadow: 0 1px 4px rgba(37,99,235,0.08); background: #fff; object-fit: contain;" loading="lazy" />
              1188/2/B East Shewrapara, Kafrul, Mirpur, Dhaka-1216
            </li>
            <li style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.1rem; color: var(--foreground); opacity: 0.9; font-size: 1rem;">
              <img src="assets/icons/telephone.png" alt="Phone" style="width: 24px; height: 24px; border-radius: 6px; margin-right: 0.2rem; box-shadow: 0 1px 4px rgba(37,99,235,0.08); background: #fff; object-fit: contain;" loading="lazy" />
              <a href="tel:+8801711019152" style="color: var(--primary); text-decoration: none; font-weight: 600; transition: color 0.2s;">+880 1711-019152</a>
            </li>
            <li style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.1rem; color: var(--foreground); opacity: 0.9; font-size: 1rem;">
              <img src="assets/icons/mail.png" alt="Email" style="width: 24px; height: 24px; border-radius: 6px; margin-right: 0.2rem; box-shadow: 0 1px 4px rgba(37,99,235,0.08); background: #fff; object-fit: contain;" loading="lazy" />
              <a href="mailto:info@wave3limited.com" style="color: #f59e42; text-decoration: none; font-weight: 600;">info@wave3limited.com</a>
            </li>
          </ul>
        </section>
        <section class="footer-newsletter-adv" aria-label="Newsletter subscription" style="display: flex; flex-direction: column; gap: 0.7rem;">
          <h3 class="footer-title-adv" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); letter-spacing: 0.01em;">Newsletter</h3>
          <form class="newsletter-form-adv" autocomplete="off" onsubmit="event.preventDefault(); showNewsletterSuccess(this);" style="display: flex; gap: 0.5rem; align-items: center; background: var(--content1); border-radius: 0.7rem; padding: 0.3rem 0.5rem; box-shadow: 0 1px 4px rgba(37,99,235,0.07); border: 1px solid var(--content3); position: relative;">
            <label for="newsletter-email-adv" class="sr-only">Email address</label>
            <input type="email" id="newsletter-email-adv" name="email" placeholder="Your email address" required aria-required="true" style="border: none; background: transparent; padding: 0.6rem 0.5rem; font-size: 1rem; color: var(--foreground); flex: 1; outline: none;">
            <input type="text" name="website" class="newsletter-honeypot" tabindex="-1" autocomplete="off" style="display:none;" aria-hidden="true" />
            <button type="submit" aria-label="Subscribe" style="background: var(--primary); color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 0.7rem; cursor: pointer; transition: background 0.2s, transform 0.2s; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(37,99,235,0.08);"><span class="iconify" data-icon="lucide:send"></span></button>
          </form>
          <div class="newsletter-success-adv" style="display:none; background: #d1fae5; color: #065f46; border-radius: 0.5rem; padding: 0.5rem 1rem; margin-top: 0.5rem; font-size: 1rem; text-align: left; animation: fadeInSlideUp 0.5s;">Thank you for subscribing!</div>
          <p class="newsletter-hint-adv" style="font-size: 0.95rem; color: var(--foreground); opacity: 0.7; margin-top: 0.2rem;">Get updates & offers. No spam.</p>
        </section>
        <section class="footer-social-adv">
          <h3 class="footer-title-adv" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary); letter-spacing: 0.01em;">Follow Us</h3>
          <div class="footer-socials-adv" aria-label="Social media links" style="display: flex; gap: 1rem; margin-top: 0.5rem;">
            <a href="https://facebook.com/wave3limited" aria-label="Facebook" target="_blank" rel="noopener" title="Facebook" style="background: #1877f2; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; transition: background 0.2s, transform 0.2s;"><img src="assets/icons/facebook.png" alt="Facebook" style="width: 22px; height: 22px; display: block;" /></a>
            <a href="https://twitter.com/wave3limited" aria-label="Twitter" target="_blank" rel="noopener" title="Twitter" style="background: #1da1f2; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; transition: background 0.2s, transform 0.2s;"><img src="assets/icons/linkedin.png" alt="Twitter" style="width: 22px; height: 22px; display: block;" /></a>
            <a href="https://instagram.com/wave3limited" aria-label="Instagram" target="_blank" rel="noopener" title="Instagram" style="background: #e1306c; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; transition: background 0.2s, transform 0.2s;"><img src="assets/icons/instagram.png" alt="Instagram" style="width: 22px; height: 22px; display: block;" /></a>
            <a href="https://wa.me/8801711019152" aria-label="WhatsApp" target="_blank" rel="noopener" title="WhatsApp" style="background: #25d366; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; transition: background 0.2s, transform 0.2s;"><img src="assets/icons/whatsapp.png" alt="WhatsApp" style="width: 22px; height: 22px; display: block;" /></a>
            <a href="https://linkedin.com/company/wave3limited" aria-label="LinkedIn" target="_blank" rel="noopener" title="LinkedIn" style="background: #0a66c2; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; transition: background 0.2s, transform 0.2s;"><img src="assets/icons/linkedin.png" alt="LinkedIn" style="width: 22px; height: 22px; display: block;" /></a>
        </div>
        </section>
      </div>
              </div>
    <div class="footer-divider-adv" aria-hidden="true" style="width: 100%; height: 1px; background: var(--content3); margin: 0 auto; opacity: 0.5;"></div>
    <div class="footer-bottom-bar-adv" style="background: transparent; color: var(--foreground); padding: 0.7rem 0; font-size: 0.98rem; text-align: center;">
      <div class="footer-bottom-content-adv" style="max-width: 1280px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; padding: 0 1.5rem;">
        <span>&copy; <?php echo date('Y'); ?> Wave 3 Limited. All rights reserved.</span>
        <span class="footer-legal-links-adv" style="color: var(--primary); font-size: 0.98rem; display: flex; gap: 0.5rem; align-items: center;">
          <a href="#" tabindex="0" style="color: var(--primary); opacity: 0.85; margin: 0 0.1rem; text-decoration: underline; transition: opacity 0.2s;">Privacy Policy</a>
          <span aria-hidden="true">|</span>
          <a href="#" tabindex="0" style="color: var(--primary); opacity: 0.85; margin: 0 0.1rem; text-decoration: underline; transition: opacity 0.2s;">Terms of Service</a>
        </span>
      </div>
    </div>
  </footer>

    <!-- Floating Dark Mode Toggle Button -->
    <button id="dark-mode-toggle" aria-label="Toggle dark mode" title="Toggle dark mode" class="dark-toggle-adv"
        type="button">
    <span id="dark-mode-icon" class="iconify" data-icon="lucide:moon" style="font-size: 24px;"></span>
  </button>

    <style>
    .footer-advanced {
        background: linear-gradient(135deg, var(--content2) 60%, var(--primary-light) 100%);
        color: var(--foreground);
        box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.08);
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
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
        margin-bottom: 0.5rem;
        background: #fff;
        transition: box-shadow 0.3s;
    }

    .footer-logo-adv:hover,
    .footer-logo-adv:focus {
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.18);
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

    .footer-links-adv ul,
    .footer-contact-list-adv {
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

    .footer-link-adv:hover,
    .footer-link-adv:focus {
        color: var(--primary-dark);
        background: rgba(37, 99, 235, 0.08);
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

    .footer-contact-list-adv a:hover,
    .footer-contact-list-adv a:focus {
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
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
    }

    .newsletter-form-adv button:hover,
    .newsletter-form-adv button:focus {
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

    .newsletter-honeypot {
        display: none !important;
    }

    .footer-socials-adv {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .footer-socials-adv a {
        color: var(--primary);
        font-size: 1.5rem;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s, transform 0.2s, background 0.2s;
        border-radius: 50%;
        padding: 0;
        background: var(--content1);
        box-shadow: 0 1px 4px rgba(37, 99, 235, 0.07);
        position: relative;
        outline: none;
    }

    .footer-socials-adv a:hover,
    .footer-socials-adv a:focus {
        color: #fff;
        background: var(--primary-dark);
        transform: scale(1.12) rotate(-8deg);
        outline: 2px solid var(--primary-dark);
    }

    .footer-socials-adv a[title]:hover::after,
    .footer-socials-adv a[title]:focus::after {
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

    .footer-legal-links-adv a:hover,
    .footer-legal-links-adv a:focus {
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

    [data-theme="dark"] .footer-link-adv:hover,
    [data-theme="dark"] .footer-link-adv:focus {
        color: var(--primary-light);
        background: rgba(59, 130, 246, 0.08);
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
        box-shadow: 0 4px 24px rgba(37, 99, 235, 0.18);
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
    .dark-toggle-adv:hover,
    .dark-toggle-adv:focus {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.28);
        transform: scale(1.08);
        outline: 2px solid var(--primary-dark);
    }
    [data-theme="dark"] .dark-toggle-adv {
        background: var(--content1);
        color: var(--primary-light);
    }
    [data-theme="dark"] .dark-toggle-adv:hover,
    [data-theme="dark"] .dark-toggle-adv:focus {
        background: var(--primary-dark);
        color: #fff;
    }
    @media (max-width: 600px) {
        .dark-toggle-adv {
            width: 48px;
            height: 48px;
            font-size: 1.2rem;
            bottom: 1rem;
            right: 1rem;
        }
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
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
            setTimeout(() => {
                success.style.display = 'none';
            }, 3500);
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
    // Move toggle button with scroll (not fixed)
    function updateTogglePosition() {
        const scrollY = window.scrollY || window.pageYOffset;
        // 2rem from bottom, plus scroll offset
        toggle.style.bottom = (32 + scrollY) + 'px';
    }
    window.addEventListener('scroll', updateTogglePosition);
    window.addEventListener('resize', updateTogglePosition);
    document.addEventListener('DOMContentLoaded', updateTogglePosition);
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
        const cards = document.querySelectorAll(
            '.service-card, .company-card, .team-member, .sister-card-custom');
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
      const overlay = document.getElementById('mobile-menu-overlay');
      const button = document.querySelector('[aria-controls="mobile-menu"]');
      const isShown = menu.classList.toggle('show');

      button.setAttribute('aria-expanded', isShown.toString());
      document.body.style.overflow = isShown ? 'hidden' : '';
      
      if (overlay) {
        overlay.classList.toggle('show');
      }

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
      const overlay = document.getElementById('mobile-menu-overlay');
      
      if (menu.classList.contains('show') && 
          !menu.contains(e.target) && 
          !button.contains(e.target) && 
          !overlay?.contains(e.target)) {
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

    // Enhanced mobile menu animations
    document.addEventListener('DOMContentLoaded', () => {
      const menu = document.getElementById('mobile-menu');
      const overlay = document.getElementById('mobile-menu-overlay');
      
      if (menu && overlay) {
        // Add smooth animations
        menu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        overlay.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';
      }
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
        anchor.addEventListener('click', function(e) {
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
    if (currentPage === 'home') {
        preloadResource('?page=services', 'fetch');
    }
    </script>
    <script>
    // Social icon glow on click
    document.querySelectorAll('.contact-socials a.social-glow').forEach(function(el) {
      el.addEventListener('mousedown', function() {
        el.classList.add('glow');
      });
      el.addEventListener('mouseup', function() {
        setTimeout(function() { el.classList.remove('glow'); }, 300);
      });
      el.addEventListener('mouseleave', function() {
        el.classList.remove('glow');
      });
      el.addEventListener('touchstart', function() {
        el.classList.add('glow');
      });
      el.addEventListener('touchend', function() {
        setTimeout(function() { el.classList.remove('glow'); }, 300);
      });
    });
    </script>
</body>

</html>

