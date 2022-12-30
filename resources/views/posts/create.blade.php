@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush
@section('contenido')
    <div class="md:flex md:items-center">
        <div class="px-10 md:w-1/2">
            <form id="dropzone" action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data"
            class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded h-96 dropzone">
                @csrf
            </form>
        </div>
        <div class="p-10 mt-10 bg-white rounded-lg shadow-xl md:w-1/2 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="block mb-2 font-bold text-gray-500 uppercase">
                        Titulo
                    </label>
                    <input type="text" name="title" id="title" placeholder="Titulo de la publicación"
                    class="w-full p-3 border rounded-lg @error('name') border-red-400 @enderror"
                    value="{{old('title')}}"
                    >
                    @error('title')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="block mb-2 font-bold text-gray-500 uppercase">
                        Descripción
                    </label>
                    <textarea name="description" id="description" placeholder="Descripción de la publicación"
                    class="w-full p-3 border rounded-lg @error('name') border-red-400 @enderror"
                    
                    >{{old('description')}}</textarea>
                    @error('description')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="image" value="{{old('image')}}">
                    @error('image')
                        <p class="p-2 my-2 text-sm text-center text-white bg-red-400 rounded-lg">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                
                <input type="submit" value="Crear publicación"
                class="w-full p-3 font-bold text-white uppercase transition-colors rounded-lg cursor-pointer bg-sky-600 hover:bg-sky-700"
                >
            
            </form>
        </div>
    </div>
@endsection