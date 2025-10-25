<div x-data x-on:appointmentCreated.window="$wire.refreshAppointments()">
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
                                <form wire:submit.prevent="cancelAppointment({{ $appointment->id }})">
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
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
