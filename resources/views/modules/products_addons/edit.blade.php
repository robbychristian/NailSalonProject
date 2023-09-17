@extends('layouts.main')
@section('title', '| Edit Product Add Ons')
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
                    Edit Product Add Ons
                </h1>

                <form action="{{ route('product-add-ons.update', $product_add_on->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">

                        <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900">Product List</label>
                        <select id="product_id" name="product_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @forelse ($products as $product)
                                <option value={{ $product->id }}
                                    {{ $product->id == $product_add_on->product_id ? 'selected' : '' }}>
                                    {{ $product->product_name }}</option>
                            @empty
                                There are no options.
                            @endforelse
                        </select>
                        @error('product_id')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="additional" class="block mb-2 text-sm font-medium text-gray-900">Additional</label>
                        <input type="text" value="{{ $product_add_on->additional }}" name="additional" id="additional"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('additional')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="additional_price" class="block mb-2 text-sm font-medium text-gray-900">Additional
                            Price</label>
                        <input type="text" value="{{ $product_add_on->additional_price }}" name="additional_price"
                            id="additional_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            onkeypress="return onlyNumberKey(event)">
                        @error('additional_price')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ route('product-add-ons.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                    <button type="submit"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
