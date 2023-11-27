@extends('layouts.main')
@section('title', '| Discounts')
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
                    Discounts
                </h1>
                {{-- <a href="{{ route('discounts.create') }}"
                    class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Discount (Service)
                </a> --}}

                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-discount"
                    class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                    type="button">Add Discount <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown-discount" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('discounts.create') }}" class="block px-4 py-2 hover:bg-gray-100">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('discounts.products') }}"
                                class="block px-4 py-2 hover:bg-gray-100">Products</a>
                        </li>
                    </ul>
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
                                Discount Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Discount Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Discount Percentage
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($discounts as $discount)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $discount->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $discount->discount_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->discount_desc }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->product->product_name ?? null }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->service->service_name ?? null }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $discount->discount_percent }}
                                </td>
                                <td class="px-6 py-4" colspan="3">
                                    <div class="flex">
                                        {{-- <a href="{{ route('services.edit', $service->id) }}"
                                            class="font-medium text-darker-pink hover:underline">Edit</a> --}}

                                        <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST">
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
