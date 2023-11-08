@extends('layouts.main')

@section('title', '| Sales Report')
@section('content')
    <section>
        <div class="px-6 py-8 mx-auto lg:py-0">
            <div class="flex items-center justify-between mb-5 mt-3">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Sales Report
                </h1>
                <a href="{{ route('reports.print') }}" target="_blank" rel="noopener noreferrer">Print</a>
            </div>
            <div class="mt-4">
                <div class="flex flex-wrap -mx-6">
                    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/4 sm:mt-0">
                        <div class="flex items-center px-5 py-6 shadow-lg rounded-md bg-white">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                                <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 1v3m5-3v3m5-3v3M1 7h18M5 11h10M2 3h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" />
                                </svg>
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $bookingsTodayCount }}</h4>
                                <div class="text-gray-500">Total Bookings Today</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/4 xl:mt-0">
                        <div class="flex items-center px-5 py-6 shadow-lg rounded-md bg-white">
                            <div class="p-3 rounded-full bg-sky-500 bg-opacity-75">
                                <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z" />
                                </svg>
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">₱{{ $totalSales }}</h4>
                                <div class="text-gray-500">Total Sales</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full px-6 sm:w-1/2 xl:w-1/4">
                        <div class="flex items-center px-5 py-6 shadow-lg rounded bg-white">
                            <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                                <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                                </svg>
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalProducts }}</h4>
                                <div class="text-gray-500">Total Products</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full px-6 sm:w-1/2 xl:w-1/4">
                        <div class="flex items-center px-5 py-6 shadow-lg rounded bg-white">
                            <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
                                <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 5h4m-2 2V3M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.938-11H17l-2 7H5m0 0L3 4m0 0h2M3 4l-.792-3H1" />
                                </svg>
                            </div>

                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalPackages }}</h4>
                                <div class="text-gray-500">Total Packages</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-4">
                <div class="grid grid-cols-12 gap-10">
                    <div class="col-span-12 xl:col-span-8">
                        <div class="px-5 py-6 shadow-lg rounded bg-white h-full">
                            <h4 class="text-2xl font-semibold text-gray-700">Total Monthly Booking</h4>

                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-4">
                        <div class="px-5 py-6 shadow-lg rounded bg-white h-full">
                            <h4 class="text-2xl font-semibold text-gray-700">Total Customers per Type</h4>
                            <div>
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="grid grid-cols-12 gap-10">
                    <div class="col-span-12 xl:col-span-6">
                        <div class="px-5 py-6 shadow-lg rounded bg-white h-full">
                            <h4 class="text-2xl font-semibold text-gray-700">Top Products Availed</h4>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                <table class="w-full text-sm text-left text-gray-900">
                                    <thead class="text-xs text-gray-700 uppercase bg-dark-pink">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                #
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topProducts as $key => $product)
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $key + 1 }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $product->product_name }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="px-6 py-4 text-center" colspan="2">There are no data
                                                    available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                        <div class="px-5 py-6 shadow-lg rounded bg-white h-full">
                            <h4 class="text-2xl font-semibold text-gray-700">Top Packages Availed</h4>


                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                <table class="w-full text-sm text-left text-gray-900">
                                    <thead class="text-xs text-gray-700 uppercase bg-dark-pink">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                #
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topPackages as $key => $package)
                                            <tr class="bg-white border-b">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $key + 1 }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $package->package_name }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="px-6 py-4 text-center" colspan="2">There are no data
                                                    available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        let months = {!! json_encode($months) !!};
        let numberOfBookings = {!! json_encode($numberOfBookings) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'No of Booking per month',
                    data: numberOfBookings,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    // title: {
                    //     display: true,
                    //     text: 'Total Monthly Booking'
                    // }
                }

            }

        });
    </script>

    <script>
        const ctx2 = document.getElementById('myChart2');
        let totalTypeOfCustomer = {!! json_encode($totalTypeOfCustomer) !!}
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Loyal Customer', 'Non-Loyal Customer'],
                datasets: [{
                    data: totalTypeOfCustomer,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: '# of Bookings per Time'
                    }
                }

            }

        });
    </script>
@endsection
