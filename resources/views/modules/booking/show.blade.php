@extends('layouts.main')
@section('title', '| Show Booking')
@section('content')
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-5 mb-10 md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    View Booking Reservation Details
                </h1>

                <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Customer Information</h4>
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First
                            name</label>
                        <input type="text" disabled value="{{ $booking->user->first_name }}" name="first_name"
                            id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div>
                        <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900">Middle
                            name</label>
                        <input type="text" disabled value="{{ $booking->userProfile->middle_name }}" name="middle_name"
                            id="middle_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>

                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last
                            name</label>
                        <input type="text" disabled value="{{ $booking->user->last_name }}" name="last_name"
                            id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="contact_no" class="block mb-2 text-sm font-medium text-gray-900">Contact Number</label>
                        <input type="text" disabled value="{{ $booking->userProfile->contact_no }}" name="contact_no"
                            id="contact_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                        <input type="text" disabled value="{{ $booking->user->email }}" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Booking Details</h4>
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900"> Date</label>
                        <input type="text" disabled value="{{ \Carbon\Carbon::parse($booking->date)->format('m-d-Y') }}"
                            name="date" id="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="time" class="block mb-2 text-sm font-medium text-gray-900">Time</label>
                        <input type="text" disabled
                            value=" {{ \Carbon\Carbon::parse($booking->time_in)->format('h:i A') }} -  {{ \Carbon\Carbon::parse($booking->time_out)->format('h:i A') }}"
                            name="time" id="time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="branch" class="block mb-2 text-sm font-medium text-gray-900">Branch</label>
                        <input type="text" disabled value="{{ $booking->branch->branch_address }}" name="branch"
                            id="branch"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>

                <div class="grid gap-6 mb-6">
                    <div>
                        <label for="service" class="block mb-2 text-sm font-medium text-gray-900">Availed Services</label>
                        @foreach ($booking->products as $products)
                            <input type="text" disabled value="{{ $products->product_name }}" name="service"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-3">
                        @endforeach
                        @foreach ($booking->packages as $packages)
                            <input type="text" disabled value="{{ $packages->package_name }}" name="service"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-3">
                        @endforeach
                    </div>
                </div>

                <div class="grid gap-6 mb-6">
                    <div>
                        <label for="staff" class="block mb-2 text-sm font-medium text-gray-900">Technician Name</label>
                        <input type="text" disabled value="{{ $booking->staff->staff_name }}" name="staff"
                            id="staff"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>

                </div>

                <h4 class="text-lg font-semibold text-gray-900 md:text-xl mb-3">Payment Details</h4>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="totalPrice" class="block mb-2 text-sm font-medium text-gray-900"> Total Price</label>
                        <input type="text" disabled value="₱{{ $booking->payment->total_price }}" name="totalPrice"
                            id="totalPrice"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="time" class="block mb-2 text-sm font-medium text-gray-900">Payment Status</label>
                        @if ($booking->payment->payment_status == 1)
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Paid</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Not Yet
                                Paid</span>
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <a href="{{ route('booking.index') }}"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection