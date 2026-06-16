<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased min-h-screen flex items-center justify-center py-12">

    <div class="w-full max-w-md px-6">
        
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight mb-5">Create an account</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="role" id="role-input" value="{{ old('role', 'staff') }}">

            <div class="flex bg-gray-100 rounded-full p-1 border border-gray-200">
                <button type="button" id="tab-staff" onclick="switchRole('staff')" 
                    class="w-1/2 py-2 text-sm font-semibold rounded-full transition duration-200 bg-neutral-900 text-white shadow-sm cursor-pointer">
                    Personal (Staff)
                </button>
                <button type="button" id="tab-admin" onclick="switchRole('admin')" 
                    class="w-1/2 py-2 text-sm font-semibold rounded-full transition duration-200 text-gray-600 hover:text-gray-900 cursor-pointer">
                    Business (Admin)
                </button>
            </div>

            <div class="pt-2">
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Full name" 
                    class="w-full px-4 py-3 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Email" 
                    class="w-full px-4 py-3 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm">
                @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input type="password" name="password" id="password" required placeholder="Password" 
                    class="w-full px-4 py-3 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm">
                @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm password" 
                    class="w-full px-4 py-3 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm">
            </div>

            <div>
                <label for="birth_of_day" class="block text-xs font-semibold text-gray-500 mb-1 ml-1">Birth of Day</label>
                <input type="date" name="birth_of_day" id="birth_of_day" value="{{ old('birth_of_day') }}" required
                    class="w-full px-4 py-3 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base text-gray-700 shadow-sm">
                @error('birth_of_day') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <textarea name="address" id="address" required placeholder="Address" rows="2"
                    class="w-full px-4 py-3 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-base placeholder-gray-500 shadow-sm resize-none">{{ old('address') }}</textarea>
                @error('address') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <p class="text-xs text-gray-500 leading-normal pt-1">
                By selecting <span class="font-semibold text-gray-800">Create account</span>, you agree to our <a href="#" class="text-blue-600 hover:underline">User Agreement</a> and acknowledge reading our <a href="#" class="text-blue-600 hover:underline">User Privacy Notice</a>.
            </p>

            <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full text-base tracking-wide transition duration-150 cursor-pointer shadow-md">
                Create account
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline font-medium">Already have an account? Sign in</a>
        </div>
    </div>

    <script>
        function switchRole(selectedRole) {
            // 1. Masukkan nilai role ke input hidden agar dibaca Laravel
            document.getElementById('role-input').value = selectedRole;

            // 2. Ambil elemen tombol tab
            const btnStaff = document.getElementById('tab-staff');
            const btnAdmin = document.getElementById('tab-admin');

            // 3. Ubah warna kelas Tailwind sesuai tab yang aktif
            if (selectedRole === 'staff') {
                btnStaff.className = "w-1/2 py-2 text-sm font-semibold rounded-full transition duration-200 bg-neutral-900 text-white shadow-sm cursor-pointer";
                btnAdmin.className = "w-1/2 py-2 text-sm font-semibold rounded-full transition duration-200 text-gray-600 hover:text-gray-900 cursor-pointer";
            } else {
                btnAdmin.className = "w-1/2 py-2 text-sm font-semibold rounded-full transition duration-200 bg-neutral-900 text-white shadow-sm cursor-pointer";
                btnStaff.className = "w-1/2 py-2 text-sm font-semibold rounded-full transition duration-200 text-gray-600 hover:text-gray-900 cursor-pointer";
            }
        }

        // Cek data lama saat validasi eror/halaman direfresh
        window.onload = function() {
            const savedRole = document.getElementById('role-input').value;
            switchRole(savedRole);
        };
    </script>

</body>
</html>