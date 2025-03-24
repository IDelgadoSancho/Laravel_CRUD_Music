@extends('layout')

@section('title', 'New Artista')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5 ">

        <div class="bg-gray-800 text-white rounded-lg p-3">

            <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Crear Artista</h1>
            <a href="{{ route('artista_list') }}" class="text-blue-500 hover:underline">&laquo; Torna</a>

            <form action="{{ route('artista_new') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom:</label>
                    <input type="text" name="nom" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Genere Musical:</label>
                    <input type="text" name="genere_musical" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Pais Origen:</label>
                    <input type="text" name="pais_origen" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Foto artista:</label>
                    <input type="file" name="foto_artista"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Desar</button>
            </form>

        </div>

    </div>

@endsection