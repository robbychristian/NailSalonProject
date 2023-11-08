@extends('layouts.app')

@section('content')
    <section class="bg-pink">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-[85vh] lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-5 sm:max-w-md mb-10 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Login your account
                    </h1>

                    <form action="{{ route('admin.submit-login') }}" method="post">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email or
                                Username</label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('email')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                            @if (Session::get('error'))
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ Session::get('error') }}</p>
                            @endif
                        </div>

                        <div class="mb-2">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('password')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror

                        </div>

                        <p class="flex justify-end mb-5 text-sm font-semibold text-darker-pink"><a
                                href="{{ route('password.request') }}" class="underline">Forgot your password?</a></p>

                        <button type="submit"
                            class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>

                        <p class="mt-5 text-sm font-semibold text-darker-pink">Don't have an account yet? <a
                                href="{{ route('register') }}" class="underline">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
