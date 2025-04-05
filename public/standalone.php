<?php
// Self-contained standalone version of password strength checker

// ===== PASSWORD MODEL =====
class PasswordModel {
    private $password;
    private $strength;
    private $feedback = [];
    
    public function __construct($password = '') {
        $this->password = $password;
        $this->calculateStrength();
    }
    
    public function setPassword($password) {
        $this->password = $password;
        $this->calculateStrength();
        return $this;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getStrength() {
        return $this->strength;
    }
    
    public function getStrengthLabel() {
        if ($this->strength >= 80) {
            return 'خیلی قوی';
        } elseif ($this->strength >= 60) {
            return 'قوی';
        } elseif ($this->strength >= 40) {
            return 'متوسط';
        } elseif ($this->strength >= 20) {
            return 'ضعیف';
        } else {
            return 'خیلی ضعیف';
        }
    }
    
    public function getStrengthColor() {
        if ($this->strength >= 80) {
            return 'darkgreen';
        } elseif ($this->strength >= 60) {
            return 'green';
        } elseif ($this->strength >= 40) {
            return 'orange';
        } elseif ($this->strength >= 20) {
            return 'red';
        } else {
            return 'darkred';
        }
    }
    
    public function getFeedback() {
        return $this->feedback;
    }
    
    private function calculateStrength() {
        // Reset
        $this->strength = 0;
        $this->feedback = [];
        
        if (empty($this->password)) {
            return;
        }
        
        $length = strlen($this->password);
        
        // Length check
        if ($length < 8) {
            $this->feedback[] = 'رمز عبور باید حداقل 8 کاراکتر باشد.';
        } else {
            $this->strength += 10;
            
            // Bonus points for longer passwords
            if ($length > 12) {
                $this->strength += 10;
            }
        }
        
        // Character variety checks
        $hasLower = preg_match('/[a-z]/', $this->password);
        $hasUpper = preg_match('/[A-Z]/', $this->password);
        $hasDigit = preg_match('/\d/', $this->password);
        $hasSpecial = preg_match('/[^a-zA-Z\d]/', $this->password);
        
        if (!$hasLower) {
            $this->feedback[] = 'استفاده از حروف کوچک را در نظر بگیرید.';
        } else {
            $this->strength += 10;
        }
        
        if (!$hasUpper) {
            $this->feedback[] = 'استفاده از حروف بزرگ را در نظر بگیرید.';
        } else {
            $this->strength += 15;
        }
        
        if (!$hasDigit) {
            $this->feedback[] = 'استفاده از اعداد را در نظر بگیرید.';
        } else {
            $this->strength += 15;
        }
        
        if (!$hasSpecial) {
            $this->feedback[] = 'استفاده از کاراکترهای ویژه را در نظر بگیرید.';
        } else {
            $this->strength += 20;
        }
        
        // Check for patterns and repetition
        if (preg_match('/(.)\1{2,}/', $this->password)) {
            $this->feedback[] = 'از تکرار کاراکترها اجتناب کنید.';
            $this->strength -= 10;
        }
        
        // Check for sequential characters
        if (preg_match('/(abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz|012|123|234|345|456|567|678|789|890)/', strtolower($this->password))) {
            $this->feedback[] = 'از کاراکترهای متوالی اجتناب کنید.';
            $this->strength -= 10;
        }
        
        // Common passwords check
        $commonPasswords = ['password', '123456', 'qwerty', 'abc123', 'admin', 'welcome', 'password123'];
        if (in_array(strtolower($this->password), $commonPasswords)) {
            $this->feedback[] = 'این رمز عبور بسیار رایج است.';
            $this->strength = 0;
        }
        
        // Ensure strength is between 0 and 100
        $this->strength = max(0, min(100, $this->strength));
        
        // If no feedback was given and strength is at least medium, add a positive message
        if (empty($this->feedback) && $this->strength >= 40) {
            $this->feedback[] = 'رمز عبور خوبی انتخاب کرده‌اید!';
        }
    }
}

// Process AJAX requests
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST['password'])) {
        $model = new PasswordModel($_POST['password']);
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'strength' => $model->getStrength(),
            'label' => $model->getStrengthLabel(),
            'color' => $model->getStrengthColor(),
            'feedback' => $model->getFeedback()
        ]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بررسی قدرت رمز عبور</title>
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
        body {
            font-family: 'Vazir', sans-serif;
        }
        
        /* Animated Background */
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
        
        .animated-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            min-height: 100vh;
        }
        
        .content-wrapper {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Particle effect */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* Button animation */
        .btn-animated {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-animated:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }
        
        .btn-animated:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: translateX(-100%);
            transition: all 0.6s ease;
        }
        
        .btn-animated:hover:before {
            transform: translateX(100%);
        }
        
        /* Wave effect */
        .wave-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            overflow: hidden;
            z-index: -1;
        }
        
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.2)" fill-opacity="1" d="M0,192L48,176C96,160,192,128,288,117.3C384,107,480,117,576,144C672,171,768,213,864,218.7C960,224,1056,192,1152,186.7C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-repeat: repeat-x;
            animation: wave-animation 25s infinite linear;
        }
        
        .wave:nth-child(2) {
            bottom: 10px;
            opacity: 0.5;
            animation: wave-animation 20s infinite linear reverse;
        }
        
        .wave:nth-child(3) {
            bottom: 20px;
            opacity: 0.3;
            animation: wave-animation 15s infinite linear;
        }
        
        @keyframes wave-animation {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        /* Input focus effect */
        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.3);
            border-color: #4F46E5;
            outline: none;
        }
        
        /* Strength meter animation */
        .strength-meter-transition {
            transition: width 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.8s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2), inset 0 0 8px rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            animation: pulse-subtle 2s ease-in-out infinite;
        }
        
        @keyframes pulse-subtle {
            0% { opacity: 0.9; }
            50% { opacity: 1; }
            100% { opacity: 0.9; }
        }
        
        .strength-meter-transition::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.4), 
                transparent);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { left: -100%; }
            20% { left: 100%; }
            100% { left: 100%; }
        }
        
        /* Strength meter container */
        #strength-meter-container {
            border-radius: 8px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        #strength-text {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
            transition: all 0.5s ease;
        }
        
        /* Improve card entrance animation */
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
    </style>
</head>
<body class="animated-bg min-h-screen">
    <!-- Particles container -->
    <div class="particles" id="particles"></div>
    
    <!-- Wave container -->
    <div class="wave-container">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    
    <div class="container mx-auto px-4">
        <!-- Language Switcher -->
        <div class="fixed top-4 left-4 z-10">
            <button class="bg-white/20 hover:bg-white/30 text-white rounded-full py-2 px-3 flex items-center backdrop-blur-sm border border-white/10 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
                <span>English</span>
            </button>
        </div>
        
        <header class="py-6">
            <h1 class="text-3xl font-bold text-center text-white drop-shadow-lg">بررسی قدرت رمز عبور</h1>
        </header>
        
        <main>
            <div class="flex justify-center items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">امنیت رمز عبور خود را بررسی کنید</h2>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 mb-2">رمز عبور خود را وارد کنید:</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                class="w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 ease-in-out input-focus-effect text-black" 
                                placeholder="رمز عبور را وارد کنید..."
                            >
                            <button 
                                id="togglePassword" 
                                type="button" 
                                class="absolute inset-y-0 left-0 px-4 text-gray-600 hover:text-gray-800 transition-all duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div id="strength-meter-container" class="mb-6 hidden">
                        <label class="block text-gray-700 mb-2 font-bold">قدرت رمز عبور:</label>
                        <div class="relative h-4 bg-gray-200 rounded-lg overflow-hidden shadow-inner">
                            <div id="strength-meter" class="h-full w-0 strength-meter-transition"></div>
                        </div>
                        <p id="strength-text" class="mt-3 text-center font-bold text-lg"></p>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="font-bold text-gray-700 mb-3">یک رمز عبور قوی باید:</h3>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                            <li class="flex items-center text-gray-600">
                                <span class="mr-2 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                حداقل 8 کاراکتر داشته باشد
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="mr-2 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                شامل حروف بزرگ باشد
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="mr-2 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                شامل حروف کوچک باشد
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="mr-2 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                شامل اعداد باشد
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="mr-2 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                شامل کاراکترهای ویژه باشد
                            </li>
                            <li class="flex items-center text-gray-600">
                                <span class="mr-2 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                عدم استفاده از الگوهای متداول
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <button 
                            id="generate-password" 
                            class="btn-animated bg-primary hover:bg-indigo-700 text-white py-2 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out focus:outline-none"
                        >
                            تولید رمز عبور قوی
                        </button>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="py-6 mt-8 text-center">
            <a href="https://github.com/AdeptMehdi/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-gray-800 hover:bg-gray-900 text-white px-5 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg group">
                <svg class="w-7 h-7 mr-3 animate-pulse" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-lg font-medium">مشاهده در گیت‌هاب</span>
            </a>
            <p class="mt-4 text-gray-500 text-sm">ساخته شده با ❤️ | <?= date('Y') ?></p>
        </footer>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create particles
        const particlesContainer = document.getElementById('particles');
        const particleCount = 30;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random properties
            const size = Math.random() * 10 + 5;
            const posX = Math.random() * window.innerWidth;
            const posY = Math.random() * window.innerHeight;
            const delay = Math.random() * 10;
            const duration = Math.random() * 10 + 10;
            
            // Apply styles
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}px`;
            particle.style.bottom = `${-10}px`;
            particle.style.animationDelay = `${delay}s`;
            particle.style.animationDuration = `${duration}s`;
            
            particlesContainer.appendChild(particle);
        }
        
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');
        const strengthMeterContainer = document.getElementById('strength-meter-container');
        const strengthMeter = document.getElementById('strength-meter');
        const strengthText = document.getElementById('strength-text');
        const generatePasswordButton = document.getElementById('generate-password');
        
        // Timer for debouncing
        let debounceTimer;
        
        // Add event listener for password input
        passwordInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                checkPasswordStrength(passwordInput.value);
            }, 500); // Delay by 500ms
        });
        
        // Toggle password visibility
        togglePasswordButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                `;
            } else {
                passwordInput.type = 'password';
                togglePasswordButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                `;
            }
        });
        
        // Generate a strong random password (fixed to prevent browser crashes)
        generatePasswordButton.addEventListener('click', function() {
            try {
                // Disable button to prevent multiple rapid clicks
                generatePasswordButton.disabled = true;
                generatePasswordButton.textContent = "در حال تولید...";
                
                // Pre-define character sets (small sets to avoid memory issues)
                const upperChars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
                const lowerChars = 'abcdefghijkmnopqrstuvwxyz';
                const numberChars = '23456789';
                const specialChars = '!@#$%^&*';
                
                // Basic password with one of each character type
                let password = '';
                password += upperChars[Math.floor(Math.random() * upperChars.length)];
                password += lowerChars[Math.floor(Math.random() * lowerChars.length)];
                password += numberChars[Math.floor(Math.random() * numberChars.length)];
                password += specialChars[Math.floor(Math.random() * specialChars.length)];
                
                // Add remaining characters (max length 12)
                const allChars = upperChars + lowerChars + numberChars + specialChars;
                for (let i = 0; i < 6; i++) {
                    password += allChars[Math.floor(Math.random() * allChars.length)];
                }
                
                // Simple array shuffling (avoid complex algorithms)
                const passwordArray = password.split('');
                for (let i = passwordArray.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    const temp = passwordArray[i];
                    passwordArray[i] = passwordArray[j];
                    passwordArray[j] = temp;
                }
                
                // Update input field
                const finalPassword = passwordArray.join('');
                passwordInput.value = finalPassword;
                
                // Enable button and update text
                generatePasswordButton.disabled = false;
                generatePasswordButton.textContent = "تولید رمز عبور قوی";
                
                // Check strength after a small delay
                setTimeout(function() {
                    passwordInput.focus();
                    checkPasswordStrength(finalPassword);
                }, 50);
                
            } catch (error) {
                console.error('Error generating password:', error);
                // Reset button in case of error
                generatePasswordButton.disabled = false;
                generatePasswordButton.textContent = "تولید رمز عبور قوی";
            }
        });
        
        // Check password strength via AJAX
        function checkPasswordStrength(password) {
            if (!password) {
                hideResults();
                return;
            }
            
            // Set a timeout to prevent hanging requests
            const ajaxTimeout = 10000; // 10 seconds
            
            try {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.timeout = ajaxTimeout;
                
                xhr.onload = function() {
                    if (this.status === 200) {
                        try {
                            const response = JSON.parse(this.responseText);
                            showResults(response);
                        } catch (e) {
                            console.error('Error parsing response:', e);
                            console.log('Response text:', this.responseText);
                            // Show a default result in case of error
                            showDefaultResults();
                        }
                    } else {
                        console.error('Server returned status:', this.status);
                        showDefaultResults();
                    }
                };
                
                xhr.onerror = function() {
                    console.error('Request error');
                    showDefaultResults();
                };
                
                xhr.ontimeout = function() {
                    console.error('Request timed out');
                    showDefaultResults();
                };
                
                xhr.send('password=' + encodeURIComponent(password));
            } catch (error) {
                console.error('Error in AJAX request:', error);
                showDefaultResults();
            }
        }
        
        // Show default results in case of an error
        function showDefaultResults() {
            // Display a generic response when the server call fails
            strengthMeterContainer.classList.remove('hidden');
            
            // Set to medium strength as a fallback
            strengthMeter.style.width = '50%';
            strengthMeter.style.backgroundColor = 'orange';
            
            strengthText.textContent = 'متوسط (تخمینی)';
            strengthText.style.color = 'orange';
        }
        
        // Show strength results
        function showResults(data) {
            // Show containers
            strengthMeterContainer.classList.remove('hidden');
            
            // Update strength meter
            strengthMeter.style.width = data.strength + '%';
            strengthMeter.style.backgroundColor = data.color;
            
            // Update strength text
            strengthText.textContent = data.label;
            strengthText.style.color = data.color;
        }
        
        // Hide results
        function hideResults() {
            strengthMeterContainer.classList.add('hidden');
        }
    });
    </script>
</body>
</html> 