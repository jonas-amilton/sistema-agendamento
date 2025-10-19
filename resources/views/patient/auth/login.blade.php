@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded shadow mt-10">
        <h2 class="text-2xl font-bold mb-4 text-yellow-400">Acesse sua conta</h2>

        <form method="POST" action="{{ route('patient.login.post') }}" class="space-y-4">
            @csrf

            <!-- Email ou telefone -->
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email ou telefone"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Senha -->
            <input type="password" name="password" placeholder="Senha"
                class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:border-yellow-400 text-white" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit"
                class="w-full bg-yellow-400 text-gray-900 font-bold py-3 rounded hover:bg-yellow-500 transition">
                Entrar
            </button>
        </form>

        <p class="mt-4 text-center text-gray-400">
            Não tem conta?
            <a href="{{ route('patient.register') }}" class="text-yellow-400 hover:underline">Crie uma aqui</a>
        </p>
    </div>
@endsection
