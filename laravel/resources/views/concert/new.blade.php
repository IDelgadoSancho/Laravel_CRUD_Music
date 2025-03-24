@extends('layout')

@section('title', 'New Concert')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5 ">

        <div class="p-3 bg-gray-800 text-white rounded-lg">

            <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Crear Concert</h1>
            <a href="{{ route('concert_list') }}" class="text-blue-500 hover:text-blue-700">&laquo; Torna</a>

            <form action="{{ route('concert_new') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom:</label>
                    <input type="text" name="nom" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Data Hora:</label>
                    <input type="date" name="data_hora" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Aforament:</label>
                    <input type="number" name="aforament" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Entrades Disponibles:</label>
                    <input type="number" name="entrades_disponibles" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                @if ($artistas->isNotEmpty())
                    <div class="mb-4">
                        <label for="artistas" class="block text-sm font-medium mb-2">Artistas:</label>
                        @foreach ($artistas as $artista)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="asignado[{{ $artista->id }}]" value="{{ $artista->id }}"
                                    class="form-checkbox text-blue-500">
                                <span class="ml-2">{{ $artista->nom }}</span>
                                <input type="number" name="sou[{{ $artista->id }}]" value=""
                                    class="ml-2 w-24 px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="ml-2">Sou</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mb-4">
                    <label for="festival_id" class="block text-sm font-medium mb-2">Festival:</label>
                    <select name="festival_id"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($festivals as $festival)
                            <option value="{{ $festival->id }}">{{ $festival->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Desar</button>
            </form>

        </div>

    </div>

@endsection