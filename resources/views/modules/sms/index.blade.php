@extends('layouts.main')
@section('title', '| SMS')
@section('content')
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">


            <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">

                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    @if (Session::get('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                            <span class="font-medium">Success!</span> {{ Session::get('success') }}
                        </div>
                    @endif
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create SMS
                    </h1>

                    <form action="{{ route('sms.store') }}" method="post">
                        @csrf

                        <div class="mb-6">
                            <label for="message_content"
                                class="block mb-2 text-sm font-medium text-gray-900">Message</label>
                            <textarea value="{{ old('message_content') }}" name="message_content" id="message" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>

                            @error('message_content')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <a href="{{ route() }}"
                            class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a> --}}
                        <button type="submit"
                            class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection
