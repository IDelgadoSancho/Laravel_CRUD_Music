@extends('layout')

@section('title', 'Llistat de Concerts')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5">

        <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Llista de Concerts
            <img src="{{ asset('images/concert.svg') }}" alt="Delete" class="w-auto h-10 ml-1 inline-block">
        </h1>

        @if (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->isUsuari() || (Auth::check() && Auth::user()->isAdmin()))
            <a href="{{ route('concert_new') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Concert</a>
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
                            <th class="py-2 px-4">Data Hora
                                <form action="{{ route('concert_filtra_data') }}" method="get">
                                    <input type="submit" name="sort" value="asc"
                                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded">&nbsp;
                                    <input type="submit" name="sort" value="des"
                                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded">&nbsp;
                                </form>
                            </th>
                            <th class="py-2 px-4">Aforament
                                <form action="{{ route('concert_filtra_aforament') }}" method="get">
                                    <input type="submit" name="sort" value="asc"
                                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded">&nbsp;
                                    <input type="submit" name="sort" value="des"
                                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded">&nbsp;
                                </form>
                            </th>
                            <th class="py-2 px-4">Entrades Disponibles
                                <form action="{{ route('concert_filtra_entrades') }}" method="get">
                                    <input type="submit" name="sort" value="asc"
                                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded">&nbsp;
                                    <input type="submit" name="sort" value="des"
                                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded">&nbsp;
                                </form>
                            </th>
                            <th class="py-2 px-4">Artistes</th>
                            <th class="py-2 px-4">Festival</th>

                            @if (Auth::check() && Auth::user()->isAdmin() || (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->isUsuari()))
                                <th class="py-2 px-4">Accions</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($concerts as $concert)
                            <tr class="border-b border-gray-700">
                                <td class="py-2 px-4">{{ $concert->nom }}</td>
                                <td class="py-2 px-4">{{ $concert->data_hora->format('d-m-Y') }}</td>
                                <td class="py-2 px-4">
                                    {{ $concert->aforament }}
                                    <div class="w-full bg-gray-600 rounded-full h-2.5 mt-2">
                                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ ($concert->entrades_disponibles / $concert->aforament) * 100 }}%"></div>
                                    </div>
                                </td>
                                <td class="py-2 px-4">{{ $concert->entradesDisponibles() }}

                                    @if(Auth::check() && Auth::user()->isUsuari())
                                        @php
                                            $usuari = Auth::user();
                                            $entradesActuals = $concert->usuaris->where('id', $usuari->id)->first()?->pivot->entrades_comprades ?? 1;
                                        @endphp

                                        <form action="{{ route('concerts_comprar', $concert->id) }}" method="POST">
                                            @csrf
                                            <label for="entrades">Nombre d’entrades:</label>
                                            <input type="number" name="entrades" min="1" max="{{ $concert->entradesDisponibles() }}"
                                                required value="{{ $entradesActuals }}"
                                                class="bg-gray-600 text-white py-1 px-2 rounded">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Comprar
                                                Entrades</button>
                                        </form>
                                    @endif

                                </td>
                                <td class="py-2 px-4">
                                    @if ($concert->artistas->isEmpty())
                                        No hi ha artistas associats
                                    @else
                                        @foreach ($concert->artistas as $artista)
                                            {{ $artista->nom }}
                                            ({{ $concert->artistas->find($artista->id)->pivot->sou  }} Sou)<br />
                                        @endforeach
                                    @endif
                                </td>
                                <td class="py-2 px-4">{{ $concert->festival->nom }}</td>

                                @if (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->id == $concert->festival->user_id || (Auth::check() && Auth::user()->isAdmin()))
                                    <td class="py-2 px-4">
                                        <a href="{{ route('concert_edit', ['id' => $concert->id]) }}"
                                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                        <a href="{{ route('concert_delete', ['id' => $concert->id]) }}"
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
            <form action="{{ route('concert_cerca_artista') }}" method="get" class="w-full max-w-lg">
                <label for="cercar" class="text-[#FF3427]">Cerca<strong>&nbsp;artista:</strong></label>
                <input type="text" name="cercar" required class="bg-gray-600 text-white py-1 px-2 rounded w-full">
                <input type="submit" value="Cerca"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mt-2 w-40">

                @if (request()->has('cercar'))
                    <label class="block mt-2 text-[#FF3427]">Cercat per ...
                        <strong>{{ request('cercar') }}</strong></label><br /><br />
                    <a href="{{ route('concert_list') }}"
                        class="bg-gray-600 hover:bg-gray-500 text-white py-1 px-2 rounded mt-2 w-full">+
                        Neteja la cerca</a>
                @endif
            </form>
        </div>

    </div>

@endsection