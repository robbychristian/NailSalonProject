@extends('layouts.main')
@section('title', '| Add Staff')
@section('content')

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Add Staff
                </h1>

                <form action="{{ route('staff.store') }}" method="post" enctype="multipart/form-data">
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
                    {{-- <div class="mb-6">
                        <label for="staff_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" value="{{ old('staff_name') }}" name="staff_name" id="staff_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('staff_name')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
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
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="multiple_files">Upload Staff
                            Image</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50"
                            id="multiple_files" type="file" name="staff_image">
                        <small class="mt-1 text-gray-500" id="file_input_help">Size Limit: 2MB |
                            Allowed Extensions:
                            .jpg, .jpeg, .png, .gif. </small>

                        @error('staff_image')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Work Information</h4>

                    <div class="mb-6">
                        <label for="staff_specialty" class="block mb-2 text-sm font-medium text-gray-900">Staff
                            Specialty</label>

                        @foreach ($services as $service)
                            <div class="flex items-center mb-4">
                                <input id="default-checkbox" type="checkbox" value="{{ $service->id }}" name="services[]"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="default-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900">{{ $service->service_name }}</label>
                            </div>
                        @endforeach

                        @error('services')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="multiple_files">Upload Work
                            Images</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50"
                            id="multiple_files" type="file" name="work_images[]" multiple>
                        <small class="mt-1 text-gray-500" id="file_input_help">Size Limit: 2MB |
                            Allowed Extensions:
                            .jpg, .jpeg, .png, .gif. </small>
                        @error('work_images.*')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ route('staff.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                    <button type="submit"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
