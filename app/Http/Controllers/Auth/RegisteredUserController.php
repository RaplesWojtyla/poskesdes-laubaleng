<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('user.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'max:255', 'regex:/^[^\s]+$/', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'regex:/^[^\s]+$/'],
            'konfirmasiPassword' => ['required', 'same:password', 'regex:/^[^\s]+$/']
        ]);
        
        $user = User::create([
            'user_id' => Str::uuid(),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        Customer::create([
            'customer_id' => Str::uuid(),
            'user_id' => User::where('role', 'user')->latest()->pluck('user_id')->first()
        ]);
        
        event(new Registered($user));

        // Auth::login($user);

        return redirect('/login')->with('status', 'verification-email');
    }
}
