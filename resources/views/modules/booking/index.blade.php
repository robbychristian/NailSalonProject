@extends('layouts.main')
@section('title', '| List of Staff')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            @if (Session::get('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Success!</span> {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('status'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Success!</span> {{ Session::get('status') }}
                </div>
            @endif
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    List of Bookings
                </h1>
                <a href="{{ route('booking.create') }}"
                    class="text-white bg-darker-pink hover:bg-darker-pink-90 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Add Booking
                </a>

            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-900 py-5" id="booking-table">
                    <thead class="text-xs text-gray-700 uppercase bg-dark-pink">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Ref #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Customer Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Time In
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Branch
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Payment Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Approved At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $booking->ref_no }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($booking->date)->format('m-d-Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($booking->time_in)->format('h:i A') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->branch->branch_address }}
                                </td>
                                <td class="px-6 py-4" width="170">
                                    @if ($booking->payment->payment_status == 1)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Paid</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Not
                                            Yet
                                            Paid</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($booking->payment->updated_at != $booking->created_at)
                                        {{ $booking->payment->updated_at }}
                                    @endif
                                </td>
                                <td class="px-6 py-4" colspan="4">
                                    <div class="flex">
                                        <a href="{{ route('booking.show', $booking->id) }}"
                                            class="font-medium text-darker-pink hover:underline mr-2">View</a>

                                        <a href="{{ route('booking.edit', $booking->id) }}"
                                            class="font-medium text-darker-pink hover:underline">Edit</a>

                                        @if ($booking->payment->payment_status != 1 && Auth::user()->user_role == 1)
                                            <form action="{{ route('bookings.approve', $booking->id) }}" method="POST">
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <button type="submit"
                                                    class="ml-2 font-medium text-darker-pink hover:underline">Approve</button>
                                            </form>
                                        @endif

                                        @if ($booking->payment->payment_status != 1)
                                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="ml-2 font-medium text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 text-center" colspan="10">There are no data available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </section>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#booking-table');
    </script>
@endsection
