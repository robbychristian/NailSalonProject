import { Box, Button, Card, CardActions, CardContent, Checkbox, Chip, CircularProgress, Container, Divider, FormControl, FormControlLabel, FormLabel, Grid, InputAdornment, ImageList, ImageListItem, List, ListItem, ListItemIcon, ListItemText, MenuItem, Modal, Paper, Radio, RadioGroup, Step, StepLabel, Stepper, TextField, Typography } from "@mui/material";
import { DatePicker, LocalizationProvider, TimePicker } from "@mui/x-date-pickers";
import React, { Fragment, useEffect, useState } from "react";
import ReactDOM from "react-dom";
import { ToastContainer, toast } from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';

import { AdapterMoment } from '@mui/x-date-pickers/AdapterMoment'
import { DemoContainer } from '@mui/x-date-pickers/internals/demo';
import FullCalendar from "@fullcalendar/react";
import timeGridPlugin from '@fullcalendar/timegrid';

import PaletteIcon from '@mui/icons-material/Palette';
import CheckCircleIcon from '@mui/icons-material/CheckCircle';

import moment from "moment";
import axios from "axios";

import { styled } from "@mui/material/styles";
import Alert from '@mui/material/Alert';
import AlertTitle from '@mui/material/AlertTitle';


const steps = ["Customer Details", "Pick Schedule and Branch", "Assigned Technician", "Summary Form"];
const EditBooking = (props) => {
    const [activeStep, setActiveStep] = useState(0);
    const [formValues, setFormValues] = useState({
        selectedUser: 'None',
        selectedDate: moment().add(1, 'day'),
        selectedTime: moment('11:00 AM', 'h:mm A'),
        selectedBranch: 'None',
        staffField: '',

        product1Field: '',
        product2Field: 'None',
        product3Field: '',

        addOns1: '',
        serviceType1: '',

        addOns2: '',
        serviceType2: '',

        addOns3: '',
        serviceType3: '',

        nailCustomizationId: '',

        isChecked: false,
        totalPrice: 0,

        discountId: 'None'
    });

    const handleNext = () => {
        if (activeStep == 0) {
            if (formValues.selectedUser === 'None') {
                toast.error('User is required!');
            } else {
                setActiveStep(activeStep + 1);
            }
        } else if (activeStep == 1) {
            if (moment(formValues.selectedDate).isBefore(moment().startOf('day'))) {
                toast.error('Selected date cannot be in the past.');
            } 
            // else if (moment(formValues.selectedTime, 'h:mm A').isBefore(moment('11:00 AM', 'h:mm A')) || moment(formValues.selectedTime, 'h:mm A').isAfter(moment('10:00 PM', 'h:mm A'))) {
            //     toast.error('Selected time is outside the allowed range (11:00 AM - 10:00 PM).');
            // } 
            else if (formValues.selectedBranch === 'None') {
                toast.error('Branch Field is required!');
            } else {
                setActiveStep(activeStep + 1)
            }
        } else if (activeStep == 2) {
            if (formValues.staffField == '') {
                toast.error("Choose a technician!");
            } else {
                setActiveStep(activeStep + 1);
            }
        } else if (activeStep == 3) {
            const formdata = new FormData();
            let date = moment(formValues.selectedDate).format('YYYY-MM-DD');
            let time = moment(formValues.selectedTime).format('h:mm A');
            formdata.append('booking_id', JSON.parse(props.booking).id)
            formdata.append('user_id', formValues.selectedUser);
            formdata.append('date', moment(date).format('YYYY-MM-DD h:mm A'));
            formdata.append('time_in', moment(`${date} ${time}`, 'YYYY-MM-DD h:mm A').format('YYYY-MM-DD h:mm A'));
            formdata.append('time_out', moment(`${date} ${time}`, 'YYYY-MM-DD h:mm A').add(1, 'hour').add(30, 'minutes').format('YYYY-MM-DD h:mm A'));
            formdata.append('branch', formValues.selectedBranch);
            formdata.append('staff_id', formValues.staffField);

            console.log([...formdata]);
            axios.post(`/updateBooking/${JSON.parse(props.booking).id}`, formdata)
                .then((response) => {
                    console.log(response)
                    setActiveStep(activeStep + 1);
                })
        }
    }

    const handleBack = () => {
        setActiveStep(activeStep - 1);
    }

    const handleInputChange = (e) => {
        const { name, value } = e.target || e._d || {};
        setFormValues((prevValues) => ({
            ...prevValues,
            [name]: value
        }));
        console.log(value)
    }

    const handleDateChange = (date) => {
        setFormValues((prevValues) => ({
            ...prevValues,
            selectedDate: date
        }))
    }

    const handleTimeChange = (time) => {
        setFormValues((prevValues) => ({
            ...prevValues,
            selectedTime: time
        }))
    }

    useEffect(() => {
        if (JSON.parse(props.auth).user_role == 2) {
            setActiveStep(1)
            setFormValues((prevValues) => ({
                ...prevValues,
                selectedUser: JSON.parse(props.auth).id,
                selectedDate: moment().add(1, 'days')
            }))

        } else {
            setFormValues((prevValues) => ({
                ...prevValues,
                selectedDate: moment()
            }))
            setActiveStep(1)
        }
    }, [])

    // FORM 1
    const [userList, setUserList] = useState([]);
    useEffect(() => {
        axios.get('/api/getAllUsers')
            .then((response) => {
                setUserList(response.data.users)
            })
            .catch((error) => {
                console.log(error)
            })
    }, []);

    // FORM 2
    const [events, setEvents] = useState([]);
    const [branches, setBranches] = useState([]);
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

    useEffect(() => {
        const booking = JSON.parse(props.booking)
        setFormValues((prevValues) => ({
            selectedUser: booking.user_id,
            selectedDate: moment(booking.date),
            selectedTime: moment(booking.time_in),
            selectedBranch: booking.branch.branch_address,
            staffField: '',
    
            product1Field: '',
            product2Field: 'None',
            product3Field: '',
    
            addOns1: '',
            serviceType1: props.servicetype1,
    
            addOns2: '',
            serviceType2: props.servicetype2,
    
            addOns3: '',
            serviceType3: props.servicetype3,
    
            nailCustomizationId: '',
    
            isChecked: false,
            totalPrice: 0,
    
            discountId: 'None'
        }));
    }, [])

    // TECHNICIAN FORM
    const [staff, setStaff] = useState([]);
    const [openedStaff, setOpenedStaff] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);

    const style = {
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: 800,
        height: "80%",
        bgcolor: 'background.paper',
        border: '2px solid #000',
        boxShadow: 24,
        p: 4,
    };

    const [fieldsStatus, setFieldsStatus] = useState(false);
    useEffect(() => {
        if (formValues.selectedUser === 'None' ||
            formValues.selectedDate === '' ||
            formValues.selectedTime === ''
        ) {
            setFieldsStatus(true);
        }
    }, [formValues.selectedUser, formValues.selectedDate, formValues.selectedTime])

    useEffect(() => {
        if (fieldsStatus) {
            let date = moment(formValues.selectedDate).format('YYYY-MM-DD');
            let time = moment(formValues.selectedTime).format('h:mm A');
            let time_in = moment(`${date} ${time}`, 'YYYY-MM-DD hh:mm A').format('YYYY-MM-DD hh:mm A')
            let time_out = moment(`${date} ${time}`, 'YYYY-MM-DD hh:mm A').add(1, 'hour').add(30, 'minutes').format('YYYY-MM-DD hh:mm A')

            console.log(date);
            console.log(time);
            console.log(time_in);
            console.log(time_out);
            axios.get('/api/getAvailableStaff', {
                params: {
                    date: date,
                    time_in: time_in,
                    time_out: time_out,
                    serviceType1: props.servicetype1,
                    serviceType2: props.servicetype2,
                    serviceType3: props.servicetype3,
                    userId: formValues.selectedUser
                }
            })
                .then((response) => {
                    setStaff(response.data.staff)
                    console.log(response.data.staff)
                })
        }

    }, [fieldsStatus, formValues]);

    const handleOpenModal = (staffMember) => {
        setIsModalOpen(true);
        setOpenedStaff(staffMember)
    };

    const handleCloseModal = () => {
        setIsModalOpen(false);
    }

    // SUMMARY FORM
    const [staffName, setStaffName] = useState([]);
    const [userDetails, setUserDetails] = useState([]);
    const [number, setNumber] = useState("");

    useEffect(() => {
        axios.get(`/api/getStaffName/${formValues.staffField}`)
            .then((response) => {
                setStaffName(response.data.selectedStaff.staff_name);
            })

        console.log(formValues)
    }, [formValues.staffField])

    useEffect(() => {
        axios.get(`/api/getUser/${formValues.selectedUser}`)
            .then((response) => {
                setUserDetails(response.data.selectedUser)
                setNumber(response.data.selectedUserProfile[0].contact_no);

            })
    }, [formValues.selectedUser]);

    return (
        <Fragment>
            <ToastContainer />
            <Container component="main" maxWidth="xl" sx={{ mb: 4 }}>
                <Paper variant="outlined" sx={{ p: { xs: 2, md: 3 } }}>
                    <Typography component="h1" variant="h4" align="center">
                        Booking Reservation
                    </Typography>
                    <Stepper activeStep={activeStep} sx={{ pt: 3, pb: 5 }}>
                        {steps.map((label) => (
                            <Step key={label}>
                                <StepLabel>{label}</StepLabel>
                            </Step>
                        ))}
                    </Stepper>
                    {activeStep === steps.length ? (
                        <Fragment>
                            <Typography variant="h5" gutterBottom>
                                Thank You for Booking With Us!
                            </Typography>
                            <Typography variant="subtitle1">
                                Thank you for your reservation. Payment can be done on-site or through GCash on your mobile application.
                            </Typography>
                        </Fragment>
                    ) : (
                        <Fragment>
                            {activeStep === 0 && (
                                <Fragment>
                                    <TextField
                                        select
                                        label="Choose a User"
                                        fullWidth
                                        name="selectedUser"
                                        defaultValue="None"
                                        value={formValues.selectedUser}
                                        onChange={handleInputChange}
                                    >
                                        <MenuItem value="None">-- Choose a User --</MenuItem>
                                        {userList.map((user, index) => (
                                            <MenuItem key={index} value={user.id}>
                                                {`${user.first_name} ${user.last_name} - ${user.email} - ${user.is_loyal == 1 ? 'Loyal Customer' : 'Non-Loyal Customer'}`}
                                            </MenuItem>
                                        ))}
                                    </TextField>  <Typography variant="caption" className="text-gray-500">
                                        Note: If user is not yet registered, register <a href="/users/create" className="underline"> here</a>.
                                    </Typography>
                                </Fragment>
                            )}

                            {activeStep === 1 && (
                                <Fragment>
                                    <Grid container spacing={2}>
                                        <Grid item md={6}>
                                            <FullCalendar
                                                plugins={[timeGridPlugin]}
                                                initialView="timeGridWeek"
                                                events={events}
                                            />
                                        </Grid>
                                        <Grid item md={6}>
                                            <LocalizationProvider dateAdapter={AdapterMoment}>
                                                <DemoContainer components={['DatePicker']}>
                                                    <DatePicker
                                                        label="Choose a date"
                                                        name="selectedDate"
                                                        sx={{ width: "100%", marginBottom: "1rem" }}
                                                        value={formValues.selectedDate}
                                                        minDate={JSON.parse(props.auth).user_role == 2 ? moment().add(1, 'day') : moment()}
                                                        onChange={handleDateChange}
                                                    />
                                                </DemoContainer>
                                                <DemoContainer components={["TimePicker"]}>
                                                    <TimePicker
                                                        label="Choose a time"
                                                        name="time"
                                                        sx={{ width: "100%", marginBottom: "1rem" }}
                                                        value={formValues.selectedTime}
                                                        minTime={moment('11:00 AM', 'h:mm A')}
                                                        maxTime={moment('10:00 PM', 'h:mm A')}
                                                        onChange={handleTimeChange}
                                                    />
                                                </DemoContainer>
                                            </LocalizationProvider>
                                            <TextField
                                                select
                                                label="Choose a Branch"
                                                name="selectedBranch"
                                                sx={{ marginTop: "1rem", marginBottom: "1rem" }}
                                                fullWidth
                                                value={formValues.selectedBranch}
                                                onChange={handleInputChange}
                                            >
                                                <MenuItem value="None">-- Choose a branch --</MenuItem>

                                                {branches.map((branch, index) => (
                                                    <MenuItem key={index} value={branch.branch_address}>{branch.branch_address}</MenuItem>
                                                ))}
                                            </TextField>
                                        </Grid>
                                    </Grid>
                                </Fragment>
                            )}

                            {activeStep === 2 && (
                                <Fragment>
                                    {staff.length > 0 ? (
                                        <FormControl>
                                            <RadioGroup
                                                aria-labelledby="demo-radio-buttons-group-label"
                                                name="staffField"
                                                onChange={handleInputChange}
                                            >
                                                <Grid container spacing={2}>
                                                    {staff.map((item, index) => (
                                                        <Grid item xs>
                                                            <Card sx={{ maxWidth: 345 }} key={index}>

                                                                <img src={`/NailSalonProject-main/public/img/profile_pictures/${item.id}/${item.staff_image}`} style={{ height: "300px", width: "100%" }} />
                                                                <CardContent>
                                                                    <FormControlLabel
                                                                        value={item.id}
                                                                        control={<Radio />}
                                                                        name="staffField"
                                                                        label={item.staff_name} />
                                                                    {item.services.map((data, index) => {
                                                                        return (
                                                                            <ul className="list-disc list-inside">
                                                                                <li key={index}>{data.service_name}</li>
                                                                            </ul>
                                                                        )
                                                                    })}

                                                                </CardContent>
                                                                <CardActions>
                                                                    <Button size="small" onClick={() => handleOpenModal(item.id)}>Show Work Images</Button>
                                                                </CardActions>
                                                            </Card>
                                                        </Grid>
                                                    ))}
                                                </Grid>
                                            </RadioGroup>
                                        </FormControl>
                                    ) :

                                        <Alert severity="error">
                                            <AlertTitle>Error</AlertTitle>
                                            There are no available staff at your desired schedule. Try reserving for another time and schedule. Thank you.

                                        </Alert>
                                    }

                                    {/* MODAL */}

                                    <Modal
                                        open={isModalOpen}
                                        onClose={handleCloseModal}
                                        aria-labelledby="modal-modal-title"
                                        aria-describedby="modal-modal-description"
                                    >
                                        <Box sx={style}>
                                            <Typography id="modal-modal-title" variant="h6" component="h2" className="mb-6">
                                                Work Images
                                            </Typography>
                                            {openedStaff &&
                                                staff.filter((member) => member.id === openedStaff)
                                                    .map((item, index) => {
                                                        // console.log(item);
                                                        return (
                                                            <ImageList sx={{ height: 450 }} cols={3} rowHeight={164}>

                                                                {item.work_images.map((img) => {
                                                                    return (
                                                                        <ImageListItem key={item.img}>
                                                                            <img
                                                                                srcSet={`/NailSalonProject-main/public/img/work_images/${item.id}/${img.filename}`}
                                                                                src={`/NailSalonProject-main/public/img/work_images/${item.id}/${img.filename}`}
                                                                                alt={item.filename}
                                                                                loading="lazy"
                                                                            />
                                                                        </ImageListItem>
                                                                    )
                                                                })}
                                                            </ImageList >

                                                        )
                                                    })
                                            }
                                        </Box>
                                    </Modal>
                                </Fragment >
                            )}

                            {activeStep === 3 && (
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
                                                value={userDetails.first_name}
                                                InputProps={{
                                                    readOnly: true,
                                                }}
                                                variant="filled"

                                            />
                                            <TextField
                                                sx={{ mt: 1.5 }}
                                                label="Last Name"
                                                fullWidth
                                                value={userDetails.last_name}
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
                                                value={userDetails.email}
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
                                                value={moment(formValues.selectedDate).format('YYYY-MM-DD')}
                                                InputProps={{
                                                    readOnly: true,
                                                }}
                                                variant="filled"

                                            />
                                            <TextField
                                                sx={{ mt: 1.5 }}
                                                label="Time"
                                                fullWidth
                                                value={moment(formValues.selectedTime).format('h:mm A')}
                                                InputProps={{
                                                    readOnly: true,
                                                }}
                                                variant="filled"

                                            />

                                            <TextField
                                                sx={{ mt: 1.5 }}
                                                label="Branch"
                                                fullWidth
                                                value={formValues.selectedBranch}
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
                                    </Grid>
                                </Fragment >
                            )}

                            <Box
                                sx={{
                                    display: "flex",
                                    justifyContent: "flex-end",
                                }}
                            >
                                {(JSON.parse(props.auth).user_role === 1 && activeStep === 0) ||
                                    (JSON.parse(props.auth).user_role === 2 && activeStep === 1)
                                    ? null
                                    : (
                                        <Button
                                            onClick={handleBack}
                                            sx={{ mt: 3, ml: 1 }}
                                        >
                                            Back
                                        </Button>
                                    )}
                                <Button
                                    variant="contained"
                                    onClick={handleNext}
                                    sx={{ mt: 3, ml: 1 }}
                                >
                                    {activeStep === steps.length - 1
                                        ? "Place order"
                                        : "Next"}
                                </Button>
                            </Box>
                        </Fragment>
                    )}
                </Paper>
            </Container>

        </Fragment>
    );
}

export default EditBooking;

if (document.getElementById("edit-booking")) {
    const element = document.getElementById('edit-booking')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<EditBooking {...props} />, document.getElementById("edit-booking"));
}