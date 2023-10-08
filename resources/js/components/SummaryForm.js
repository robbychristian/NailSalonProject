import { FormControl, Grid, InputAdornment, InputLabel, OutlinedInput, TextField, Typography } from "@mui/material";
import React, { useState, useEffect } from "react";
import { Fragment } from "react"
import { styled } from "@mui/material/styles";
import Paper from "@mui/material/Paper";

const SummaryForm = (props) => {
    const [staffName, setStaffName] = useState([]);

    const Item = styled(Paper)(({ theme }) => ({
        backgroundColor: "#fff",
        ...theme.typography.body2,
        padding: theme.spacing(1),
        color: theme.palette.text.secondary,
    }));

    useEffect(() => {
        axios.get(`/api/getStaffName/${props.technicianValue}`)
            .then((response) => {
                setStaffName(response.data.selectedStaff.staff_name);
            })
    }, [props.technicianValue]);

    return (
        <Fragment>
            <Grid container spacing={2}>
                <Grid item xs={6}>
                    <Typography variant="subtitle1">
                        <b>Booking Details</b>
                    </Typography>
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Date"
                        fullWidth
                        value={props.dateValue}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Time"
                        fullWidth
                        value={props.timeValue}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />

                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Branch"
                        fullWidth
                        value={props.branchValue}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                </Grid>
                <Grid item xs={6}>
                    <Typography variant="subtitle1">
                        <b> Service Details</b>
                    </Typography>
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Service 1"
                        fullWidth
                        value={props.service1Value}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Service 2"
                        fullWidth
                        value={props.service2Value ?? "None"}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />

                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Service 3"
                        fullWidth
                        value={props.service3Value ?? "None"}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                </Grid>
            </Grid>

            <Grid container spacing={2} sx={{ mt: 2 }}>
                <Grid item xs={6}>
                    <Typography variant="subtitle1">
                        <b> Technician Details</b>
                    </Typography>
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Technician Name"
                        fullWidth
                        value={staffName}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />

                </Grid>
                <Grid item xs={6}>
                    <Typography variant="subtitle1">
                        <b>Payment Details</b>
                    </Typography>
                    <TextField
                        sx={{ mt: 1.5 }}
                        id="input-with-icon-textfield"
                        label="Total Price"
                        InputProps={{
                            startAdornment: (
                                <InputAdornment position="start">
                                    ₱
                                </InputAdornment>
                            ),
                            readOnly: true
                        }}
                        variant="filled"
                        value={props.priceValue}
                        fullWidth
                    />
                </Grid>
            </Grid>
        </Fragment>
    )
}

export default SummaryForm;