@extends('layout')

@section('title', 'Llistat de Concerts')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Llista de Concerts</h1>
    <a href="{{ route('concert_new') }}">Crear Concert</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Data Hora</th>
                <th>Aforament</th>
                <th>Entrades Disponibles</th>
                <th>Artistes</th>
                <th>Festival</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($concerts as $concert)
                <tr>
                    <td>{{ $concert->nom }}</td>
                    <td>{{ $concert->data_hora }}</td>
                    <td>{{ $concert->aforament }}</td>
                    <td>{{ $concert->entrades_disponibles }}</td>
                    <td>
                        @if ($concert->artistas->isEmpty())
                            No hi ha artistas associats
                        @else
                            @foreach ($concert->artistas as $artista)
                                {{ $artista->nom }}
                                ({{ $concert->artistas->find($artista->id)->pivot->sou  }} Sou)<br />
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $concert->festival->nom }}</td>
                    <td>
                        <a href="{{ route('concert_edit', ['id' => $concert->id]) }}">Editar</a>
                        <a href="{{ route('concert_delete', ['id' => $concert->id]) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

@endsection