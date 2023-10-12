import React, { useEffect, useState, Fragment } from "react";
import ReactDOM from "react-dom";
import moment from "moment";
import axios from "axios";
import FullCalendar from "@fullcalendar/react";
import timeGridPlugin from '@fullcalendar/timegrid';
import { Card, CardContent, FormControl, FormControlLabel, Grid, InputAdornment, Radio, RadioGroup, TextField, Typography } from "@mui/material";

const DashboardCalendar = () => {
    const [events, setEvents] = useState([]);

    useEffect(() => {
        axios
            .get('/api/getAllBookings')
            .then((response) => {
                const eventData = response.data.bookings.map(booking => ({
                    title: `Booking ${booking.id}`, // You can customize this title
                    start: moment(booking.time_in, "YYYY-MM-DD h:mm A").format("YYYY-MM-DDTHH:mm:ss.SSSZ"),
                    end: moment(booking.time_out, "YYYY-MM-DD h:mm A").format("YYYY-MM-DDTHH:mm:ss.SSSZ"),
                }));
                // console.log(eventData)
                setEvents(eventData);
            })
    }, [])

    return (
        <Fragment>
            <Card variant="outlined">
                <CardContent>
                    <FullCalendar
                        plugins={[timeGridPlugin]}
                        initialView="timeGridWeek"
                        events={events}
                    />
                </CardContent>
            </Card>

        </Fragment>

    );
};

export default DashboardCalendar;

if (document.getElementById("dashboard-calendar")) {
    // const element = document.getElementById('dashboard-calendar')
    ReactDOM.render(<DashboardCalendar />, document.getElementById("dashboard-calendar"));
}
