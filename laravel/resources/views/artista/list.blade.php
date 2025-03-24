@extends('layout')

@section('title', 'Llistat de Artistas')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5">

        <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Llista de Artistas</h1>

        @if (Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('artista_new') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Artista</a>
        @endif

        @if (session('status'))
            <div class="bg-green-500 text-white p-4 rounded mt-4">
                <strong>Success!</strong> {{ session('status') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-4">
            <div class="min-w-full flex justify-center">
                <table class="bg-gray-800 text-white rounded-lg">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="py-2 px-4">Nom</th>
                            <th class="py-2 px-4">Genere Musical</th>
                            <th class="py-2 px-4">Pais Origen</th>
                            <th class="py-2 px-4">Foto Artista</th>
                            @if (Auth::check() && Auth::user()->isAdmin())
                                <th class="py-2 px-4">Accions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artistas as $artista)
                            <tr class="border-b border-gray-700">
                                <td class="py-2 px-4">{{ $artista->nom }}</td>
                                <td class="py-2 px-4">{{ $artista->genere_musical }}</td>
                                <td class="py-2 px-4">{{ $artista->pais_origen }}</td>
                                <td class="py-2 px-4">
                                    <img src="{{ asset(env('RUTA_IMATGES') . '/artistas/' . $artista->foto_artista) }}"
                                        class="w-24 h-auto rounded" alt="">
                                </td>
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <td class="py-2 px-4">
                                        <a href="{{ route('artista_edit', ['id' => $artista->id]) }}"
                                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                        <a href="{{ route('artista_delete', ['id' => $artista->id]) }}"
                                            class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-1 px-2 rounded">
                                            <img src="{{ asset('images/trash.svg') }}" alt="Delete"
                                                class="w-4 h-4 inline-block"></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-center mt-4">
            <form action="{{ route('artista_cerca_genere') }}" method="get" class="w-full max-w-lg">
                <label for="cercar" class="text-[#FF3427]">Cerca per<strong>&nbsp;Genere:</strong></label>
                <input type="text" name="cercar" required class="bg-gray-600 text-white py-1 px-2 rounded w-full">
                <input type="submit" value="Cerca"
                    class="bg-blue-500 hover:bg-blue-700 w-40 text-white font-bold py-1 px-2 rounded mt-2">

                @if (request()->has('cercar'))
                    <label class="block mt-2 text-[#FF3427]">Cercat per ...
                        <strong>{{ request('cercar') }}</strong></label><br /><br />
                    <a href="{{ route('artista_list') }}"
                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded mt-2 w-full">+
                        Neteja la cerca</a>
                @endif
            </form>
        </div>

    </div>

@endsection