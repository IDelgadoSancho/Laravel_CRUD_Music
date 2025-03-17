@extends('layout')

@section('title', 'Llistat de Artistas')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Llista de Artistas</h1>
    <a href="{{ route('artista_new') }}">Crear Artista</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Genere Musical</th>
                <th>Pais Origen</th>
                <th>Foto Artista</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artistas as $artista)
                <tr>
                    <td>{{ $artista->nom }}</td>
                    <td>{{ $artista->genere_musical }}</td>
                    <td>{{ $artista->pais_origen }}</td>
                    <td class="img">
                        <img src="{{ asset(env('RUTA_IMATGES') . '/artistas/' . $artista->foto_artista) }}"
                            style="width: 100px; heigth: auto;" alt="">
                    </td>
                    <td>
                        <a href="{{ route('artista_edit', ['id' => $artista->id]) }}">Editar</a>
                        <a href="{{ route('artista_delete', ['id' => $artista->id]) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

@endsection