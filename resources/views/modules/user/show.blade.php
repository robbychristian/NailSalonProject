@extends('layouts.main')
@section('title', '| Show User')
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
                    View User Details
                </h1>


                <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Personal
                    Information</h4>
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First
                            name</label>
                        <input type="text" disabled value="{{ $user->first_name }}" name="first_name" id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div>
                        <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900">Middle
                            name</label>
                        <input type="text" disabled value="{{ $user->userProfile->middle_name }}" name="middle_name"
                            id="middle_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last
                            name</label>
                        <input type="text" disabled value="{{ $user->last_name }}" name="last_name" id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900">Date of
                            Birth</label>
                        <input type="date" disabled value="{{ $user->userProfile->birthday }}" name="birthday"
                            id="birthday"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2">
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                        <input type="text" disabled value="{{ $user->userProfile->address }}" name="address"
                            id="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>

                </div>

                <hr>
                <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3 mt-5">Contact Information & Log In
                    Information</h4>
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="contact_no" class="block mb-2 text-sm font-medium text-gray-900">Contact
                            Number</label>
                        <input type="text" disabled value="{{ $user->userProfile->contact_no }}" name="contact_no"
                            id="contact_no" onkeypress="return onlyNumberKey(event)" maxlength="11"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email
                            address</label>
                        <input type="email" disabled value="{{ $user->email }}" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" disabled value="{{ $user->username }}" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <div class="mb-6">
                    <a href="{{ route('users.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
