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
            <div id="nail-customization" data-auth="{{ Auth::user() }}"></div>
        </div>

    </section>

@endsection
