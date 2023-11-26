@extends('layouts.main')
@section('title', '| Edit Schedule')
@section('content')
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Edit Schedule
                    </h1>

                    <form action="{{ route('schedule.store') }}" method="post">
                        @csrf
                        <div class="mb-6">
                            <ul
                                class="grid grid-cols-1 md:grid-cols-7 gap-4 p-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">

                                @foreach ($dates as $date)
                                    <li class="w-full border border-gray-200 p-1">
                                        <div class="flex items-center ps-1">
                                            <input type="checkbox" name="dates[]" value="{{ $date['date'] }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <div class="ms-2 text-sm">
                                                <label for="helper-checkbox"
                                                    class="font-medium text-gray-900">{{ $date['fullDate'] }}</label>
                                                <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500">
                                                    {{ $date['day'] }}</p>
                                            </div>
                                        </div>
                                        {{-- <hr> --}}
                                        <div class="mt-3">
                                            <small class="text-sm ps-1">Services to Offer:</small>
                                            @foreach (Auth::user()->staff->services as $service)
                                                <div class="flex items-center ps-1 mt-3">
                                                    <input id="default-checkbox" name="services[{{ $date['date'] }}][]"
                                                        type="checkbox" value="{{ $service->id }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                    <label for="default-checkbox"
                                                        class="ms-2 text-sm font-normal text-gray-900">{{ $service->service_name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ route('services.index') }}"
                            class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-1">Back</a>
                        <button type="submit"
                            class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection
