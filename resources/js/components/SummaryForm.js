import { FormControl, Grid, InputAdornment, InputLabel, OutlinedInput, TextField, Typography } from "@mui/material";
import React, { useState, useEffect } from "react";
import { Fragment } from "react"
import { styled } from "@mui/material/styles";
import Paper from "@mui/material/Paper";
import Chip from '@mui/material/Chip';

const SummaryForm = (props) => {
    const [staffName, setStaffName] = useState([]);
    const [fname, setFname] = useState("");
    const [lname, setLname] = useState("");
    const [number, setNumber] = useState("");
    const [email, setEmail] = useState("");
    const [isLoyal, setIsLoyal] = useState("");

    const [addOns1, setAddOn1] = useState("");
    const [addOns2, setAddOn2] = useState("");
    const [addOns3, setAddOn3] = useState("");

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

    useEffect(() => {
        axios.get(`/api/getUser/${props.userValue}`)
            .then((response) => {
                setFname(response.data.selectedUser.first_name);
                setLname(response.data.selectedUser.last_name);
                setEmail(response.data.selectedUser.email);
                setNumber(response.data.selectedUserProfile[0].contact_no);
                setIsLoyal(response.data.selectedUser.is_loyal);
            })
    }, [props.userValue]);

    useEffect(() => {
        axios.get(`/api/getProductAddOns/${props.addOn1Value}`)
            .then((response) => {
                setAddOn1(response.data.addons.additional);
            })
    }, [props.addOn1Value]);

    useEffect(() => {
        axios.get(`/api/getProductAddOns/${props.addOn2Value}`)
            .then((response) => {
                setAddOn2(response.data.addons.additional);
            })
    }, [props.addOn2Value]);

    useEffect(() => {
        axios.get(`/api/getProductAddOns/${props.addOn3Value}`)
            .then((response) => {
                setAddOn3(response.data.addons.additional);
            })
    }, [props.addOn3Value]);

    return (
        <Fragment>
            <Grid container spacing={2}>
                <Grid item xs={6}>
                    <Typography variant="subtitle1">
                        <b>Customer Details</b>
                    </Typography>
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="First Name"
                        fullWidth
                        value={fname}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Last Name"
                        fullWidth
                        value={lname}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />

                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Contact Number"
                        fullWidth
                        value={number}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                    <TextField
                        sx={{ mt: 1.5 }}
                        label="Email"
                        fullWidth
                        value={email}
                        InputProps={{
                            readOnly: true,
                        }}
                        variant="filled"

                    />
                </Grid>
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
            </Grid>

            <Grid container spacing={2} sx={{ mt: 2 }}>
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
                    {props.addOn1Value &&

                        <TextField
                            sx={{ mt: 1.5 }}
                            label="Add Ons"
                            fullWidth
                            value={addOns1}
                            InputProps={{
                                readOnly: true,
                            }}
                            variant="filled"

                        />
                    }
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

                    {props.addOn2Value &&

                        <TextField
                            sx={{ mt: 1.5 }}
                            label="Add Ons"
                            fullWidth
                            value={addOns2}
                            InputProps={{
                                readOnly: true,
                            }}
                            variant="filled"

                        />
                    }

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

                    {props.addOn3Value &&

                        <TextField
                            sx={{ mt: 1.5 }}
                            label="Add Ons"
                            fullWidth
                            value={addOns3}
                            InputProps={{
                                readOnly: true,
                            }}
                            variant="filled"

                        />
                    }
                </Grid>
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
            </Grid>
            <Grid container spacing={2} sx={{ mt: 2 }}>

                <Grid item xs={12}>
                    <Typography variant="subtitle1">
                        <b>Payment Details</b>
                    </Typography>

                    <div className="flex justify-between mb-3">
                        <Typography variant="subtitle1">
                            Total:
                        </Typography>
                        <Typography variant="subtitle1">
                            <b>₱ {props.priceValue}</b>
                        </Typography>
                    </div>

                    <div className="flex justify-between mb-3">
                        <Typography variant="subtitle1">
                            Discount:
                        </Typography>
                        {isLoyal == 1 ? <Chip
                            color="success"
                            label="10% Discount"
                            disabled={false}
                            size="small"
                        /> :
                            <Chip
                                label="0% Discount"
                                disabled={false}
                                size="small"
                            />
                        }
                    </div>

                    <hr></hr>
                    <div className="flex justify-end mt-3">
                        <Typography variant="h4">
                            {isLoyal == 1 ? <b>₱ {Number(props.priceValue) * Number(0.9)}</b> : <b>₱ {props.priceValue}</b>}
                        </Typography>
                    </div>
                </Grid>
            </Grid>
        </Fragment >
    )
}

export default SummaryForm;