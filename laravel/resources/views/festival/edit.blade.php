@extends('layout')

@section('title', 'Nou Llibre')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Editar Festival</h1>

    <form action="{{ route('festival_edit', ['id' => $festival->id]) }}" method="POST" enctype="multipart/form-data">
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
                <input type="date" name="data_inici" value="{{ $festival->data_inici }}" required></label>
        </div>
        <br>
        <div>
            <label>Data Fi:
                <input type="date" name="data_fi" value="{{ $festival->data_fi }}" required></label>
        </div>
        <br>
        @if ($festival->cartell)
            <div>
                Cartell actual:<strong>{{$festival->cartell}}</strong>
                <label for="delete_photo">Esborrar?</label>
                <input type="checkbox" name="delete_photo" value="0" />
            </div>
        @endif
        <div>
            <label for="cartell">Cartell</label>
            <input type="file" name="cartell" />
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