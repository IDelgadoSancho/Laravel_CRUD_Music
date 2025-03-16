@extends('layout')

@section('title', 'New Concert')

@section('stylesheets')
    @parent
@endsection

@section('content')

<h1>Crear Concert</h1>
    <a href="{{ route('concert_list') }}">&laquo; Torna</a>

    <form action="{{ route('concert_new') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nom: <input type="text" name="nom" required></label><br>
        <label>Data Hora: <input type="date" name="data_hora" required></label><br>
        <label>Aforament: <input type="number" name="aforament" required></label><br>
        <label>Entrades Disponibles: <input type="number" name="entrades_disponibles" required></label><br>
        <label>Festival:
            <select name="festival_id">
                @foreach ($festivals as $festival)
                    <option value="{{ $festival->id }}">{{ $festival->nom }}</option>
                @endforeach
            </select>
        </label><br>
        <button type="submit">Desar</button>
    </form>

@endsection