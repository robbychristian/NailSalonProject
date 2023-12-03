import React, { useEffect, useState, Fragment } from "react";
import ReactDOM from "react-dom";
import {
    Card,
    CardContent,
    FormControl,
    FormControlLabel,
    Grid,
    InputAdornment,
    MenuItem,
    Radio,
    RadioGroup,
    TextField,
    Typography,
} from "@mui/material";
import { Bar } from "react-chartjs-2";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
} from "chart.js";
import axios from "axios";

ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend
);

const Report = (props) => {
    const [year, setYear] = useState(new Date().getFullYear());
    const [reservedBookings, setReservedBookings] = useState([]);
    const [cancelledBookings, setCancelledBookings] = useState([]);

    useEffect(() => {
        axios.get(`/api/getDataByYear/${year}`).then((response) => {
            setReservedBookings(response.data.reservedBookings);
            setCancelledBookings(response.data.cancelledBookings);
        });
    }, [year]);

    return (
        <Fragment>
            <div className="flex justify-between items-center">
                <h4 className="text-2xl font-semibold text-gray-700">
                    Total Yearly Booking
                </h4>

                <TextField
                    label="Year"
                    sx={{ width: "100px" }}
                    select
                    value={year}
                    onChange={(e) => setYear(e.target.value)}
                >
                    <MenuItem value="2023">2023</MenuItem>
                    <MenuItem value="2024">2024</MenuItem>
                    <MenuItem value="2025">2025</MenuItem>
                </TextField>
            </div>
            <Bar
                data={{
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ],
                    datasets: [
                        {
                            label: "Reserved Bookings",
                            backgroundColor: "rgba(75,192,192,0.2)",
                            borderColor: "rgba(75,192,192,1)",
                            borderWidth: 1,
                            hoverBackgroundColor: "rgba(75,192,192,0.4)",
                            hoverBorderColor: "rgba(75,192,192,1)",
                            data: reservedBookings,
                        },
                        {
                            label: "Cancelled Bookings",
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 1,
                            hoverBackgroundColor: "rgba(255, 99, 132, 0.4)",
                            hoverBorderColor: "rgba(255, 99, 132, 1)",
                            data: cancelledBookings,
                        },
                    ],
                }}
                options={{
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                }}
            />
        </Fragment>
    );
};

export default Report;

if (document.getElementById("sales-report")) {
    // const element = document.getElementById('sales-report')
    // const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Report />, document.getElementById("sales-report"));
}
