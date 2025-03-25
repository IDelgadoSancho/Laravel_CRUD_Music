@extends('layout')

@section('title', 'Llistat de Artistas')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5">

        <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Llista de Usuaris
            <img src="{{ asset('images/users.svg') }}" alt="Delete" class="w-auto h-10 ml-1 inline-block">
        </h1>

        <div class="overflow-x-auto mt-4">
            <div class="min-w-full flex justify-center">
                <table class="bg-gray-800 text-white rounded-lg">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="py-2 px-4">Nom</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-700">
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                <td class="py-2 px-4">
                                    @if ($user->isAdmin())
                                        <span class="text-cyan-300">{{ $user->rol }}</span>
                                    @elseif ($user->isOrganitzador())
                                        <span class="text-red-600">{{ $user->rol }}</span>
                                    @elseif($user->isUsuari())
                                        <span class="text-amber-600">{{ $user->rol }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection