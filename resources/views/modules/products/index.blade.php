@extends('layouts.main')
@section('title', '| List of products')
@section('content')
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            @if (Session::get('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Success!</span> {{ Session::get('success') }}
                </div>
            @endif
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    List of Products
                </h1>

                <div>

                    <a href="{{ route('products.create') }}"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Add Product
                    </a>

                    <a href="{{ route('product-add-ons.index') }}"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Product Add Ons
                    </a>

                    <a href="{{ route('packages.index') }}"
                        class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Add Packages
                    </a>
                </div>

            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-900">
                    <thead class="text-xs text-gray-700 uppercase bg-dark-pink">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Service Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $product->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $product->product_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->product_description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $product->serviceType->service_name }}
                                </td>
                                <td class="px-6 py-4">
                                    ₱{{ $product->price }}
                                </td>
                                <td class="px-6 py-4" colspan="3">
                                    <div class="flex">

                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="font-medium text-darker-pink hover:underline">Edit</a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="ml-2 font-medium text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 text-center" colspan="6">There are no data available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </section>

@endsection
