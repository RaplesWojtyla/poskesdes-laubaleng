<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Login - Poskesdes Laubaleng')]
class LoginPage extends Component
{
    public $email;
    public $password;

    public function login() 
    {
        $this->validate([
            'email' => 'required|email|max:255', 
            'password' => 'required|min:8|max:255'
        ]);

        if(!auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            // return $this->addError('password', 'Email atau password salah');
            session()->flash('error', 'Email atau password salah');
            return;
        }

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
