<?php

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