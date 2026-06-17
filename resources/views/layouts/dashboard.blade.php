<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">Inventory System</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        {{ auth()->user()->full_name ?? auth()->user()->name ?? 'User' }}
                        <span class="ml-2 px-2 py-1 text-xs rounded-full 
                            @if(auth()->user()->isAdmin()) bg-red-100 text-red-800
                            @elseif(auth()->user()->isManager()) bg-blue-100 text-blue-800
                            @elseif(auth()->user()->isStaff()) bg-green-100 text-green-800
                            @elseif(auth()->user()->isPegawai()) bg-purple-100 text-purple-800
                            @elseif(auth()->user()->isKurir()) bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar & Content -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen p-4">
            <nav class="space-y-2">
                @include('layouts.sidebar-' . auth()->user()->role)
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>

</body>
</html>