@extends('layouts.app')
@section('title', '| About Us')

@section('content')
    <section id="about-us" class="bg-pink">
        <div class="container mx-auto md:px-20 px-4">
            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase text-center mb-10">
                Our Services and Rates
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 justify-items-center items-center gap-4">
                <img class="w-full object-contain" src="{{ asset('img/homepage/services1.jpg') }}" alt="">
                <img class="w-full object-contain" src="{{ asset('img/homepage/services2.jpg') }}" alt="">
            </div>


            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase mt-10 mb-10">
                Services Reviews
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 justify-items-center items-center gap-4">
                <div class="h-full w-full">
                    <img class="h-full w-full object-cover" src="{{ asset('img/homepage/review1.png') }}" alt="">
                </div>
                <div class="h-full w-full">
                    <img class="h-full w-full object-cover" src="{{ asset('img/homepage/review2.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

@endsection
