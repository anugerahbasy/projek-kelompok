<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to your account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-4xl bg-white rounded-[30px] shadow-2xl flex flex-col md:flex-row overflow-hidden">

        <!-- SISI KIRI - GAMBAR / BRANDING -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-green-700 to-emerald-800 p-8 flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-2xl">INVENT</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Manage Your<br><span class="text-emerald-300">Stock</span></h1>
                <p class="text-emerald-100">Real-time inventory tracking for your business</p>
            </div>

            <div class="space-y-3 mt-8">
                <div class="flex items-center gap-3 text-white/80">
                    <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Multi-role access</span>
                </div>
                <div class="flex items-center gap-3 text-white/80">
                    <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Live stock updates</span>
                </div>
                <div class="flex items-center gap-3 text-white/80">
                    <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Secure & reliable</span>
                </div>
            </div>

            <div class="text-white/30 text-sm mt-8">
                v1.0 • Laravel {{ Illuminate\Foundation\Application::VERSION }}
            </div>
        </div>

        <!-- SISI KANAN - FORM LOGIN -->
        <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col justify-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome Back</h2>
            <p class="text-gray-500 mb-6">Sign in to manage your inventory</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Email address" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600 text-sm placeholder-gray-400 shadow-sm transition">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password" id="password" required placeholder="Password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600 text-sm placeholder-gray-400 shadow-sm transition">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-xl text-sm transition cursor-pointer shadow-md shadow-green-100 active:scale-[0.99]">
                        Sign In
                    </button>
                </div>
            </form>

            <!-- DIVIDER -->
            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink mx-3 text-xs text-gray-400 uppercase tracking-wider">or</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <!-- REGISTER LINK -->
            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-green-700 font-semibold hover:underline">Create one</a>
            </p>

        
        </div>

    </div>

</body>
</html>