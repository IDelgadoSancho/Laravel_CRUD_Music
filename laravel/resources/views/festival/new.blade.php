@extends('layout')

@section('title', 'Nou Llibre')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Crear Festival</h1>
    <a href="{{ route('festival_list') }}">&laquo; Torna</a>

    <form action="{{ route('festival_new') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nom: <input type="text" name="nom" required></label><br>
        <label>Ubicació: <input type="text" name="ubicacio" required></label><br>
        <label>Data Inici: <input type="date" name="data_inici" required></label><br>
        <label>Data Fi: <input type="date" name="data_fi" required></label><br>
        <label>Cartell: <input type="file" name="cartell"></label><br>
        <label>Organitzador:
            <select name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nom }}</option>
                @endforeach
            </select>
        </label><br>
        <button type="submit">Desar</button>
    </form>

@endsection