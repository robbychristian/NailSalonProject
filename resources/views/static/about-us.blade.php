@extends('layouts.app')
@section('title', '| About Us')

@section('content')
    <section id="about-us" class="bg-pink">
        <div class="container mx-auto md:px-20 px-4 py-10">
            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase text-center mb-10">
                Who we are. What we do.
            </h1>

            <div class="grid grid-cols-2 justify-items-center items-center">
                <div class="h-96 w-full">
                    <img class="h-full w-full object-cover" src="{{ asset('img/homepage/graceyfront.jpg') }}" alt="">
                </div>
                <div class="h-96 w-full">
                    <img class="h-full w-full object-cover" src="{{ asset('img/homepage/graceyindo.jpg') }}" alt="">
                </div>
            </div>

            <div class="bg-dark-pink mt-6">
                <p class="text-justify p-5">
                    Gracey Nails and Lashes Services is a salon that specializes in providing aesthetic enhancements for
                    nails
                    and eyelashes. Founded on the year 2022 by Gladys Galapin, Gracey Nails and Lashes Services strives to
                    be
                    on-par with its competitors and customer’s needs. Through their vast and affordable selection of
                    services
                    and offers readily made available to the clients, the salon makes sure that the accommodation and
                    providing
                    of service would be of quality and without the risk of compromising in bringing your true beauty.
                    Located at
                    Sampaloc, Manila, Gracey Nails and Lashes Services proves to thrive and further their reputation and
                    capability to adapt and enhance on making your very own nails and lashes aesthetically pleasing. We are
                    open
                    from Monday to Sunday - 10:00 AM to 10:00 PM. We also accept advance bookings and walk-ins. See what
                    lies
                    ahead by paying us a visit!
                </p>

              
            </div>

            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase mt-10">
                Our Team
            </h1>

            <div class="mt-6 grid grid-cols-12 justify-items-center items-center gap-10">
                <div class="col-span-12 md:col-span-3 bg-darker-pink h-full w-full">
                    <div class="h-full flex justify-center items-center">
                        <img class="h-48 w-48 rounded-full" src="{{ asset('img/homepage/founder.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-span-12 md:col-span-9 h-full w-full">
                    <div class="grid grid-rows-12 gap-5">
                        <div class="rows-span-12 md:rows-span-3 bg-dark-pink">
                            <h3 class="text-center p-3 text-3xl font-bold uppercase">Founder, Gladys Depollo</h3>
                        </div>
                        <div class="rows-span-12 md:rows-span-9 bg-dark-pink">
                              <p class="text-justify p-5">
                    Gladys Galapin is the founder of Gracey Nails and Lashes Services. On the year 2022, she established the
                    salon which aims to provide maintenance and enhancement to its customers’ nails and lashes such as
                    manicure,
                    pedicure, foot spa, threading, and waxing. Gracey Nails and Lashes Services was a dream business now
                    made
                    true fueled by Gladys’ vision and consistent drive for a competitive yet efficient strategies on
                    bringing
                    the salon to its customers. Being charismatic with her overseeing the salon, it is then highly
                    anticipated
                    that our customers are in for a quality experience with our services.
                </p>
                            <p class="p-5 text-justify">

                                Gracey Nails and Lashes Services is a salon that specializes in providing aesthetic
                                enhancements for nails and eyelashes.
                                Founded on the year 2022 by Gladys Galapin, Gracey Nails and Lashes Services strives to be
                                on-par with its competitors and customer’s needs.
                                Through their vast selection of services and offers readily made available to the clients,
                                the salon makes sure that the accommodation and providing of service would be of quality and
                                without the risk of compromising in bringing your true beauty.
                                Located at Sampaloc, Manila, Gracey Nails and Lashes Services proves to thrive and further
                                their reputation and capability to adapt and enhance on making your very own nails and
                                lashes aesthetically pleasing.
                                See what lies ahead by paying us a visit!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-10 grid grid-cols-1 md:grid-cols-3 gap-10 justify-items-stretch mt-10">
                @foreach ($staffs as $staff)
                    <div class="mb-20">
                        <div class="h-full">
                            <div class="h-full flex justify-center items-center bg-darker-pink">
                                <img class="h-40 w-40 rounded-full"
                                    src="{{ asset('img/profile_pictures/' . $staff->id . '/' . $staff->staff_image) }}"
                                    alt="">
                            </div>

                            <p class="font-bold text-center mb-2 mt-2">{{ $staff->staff_name }}</p>
                            <div class="flex justify-center items-center flex-wrap">
                                @foreach ($staff->services as $service)
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded mb-2">{{ $service->service_name }}</span>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
