@extends('layout')

@section('title', 'Edit Concert')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Editar Concert</h1>

    <form action="{{ route('concert_edit', ['id' => $concert->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nom:
                <input type="text" name="nom" value="{{ $concert->nom }}" required></label>
        </div>
        <br>
        <div>
            <label>Data Hora:
                <input type="date" name="data_hora" value="{{ $concert->data_hora }}" required></label>
        </div>
        <br>
        <div>
            <label>Aforament:
                <input type="number" name="aforament" value="{{ $concert->aforament }}" required></label>
        </div>
        <br>
        <div>
            <label>Entrades Disponibles:
                <input type="number" name="entrades_disponibles" value="{{ $concert->entrades_disponibles }}" required></label>
        </div>
        <br>
        <label>Festival:
            <select name="festival_id">
                @foreach ($festivals as $festival)
                    <option value="{{ $festival->id }}" {{ $concert->festival_id == $festival->id ? 'selected' : '' }}>{{ $festival->nom }}
                    </option>
                @endforeach
            </select>
        </label>
        <br>
        <button type="submit">Actualitzar</button>
    </form>

@endsection