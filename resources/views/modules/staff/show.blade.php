@extends('layouts.main')
@section('title', '| View Staff')
@section('content')

    <div class="flex flex-col px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                <a href="{{ route('staff.index') }}" class="text-gray-900  font-medium flex items-center "><i
                        class="fa-solid fa-arrow-left mr-3"></i><span class="hover:underline">Back</span></a>
                <div>
                    <label for="staff_name" class="block mb-2 text-sm font-medium text-gray-900">Staff Name</label>
                    <input type="text" disabled value="{{ $staff->staff_name }}" name="staff_name" id="staff_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>

                <div>
                    <label for="services" class="block mb-2 text-sm font-medium text-gray-900">Services</label>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($staff->services as $service)
                            <li>{{ $service->service_name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <label for="work_image" class="block mb-2 text-sm font-medium text-gray-900">Saved Work Images</label>
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        @forelse ($staff->workImages as $img)
                            <img class="h-auto max-w-xs"
                                src="{{ asset('img/work_images/' . $staff->id . '/' . $img->filename) }}" alt="">
                        @empty
                            <small>There are no saved work images available.</small>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
