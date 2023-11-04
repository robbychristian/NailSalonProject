@extends('layouts.main')
@section('title', '| Add Nail Colors')
@section('content')

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Add Nail Colors
                </h1>

                <form action="{{ route('nail-colors.store') }}" method="post">
                    @csrf

                    <div class="mb-6">
                        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900">Nail Polish Brand</label>
                        <select id="brand" name="brand"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="Gel polish (China brand)">China</option>
                            <option value="Gel polish (Orly brand)">Orly</option>
                        </select>
                        @error('brand')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Color</label>
                        <input type="text" value="{{ old('color') }}" name="color" id="color"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                        @error('color')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ route('nail-colors.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                    <button type="submit"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
