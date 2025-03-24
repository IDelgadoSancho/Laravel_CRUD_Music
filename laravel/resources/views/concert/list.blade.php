@extends('layout')

@section('title', 'Llistat de Concerts')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <h1>Llista de Concerts</h1>

    @if (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->isUsuari() || (Auth::check() && Auth::user()->isAdmin()))
        <a href="{{ route('concert_new') }}">Crear Concert</a>
    @endif

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Data Hora
                    <form action="{{ route('concert_filtra_data') }}" method="get">
                        <input type="submit" name="sort" value="asc">&nbsp;
                        <input type="submit" name="sort" value="des">&nbsp;
                    </form>
                <th>Aforament
                    <form action="{{ route('concert_filtra_aforament') }}" method="get">
                        <input type="submit" name="sort" value="asc">&nbsp;
                        <input type="submit" name="sort" value="des">&nbsp;
                    </form>
                </th>
                <th>Entrades Disponibles
                    <form action="{{ route('concert_filtra_entrades') }}" method="get">
                        <input type="submit" name="sort" value="asc">&nbsp;
                        <input type="submit" name="sort" value="des">&nbsp;
                    </form>
                </th>
                <th>Artistes</th>
                <th>Festival</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($concerts as $concert)
                <tr>
                    <td>{{ $concert->nom }}</td>
                    <td>{{ $concert->data_hora->format('d-m-Y') }}</td>
                    <td>{{ $concert->aforament }}</td>
                    <td>{{ $concert->entradesDisponibles() }}

                        @if(Auth::check() && Auth::user()->isUsuari())
                                    @php
                                        $usuari = Auth::user();
                                        $entradesActuals = $concert->usuaris->where('id', $usuari->id)->first()?->pivot->entrades_comprades ?? 1;
                                    @endphp

                                    <form action="{{ route('concerts_comprar', $concert->id) }}" method="POST">
                                        @csrf
                                        <label for="entrades">Nombre d’entrades:</label>
                                        <input type="number" name="entrades" min="1" max="{{ $concert->entradesDisponibles() }}" required
                                            value="{{ $entradesActuals }}">
                                        <button type="submit">Comprar Entrades</button>
                                    </form>
                        @endif

                    </td>
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

                    @if (Auth::check() && Auth::user()->isOrganitzador() && Auth::user()->id == $concert->festival->user_id || (Auth::check() && Auth::user()->isAdmin()))
                        <td>
                            <a href="{{ route('concert_edit', ['id' => $concert->id]) }}">Editar</a>
                            <a href="{{ route('concert_delete', ['id' => $concert->id]) }}">Eliminar</a>
                        </td>
                    @endif

                </tr>
            @endforeach

        </tbody>
    </table>

    <form action="{{ route('concert_cerca_artista') }}" method="get">
        <label for="cercar">Cerca<strong>&nbsp;artista:</strong></label>
        <input type="text" name="cercar" required>
        <input type="submit" value="Cerca">&nbsp;

        @if (request()->has('cercar'))
            <label>Cercat per ... <strong>{{ request('cercar') }}</strong></label><br /><br />
            <a href="{{ route('concert_list') }}">+ Neteja la cerca</a>
        @endif
    </form>

@endsection