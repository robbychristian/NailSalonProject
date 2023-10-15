@extends('layouts.main')

@section('title', '| Dashboard')
@section('content')
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            <div class="flex items-center justify-between mb-5 mt-3">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Reviews
                </h1>
            </div>

            <div id="review" data-booking="{{ $booking->id }}" data-auth="{{ Auth::user()->id }}"></div>
        </div>
    </section>
@endsection
