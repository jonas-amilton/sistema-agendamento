@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-yellow-400 mb-4 mt-3">Meus Agendamentos</h2>

    @livewire('patient-appointments')

    @livewire('appointment-form')
@endsection
