<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to your account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-[24px] shadow-xl p-6 md:p-8">
        
        <div class="text-center md:text-left">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight mb-2">
                Sign in to your account
            </h1>
            
            <div class="flex items-center justify-between bg-gray-50 rounded-2xl p-3 mt-4 mb-6 border border-gray-100">
                <span class="text-xs md:text-sm text-gray-600">New to INVENT?</span>
                <a href="{{ route('register') }}" class="py-1 px-3 bg-white border border-gray-300 rounded-full text-xs font-semibold text-gray-900 hover:bg-gray-50 transition shadow-sm">
                    Create account
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Email or username" 
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

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center text-xs md:text-sm text-gray-700 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-green-700 border-gray-300 focus:ring-green-600 mr-2 cursor-pointer" checked>
                    Stay signed in
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs md:text-sm text-green-700 hover:underline font-medium">Forgot password?</a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-full text-sm transition cursor-pointer shadow-md shadow-green-100 active:scale-[0.99]">
                    Continue
                </button>
            </div>
        </form>

        <div class="relative flex py-5 items-center">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="flex-shrink mx-3 text-xs text-gray-400 uppercase tracking-wider">or continue with</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <div class="grid grid-cols-3 gap-2.5">
            <button type="button" class="border border-gray-300 rounded-xl py-2 flex items-center justify-center gap-1.5 hover:bg-gray-50 transition text-xs font-semibold text-gray-700 cursor-pointer shadow-sm">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                </svg>
                <span>Google</span>
            </button>

            <button type="button" class="border border-gray-300 rounded-xl py-2 flex items-center justify-center gap-1.5 hover:bg-gray-50 transition text-xs font-semibold text-gray-700 cursor-pointer shadow-sm">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 4.17c.66-.81 1.11-1.93.99-3.06-1 .04-2.21.67-2.93 1.49-.62.69-1.16 1.84-1.01 2.96 1.12.09 2.27-.58 2.95-1.39z"/>
                </svg>
                <span>Apple</span>
            </button>

            <button type="button" class="border border-gray-300 rounded-xl py-2 flex items-center justify-center gap-1.5 hover:bg-gray-50 transition text-xs font-semibold text-gray-700 cursor-pointer shadow-sm">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#1877F2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span>Facebook</span>
            </button>
        </div>

    </div>

</body>
</html>