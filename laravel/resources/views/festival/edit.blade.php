@extends('layout')

@section('title', 'Nou Llibre')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Editar Festival</h1>

    <form action="{{ route('festival_edit', $festival->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nom:
            <input type="text" name="nom" value="{{ $festival->nom }}" required></label>
        </div>
        <br>
        <div>
            <label>Ubicació:
            <input type="text" name="ubicacio" value="{{ $festival->ubicacio }}" required></label>
        </div>
        <br>
        <div>
            <label>Data Inici:
            <input type="date" name="data_inici" value="{{ $festival->data_inici->format('Y-m-d') }}" required></label>
        </div>
        <br>
        <div>
            <label>Data Fi:
            <input type="date" name="data_fi" value="{{ $festival->data_fi->format('Y-m-d') }}" required></label>
        </div>
        <br>
        <label>Organitzador:
            <select name="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $festival->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}
                    </option>
                @endforeach
            </select>
        </label>
        <br>
        <button type="submit">Actualitzar</button>
    </form>

@endsection