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

                    <div class="mb-6">
                        <label for="staff_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" value="{{ old('staff_name') }}" name="staff_name" id="staff_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('staff_name')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="multiple_files">Upload Staff Image</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50"
                            id="multiple_files" type="file" name="staff_image">
                        @error('staff_image')
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                {{ $message }}</p>
                        @enderror
                    </div>

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
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="multiple_files">Upload Work Images</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50"
                            id="multiple_files" type="file" name="work_images[]" multiple>
                        @error('work_images')
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
