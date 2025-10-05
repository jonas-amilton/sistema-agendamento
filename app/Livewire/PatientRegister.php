<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientRegister extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $date_of_birth;
    public $password = '';
    public $password_confirmation = '';
    public $cpf;
    public $address = '';
    public $city = '';
    public $profession = '';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:patients,email',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:6|confirmed',
        'date_of_birth' => 'required|date',
        'cpf' => 'required|string|unique:patients,cpf',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'profession' => 'required|string|max:100',
    ];

    public function register()
    {
        $this->validate();

        $patient = Patient::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cpf' => $this->cpf,
            'password' => Hash::make($this->password),
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'city' => $this->city,
            'profession' => $this->profession,
        ]);

        Auth::guard('patients')->login($patient);

        return redirect()->route('patient.dashboard');
    }

    public function render()
    {
        return view('livewire.patient-register')->layout('layouts.patient');
    }
}