<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="w-full max-w-5xl bg-white rounded-[30px] shadow-2xl flex flex-col lg:flex-row items-stretch p-6 gap-8">

        <!-- Sisi Kiri - Background dengan Animasi -->
        <div class="hidden lg:block lg:w-[45%] min-h-[500px] rounded-[24px] overflow-hidden bg-gradient-to-br from-green-700 to-emerald-800 relative">
            
            <!-- Animated Background -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-48 h-48 bg-white/5 rounded-full animate-bounce" style="animation-duration: 4s;"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full animate-ping" style="animation-duration: 6s;"></div>
            </div>
            
            <!-- Konten Utama -->
            <div class="relative z-10 w-full h-full flex flex-col items-center justify-center p-8 text-center">
                <!-- Icon -->
                <div class="mb-8 p-6 bg-white/10 backdrop-blur-sm rounded-full animate-pulse">
                    <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>

                <h3 class="text-white font-bold text-3xl md:text-4xl leading-tight">
                    Welcome to<br>
                    <span class="text-emerald-300">INVENT</span>
                </h3>
                <p class="text-white/80 mt-3 text-sm md:text-base max-w-xs">
                    Streamline your inventory management process
                </p>

                <!-- Stats -->
                <div class="mt-8 grid grid-cols-3 gap-4 w-full max-w-xs">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="text-2xl font-bold text-white">24/7</div>
                        <div class="text-xs text-white/60">Support</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="text-2xl font-bold text-white">100%</div>
                        <div class="text-xs text-white/60">Secure</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3">
                        <div class="text-2xl font-bold text-white">+5K</div>
                        <div class="text-xs text-white/60">Users</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sisi Kanan - Form Registrasi -->
        <div class="w-full lg:w-[55%] p-4 md:p-6 flex flex-col justify-center">

            <div class="mb-6">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                    Get Started Now
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base">
                    Create your account to manage stock inventory.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-3" id="registerForm">
                @csrf

                <input type="hidden" name="role" value="user">

                <!-- First Name & Last Name -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required
                            class="w-full p-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm transition">
                        @error('first_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required
                            class="w-full p-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm transition">
                        @error('last_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required
                        class="w-full p-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm transition">
                    @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password & Confirm Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full p-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm transition">
                        @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                            class="w-full p-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm transition">
                    </div>
                </div>

                <!-- Date of Birth -->
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1 ml-1">
                        Date of Birth
                    </label>
                    <input type="date" name="birth_of_day" value="{{ old('birth_of_day') }}" required
                        class="w-full p-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm text-gray-700 transition">
                    @error('birth_of_day') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Address -->
                <div>
                    <textarea name="address" rows="2" placeholder="Address" required
                        class="w-full p-3.5 border border-gray-300 rounded-xl resize-none focus:ring-2 focus:ring-green-600 focus:border-green-600 outline-none text-sm transition">{{ old('address') }}</textarea>
                    @error('address') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Terms -->
                <div class="pt-1">
                    <label class="flex items-center gap-2 text-xs md:text-sm text-gray-500 cursor-pointer select-none">
                        <input type="checkbox" name="terms" required class="rounded text-green-700 focus:ring-green-600 w-4 h-4">
                        <span>I agree to the <a href="#" class="text-green-700 hover:underline font-medium">terms & policy</a></span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" id="signupBtn" class="w-full bg-green-700 hover:bg-green-800 text-white py-3.5 rounded-xl font-semibold transition shadow-md shadow-green-100 cursor-pointer active:scale-[0.99] flex items-center justify-center gap-2">
                        <span id="btnText">Signup</span>
                        <svg id="btnLoader" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-5">
                <div class="flex-1 border-t border-gray-200"></div>
                <span class="mx-3 text-xs text-gray-400 uppercase tracking-wider">Or</span>
                <div class="flex-1 border-t border-gray-200"></div>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-3 gap-3">
                <button type="button" class="border border-gray-300 rounded-xl py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition text-sm font-semibold text-gray-700 cursor-pointer shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                    </svg>
                    <span class="hidden sm:inline">Google</span>
                </button>

                <button type="button" class="border border-gray-300 rounded-xl py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition text-sm font-semibold text-gray-700 cursor-pointer shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 4.17c.66-.81 1.11-1.93.99-3.06-1 .04-2.21.67-2.93 1.49-.62.69-1.16 1.84-1.01 2.96 1.12.09 2.27-.58 2.95-1.39z"/>
                    </svg>
                    <span class="hidden sm:inline">Apple</span>
                </button>

                <button type="button" class="border border-gray-300 rounded-xl py-2.5 flex items-center justify-center gap-2 hover:bg-gray-50 transition text-sm font-semibold text-gray-700 cursor-pointer shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#1877F2" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span class="hidden sm:inline">Facebook</span>
                </button>
            </div>

            <!-- Login Link -->
            <p class="text-center mt-6 text-sm text-gray-500">
                Have an account? 
                <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline ml-1">
                    Sign In
                </a>
            </p>
        </div>

    </div>

    <!-- JavaScript untuk Loading State -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const btn = document.getElementById('signupBtn');
            const btnText = document.getElementById('btnText');
            const btnLoader = document.getElementById('btnLoader');

            if (form && btn) {
                form.addEventListener('submit', function(e) {
                    if (form.checkValidity()) {
                        btnText.textContent = 'Processing...';
                        btnLoader.classList.remove('hidden');
                        btn.disabled = true;
                        btn.classList.add('opacity-70', 'cursor-not-allowed');
                    }
                });
            }
        });
    </script>

</body>
</html>