<div class="max-w-3xl mx-auto bg-gray-800 p-6 rounded shadow space-y-6">
    <h2 class="text-2xl font-bold text-yellow-400 mb-4">Agende sua consulta</h2>

    @if (session()->has('message'))
        <div class="bg-green-600 text-white p-3 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="book" class="space-y-4">
        <div>
            <label class="block mb-1 font-semibold">Especialidade</label>
            <select wire:model="specialty_id"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
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
            <label class="block mb-1 font-semibold">Profissional</label>
            <select wire:model="professional_id"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
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
            <label class="block mb-1 font-semibold">Horário disponível</label>
            <select wire:model="selected_slot"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
                <option value="">Selecione o horário</option>
                @foreach ($availableSlots as $slot)
                    <option value="{{ $slot }}">{{ \Carbon\Carbon::parse($slot)->format('d/m/Y H:i') }}</option>
                @endforeach
            </select>
            @error('selected_slot')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-yellow-400 text-gray-900 font-bold py-3 rounded hover:bg-yellow-500 transition">Agendar</button>
    </form>
</div>
