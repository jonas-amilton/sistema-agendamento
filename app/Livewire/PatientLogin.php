<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PatientLogin extends Component
{
    public $emailOrPhone = '';
    public $password = '';

    public function login()
    {
        $credentials = filter_var($this->emailOrPhone, FILTER_VALIDATE_EMAIL)
            ? ['email' => $this->emailOrPhone, 'password' => $this->password]
            : ['phone' => $this->emailOrPhone, 'password' => $this->password];

        if (Auth::guard('patients')->attempt($credentials)) {
            session()->regenerate();
            return redirect()->route('patient.dashboard');
        }

        $this->addError('emailOrPhone', 'Credenciais inválidas.');
    }

    public function render()
    {
        return view('livewire.patient-login');
    }
}