@extends('layouts.app')
@section('title', '| Contact Us')

@section('content')
    <section id="contact-us" class="bg-pink">
        <div class="container mx-auto md:px-20 px-4 h-screen">
            <h1
                class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase text-center mb-10">
                Get in Touch with us
            </h1>

            <div class="flex justify-center items-center">
                <div
                    class="w-9/12 p-6 bg-white border border-gray-200 rounded-lg shadow">

                    <div class="grid grid-cols-2">

                        <div class="flex justify-center flex-col">

                            <div class="flex items-center">
                                <span class="fa-stack fa-xl">
                                    <i class="fa-solid fa-circle fa-stack-2x text-dark-pink"></i>
                                    <i class="fa-solid fa-location-dot fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="ml-3">
                                    <h2 class="text-md font-semibold text-gray-900">Location</h2>
                                    <p class="text-sm">177 M. Dela Fuente St, Sampaloc, Manila, Manila, Philippines</p>
                                </span>
                            </div>

                            <div class="flex items-center mt-5">
                                <span class="fa-stack fa-xl">
                                    <i class="fa-solid fa-circle fa-stack-2x text-dark-pink"></i>
                                    <i class="fa-solid fa-clock fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="ml-3">
                                    <h2 class="text-md font-semibold text-gray-900">Opening Hours</h2>
                                    <p class="text-sm">11:00AM - 10:00PM</p>
                                </span>
                            </div>

                            <div class="flex items-center mt-5">
                                <span class="fa-stack fa-xl">
                                    <i class="fa-solid fa-circle fa-stack-2x text-dark-pink"></i>
                                    <i class="fa-solid fa-phone fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="ml-3">
                                    <h2 class="text-md font-semibold text-gray-900">Contact Number</h2>
                                    <p class="text-sm">0945 843 6936</p>
                                </span>
                            </div>


                            <div class="flex items-center mt-5">
                                <span class="fa-stack fa-xl">
                                    <i class="fa-solid fa-circle fa-stack-2x text-dark-pink"></i>
                                    <i class="fa-solid fa-envelope fa-stack-1x fa-inverse"></i>
                                </span>

                                <span class="ml-3">
                                    <h2 class="text-md font-semibold text-gray-900">Email Address</h2>
                                    <p class="text-sm">glgdepollo@gmail.com</p>
                                </span>
                            </div>
                        </div>
                        {{-- <iframe style="border:0; width: 100%; height: 500px;"
                            src="https://maps.google.com/maps?q=cobra%20itech&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" allowfullscreen></iframe> --}}

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.9148871469874!2d120.9981014747126!3d14.603924176996038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c98db0a2db83%3A0xbec0a0c466ff23b9!2sGracey%20Nails%20and%20Lashes%20Services!5e0!3m2!1sen!2sph!4v1699186102111!5m2!1sen!2sph"
                            style="border:0; width: 100%; height: 300px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
