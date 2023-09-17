@extends('layouts.main')
@section('title', '| List of Product Add Ons')
@section('content')
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            @if (Session::get('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">Success!</span> {{ Session::get('success') }}
                </div>
            @endif
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    List of Product Add Ons
                </h1>
                <a href="{{ route('product-add-ons.create') }}"
                    class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Product Add Ons
                </a>

            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-900">
                    <thead class="text-xs text-gray-700 uppercase bg-dark-pink">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Additional
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Additional Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product_add_ons as $addons)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $addons->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $addons->product->product_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $addons->additional }}
                                </td>
                                <td class="px-6 py-4">
                                    ₱{{ $addons->additional_price }}
                                </td>
                                <td class="px-6 py-4" colspan="3">
                                    <div class="flex">
                                        <a href="{{ route('product-add-ons.edit', $addons->id) }}"
                                            class="font-medium text-darker-pink hover:underline">Edit</a>

                                        <form action="{{ route('product-add-ons.destroy', $addons->id) }}" method="POST">
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