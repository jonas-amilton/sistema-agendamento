<div class="max-w-md mx-auto bg-gray-800 p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-yellow-400">Crie sua conta</h2>

    <form wire:submit.prevent="register" class="space-y-4">
        <input type="text" wire:model.defer="first_name" placeholder="Seu nome"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('first_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="text" wire:model.defer="last_name" placeholder="Seu sobrenome"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('last_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="date" wire:model.defer="date_of_birth" placeholder="Data de nascimento"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('date_of_birth')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="email" wire:model.defer="email" placeholder="E-mail"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="text" wire:model.defer="phone" placeholder="Celular"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('phone')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="text" wire:model.defer="cpf" placeholder="CPF"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('cpf')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="text" wire:model.defer="address" placeholder="Endereço"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('address')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="text" wire:model.defer="city" placeholder="Cidade"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('city')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="text" wire:model.defer="profession" placeholder="Profissão"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('profession')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="password" wire:model.defer="password" placeholder="Senha"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <input type="password" wire:model.defer="password_confirmation" placeholder="Confirme sua senha"
            class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400" required>

        <button type="submit"
            class="w-full bg-yellow-400 text-gray-900 font-bold py-3 rounded hover:bg-yellow-500 transition">Registrar</button>
    </form>

    <p class="mt-4 text-center text-gray-400">
        Já tem conta? <a href="{{ route('patient.login') }}" class="text-yellow-400 hover:underline">Entre aqui</a>
    </p>
</div>