@extends('layouts.main')
@section('title', '| Add Package')
@section('content')
    <script>
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode < 48 || ASCIICode > 57)
                return false;
            return true;
        }
    </script>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Add Package
                </h1>

                <form action="{{ route('packages.store') }}" method="post">
                    @csrf

                    <div class="mb-6">
                        <label for="package_name" class="block mb-2 text-sm font-medium text-gray-900">Name of Service</label>
                        <input type="text" value="{{ old('package_name') }}" name="package_name" id="package_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('package_name')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">List of Products</label>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            @foreach ($services as $service)
                                <div class="mb-4">
                                    <h3 class="mb-3 text-sm font-semibold text-gray-900">{{ $service->service_name }}</h3>
                                    <ul class="w-full text-sm font-medium text-gray-900 bg-pink rounded-lg">
                                        @foreach ($products as $product)
                                            @if ($service->id === $product->service_id)
                                                <li class="w-full border-b border-gray-50 rounded-t-lg">
                                                    <div class="flex items-center pl-3">
                                                        <input id="{{ $product->id }}" type="checkbox" name="product[]"
                                                            value="{{ $product->id }}"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                        <label for="{{ $product->id }}"
                                                            class="w-full py-3 ml-2 text-sm font-medium text-gray-900">{{ $product->product_name }}</label>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>

                        @error('product')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                        <input type="text" value="{{ old('price') }}" name="price" id="price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            onkeypress="return onlyNumberKey(event)">
                        @error('price')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ route('packages.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                    <button type="submit"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
