@extends('layout')

@section('title', 'New Festival')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="p-5 ">

        <div class="p-3 bg-gray-800 text-white rounded-lg">

            <h1 class="text-3xl font-bold mb-4 text-[#FF3427]">Crear Festival</h1>
            <a href="{{ route('festival_list') }}" class="text-blue-500 hover:text-blue-700">&laquo; Torna</a>

            <form action="{{ route('festival_new') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom:</label>
                    <input type="text" name="nom" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Ubicació:</label>
                    <input type="text" name="ubicacio" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Data Inici:</label>
                    <input type="date" name="data_inici" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Data Fi:</label>
                    <input type="date" name="data_fi" required
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4"></div>
                <label for="cartell" class="block text-sm font-medium mb-2">Cartell:</label>
                <input type="file" name="cartell"
                    class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Organitzador:</label>
            <select name="user_id"
                class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Desar</button>
        </form>

    </div>

    </div>

@endsection