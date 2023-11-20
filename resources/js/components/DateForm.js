import { Card, CardContent, Grid, TextField } from "@mui/material";
import React, { Fragment, useEffect, useState } from "react";
import { styled } from "@mui/material/styles";
import Paper from "@mui/material/Paper";
import { DemoContainer } from "@mui/x-date-pickers/internals/demo";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";
import { TimePicker } from "@mui/x-date-pickers";
import MenuItem from "@mui/material/MenuItem";
import axios from "axios";
import { AdapterMoment } from "@mui/x-date-pickers/AdapterMoment";
import moment from "moment";
import FullCalendar from "@fullcalendar/react";
import timeGridPlugin from '@fullcalendar/timegrid';

const DateForm = ({ onDateChange, onTimeChange, onBranchChange, errors, ...props }) => {
    const [branches, setBranches] = useState([]);
    const [dateError, setDateError] = useState(null);
    const [timeError, setTimeError] = useState(null);
    const [events, setEvents] = useState([]);

    const Item = styled(Paper)(({ theme }) => ({
        backgroundColor: "#fff",
        ...theme.typography.body2,
        padding: theme.spacing(1),
        color: theme.palette.text.secondary,
    }));

    useEffect(() => {
        axios
            .get("/api/getBranches")
            .then((response) => {
                // console.log(response.data)
                setBranches(response.data.branches);
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    useEffect(() => {
        axios
            .get('/api/getAllBookings')
            .then((response) => {
                const eventData = response.data.bookings.map(booking => ({
                    title: 'Event', // You can customize this title
                    start: moment(booking.time_in, "YYYY-MM-DD h:mm A").format("YYYY-MM-DDTHH:mm:ss.SSSZ"),
                    end: moment(booking.time_out, "YYYY-MM-DD h:mm A").format("YYYY-MM-DDTHH:mm:ss.SSSZ"),
                }));
                // console.log(eventData)
                setEvents(eventData);
            })
    }, [])

    return (
        <Fragment>
            <Grid container spacing={2}>
                <Grid item xs={6}>

                    <FullCalendar
                        plugins={[timeGridPlugin]}
                        initialView="timeGridWeek"
                        events={events}
                    />

                </Grid>
                <Grid item xs={6}>
                    <LocalizationProvider dateAdapter={AdapterMoment}>
                        <DemoContainer components={["DatePicker"]}>
                            <DatePicker
                                label="Choose a date"
                                name="date"
                                className="w-full"
                                onChange={(e) => onDateChange(moment(e._d).format('YYYY-MM-DD'))}
                                minDate={props.userRole == 2 ? moment().add(1, 'day') : moment()}
                                defaultValue={props.userRole == 2 ? moment().add(1, 'day') : moment()}
                            />
                        </DemoContainer>

                        <DemoContainer components={["TimePicker"]}>
                            <TimePicker
                                label="Choose a time"
                                name="time"
                                className="w-full"
                                onChange={(e) => onTimeChange(moment(e._d).format('h:mm A'))}
                                minTime={moment('11:00 AM', 'h:mm A')}
                                maxTime={moment('10:00 PM', 'h:mm A')}
                                defaultValue={moment('11:00 AM', 'h:mm A')}
                            />
                        </DemoContainer>
                    </LocalizationProvider>

                    <TextField
                        sx={{ mt: 1.5 }}
                        error={
                            errors.branchError !== undefined
                                ? errors.branchError
                                : false
                        }
                        select
                        label="Choose a branch"
                        defaultValue="None"
                        onChange={(e) => onBranchChange(e.target.value)}
                        fullWidth
                    >
                        <MenuItem value="None">-- Choose a branch --</MenuItem>
                        {branches.map((item, index) => (
                            <MenuItem key={index} value={item.branch_address}>
                                {item.branch_address}
                            </MenuItem>
                        ))}
                    </TextField>
                </Grid>
            </Grid>
        </Fragment>
    );
};

export default DateForm;
