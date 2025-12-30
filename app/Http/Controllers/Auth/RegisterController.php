<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'role' => ['required', 'in:admin,customer'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'role' => $validated['role'],
        ]);

        // Create cart for customer
        if ($user->isCustomer()) {
            Cart::create(['user_id' => $user->id]);
        }

        Auth::login($user);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Registration successful! Welcome to Apparify Admin Panel.');
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Registration successful! Welcome to Apparify.');
    }
}