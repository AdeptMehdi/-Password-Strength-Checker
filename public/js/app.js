document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const strengthMeterContainer = document.getElementById('strength-meter-container');
    const strengthMeter = document.getElementById('strength-meter');
    const strengthText = document.getElementById('strength-text');
    const feedbackContainer = document.getElementById('feedback-container');
    const feedbackList = document.getElementById('feedback-list');
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
            
            const length = 16; // Standard password length
            let password = '';
            
            // Separate character sets
            const upperChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowerChars = 'abcdefghijklmnopqrstuvwxyz';
            const numberChars = '0123456789';
            const specialChars = '!@#$%^&*()-_=+';
            
            // Simplified character set for the rest of the password
            const allChars = upperChars + lowerChars + numberChars + specialChars;
            
            // Add one character from each category (safer approach)
            password += upperChars.charAt(Math.floor(Math.random() * upperChars.length));
            password += lowerChars.charAt(Math.floor(Math.random() * lowerChars.length));
            password += numberChars.charAt(Math.floor(Math.random() * numberChars.length));
            password += specialChars.charAt(Math.floor(Math.random() * specialChars.length));
            
            // Fill the rest with random characters
            for (let i = 4; i < length; i++) {
                password += allChars.charAt(Math.floor(Math.random() * allChars.length));
            }
            
            // Safer shuffling algorithm
            const passwordArray = password.split('');
            for (let i = passwordArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [passwordArray[i], passwordArray[j]] = [passwordArray[j], passwordArray[i]];
            }
            password = passwordArray.join('');
            
            // Update the input field
            passwordInput.value = password;
            
            // Use a small timeout to allow UI to update before checking strength
            setTimeout(() => {
                passwordInput.focus();
                checkPasswordStrength(password);
                // Re-enable button after password is generated
                generatePasswordButton.disabled = false;
            }, 100);
        } catch (error) {
            console.error('Error generating password:', error);
            // Re-enable button if there's an error
            generatePasswordButton.disabled = false;
        }
    });
    
    // Check password strength via AJAX with improved error handling
    function checkPasswordStrength(password) {
        if (!password) {
            hideResults();
            return;
        }
        
        // Set a timeout to prevent hanging requests
        const ajaxTimeout = 10000; // 10 seconds
        
        try {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?action=check-password', true);
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
        
        // Always keep feedback hidden
        feedbackContainer.classList.add('hidden');
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
        
        // Always keep feedback hidden
        feedbackContainer.classList.add('hidden');
    }
    
    // Hide results
    function hideResults() {
        strengthMeterContainer.classList.add('hidden');
        feedbackContainer.classList.add('hidden');
    }
}); 