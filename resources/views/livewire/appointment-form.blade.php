<div>
    <button wire:click="openModal"
        class="fixed bottom-3 mb-5 right-5 bg-yellow-400 hover:bg-yellow-500 text-gray-900 p-6 rounded-full shadow-lg font-semibold transition z-50 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-gray-800 text-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-2xl font-bold mb-4 text-yellow-400">Agendar Consulta</h2>

                <form wire:submit.prevent="submit" class="space-y-4">
                    <!-- Especialidade -->
                    <label class="block mb-1">Especialidade</label>
                    <select wire:model.live="specialty_id" class="w-full p-2 rounded bg-gray-700">
                        <option value="">Selecione</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>

                    <!-- Profissional -->
                    <label class="block mb-1">Profissional</label>
                    <select wire:model.live="professional_id" class="w-full p-2 rounded bg-gray-700">
                        <option value="">Selecione</option>
                        @foreach ($professionals as $professional)
                            <option value="{{ $professional->id }}">
                                {{ $professional->first_name }} {{ $professional->last_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Data -->
                    <div>
                        <label class="block mb-1">Data</label>
                        <input type="date" wire:model.live="selectedDate" class="p-2 rounded bg-gray-700 w-full">
                    </div>

                    <div>
                        <!-- Horários disponíveis -->
                        @if ($availableSlots)
                            <label class="block mb-1">Horário disponível</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($availableSlots as $slot)
                                    <input type="radio" class="hidden" id="slot-{{ $loop->index }}"
                                        wire:model.live="start_time" value="{{ $slot }}" name="available_slots">

                                    <label for="slot-{{ $loop->index }}" @class([
                                        'cursor-pointer px-3 py-2 rounded hover:bg-yellow-500',
                                        'bg-yellow-600 text-white' => $start_time === $slot,
                                        'bg-yellow-400 text-gray-900' => $start_time !== $slot,
                                    ])>
                                        {{ \Carbon\Carbon::parse($slot)->format('H:i') }}
                                    </label>
                                @endforeach
                            </div>
                        @endif

                    </div>

                    @error('start_time')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Botões -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 rounded bg-gray-600 hover:bg-gray-700">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-yellow-400 hover:bg-yellow-500 text-gray-900">Confirmar
                            agendamento</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <!-- Toast -->
    <div x-data="{ show: @entangle('successMessage') }" x-show="show" x-transition x-init="$watch('show', value => { if (value) setTimeout(() => show = false, 4000) })"
        class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50">
        {{ $successMessage }}
    </div>

</div>
