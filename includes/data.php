<?php
// Data arrays for services, companies, and team members

$services = [
    ['id' => 1, 'title' => 'Web Development', 'description' => 'Custom web applications tailored to your needs', 'icon' => 'lucide:code'],
    ['id' => 2, 'title' => 'Mobile App Development', 'description' => 'iOS and Android apps with cutting-edge features', 'icon' => 'lucide:smartphone'],
    ['id' => 3, 'title' => 'Cloud Solutions', 'description' => 'Scalable and secure cloud infrastructure', 'icon' => 'lucide:cloud'],
    ['id' => 4, 'title' => 'Data Analytics', 'description' => 'Insights from your data to drive business decisions', 'icon' => 'lucide:bar-chart'],
    ['id' => 5, 'title' => 'UI/UX Design', 'description' => 'Beautiful and intuitive user interfaces', 'icon' => 'lucide:palette'],
    ['id' => 6, 'title' => 'Cybersecurity', 'description' => 'Protect your digital assets with our security solutions', 'icon' => 'lucide:shield']
];

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

// Helper functions

function getTeamMemberImage($photo_path) {
    if (file_exists($photo_path)) {
        return $photo_path;
    }
    return 'assets/team/default-avatar.png';
}

function getCompanyLogo($company_key) {
    $logo_path = "assets/companies/{$company_key}-logo.png";
    if (file_exists($logo_path)) {
        return $logo_path;
    }
    return 'assets/WAVElogo01.png';
}

function getServiceIcon($icon_name) {
    return $icon_name;
}

function optimizeImagePath($path) {
    $path = ltrim($path, '/');
    if (!file_exists($path)) {
        return 'assets/team/default-avatar.png';
    }
    return $path;
}
?>
