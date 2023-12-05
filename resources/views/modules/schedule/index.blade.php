@extends('layouts.main')
@section('title', '| Staff Schedule')
@section('content')
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            @if (Session::get('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Success!</span> {{ Session::get('success') }}
                </div>
            @endif
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Schedule
                </h1>
                @if (count($schedule) == 0)
                    <a href="{{ route('schedule.create') }}"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Edit Schedule
                    </a>
                @endif

            </div>

            <div id="schedule-calendar" data-staffId="{{ $staffId }}"></div>
        </div>

    </section>

@endsection
