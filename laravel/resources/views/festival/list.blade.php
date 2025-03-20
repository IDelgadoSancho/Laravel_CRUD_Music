@extends('layout')

@section('title', 'Llistat de Festivals')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Llista de Festivals</h1>

    @if (Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('festival_new') }}">Crear Festival</a>
    @endif

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Ubicació</th>
                <th>Data Inici</th>
                <th>Data Fi</th>
                <th>Concerts</th>
                <th>Cartell</th>
                <th>Organitzador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($festivals as $festival)
                <tr>
                    <td>{{ $festival->nom }}</td>
                    <td>{{ $festival->ubicacio }}</td>
                    <td>{{ $festival->data_inici->format('d-m-Y') }}</td>
                    <td>{{ $festival->data_fi->format('d-m-Y') }}</td>
                    <td>
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
                    <td class="img">
                        <img src="{{ asset(env('RUTA_IMATGES') . '/festivals/' . $festival->cartell) }}"
                            style="width: 100px; heigth: auto;" alt="">
                    </td>
                    <td>{{ $festival->organitzador->name }}</td>
                    @if (Auth::check() && Auth::user()->isAdmin() || (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->id == $festival->user_id))
                        <td>
                            <a href="{{ route('festival_edit', ['id' => $festival->id]) }}">Editar</a>
                            <a href="{{ route('festival_delete', ['id' => $festival->id]) }}">Eliminar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection