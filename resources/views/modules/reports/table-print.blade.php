<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <div style="display:flex; justify-content:space-between; align-items:center">
        <h2>Sales Report</h2>
        <button onclick="window.print()" style="height:30px; width:50px">Print</button>
    </div>
    <h2>Summary</h2>
    <table>
        <tr>
            <th>Total Bookings Today</th>
            <th>Total Sales</th>
            <th>Total Products</th>
            <th>Total Packages</th>
        </tr>
        <tr>
            <td>{{ $bookingsTodayCount }}</td>
            <td>{{ $totalSales }}</td>
            <td>{{ $totalProducts }}</td>
            <td>{{ $totalPackages }}</td>
        </tr>
    </table>

    <br>

    <h2>Total Reserved Booking</h2>

    <div style="display: flex; justify-content:space-between; width: 100%">

        <table>
            <tr>
                <th>Month</th>
            </tr>
            @foreach ($months as $month)
                <tr>
                    <td>{{ $month }}</td>
                </tr>
            @endforeach
        </table>
        <table>
            <tr>
                <th>No of Booking per month</th>
            </tr>
            @foreach ($reservedBookings as $booking)
                <tr>
                    <td>{{ $booking }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <br>

    <h2>Total Cancelled Booking</h2>

    <div style="display: flex; justify-content:space-between; width: 100%">

        <table>
            <tr>
                <th>Month</th>
            </tr>
            @foreach ($months as $month)
                <tr>
                    <td>{{ $month }}</td>
                </tr>
            @endforeach
        </table>
        <table>
            <tr>
                <th>No of Booking per month</th>
            </tr>
            @foreach ($cancelledBookings as $booking)
                <tr>
                    <td>{{ $booking }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <br>

    <h2>Total Customers per Type</h2>
    <div style="display: flex; justify-content:space-between; width: 100%">
        <table>
            <tr>
                <th>Type of Customer</th>
            </tr>
            <tr>
                <td>Loyal Customer</td>
            </tr>
            <tr>
                <td>Non-Loyal Customer</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Total of Customer</th>
            </tr>
            @foreach ($totalTypeOfCustomer as $total)
                <tr>
                    <td>{{ $total }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div style="display: grid; grid-template-columns: auto auto;">
        <div>
            <h2>Top 10 Products Availed</h2>

            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                @forelse ($topProducts as $key => $products)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $products->product_name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align:center">No available data</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div style="margin-left: 40px">
            <h2>Top 10 Packages Availed</h2>

            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                @forelse ($topPackages as $key => $packages)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $packages->package_name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align:center">No available data</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>


</body>

</html>
