@extends('layout')

@section('title', 'Edit Festival')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5 ">

        <div class="bg-gray-800 text-white rounded-lg p-3">

            <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Editar Festival</h1>

            <form action="{{ route('festival_edit', ['id' => $festival->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom:</label>
                    <input type="text" name="nom" value="{{ $festival->nom }}" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Ubicació:</label>
                    <input type="text" name="ubicacio" value="{{ $festival->ubicacio }}" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Data Inici:</label>
                    <input type="date" name="data_inici"
                        value="{{ old('data_inici', isset($festival) ? $festival->data_inici->format('Y-m-d') : '') }}"
                        required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Data Fi:</label>
                    <input type="date" name="data_fi"
                        value="{{ old('data_fi', isset($festival) ? $festival->data_fi->format('Y-m-d') : '') }}" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                @if ($festival->cartell)
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Cartell actual:</label>
                        <strong class="block mb-2">{{ $festival->cartell }}</strong>
                        <label for="delete_photo" class="inline-flex items-center">
                            <input type="checkbox" name="delete_photo" value="0" class="form-checkbox text-blue-500">
                            <span class="ml-2">Esborrar?</span>
                        </label>
                    </div>
                @endif
                <div class="mb-4">
                    <label for="cartell" class="block text-sm font-medium mb-2">Cartell:</label>
                    <input type="file" name="cartell"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Organitzador:</label>
                    <select name="user_id"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $festival->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualitzar</button>
            </form>

        </div>

    </div>

@endsection