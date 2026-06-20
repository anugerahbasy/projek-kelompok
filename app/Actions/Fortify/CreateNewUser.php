<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'birth_of_day' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // ============================================
        // CEK EMAIL UNTUK DETERMINE ROLE
        // ============================================
        $email = $input['email'];
        
        if (str_contains($email, 'admin')) {
            $role = 'admin';
        } elseif (str_contains($email, 'kurir')) {
            $role = 'kurir';
        } else {
            $role = 'client'; // <-- CLIENT BUKAN USER!
        }

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'name' => $input['first_name'] . ' ' . $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'birth_of_day' => $input['birth_of_day'] ?? null,
            'address' => $input['address'] ?? null,
            'role' => $role,
        ]);
    }
}