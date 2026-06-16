<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to your account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased min-h-screen flex items-center justify-center py-12">

    <div class="w-full max-w-md px-6">
        
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight text-center mb-4">Sign in to your account</h1>

        <div class="flex items-center justify-between bg-gray-50 rounded-2xl p-4 mb-8 border border-gray-100">
            <span class="text-sm text-gray-600">New In invent</span>
            <a href="{{ route('register') }}" class="py-1.5 px-4 bg-white border border-gray-900 rounded-full text-sm font-semibold text-gray-900 hover:bg-gray-50 text-center transition">
                Create account
            </a>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Email or username" 
                    class="w-full px-4 py-3.5 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm">
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="password" name="password" id="password" required placeholder="Password" 
                    class="w-full px-4 py-3.5 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm">
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full text-base transition cursor-pointer shadow-md">
                Continue
            </button>

            <div class="flex items-center justify-between pt-2">
                <label class="flex items-center text-sm text-gray-900 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-blue-600 border-gray-400 focus:ring-blue-500 mr-2 cursor-pointer" checked>
                    Stay signed in
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline font-medium">Forgot password?</a>
                @endif
            </div>
        </form>

        <div class="relative flex py-6 items-center">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="flex-shrink mx-4 text-sm text-gray-400">or</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <div class="space-y-3">
            <button type="button" class="w-full py-3 border border-gray-400 rounded-full font-semibold text-gray-700 flex items-center justify-center gap-2 hover:bg-gray-50 cursor-pointer text-sm transition">
                <span class="font-bold text-red-500 text-base">G</span> Continue with Google
            </button>
            <button type="button" class="w-full py-3 border border-gray-400 rounded-full font-semibold text-gray-700 flex items-center justify-center gap-2 hover:bg-gray-50 cursor-pointer text-sm transition">
                <span class="text-base"></span> Continue with Apple
            </button>
            <button type="button" class="w-full py-3 border border-gray-400 rounded-full font-semibold text-gray-700 flex items-center justify-center gap-2 hover:bg-gray-50 cursor-pointer text-sm transition">
                <span class="text-blue-600 text-base font-bold">f</span> Continue with Facebook
            </button>
        </div>

    </div>

</body>
</html>