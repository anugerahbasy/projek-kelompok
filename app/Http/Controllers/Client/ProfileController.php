<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
        ]);

        DB::table('users')
            ->where('id', $userId)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
            ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}