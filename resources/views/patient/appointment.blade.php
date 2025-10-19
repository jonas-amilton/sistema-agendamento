@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-800 p-6 rounded shadow space-y-6 mt-10">
        <h2 class="text-2xl font-bold text-yellow-400 mb-4">Agende sua consulta</h2>

        @if (session('message'))
            <div class="bg-green-600 text-white p-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('patient.appointments.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold text-white">Especialidade</label>
                <select name="specialty_id"
                    class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white"
                    required>
                    <option value="">Selecione a especialidade</option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                </select>
                @error('specialty_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold text-white">Profissional</label>
                <select name="professional_id"
                    class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white"
                    required>
                    <option value="">Selecione o profissional</option>
                    @foreach ($professionals as $professional)
                        <option value="{{ $professional->id }}">{{ $professional->first_name }}
                            {{ $professional->last_name }}</option>
                    @endforeach
                </select>
                @error('professional_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-semibold text-white">Horário disponível</label>
                {{-- TODO: criar btns de radio button com horarios disponíveis dinamicamente --}}
                @error('selected_slot')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 text-gray-900 font-bold py-3 rounded hover:bg-yellow-500 transition">
                Agendar Consulta
            </button>
        </form>
    </div>
@endsection
