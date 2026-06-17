<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

        <!-- Sisi Kiri - Brand -->
        <div class="md:w-1/2 bg-gradient-to-br from-green-700 to-emerald-800 p-8 md:p-12 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-white font-semibold text-lg">INVENT</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Manage Your Stock</h1>
                <p class="text-emerald-100 text-sm">Real-time inventory tracking for your business</p>
            </div>

            <div class="mt-8 space-y-3">
                <div class="flex items-center gap-3 text-white/80 text-sm">
                    <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Multi-role access (Admin, Staff, Kurir, Client)</span>
                </div>
                <div class="flex items-center gap-3 text-white/80 text-sm">
                    <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Live stock updates & reporting</span>
                </div>
                <div class="flex items-center gap-3 text-white/80 text-sm">
                    <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Secure & reliable data management</span>
                </div>
            </div>

            <div class="mt-6 text-white/40 text-xs">
                v1.0 • Laravel {{ Illuminate\Foundation\Application::VERSION }}
            </div>
        </div>

        <!-- Sisi Kanan - Form -->
        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Welcome Back</h2>
            <p class="text-gray-500 text-sm mb-6">Sign in to manage your inventory</p>

            <div class="space-y-3">
                <a href="{{ route('login') }}" 
                   class="w-full py-3 bg-green-700 hover:bg-green-800 text-white font-medium rounded-xl transition text-center block">
                    Sign In
                </a>
                <a href="{{ route('register') }}" 
                   class="w-full py-3 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-xl transition text-center block">
                    Create Account
                </a>
            </div>

        </div>

    </div>

</body>
</html>