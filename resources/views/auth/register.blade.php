@extends('layouts.app')
@section('title', 'Registration')
@section('content')
    {{-- <form action="{{ route('register') }}" method="post">
        @csrf

        <input type="text"  name="first_name" id="first_name" placeholder="first_name" class="border">
        <input type="text" name="middle_name" id="middle_name" placeholder="middle_name" class="border">
        <input type="text" name="last_name" id="last_name" placeholder="last_name" class="border">
        <input type="date" name="birthday" id="birthday" placeholder="birthday" class="border">
        <input type="text" name="street" id="street" placeholder="street" class="border">
        <input type="text" name="region" id="region" placeholder="region" class="border">
        <input type="text" name="province" id="province" placeholder="province" class="border">
        <input type="text" name="city" id="city" placeholder="city" class="border">
        <input type="text" name="barangay" id="barangay" placeholder="barangay" class="border">
        <input type="text" name="postal_code" id="postal_code" placeholder="postal_code" class="border">
        <input type="text" name="contact_no" id="contact_no" placeholder="contact_no" class="border">
        <input type="text" name="email" id="email" placeholder="email" class="border">
        <input type="text" name="username" id="username" placeholder="username" class="border">
        <input type="password" name="password" id="password" placeholder="password" class="border">
        <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm_password" class="border">
        <input type="checkbox" name="is_notify" id="is_notify">

        <button type="submit">Submit</button>
    </form> --}}

    <section class="bg-pink">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create your account
                    </h1>

                    <form action="{{ route('register') }}" method="post">
                        @csrf

                        <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Personal
                            Information</h4>
                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First
                                    name</label>
                                <input type="text" value="{{ old('first_name') }}" name="first_name" id="first_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="John">
                                @error('first_name')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900">Middle
                                    name</label>
                                <input type="text" value="{{ old('middle_name') }}" name="middle_name" id="middle_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('middle_name')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last
                                    name</label>
                                <input type="text" value="{{ old('last_name') }}" name="last_name" id="last_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('last_name')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900">Date of
                                Birth</label>
                            <input type="date" value="{{ old('birthday') }}" name="birthday" id="birthday"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2"
                                placeholder="">
                            @error('birthday')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <label for="street" class="block mb-2 text-sm font-medium text-gray-900">Street</label>
                                <input type="text" value="{{ old('street') }}" name="street" id="street"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('street')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="region" class="block mb-2 text-sm font-medium text-gray-900">Region</label>
                                <input type="text" value="{{ old('region') }}" name="region" id="region"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('region')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900">Province</label>
                                <input type="text" value="{{ old('province') }}" name="province" id="province"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('province')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                                <input type="text" value="{{ old('city') }}" name="city" id="city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('city')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                <input type="text" value="{{ old('barangay') }}" name="barangay" id="barangay"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('barangay')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label for="postal_code" class="block mb-2 text-sm font-medium text-gray-900">Postal
                                    Code</label>
                                <input type="text" value="{{ old('postal_code') }}" name="postal_code"
                                    id="postal_code"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('postal_code')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3 mt-5">Contact Information & Log In
                            Information</h4>
                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <label for="contact_no" class="block mb-2 text-sm font-medium text-gray-900">Contact
                                    Number</label>
                                <input type="text" value="{{ old('contact_no') }}" name="contact_no" id="contact_no"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('contact_no')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email
                                    address</label>
                                <input type="email" value="{{ old('email') }}" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="john.@company.com">
                                @error('email')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                <input type="text" value="{{ old('username') }}" name="username" id="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="">
                                @error('username')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                <input type="password" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="•••••••••">
                                <p id="floating_helper_text" class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Remember,
                                    contributions to this topic should follow ou
                                </p>

                                @error('password')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror

                            </div>
                            <div>
                                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                                    password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="•••••••••">

                                @error('confirm_password')
                                    <p id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="flex items-start mb-6">
                            <div class="flex items-center h-5">
                                <input name="is_notify" type="hidden" value="0">
                                <input name="is_notify" type="checkbox" value="1"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Get SMS Notifications for
                                updates and promotions.</label>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </section>
@endsection
