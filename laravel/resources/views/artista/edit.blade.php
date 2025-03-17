@extends('layout')

@section('title', 'Edit Artista')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Editar Artisat</h1>

    <form action="{{ route('artista_edit', ['id' => $artista->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nom:
                <input type="text" name="nom" value="{{ $artista->nom }}" required></label>
        </div>
        <br>
        <div>
            <label>Genere Musical:
                <input type="text" name="genere_musical" value="{{ $artista->genere_musical }}" required></label>
        </div>
        <br>
        <div>
            <label>Pais Origen:
                <input type="text" name="pais_origen" value="{{ $artista->pais_origen }}" required></label>
        </div>
        <br>
        @if ($artista->foto_artista)
            <div>
                Foto actual:<strong>{{$artista->foto_artista}}</strong>
                <label for="delete_photo">Esborrar?</label>
                <input type="checkbox" name="delete_photo" value="0" />
            </div>
        @endif
        <div>
            <label for="foto_artista">Foto Artista</label>
            <input type="file" name="cartell" />
        </div>
        <br>
        <button type="submit">Actualitzar</button>
    </form>

@endsection