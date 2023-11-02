@extends('layouts.main')
@section('title', '| List of Nail Colors')
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
                    List of Nail Colors
                </h1>
                <a href="{{ route('nail-colors.create') }}"
                    class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Nail Color
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
                                Brand
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Color
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colors as $color)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $color->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $color->brand }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full @if ($color->color == '#FFF' ? 'border border-gray-500' : '')  @endif"
                                        style="background-color:{{ $color->color }}">
                                    </div>
                                </td>
                                <td class="px-6 py-4" colspan="3">
                                    <div class="flex">

                                        <form action="{{ route('nail-colors.destroy', $color->id) }}" method="POST">
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
