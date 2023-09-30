import { Grid, TextField } from "@mui/material";
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

const DateForm = ({ onDateChange, onTimeChange, onBranchChange, errors }) => {
    const [branches, setBranches] = useState([]);
    const [dateError, setDateError] = useState(null);
    const [timeError, setTimeError] = useState(null);

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

    return (
        <Fragment>
            <Grid container spacing={2}>
                <Grid item xs={6}>
                    <Item>Left</Item>
                </Grid>
                <Grid item xs={6}>
                    <LocalizationProvider dateAdapter={AdapterMoment}>
                        <DemoContainer components={["DatePicker"]}>
                            <DatePicker
                                label="Choose a date"
                                name="date"
                                className="w-full"
                                onChange={(e) => onDateChange(moment(e._d).format('YYYY-MM-DD'))}
                                minDate={moment().add(1, 'day')}
                                defaultValue={moment().add(1, 'day')}
                            />
                        </DemoContainer>

                        <DemoContainer components={["TimePicker"]}>
                            <TimePicker
                                label="Choose a time"
                                name="time"
                                className="w-full"
                                onChange={(e) => onTimeChange(e._d)}
                                minTime={moment('10:00 AM', 'h:mm A')}
                                maxTime={moment('10:00 PM', 'h:mm A')}
                                defaultValue={moment('10:00 AM', 'h:mm A')}
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
