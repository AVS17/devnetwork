@extends('layouts.app')
@section('titulo')
    Registrate en DevStagram
@endsection
@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="p-5 md:w-6/12">
        <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
    </div>
    <div class="p-6 bg-white rounded-lg shadow-xl md:w-4/12">
        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 font-bold text-gray-500 uppercase">
                    Nombre
                </label>
                <input type="text" name="name" id="name" placeholder="Tu Nombre"
                class="w-full p-3 border rounded-lg @error('name') border-red-400 @enderror"
                value="{{old('name')}}"
                >
                @error('name')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="username" class="block mb-2 font-bold text-gray-500 uppercase">
                    UserName
                </label>
                <input type="text" name="username" id="username" placeholder="Tu Nombre de Usuario"
                class="w-full p-3 border rounded-lg @error('username') border-red-400 @enderror"
                value="{{old('username')}}"
                >
                @error('username')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                    {{$message}}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 font-bold text-gray-500 uppercase">
                    Email
                </label>
                <input type="email" name="email" id="email" placeholder="Tu Email de Registro"
                class="w-full p-3 border rounded-lg @error('email') border-red-400 @enderror"
                value="{{old('email')}}"
                >
                @error('email')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 font-bold text-gray-500 uppercase">
                    Password
                </label>
                <input type="password" name="password" id="password" placeholder="Tu Password"
                class="w-full p-3 border rounded-lg @error('password') border-red-400 @enderror"
                >
                @error('password')
                    <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 font-bold text-gray-500 uppercase">
                    Repetir Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite Tu Password"
                class="w-full p-3 border rounded-lg">
            </div>
            <input type="submit" value="Crear Cuenta"
            class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700">
        </form>
    </div>
</div>
@endsection