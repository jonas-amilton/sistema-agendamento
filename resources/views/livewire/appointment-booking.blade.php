<div>
    @if (session()->has('message'))
        <div class="bg-green-200 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if ($step === 1)
        <h2>Cadastro do Paciente</h2>
        <form wire:submit.prevent="savePatient">
            <input type="text" wire:model.defer="patientData.first_name" placeholder="Nome" required>
            <input type="text" wire:model.defer="patientData.last_name" placeholder="Sobrenome" required>
            <input type="date" wire:model.defer="patientData.date_of_birth" placeholder="Data de Nascimento" required>
            <input type="text" wire:model.defer="patientData.cpf" placeholder="CPF" required>
            <input type="text" wire:model.defer="patientData.phone" placeholder="Telefone" required>
            <input type="email" wire:model.defer="patientData.email" placeholder="Email" required>
            <input type="text" wire:model.defer="patientData.address" placeholder="Endereço">
            <input type="text" wire:model.defer="patientData.city" placeholder="Cidade">
            <input type="text" wire:model.defer="patientData.insurance_card_number" placeholder="Número do Cartão do Plano">
            <button type="submit">Continuar</button>
        </form>
    @elseif ($step === 2)
        <h2>Agendamento</h2>
        <form wire:submit.prevent="bookAppointment">
            <select wire:model="specialty_id" required>
                <option value="">Selecione a especialidade</option>
                @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
            </select>

            <select wire:model="professional_id" required>
                <option value="">Selecione o profissional</option>
                @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}">{{ $professional->first_name }} {{ $professional->last_name }}</option>
                @endforeach
            </select>

            <select wire:model="clinic_id" required>
                <option value="">Selecione a clínica</option>
                @foreach ($clinics as $clinic)
                    <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                @endforeach
            </select>

            <select wire:model="selected_slot" required>
                <option value="">Selecione o horário</option>
                @foreach ($availableSlots as $slot)
                    <option value="{{ $slot }}">{{ \Carbon\Carbon::parse($slot)->format('d/m/Y H:i') }}</option>
                @endforeach
            </select>

            <button type="submit">Agendar Consulta</button>
        </form>
    @endif
</div>