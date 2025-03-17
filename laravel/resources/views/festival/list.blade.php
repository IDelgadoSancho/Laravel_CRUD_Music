@extends('layout')

@section('title', 'Llistat de Festivals')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Llista de Festivals</h1>
    <a href="{{ route('festival_new') }}">Crear Festival</a>

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
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($festivals as $festival)
                <tr>
                    <td>{{ $festival->nom }}</td>
                    <td>{{ $festival->ubicacio }}</td>
                    <td>{{ $festival->data_inici }}</td>
                    <td>{{ $festival->data_fi }}</td>
                    <td>
                        @if ($festival->concerts->isEmpty())
                            No hi ha concerts associats
                        @else
                            @foreach ($festival->concerts as $concert)
                                {{ $concert->nom }}<br />
                            @endforeach
                        @endif
                    </td>
                    <td class="img">
                        <img src="{{ asset(env('RUTA_IMATGES') . '/festivals/' . $festival->cartell) }}"
                            style="width: 100px; heigth: auto;" alt="">
                    </td>
                    <td>{{ $festival->organitzador->name }}</td>
                    <td>
                        <a href="{{ route('festival_edit', ['id' => $festival->id]) }}">Editar</a>
                        <a href="{{ route('festival_delete', ['id' => $festival->id]) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection