@extends('layouts.main')
@section('title', '| View Package')
@section('content')

    <div class="flex flex-col px-6 py-8 mx-auto lg:py-0">
        <div class="w-96 bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                {{-- <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    View Package
                </h1> --}}
                <a href="{{ route('packages.index') }}" class="text-gray-900  font-medium flex items-center "><i
                        class="fa-solid fa-arrow-left mr-3"></i><span class="hover:underline">Back</span></a>
                <div>
                    <div class="flex justify-between">
                        <h1 class="font-bold">{{ $package->package_name }}</h1>
                        <p class="font-bold">₱{{ $package->price }}</p>
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
            </div>
        </div>
    </div>
@endsection
