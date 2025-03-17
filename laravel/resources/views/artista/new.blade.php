@extends('layout')

@section('title', 'New Artista')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Crear Artista</h1>
    <a href="{{ route('artista_list') }}">&laquo; Torna</a>

    <form action="{{ route('artista_new') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nom: <input type="text" name="nom" required></label><br>
        <label>Genere Musical: <input type="text" name="genere_musical" required></label><br>
        <label>Pais Origen: <input type="text" name="pais_origen" required></label><br>
        <label>Foto artista: <input type="file" name="foto_artista"></label><br>
        <button type="submit">Desar</button>
    </form>

@endsection