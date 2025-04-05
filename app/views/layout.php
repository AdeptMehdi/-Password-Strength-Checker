<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <!-- Yekan Font from CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#4F46E5',
                    }
                }
            }
        }
    </script>
    <style>
        /* فونت وزیر */
        @font-face {
            font-family: Vazir;
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/Vazir.eot');
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/Vazir.eot?#iefix') format('embedded-opentype'),
                 url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/Vazir.woff2') format('woff2'),
                 url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/Vazir.woff') format('woff'),
                 url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/Vazir.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        /* فونت یکان */
        @font-face {
            font-family: 'Yekan';
            src: url('https://cdn.jsdelivr.net/gh/hosseinmh/cdn/fonts/yekan/Yekan.eot');
            src: url('https://cdn.jsdelivr.net/gh/hosseinmh/cdn/fonts/yekan/Yekan.eot?#iefix') format('embedded-opentype'),
                 url('https://cdn.jsdelivr.net/gh/hosseinmh/cdn/fonts/yekan/Yekan.woff2') format('woff2'),
                 url('https://cdn.jsdelivr.net/gh/hosseinmh/cdn/fonts/yekan/Yekan.woff') format('woff'),
                 url('https://cdn.jsdelivr.net/gh/hosseinmh/cdn/fonts/yekan/Yekan.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        /* فونت یکان - منبع جایگزین */
        @font-face {
            font-family: 'Yekan';
            src: url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.eot');
            src: url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.eot?#iefix') format('embedded-opentype'),
                 url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.woff') format('woff'),
                 url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        /* فونت یکان - روش دوم */
        @font-face {
            font-family: 'Yekan';
            src: url('https://cdn.jsdelivr.net/npm/font-vasir@1.0.0/dist/font-yekan/Yekan.eot');
            src: url('https://cdn.jsdelivr.net/npm/font-vasir@1.0.0/dist/font-yekan/Yekan.eot?#iefix') format('embedded-opentype'),
                 url('https://cdn.jsdelivr.net/npm/font-vasir@1.0.0/dist/font-yekan/Yekan.woff') format('woff'),
                 url('https://cdn.jsdelivr.net/npm/font-vasir@1.0.0/dist/font-yekan/Yekan.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        /* فونت یکان - روش سوم */
        @font-face {
            font-family: 'Yekan';
            src: url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.eot');
            src: url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.eot?#iefix') format('embedded-opentype'),
                 url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.woff') format('woff'),
                 url('https://raw.githubusercontent.com/ParsMizban/Yekan-Font/master/Yekan.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        
        /* تنظیم فونت سایت */
        body {
            font-family: 'Yekan', 'Vazirmatn', 'Vazir', tahoma, sans-serif;
        }
        
        /* تعریف کلاس اختصاصی برای فونت یکان */
        .font-yekan {
            font-family: 'Yekan', 'Vazirmatn', 'Vazir', tahoma, sans-serif;
        }
        
        /* Background */
        .animated-bg {
            background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #1a1448);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            min-height: 100vh;
            position: relative;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        /* Particles.js */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        
        .particles-js-canvas-el {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }
        
        /* Card Animation */
        .card-entrance {
            animation: card-appear 0.7s cubic-bezier(0.21, 1.11, 0.7, 1.2);
        }
        
        @keyframes card-appear {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Content Wrapper */
        .content-wrapper {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.08);
            background-image: linear-gradient(
                135deg, 
                rgba(255, 255, 255, 0.15) 0%, 
                rgba(255, 255, 255, 0.05) 100%
            );
            border-radius: 1.2rem;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            border: none;
            position: relative;
            overflow: hidden;
        }
        
        /* Shiny border effect */
        .content-wrapper::before {
            display: none;
        }
        
        @keyframes shine {
            0% { left: -150%; }
            20% { left: 100%; }
            100% { left: 100%; }
        }
        
        /* Floating animation */
        .float-animation {
            animation: floating 6s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px) rotate3d(0, 0, 0, 0deg); }
            50% { transform: translateY(-15px) rotate3d(1, 2, 1, 2deg); }
            100% { transform: translateY(0px) rotate3d(0, 0, 0, 0deg); }
        }
        
        /* Enhanced entrance animation */
        .card-entrance {
            animation: card-appear 1s cubic-bezier(0.21, 1.11, 0.7, 1.2);
        }
        
        @keyframes card-appear {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.9);
                box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            }
            70% {
                opacity: 1;
                transform: translateY(-10px) scale(1.02);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Inner glow pulse */
        .pulse-glow {
            position: relative;
        }
        
        .pulse-glow::after {
            display: none;
        }
        
        @keyframes pulse {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }
        
        /* Content wrapper hover effects */
        .hover-effects {
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        
        .hover-effects:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        /* GitHub link styles */
        .github-link-container {
            animation: float-subtle 3s ease-in-out infinite;
        }
        
        @keyframes float-subtle {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        
        .github-link {
            position: relative;
            overflow: hidden;
        }
        
        .github-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shine-github 6s infinite;
        }
        
        @keyframes shine-github {
            0% { left: -100%; }
            20% { left: 100%; }
            100% { left: 100%; }
        }
        
        /* Feedback Styling */
        #feedback-container {
            display: none;
        }
        
        #feedback-list {
            display: none;
        }
        
        /* Password strength meter styling */
        #strength-meter-container {
            margin-bottom: 1.5rem;
        }
        
        #strength-meter {
            border-radius: 4px;
            transition: width 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        
        #strength-text {
            transition: all 0.3s ease;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            font-weight: 600;
        }
        
        /* Main Content Animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes floatAnimation {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        
        @keyframes pulse-delayed {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.05); }
        }
        
        @keyframes borderGlow {
            0%, 100% { border-color: rgba(255, 255, 255, 0.1); }
            50% { border-color: rgba(255, 255, 255, 0.3); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-float {
            animation: floatAnimation 6s ease-in-out infinite;
        }
        
        .animate-pulse-delayed {
            animation: pulse-delayed 4s infinite;
            animation-delay: 2s;
        }
        
        .animate-border-glow {
            animation: borderGlow 4s ease-in-out infinite;
        }
        
        .animation-delay-200 {
            animation-delay: 0.2s;
        }
        
        .animation-delay-400 {
            animation-delay: 0.4s;
        }
        
        /* Content Container Styling */
        .content-container {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.2),
                0 10px 10px -5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 36rem;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .content-container:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 25px 30px -5px rgba(0, 0, 0, 0.3),
                0 15px 15px -5px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* Glowing orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            z-index: -1;
            opacity: 0.5;
        }
        
        .orb-blue {
            width: 150px;
            height: 150px;
            background: rgba(56, 182, 255, 0.1);
            top: -75px;
            right: -75px;
        }
        
        .orb-purple {
            width: 150px;
            height: 150px;
            background: rgba(132, 56, 255, 0.1);
            bottom: -75px;
            left: -75px;
        }
        
        /* RTL/LTR Switching */
        .is-rtl {
            direction: rtl;
            text-align: right;
        }
        
        .is-ltr {
            direction: ltr;
            text-align: left;
        }
        
        /* Adjust padding for LTR mode */
        .is-ltr .mr-2 {
            margin-right: 0;
            margin-left: 0.5rem;
        }
        
        .is-ltr .ml-1, .is-ltr .ml-2, .is-ltr .ml-3 {
            margin-left: 0;
            margin-right: 0.25rem;
        }
        
        /* Keep some elements centered regardless of direction */
        .text-center {
            text-align: center !important;
        }
    </style>
</head>
<body class="animated-bg min-h-screen">
    <!-- Particles.js Container -->
    <div id="particles-js"></div>
    
    <div class="container mx-auto px-4">
        <!-- Language Switcher -->
        <div class="fixed top-4 left-4 z-10">
            <button class="language-switcher-btn bg-white/20 hover:bg-white/30 text-white rounded-full py-2 px-3 flex items-center backdrop-blur-sm border border-white/10 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
                <span>English</span>
            </button>
        </div>
        
        <header class="py-6">
            <h1 class="text-3xl font-bold text-center text-white drop-shadow-lg font-yekan"><?= APP_NAME ?></h1>
        </header>
        
        <main>
            <div class="flex justify-center items-center">
                <div>
                    <!-- Animated background elements -->
                    <div class="orb orb-blue animate-pulse"></div>
                    <div class="orb orb-purple animate-pulse-delayed"></div>
                    
                    <!-- Content wrapper with z-index -->
                    <div class="relative z-10">
                        <?php include $content; ?>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="py-6 mt-8 text-center">
            <div class="github-link-container inline-block">
                <a href="https://github.com/AdeptMehdi/" target="_blank" class="github-link group flex items-center justify-center px-4 py-2 rounded-full backdrop-blur-sm bg-white/10 border border-white/20 transition-all duration-500 hover:bg-white/20 hover:scale-105 hover:shadow-lg shadow-md">
                    <div class="github-icon-wrapper relative overflow-hidden ml-1">
                        <svg class="w-6 h-6 text-white group-hover:animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                        </svg>
                    </div>
                    <span class="text-white font-medium tracking-wide text-sm ml-1 group-hover:text-primary transition-colors duration-300">github.com/AdeptMehdi</span>
                </a>
            </div>
        </footer>
    </div>
    
    <!-- Animation Scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove complex animations to prevent browser crashes
    });
    </script>
    
    <!-- Language Switcher Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Language translations
        const translations = {
            'fa': {
                'appTitle': 'بررسی قدرت رمز عبور',
                'checkSecurity': 'امنیت رمز عبور خود را بررسی کنید',
                'enterPassword': 'رمز عبور خود را وارد کنید:',
                'passwordPlaceholder': 'رمز عبور را وارد کنید...',
                'strengthLabel': 'قدرت رمز عبور:',
                'generatePassword': 'تولید رمز عبور قوی',
                'generating': 'در حال تولید...',
                'strongPasswordTitle': 'یک رمز عبور قوی باید:',
                'req1': 'حداقل 8 کاراکتر داشته باشد',
                'req2': 'شامل حروف بزرگ باشد',
                'req3': 'شامل حروف کوچک باشد',
                'req4': 'شامل اعداد باشد',
                'req5': 'شامل کاراکترهای ویژه باشد',
                'req6': 'عدم استفاده از الگوهای متداول',
                'viewOnGithub': 'مشاهده در گیت‌هاب',
                'footerText': 'ساخته شده با ❤️',
                'switchLang': 'English'
            },
            'en': {
                'appTitle': 'Password Strength Checker',
                'checkSecurity': 'Check Your Password Security',
                'enterPassword': 'Enter your password:',
                'passwordPlaceholder': 'Enter password...',
                'strengthLabel': 'Password strength:',
                'generatePassword': 'Generate Strong Password',
                'generating': 'Generating...',
                'strongPasswordTitle': 'A strong password should:',
                'req1': 'Be at least 8 characters long',
                'req2': 'Include uppercase letters',
                'req3': 'Include lowercase letters',
                'req4': 'Include numbers',
                'req5': 'Include special characters',
                'req6': 'Avoid common patterns',
                'viewOnGithub': 'View on GitHub',
                'footerText': 'Made with ❤️',
                'switchLang': 'فارسی'
            }
        };
        
        // Set default language
        let currentLang = 'fa';
        
        // Get language switcher button
        const langSwitcher = document.querySelector('.language-switcher-btn');
        if (!langSwitcher) return;
        
        // Add click event listener to language switcher
        langSwitcher.addEventListener('click', function() {
            // Toggle language
            currentLang = currentLang === 'fa' ? 'en' : 'fa';
            
            // Update page content
            updatePageLanguage(currentLang);
            
            // Update HTML dir attribute
            document.documentElement.dir = currentLang === 'fa' ? 'rtl' : 'ltr';
            
            // Add/remove RTL class for styling
            document.body.classList.toggle('is-rtl', currentLang === 'fa');
            document.body.classList.toggle('is-ltr', currentLang === 'en');
        });
        
        // Function to update page language
        function updatePageLanguage(lang) {
            // Update title
            document.title = translations[lang]['appTitle'];
            
            // Update header
            const headerTitle = document.querySelector('header h1');
            if (headerTitle) headerTitle.textContent = translations[lang]['appTitle'];
            
            // Update main content if available
            const mainTitle = document.querySelector('main h2');
            if (mainTitle) mainTitle.textContent = translations[lang]['checkSecurity'];
            
            const passwordLabel = document.querySelector('label[for="password"]');
            if (passwordLabel) passwordLabel.textContent = translations[lang]['enterPassword'];
            
            const passwordInput = document.getElementById('password');
            if (passwordInput) passwordInput.placeholder = translations[lang]['passwordPlaceholder'];
            
            const strengthLabel = document.querySelector('#strength-meter-container label');
            if (strengthLabel) strengthLabel.textContent = translations[lang]['strengthLabel'];
            
            const generateBtn = document.getElementById('generate-password');
            if (generateBtn) generateBtn.textContent = translations[lang]['generatePassword'];
            
            // Update password requirements
            const requirementsTitle = document.querySelector('main h3');
            if (requirementsTitle) requirementsTitle.textContent = translations[lang]['strongPasswordTitle'];
            
            const requirementsList = document.querySelectorAll('main ul li');
            if (requirementsList.length >= 6) {
                requirementsList[0].innerHTML = requirementsList[0].innerHTML.replace(/[^<>]+(?=<\/span>)/, translations[lang]['req1']);
                requirementsList[1].innerHTML = requirementsList[1].innerHTML.replace(/[^<>]+(?=<\/span>)/, translations[lang]['req2']);
                requirementsList[2].innerHTML = requirementsList[2].innerHTML.replace(/[^<>]+(?=<\/span>)/, translations[lang]['req3']);
                requirementsList[3].innerHTML = requirementsList[3].innerHTML.replace(/[^<>]+(?=<\/span>)/, translations[lang]['req4']);
                requirementsList[4].innerHTML = requirementsList[4].innerHTML.replace(/[^<>]+(?=<\/span>)/, translations[lang]['req5']);
                requirementsList[5].innerHTML = requirementsList[5].innerHTML.replace(/[^<>]+(?=<\/span>)/, translations[lang]['req6']);
            }
            
            // Update footer
            const githubLink = document.querySelector('.github-link span');
            if (githubLink) githubLink.textContent = translations[lang]['viewOnGithub'];
            
            const footerText = document.querySelector('footer p');
            if (footerText) {
                const year = new Date().getFullYear();
                footerText.innerHTML = `${translations[lang]['footerText']} | ${year}`;
            }
            
            // Update language switcher button
            langSwitcher.querySelector('span').textContent = translations[lang]['switchLang'];
        }
    });
    </script>
    
    <!-- Particles.js Library & Config -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 40,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 2,
                        "size_min": 0.3,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.3,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": false,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "push": {
                        "particles_nb": 4
                    }
                }
            },
            "retina_detect": false
        });
    });
    </script>
    
    <!-- Application Scripts -->
    <script src="js/app.js"></script>
</body>
</html> 