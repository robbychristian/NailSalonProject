@extends('layouts.main')
@section('title', '| Nail Customization')
@section('content')
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            @if (Session::get('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Success!</span> {{ Session::get('success') }}
                </div>
            @endif

            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                Self-Personalization Digital Catalogue
            </h1>
            @guest
                <small>In order to your personalized nail design, <a href="{{ route('login') }}">Login</a> or <a
                        href="{{ route('register') }}">Sign up</a> to schedule a booking.</small>
            @endguest
            @auth
                <small>Note: Once you have saved your personalized nail design, this will be used on the booking module.</small>
            @endauth
            <div id="nail-customization" data-auth="{{ Auth::user() }}"></div>
        </div>

    </section>

@endsection
