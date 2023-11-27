@extends('layouts.main')
@section('title', '| Add Discount')
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
                    Add Discount - Service
                </h1>

                <form action="{{ route('discounts.store') }}" method="post">
                    @csrf

                    <div class="mb-6">
                        <label for="discount_name" class="block mb-2 text-sm font-medium text-gray-900">Name of
                            Discount</label>
                        <input type="text" value="{{ old('discount_name') }}" name="discount_name" id="discount_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('discount_name')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="discount_description"
                            class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea name="discount_description" id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('discount_description') }}</textarea>

                        @error('discount_description')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="staff_specialty" class="block mb-2 text-sm font-medium text-gray-900">Services</label>

                        @foreach ($services as $service)
                            <div class="flex items-center mb-4">
                                <input id="default-radio-1" type="radio" value="{{ $service->id }}" name="service"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                <label for="default-radio-1"
                                    class="ms-2 text-sm font-medium text-gray-900">{{ $service->service_name }}</label>
                            </div>
                        @endforeach

                        @error('service')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-6">
                        <label for="discount_percentage" class="block mb-2 text-sm font-medium text-gray-900">Discount
                            Percentage</label>
                        <input type="text" value="{{ old('discount_percentage') }}" name="discount_percentage"
                            id="discount_percentage"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            onkeypress="return onlyNumberKey(event)">
                        @error('discount_percentage')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ route('discounts.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                    <button type="submit"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
