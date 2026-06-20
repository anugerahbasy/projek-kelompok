<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
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