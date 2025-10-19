@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded shadow space-y-6 mt-10">
        <h2 class="text-2xl font-bold text-yellow-400 mb-4">Meus Agendamentos</h2>

        <div class="mb-4">
            <a href="{{ route('patient.appointments.create') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-4 py-2 rounded font-semibold transition">
                Agendar nova consulta
            </a>
        </div>

        @if (session('message'))
            <div class="bg-green-600 text-white p-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if ($appointments->isEmpty())
            <p class="text-gray-400">Você não tem agendamentos futuros.</p>
        @else
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="py-2 px-4">Data e Hora</th>
                        <th class="py-2 px-4">Profissional</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="py-2 px-4">
                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-2 px-4">
                                {{ $appointment->professional->first_name ?? 'N/A' }}
                                {{ $appointment->professional->last_name ?? '' }}
                            </td>
                            <td class="py-2 px-4 capitalize">
                                {{ $appointment->status }}
                            </td>
                            <td class="py-2 px-4">
                                @if ($appointment->status !== 'cancelado')
                                    <form method="POST"
                                        action="{{ route('patient.appointments.destroy', $appointment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Cancelar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Cancelado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="max-w-4xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('patient.appointments.create') }}"
            class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 p-4 rounded shadow text-center font-semibold">
            Agendar Consulta
        </a>
        <a href="{{ route('patient.appointments.index') }}"
            class="bg-gray-700 hover:bg-gray-600 text-white p-4 rounded shadow text-center font-semibold">
            Ver Histórico
        </a>
        <a href="{{ route('patient.appointments.index') }}"
            class="bg-gray-700 hover:bg-gray-600 text-white p-4 rounded shadow text-center font-semibold">
            Próximos Agendamentos
        </a>
    </div>
@endsection
