<div class="flex justify-center items-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg transition-all duration-300 ease-in-out">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 main-title">امنیت رمز عبور خود را بررسی کنید</h2>
        
        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2 password-label">رمز عبور خود را وارد کنید:</label>
            <div class="relative password-input-container">
                <input 
                    type="password" 
                    id="password" 
                    class="w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 ease-in-out input-focus-effect" 
                    placeholder="رمز عبور را وارد کنید..."
                >
                <button 
                    id="togglePassword" 
                    type="button" 
                    class="absolute inset-y-0 left-0 px-4 text-gray-600 hover:text-gray-800 transition-all duration-200"
                    title="نمایش/مخفی کردن رمز عبور"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="strength-meter-container" class="mb-6 hidden">
            <label class="block text-gray-700 mb-2 strength-label">قدرت رمز عبور:</label>
            <div class="relative h-3 bg-gray-200 rounded-full overflow-hidden">
                <div id="strength-meter" class="h-full w-0 strength-meter-transition"></div>
            </div>
            <p id="strength-text" class="mt-2 text-center font-medium"></p>
        </div>
        
        <div id="feedback-container" class="mb-6 hidden">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="font-bold text-gray-700 mb-2 feedback-title">بازخورد:</h3>
                <ul id="feedback-list" class="list-disc list-inside text-gray-600"></ul>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="font-bold text-gray-700 mb-3 strong-password-title">یک رمز عبور قوی باید:</h3>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                <li class="flex items-center text-gray-600 password-requirement">
                    <span class="mr-2 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    حداقل 8 کاراکتر داشته باشد
                </li>
                <li class="flex items-center text-gray-600 password-requirement">
                    <span class="mr-2 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    شامل حروف بزرگ باشد
                </li>
                <li class="flex items-center text-gray-600 password-requirement">
                    <span class="mr-2 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    شامل حروف کوچک باشد
                </li>
                <li class="flex items-center text-gray-600 password-requirement">
                    <span class="mr-2 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    شامل اعداد باشد
                </li>
                <li class="flex items-center text-gray-600 password-requirement">
                    <span class="mr-2 text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    شامل کاراکترهای ویژه باشد
                </li>
                <li class="flex items-center text-gray-600 password-requirement">
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