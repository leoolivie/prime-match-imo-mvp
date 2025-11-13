@extends('layouts.app')

@section('title', 'Cadastro - Prime Match Imo')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Criar Conta</h2>
            <p class="mt-2 text-gray-600">Junte-se à Prime Match Imo</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nome Completo
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    E-mail
                </label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}"
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Senha
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmar Senha
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Conta
                </label>
                <select name="role" 
                        id="role" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-black focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror">
                    <option value="">Selecione...</option>
                    <option value="investor" {{ old('role') == 'investor' ? 'selected' : '' }}>Investidor</option>
                    <option value="businessman" {{ old('role') == 'businessman' ? 'selected' : '' }}>Empresário</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    Telefone (opcional)
                </label>
                <input type="text" 
                       name="phone" 
                       id="phone" 
                       value="{{ old('phone') }}"
                       placeholder="(11) 99999-9999"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="flex items-start">
                    <input type="checkbox" 
                           name="terms" 
                           required 
                           class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">
                        Eu aceito os 
                        <a href="#" class="text-blue-600 hover:text-blue-700">termos de uso</a> 
                        e 
                        <a href="#" class="text-blue-600 hover:text-blue-700">política de privacidade</a>
                    </span>
                </label>
                @error('terms')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition duration-200">
                Criar Conta
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Já tem uma conta? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    Entrar
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
