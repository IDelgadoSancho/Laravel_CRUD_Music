@extends('layout')

@section('title', 'Llistat de Festivals')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5">

        <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Llista de Festivals</h1>

        @if (Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('festival_new') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Festival</a>
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
                            <th class="py-2 px-4">Ubicació</th>
                            <th class="py-2 px-4">Data Inici</th>
                            <th class="py-2 px-4">Data Fi</th>
                            <th class="py-2 px-4">Concerts</th>
                            <th class="py-2 px-4">Cartell</th>
                            <th class="py-2 px-4">Organitzador</th>
                            @if (Auth::check() && Auth::user()->isAdmin() || (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->id == $festival->user_id))
                                <th class="py-2 px-4">Accions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($festivals as $festival)
                            <tr class="border-b border-gray-700">
                                <td class="py-2 px-4">{{ $festival->nom }}</td>
                                <td class="py-2 px-4">{{ $festival->ubicacio }}</td>
                                <td class="py-2 px-4">{{ $festival->data_inici->format('d-m-Y') }}</td>
                                <td class="py-2 px-4">{{ $festival->data_fi->format('d-m-Y') }}</td>
                                <td class="py-2 px-4">
                                    @if ($festival->concerts->isEmpty())
                                        No hi ha concerts associats
                                    @else
                                        @foreach ($festival->concerts as $concert)
                                            {{ $concert->nom }}<br />
                                            @if($concert->usuaris->isEmpty())
                                                <p>Encara no s'han comprat entrades per aquest concert.</p>
                                            @else
                                                <ul>
                                                    @foreach($concert->usuaris as $usuari)
                                                        <li>{{ $usuari->name }} - {{ $usuari->pivot->entrades_comprades }} entrades</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td class="py-2 px-4">
                                    <img src="{{ asset(env('RUTA_IMATGES') . '/festivals/' . $festival->cartell) }}"
                                        class="w-24 h-auto rounded" alt="">
                                </td>
                                <td class="py-2 px-4">{{ $festival->organitzador->name }}</td>
                                @if (Auth::check() && Auth::user()->isAdmin() || (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->id == $festival->user_id))
                                    <td class="py-2 px-4">
                                        <a href="{{ route('festival_edit', ['id' => $festival->id]) }}"
                                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                                        <a href="{{ route('festival_delete', ['id' => $festival->id]) }}"
                                            class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-1 px-2 rounded">
                                            <img src="{{ asset('images/trash.svg') }}" alt="Delete" class="w-4 h-4 inline-block"></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection