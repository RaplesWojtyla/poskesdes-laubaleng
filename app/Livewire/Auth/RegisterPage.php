<?php

namespace App\Livewire\Auth;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register - Poskesdes Laubaleng')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;
    public $phoneNumber;

    public function register()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phoneNumber' => 'required',
            'password' => 'required|min:8',
        ]);

        $id_user = \Illuminate\Support\Str::uuid();

        $user = User::create([
            'id_user' => $id_user,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'user'
        ]);

        Customer::create([
            'id_user' => $id_user,
            'email' => $this->email,
            'no_telp' => $this->phoneNumber,
        ]);

        auth()->login($user);

        // return redirect()->to('/dashboard');
        return redirect()->intended();

    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
