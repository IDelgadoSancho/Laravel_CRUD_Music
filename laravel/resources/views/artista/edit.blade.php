@extends('layout')

@section('title', 'Edit Artista')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5 ">

        <div class="bg-gray-800 text-white rounded-lg p-3">

            <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Editar Artista</h1>

            <form action="{{ route('artista_edit', ['id' => $artista->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom:</label>
                    <input type="text" name="nom" value="{{ $artista->nom }}" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Genere Musical:</label>
                    <input type="text" name="genere_musical" value="{{ $artista->genere_musical }}" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Pais Origen:</label>
                    <input type="text" name="pais_origen" value="{{ $artista->pais_origen }}" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                @if ($artista->foto_artista)
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Foto actual:</label>
                        <strong class="block mb-2">{{ $artista->foto_artista }}</strong>
                        <label for="delete_photo" class="inline-flex items-center">
                            <input type="checkbox" name="delete_photo" value="0" class="form-checkbox text-blue-500">
                            <span class="ml-2">Esborrar?</span>
                        </label>
                    </div>
                @endif
                <div class="mb-4">
                    <label for="foto_artista" class="block text-sm font-medium mb-2">Foto Artista:</label>
                    <input type="file" name="foto_artista"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualitzar</button>
            </form>

        </div>

    </div>

@endsection