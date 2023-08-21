@extends('layouts.app')

@section('content')
    <section id="banner-section">
        <div class="h-screen w-full bg-cover bg-no-repeat bg-slate-300 bg-blend-multiply"
            style="background-image: url('/img/hp-background.jpg');">
            <div class="flex flex-col justify-center items-center h-screen">
                <div class="px-4 text-center">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                        Beauty starts with nails.
                    </h1>
                    <p class="mb-8 text-lg font-normal text-white lg:text-xl sm:px-16 lg:px-64">Lorem ipsum dolor sit,
                        amet
                        consectetur adipisicing elit. Eaque veritatis nulla ullam
                    </p>

                    <a href="#"
                        class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="services-section" class=" bg-pink">
        <div class="container mx-auto px-5 md:px-0 py-10">
            <h1 class="text-center text-4xl font-bold text-gray-900">Services Offered</h1>

            <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                <!--Card 1-->
                <div class="rounded overflow-hidden shadow-lg h-full">
                    <div class="card-img h-60">
                        <img class="w-full h-full object-cover" src="{{ asset('img/homepage/1.jpg') }}" alt="Manicure">
                    </div>
                    <div class="px-6 py-4 bg-white text-center">
                        <div class="font-bold text-xl mb-2">Manicure</div>
                        <p class="text-gray-700 text-base">
                            Deep cleaning and treatment of your hands and nails.
                        </p>
                    </div>
                </div>
                <!--Card 2-->
                <div class="rounded overflow-hidden shadow-lg h-full">
                    <div class="card-img h-60">
                        <img class="w-full h-full object-cover" src="{{ asset('img/homepage/2.jpg') }}" alt="Pedicure">
                    </div>
                    <div class="px-6 py-4 bg-white text-center">
                        <div class="font-bold text-xl mb-2">Pedicure</div>
                        <p class="text-gray-700 text-base">
                            Deep cleaning and treatment of your feet and toenails.
                        </p>
                    </div>

                </div>

                <!--Card 3-->
                <div class="rounded overflow-hidden shadow-lg h-full">
                    <div class="card-img h-60">
                        <img class="w-full h-full object-cover" src="{{ asset('img/homepage/3.jfif') }}" alt="Extensions">
                    </div>
                    <div class="px-6 py-4 bg-white text-center h-full">
                        <div class="font-bold text-xl mb-2">Extensions</div>
                        <p class="text-gray-700 text-base">
                            Enchance the look of your eye lashes.
                        </p>
                    </div>
                </div>

                <!--Card 3-->
                <div class="rounded overflow-hidden shadow-lg h-full">
                    <div class="card-img h-60">
                        <img class="w-full h-full object-cover" src="{{ asset('img/homepage/4.jfif') }}" alt="Footspa">
                    </div>
                    <div class="px-6 py-4 bg-white text-center h-full">
                        <div class="font-bold text-xl mb-2">Footspa</div>
                        <p class="text-gray-700 text-base">
                            A massage that helps lessen stress and soothe your aching feet.
                        </p>
                    </div>
                </div>

                <!--Card 3-->
                <div class="rounded overflow-hidden shadow-lg h-full">
                    <div class="card-img h-60">
                        <img class="w-full h-full object-cover" src="{{ asset('img/homepage/5.jpg') }}" alt="Waxing">
                    </div>
                    <div class="px-6 py-4 bg-white text-center h-full">
                        <div class="font-bold text-xl mb-2">Waxing</div>
                        <p class="text-gray-700 text-base">
                            Usage of paraffin wax to soften your skin.
                        </p>
                    </div>
                </div>

                <!--Card 3-->
                <div class="rounded overflow-hidden shadow-lg h-full">
                    <div class="card-img h-60">
                        <img class="w-full h-full object-cover" src="{{ asset('img/homepage/6.jpg') }}" alt="Haircare">
                    </div>
                    <div class="px-6 py-4 bg-white text-center h-full">
                        <div class="font-bold text-xl mb-2">Haircare</div>
                        <p class="text-gray-700 text-base">
                            Treatment of your hair such as rebonding and hair coloring.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
