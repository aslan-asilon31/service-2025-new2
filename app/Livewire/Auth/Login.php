<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Login extends Component
{
    public string $title = "Login";
    public string $url = "/pegawai/login";

    public string $email = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::guard('pegawai')->attempt($credentials)) {
            return redirect()->route('pegawai-dashboard.list');
        } else {
            session()->flash('error', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->title($this->title);
    }
}
