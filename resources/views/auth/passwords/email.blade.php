@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <section class="bg-pink">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-[85vh] lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-5 sm:max-w-md mb-10 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Reset Password
                    </h1>

                    @if (Session::get('status'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                            <span class="font-medium">Success!</span> {{ Session::get('status') }}
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="post">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" required
                                autocomplete="email" autofocus
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @error('email')
                                <p id="outlined_error_help" class="mt-2 text-xs text-red-600">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="text-white bg-darker-pink hover:bg-darker-pink-90 focus:ring-1 focus:outline-none focus:ring-darker-pink-90 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
