@extends('layouts.main')
@section('title', '| Add User')
@section('content')
    <script>
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode < 48 || ASCIICode > 57)
                return false;
            var inputValue = evt.target.value;

            // Check if the first character is '0' and if the input is longer than 1 character
            if (inputValue.length === 0 && ASCIICode === 48) {
                return false; // Disallow leading '0'
            }
            return true;
        }
    </script>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Create your account
                </h1>

                <form action="{{ route('users.store') }}" method="post">
                    @csrf

                    <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Personal
                        Information</h4>
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First
                                name</label>
                            <input type="text" value="{{ old('first_name') }}" name="first_name" id="first_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('first_name')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900">Middle
                                name</label>
                            <input type="text" value="{{ old('middle_name') }}" name="middle_name" id="middle_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('middle_name')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last
                                name</label>
                            <input type="text" value="{{ old('last_name') }}" name="last_name" id="last_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('last_name')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900">Date of
                                Birth</label>
                            <input type="date" value="{{ old('birthday') }}" name="birthday" id="birthday"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2">
                            @error('birthday')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                            <input type="text" value="{{ old('address') }}" name="address" id="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('address')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
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
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-1">
                                    <input type="text" value="+63" readonly disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full py-2.5">
                                </div>
                                <div class="col-span-11">
                                    <input type="text" value="{{ old('contact_no') }}" name="contact_no" id="contact_no"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                </div>
                            </div>

                            @error('contact_no')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email
                                address</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('email')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" value="{{ old('username') }}" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('username')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <p id="floating_helper_text" class="mt-2 text-xs text-gray-500">
                                Password must be 6-16 characters long, contain uppercase and lowercase
                                characters, numbers, and special character.
                            </p>

                            @error('password')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror

                        </div>
                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                                password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                            @error('confirm_password')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
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

                    <a href="{{ route('users.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                    <button type="submit"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
