@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded shadow mt-10">
        <h2 class="text-2xl font-bold mb-4 text-yellow-400">Crie sua conta</h2>

        <form method="POST" action="{{ route('patient.register.post') }}" class="space-y-4">
            @csrf

            <!-- Nome -->
            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Seu nome"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('first_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Sobrenome -->
            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Seu sobrenome"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('last_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Data de nascimento -->
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('date_of_birth')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Email -->
            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Telefone -->
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Celular"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- CPF -->
            <input type="text" name="cpf" value="{{ old('cpf') }}" placeholder="CPF"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('cpf')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Endereço -->
            <input type="text" name="address" value="{{ old('address') }}" placeholder="Endereço"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('address')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Cidade -->
            <input type="text" name="city" value="{{ old('city') }}" placeholder="Cidade"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('city')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Profissão -->
            <input type="text" name="profession" value="{{ old('profession') }}" placeholder="Profissão"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('profession')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Senha -->
            <input type="password" name="password" placeholder="Senha"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Confirmação de senha -->
            <input type="password" name="password_confirmation" placeholder="Confirme sua senha"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>

            <button type="submit"
                class="w-full bg-yellow-400 text-gray-900 font-bold py-3 rounded hover:bg-yellow-500 transition">
                Registrar
            </button>
        </form>

        <p class="mt-4 text-center text-gray-400">
            Já tem conta?
            <a href="{{ route('patient.login') }}" class="text-yellow-400 hover:underline">Entre aqui</a>
        </p>
    </div>
@endsection
