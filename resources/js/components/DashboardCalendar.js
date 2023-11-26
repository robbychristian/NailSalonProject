import React, { useEffect, useState, Fragment } from "react";
import ReactDOM from "react-dom";
import moment from "moment";
import axios from "axios";
import FullCalendar from "@fullcalendar/react";
import timeGridPlugin from '@fullcalendar/timegrid';
import dayGridPlugin from '@fullcalendar/daygrid'
import { Card, CardContent, FormControl, FormControlLabel, Grid, InputAdornment, Radio, RadioGroup, TextField, Typography } from "@mui/material";

const DashboardCalendar = () => {
    const [events, setEvents] = useState([]);
    const [staffSchedule, setStaffSchedule] = useState([]);
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

        // const staffId = props.staffid
        axios
            .get(`/api/getAllStaffSchedule`)
            .then((response) => {
                const data = response.data.schedule;
                const event = data.map(schedule => ({
                    title: `${schedule.staff.staff_name}`, // You can customize this title
                    start: moment(schedule.date).format("YYYY-MM-DD"),
                    allDay: true
                }));
                setStaffSchedule(event);
            })
    }, [])

    return (
        <Fragment>
            <Card variant="outlined">
                <CardContent>
                    <Typography variant="h5" sx={{ marginBotton: "5rem" }}>Bookings</Typography>

                    <FullCalendar
                        plugins={[timeGridPlugin]}
                        initialView="timeGridWeek"
                        events={events}
                    />
                </CardContent>
            </Card>

            <Card variant="outlined">
                <CardContent>
                    <Typography variant="h5" sx={{ marginBotton: "5rem" }}>Staff Schedule</Typography>
                    <FullCalendar
                        plugins={[dayGridPlugin]}
                        initialView="dayGridMonth"
                        events={staffSchedule}
                    />

                </CardContent>
            </Card>
        </Fragment >

    );
};

export default DashboardCalendar;

if (document.getElementById("dashboard-calendar")) {
    // const element = document.getElementById('dashboard-calendar')
    ReactDOM.render(<DashboardCalendar />, document.getElementById("dashboard-calendar"));
}
