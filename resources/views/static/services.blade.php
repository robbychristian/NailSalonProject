@extends('layouts.app')
@section('title', '| About Us')

@section('content')
    <section id="about-us" class="bg-pink">
        <div class="container mx-auto md:px-20 px-4">
            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase text-center mb-10">
                Our Services and Rates
            </h1>

            <div class="grid lg:grid-cols-3 grid-cols-1 gap-4 justify-items-center">

                @foreach ($services as $service)
                    <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow w-full">
                        <h1 class="font-bold text-xl text-gray-900 mb-3">{{ $service->service_name }}</h1>
                        @foreach ($products as $product)
                            @if ($product->service_id == $service->id)
                                <div class="flex justify-between mt-2">
                                    <p>{{ $product->product_name }}</p>
                                    <p>{{ $product->price }}</p>
                                </div>
                                @foreach ($product_add_ons as $addons)
                                    @if ($product->id == $addons->product_id)
                                        <div class="flex justify-between">
                                            <p class="italic text-sm">*{{ $addons->additional }}</p>
                                            <p class="italic text-sm">{{ $addons->additional_price }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="grid grid-cols-1 gap-4 justify-items-center mt-5">
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow w-full">
                    <h1 class="font-bold text-xl text-gray-900 mb-3">Packages</h1>
                    <div class="grid md:grid-cols-4 grid-cols-1 md:gap-10 gap-4">
                        @foreach ($packages as $package)
                            <div>
                                <div class="flex justify-between">
                                    <h1 class="font-bold">{{ $package->package_name }}</h1>
                                    <p class="font-bold">{{ $package->price }}</p>
                                </div>
                                <ul class="list-disc list-inside">

                                    @foreach ($package->products as $product)
                                        <li>
                                            {{ $product->product_name }}
                                        </li>
                                    @endforeach
                                </ul>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </div>
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
