import React, { useEffect, useState, Fragment } from "react";
import ReactDOM from "react-dom";
import moment from "moment";
import axios from "axios";
import FullCalendar from "@fullcalendar/react";
import timeGridPlugin from '@fullcalendar/timegrid';
import dayGridPlugin from '@fullcalendar/daygrid'

import { Card, CardContent, FormControl, FormControlLabel, Grid, InputAdornment, Radio, RadioGroup, TextField, Typography } from "@mui/material";

const Schedule = (props) => {
    const [events, setEvents] = useState([]);

    useEffect(() => {
        // const staffId = JSON.parse(props.staffId);
        const staffId = props.staffid
        axios
            .get(`/api/getStaffSchedule/${staffId}`)
            .then((response) => {
                const data = response.data.schedule;
                const event = data.flatMap((data) => (
                    // console.log(data.services)
                    data.services.map((service) => (
                        {
                            title: service.service_name,
                            start: moment(`${data.date}`).format("YYYY-MM-DD"),
                            allDay: true
                        }
                    ))
                ))
                setEvents(event);
            })
    }, [])

    return (
        <Fragment>
            <Card variant="outlined">
                <CardContent>
                    <FullCalendar
                        plugins={[dayGridPlugin]}
                        initialView="dayGridMonth"
                        events={events}
                    />
                </CardContent>
            </Card>

        </Fragment>

    );
};

export default Schedule;

if (document.getElementById("schedule-calendar")) {
    const element = document.getElementById('schedule-calendar')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Schedule {...props} />, document.getElementById("schedule-calendar"));
}
