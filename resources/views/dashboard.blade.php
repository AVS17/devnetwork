@extends('layouts.app')

@section('titulo')
    Perfil:{{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="flex flex-col items-center w-full md:w-8/12 lg:w-6/12 md:flex-row">
            <div class="w-8/12 px-5 lg:w-6/12">
                <img src="{{
                    $user->image ?
                    asset('perfiles') . '/' .$user->image :
                    asset('img/usuario.svg')}}" 
                    alt="Imagen usuario">
            </div>
            <div class="flex flex-col items-center px-5 py-10 md:w-8/12 lg:w-6/12 md:justify-center md:items-start md:py-10">
                <div class="flex items-center gap-4">
                    <p class="py-5 text-2xl text-gray-700">
                        {{$user->username}} 
                    </p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index')}}" class="text-gray-500 cursor-pointer hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>                              
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{$user->followers->count()}} 
                    <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count())</span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{$user->followings->count()}} 
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-800">
                    {{$user->posts->count()}} <span class="font-normal">Posts</span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form action="{{route('users.follow', $user)}}" method="POST">
                                @csrf
                                <input 
                                type="submit"
                                class="px-3 py-1 text-xs font-bold text-white uppercase bg-blue-600 rounded-lg cursor-pointer"
                                value="Seguir"
                                >
                            </form>
                        @else
                            <form action="{{route('users.unfollow',$user)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input 
                                type="submit"
                                class="px-3 py-1 text-xs font-bold text-white uppercase bg-red-600 rounded-lg cursor-pointer"
                                value="Dejar de Seguir"
                                >
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    
    <x-listar-post :posts="$posts"/>
    
@endsection