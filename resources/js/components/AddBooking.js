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


const steps = ["Customer Details", "Pick Schedule and Branch", "Choose Services", "Assigned Technician", "Summary Form"];
const AddBooking = (props) => {
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
        totalPrice: 0
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
            } else if (moment(formValues.selectedTime, 'h:mm A').isBefore(moment('11:00 AM', 'h:mm A')) || moment(formValues.selectedTime, 'h:mm A').isAfter(moment('10:00 PM', 'h:mm A'))) {
                toast.error('Selected time is outside the allowed range (11:00 AM - 10:00 PM).');
            } else if (formValues.selectedBranch === 'None') {
                toast.error('Branch Field is required!');
            } else {
                setActiveStep(activeStep + 1)
            }
        } else if (activeStep == 2) {
            if (formValues.product1Field == '') {
                toast.error('Choose atleast 1 service!');
            } else if (formValues.product1Field == formValues.product2Field || formValues.product1Field == formValues.product3Field) {
                toast.error("Same service has been selected! Choose different service!");
            } else if (formValues.product2Field == formValues.product1Field || formValues.product2Field == formValues.product3Field) {
                toast.error("Same service has been selected! Choose different service!");
            } else if (formValues.product3Field == formValues.product1field || formValues.product3Field == formValues.product2Field) {
                toast.error("Same service has been selected! Choose different service!");
            } else {
                toast.success('Services selected successfully! Proceed to the next step.');
                setActiveStep(activeStep + 1);
            }
        } else if (activeStep == 3) {
            if (formValues.staffField == '') {
                toast.error("Choose a technician!");
            } else {
                setActiveStep(activeStep + 1);
            }
        } else if (activeStep == 4) {
            const formdata = new FormData();
            let date = moment(formValues.selectedDate).format('YYYY-MM-DD');
            let time = moment(formValues.selectedTime).format('h:mm A');
            formdata.append('user_id', formValues.selectedUser);
            formdata.append('date', moment(date).format('YYYY-MM-DD h:mm A'));
            formdata.append('time_in', moment(`${date} ${time}`, 'YYYY-MM-DD h:mm A').format('YYYY-MM-DD h:mm A'));
            formdata.append('time_out', moment(`${date} ${time}`, 'YYYY-MM-DD h:mm A').add(1, 'hour').add(30, 'minutes').format('YYYY-MM-DD h:mm A'));
            formdata.append('branch', formValues.selectedBranch);
            formdata.append('staff_id', formValues.staffField);

            formdata.append('service1', formValues.product1Field);
            formdata.append('addon1', formValues.addOns1);
            formdata.append('service2', formValues.product2Field);
            formdata.append('addon2', formValues.addOns2);
            formdata.append('service3', formValues.product3Field);
            formdata.append('addon3', formValues.addOns3);

            formdata.append('total_price', formValues.totalPrice);
            formdata.append('nail_customization_id', formValues.nailCustomizationId)

            console.log([...formdata]);
            axios.post('/booking', formdata)
                .then((response) => {
                    console.log(response)
                    setActiveStep(activeStep + 1);
                })
        }
        // setActiveStep(activeStep + 1);

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
            //   setSelectedUser()
            //   setSelectedDate(moment().add(1, 'days').format('YYYY-MM-DD'))
        } else {
            setFormValues((prevValues) => ({
                ...prevValues,
                selectedDate: moment()
            }))
            //   setSelectedDate()
            setActiveStep(0)
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

    //FORM 3
    const [servicesMenu, setServicesMenu] = useState([]);
    const [productsMenu, setProductsMenu] = useState([]);
    const [productAddOnsMenu, setProductAddOnsMenu] = useState([]);
    const [packagesMenu, setPackagesMenu] = useState([]);

    const [products, setProducts] = useState([]);
    const [addOns, setAddOns] = useState([]);
    const [packages, setPackages] = useState([]);

    useEffect(() => {
        axios
            .get('/api/getAllServices')
            .then((response) => {
                setServicesMenu(response.data.services);
                setProductsMenu(response.data.products);
                setProductAddOnsMenu(response.data.product_add_ons);
                setPackagesMenu(response.data.packages);
            })
            .catch((error) => {
                console.log(error);
            });

        axios
            .get('/api/getProductsAndPackages')
            .then((response) => {
                setProducts(response.data.products);
                setPackages(response.data.packages);
                setAddOns(response.data.addons);
            })
            .catch((error) => {
                console.log(error);
            })

    }, []);

    const addonsMap = {};
    for (const addon of addOns) {
        addonsMap[addon.product_id] = true;
    }

    // PRODUCT 1 FIELD
    const [product1Price, setProduct1Price] = useState(0);
    const [hasAddOns1, setHasAddOns1] = useState("");
    const [product1Details, setProduct1Details] = useState(null);
    const [addons1Price, setAddOns1Price] = useState(0);
    const handleProduct1Field = (e) => {
        const { name, value } = e.target || e._d || {};

        // PRICE
        const selectedProduct = products.find((item) => item.product_name === e.target.value);
        const selectedPackage = packages.find((data) => data.package_name === e.target.value);
        const selectedPrice = selectedProduct ? selectedProduct.price : (selectedPackage ? selectedPackage.price : "");
        setProduct1Price(selectedPrice)

        // SERVICE TYPE
        const productServiceType = selectedProduct ? selectedProduct.service_id : (selectedPackage ? 1 : "");

        // ADDONS
        const hasAddons = selectedProduct ? selectedProduct.id in addonsMap : false;
        setHasAddOns1(hasAddons);
        setProduct1Details(selectedProduct);

        setFormValues((prevValues) => ({
            ...prevValues,
            [name]: value,
            serviceType1: productServiceType,
            addOns1: ''
        }));
    }
    const handleAddOns1 = (e) => {
        const { name, value } = e.target || e._d || {};
        setFormValues((prevValues) => ({
            ...prevValues,
            addOns1: value
        }));

        const addonId = e.target.value;
        if (addonId != "") {
            const selectedAddOn1 = addOns.find((item) => item.id == addonId);
            const addonPrice1 = selectedAddOn1.additional_price
            setAddOns1Price(addonPrice1);
            console.log(`eto yung addon1 ${addonPrice1}`)
        } else {
            setAddOns1Price(0);
        }
    }

    // PRODUCT 2 FIELD
    const [product2Price, setProduct2Price] = useState(0);
    const [hasAddOns2, setHasAddOns2] = useState("");
    const [product2Details, setProduct2Details] = useState(null);
    const [addons2Price, setAddOns2Price] = useState(0);
    const handleProduct2Field = (e) => {
        const { name, value } = e.target || e._d || {};

        // PRICE
        const selectedProduct = products.find((item) => item.product_name === e.target.value);
        const selectedPackage = packages.find((data) => data.package_name === e.target.value);
        const selectedPrice = selectedProduct ? selectedProduct.price : (selectedPackage ? selectedPackage.price : "");
        setProduct2Price(selectedPrice)

        // SERVICE TYPE
        const productServiceType = selectedProduct ? selectedProduct.service_id : (selectedPackage ? 1 : "");

        // ADDONS
        const hasAddons = selectedProduct ? selectedProduct.id in addonsMap : false;
        setHasAddOns2(hasAddons);
        setProduct2Details(selectedProduct);

        setFormValues((prevValues) => ({
            ...prevValues,
            [name]: value,
            serviceType2: productServiceType,
            addOns2: ''
        }));
    }
    const handleAddOns2 = (e) => {
        const { name, value } = e.target || e._d || {};
        setFormValues((prevValues) => ({
            ...prevValues,
            addOns2: value
        }));

        const addonId = e.target.value;
        if (addonId != "") {
            const selectedAddOn2 = addOns.find((item) => item.id == addonId);
            const addonPrice2 = selectedAddOn2.additional_price
            setAddOns2Price(addonPrice2);
            console.log(`eto yung addon2 ${addonPrice2}`)
        } else {
            setAddOns2Price(0);
        }

    }

    // PRODUCT 3 FIELD
    const [product3Price, setProduct3Price] = useState(0);
    const [hasAddOns3, setHasAddOns3] = useState("");
    const [product3Details, setProduct3Details] = useState(null);
    const [addons3Price, setAddOns3Price] = useState(0);
    const handleProduct3Field = (e) => {
        const { name, value } = e.target || e._d || {};

        // PRICE
        const selectedProduct = products.find((item) => item.product_name === e.target.value);
        const selectedPackage = packages.find((data) => data.package_name === e.target.value);
        const selectedPrice = selectedProduct ? selectedProduct.price : (selectedPackage ? selectedPackage.price : "");
        setProduct3Price(selectedPrice)

        // SERVICE TYPE
        const productServiceType = selectedProduct ? selectedProduct.service_id : (selectedPackage ? 1 : "");

        // ADDONS
        const hasAddons = selectedProduct ? selectedProduct.id in addonsMap : false;
        setHasAddOns3(hasAddons);
        setProduct3Details(selectedProduct);

        setFormValues((prevValues) => ({
            ...prevValues,
            [name]: value,
            serviceType3: productServiceType,
            addOns3: ''
        }));
    }
    const handleAddOns3 = (e) => {
        const { name, value } = e.target || e._d || {};
        setFormValues((prevValues) => ({
            ...prevValues,
            addOns3: value
        }));

        const addonId = e.target.value;
        if (addonId != "") {
            const selectedAddOn3 = addOns.find((item) => item.id == addonId);
            const addonPrice3 = selectedAddOn3.additional_price
            setAddOns3Price(addonPrice3);
            console.log(`eto yung addon3 ${addonPrice3}`)
        } else {
            setAddOns3Price(0);
        }

    }

    // NAIL CUSTOMIZATION
    const [isDisabled, setIsDisabled] = useState(false)
    const [isChecked, setIsChecked] = useState(false);
    const [loading, setLoading] = useState(false);
    const [customizationValue, setCustomizationValue] = useState([]);
    const [colorNail, setColorNail] = useState(null);
    const [skinColor, setSkinColor] = useState(null);
    const handleCheckBox = () => {
        // console.log(isChecked);
        const tempIsChecked = !isChecked
        setLoading(true)

        if (tempIsChecked) {
            console.log('checked')

            axios.get(`/api/getNailCustomizationPerUser/${formValues.selectedUser}`)
                .then((response) => {
                    const customization = response.data.user.nail_customization

                    if (customization != null) {
                        setLoading(false)
                        setCustomizationValue(customization)
                        setIsChecked(tempIsChecked)

                        setFormValues((prevValues) => ({
                            ...prevValues,
                            isChecked: tempIsChecked
                        }));
                    } else {
                        setLoading(false)
                        toast.error("You haven't edited or saved a customization. Make sure to create a customization first.");
                    }
                })
        } else {
            setCustomizationValue(null);
            setLoading(false)
            setIsChecked(tempIsChecked)
            console.log('not checked')

            setFormValues((prevValues) => ({
                ...prevValues,
                isChecked: tempIsChecked
            }));
        }
    }

    useEffect(() => {
        if (isChecked) {
            setColorNail(customizationValue.color)
            setSkinColor(customizationValue.skin)
            setIsDisabled(true);

            const serviceType = products.find((item) => item.product_name == customizationValue.service_type)
            setProduct1Price(serviceType.price)

            const nailPolishBrand = products.find((item) => item.product_name == customizationValue.nail_polish_brand)
            setProduct2Price(nailPolishBrand.price)

            setHasAddOns1("");
            setAddOns1Price(0);
            setHasAddOns2("");
            setAddOns2Price(0);

            setFormValues((prevValues) => ({
                ...prevValues,
                product1Field: serviceType.product_name,
                serviceType1: serviceType.service_id,
                product2Field: nailPolishBrand.product_name,
                serviceType2: nailPolishBrand.service_id,
                nailCustomizationId: customizationValue.id
            }));
        } else {
            setIsDisabled(false);
            setProduct1Price(0);
            setProduct2Price(0);
            setProduct3Price(0);

            setFormValues((prevValues) => ({
                ...prevValues,
                product1Field: '',
                serviceType1: '',
                product2Field: 'None',
                serviceType2: '',
                product3Field: '',
                addOns3: '',
                serviceType3: '',
                nailCustomizationId: ''
            }));
        }
    }, [isChecked])

    //TOTAL PRICE 
    useEffect(() => {
        const price1 = parseFloat(product1Price) || 0;
        const addonPrice1 = parseFloat(addons1Price) || 0;
        if (!hasAddOns1 || !product1Details) {
            setAddOns1Price(0)
        }

        const price2 = parseFloat(product2Price) || 0;
        const addonPrice2 = parseFloat(addons2Price) || 0;
        if (!hasAddOns2 || !product2Details) {
            setAddOns2Price(0)
        }

        const price3 = parseFloat(product3Price) || 0;
        const addonPrice3 = parseFloat(addons3Price) || 0;
        if (!hasAddOns3 || !product3Details) {
            setAddOns3Price(0)
        }

        const newTotalPrice = price1 + addonPrice1 + price2 + addonPrice2 + price3 + addonPrice3
        console.log(newTotalPrice)

        setFormValues((prevValues) => ({
            ...prevValues,
            totalPrice: newTotalPrice
        }))

    }, [product1Price, addons1Price, product2Price, addons2Price, product3Price, addons3Price])

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
            formValues.selectedTime === '' ||
            formValues.serviceType1 === '' ||
            formValues.serviceType2 === '' ||
            formValues.serviceType3 === ''
        ) {
            setFieldsStatus(true);
        }
    }, [formValues.selectedUser, formValues.selectedDate, formValues.selectedTime, formValues.serviceType1, formValues.serviceType2, formValues.serviceType3])

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
                    serviceType1: formValues.serviceType1,
                    serviceType2: formValues.serviceType2,
                    serviceType3: formValues.serviceType3,
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

    const [discounts, setDiscounts] = useState([]);
    const [filteredDiscounts, setFilteredDiscounts] = useState([]);
    useEffect(() => {
        axios.get('/api/getApplicableDiscounts')
            .then((response) => {
                setDiscounts(response.data.discounts);
            })
    }, [])

    useEffect(() => {
        const products = [formValues.product1Field, formValues.product2Field, formValues.product3Field];
        const filteredProducts = products.filter(product => product !== '' && product !== null && product !== undefined);

        // console.log(filteredProducts);
        console.log(`eto yung products ${filteredProducts}`);
        const filtered = discounts.filter((discount) => {
            if (discount.product && filteredProducts.includes(discount.product.product_name)) {
                return true
            } else {
                return false
            }
        })
        console.log(`eto yung filtered list ${JSON.stringify(filtered)}`)
        setFilteredDiscounts(filtered)
    }, [formValues.product1Field, formValues.product2Field, formValues.product3Field])


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
                                            {/* <FormControl>
                                                <FormLabel>Radio Button</FormLabel>
                                                <RadioGroup
                                                    name="staffField"
                                                    value={formValues.staffField}
                                                    onChange={handleInputChange}
                                                >
                                                    <FormControlLabel value="Radio 1" control={<Radio />} label="Radio 1" />
                                                    <FormControlLabel value="Radio 2" control={<Radio />} label="Radio 2" />
                                                </RadioGroup>
                                            </FormControl> */}
                                        </Grid>
                                    </Grid>
                                </Fragment>
                            )}

                            {activeStep === 2 && (
                                <Fragment>
                                    <Grid container spacing={2}>
                                        <Grid item md={6}>
                                            <Card variant="outlined">
                                                <CardContent>
                                                    <div className="grid grid-cols-2 gap-4 mb-3">
                                                        {servicesMenu.map((service) => (
                                                            <div className="text-sm">
                                                                <div className="mb-2">
                                                                    <Typography variant="subtitle1">
                                                                        {service.service_name}
                                                                    </Typography>
                                                                    {productsMenu.filter((product) => product.service_id == service.id)
                                                                        .map((product) => (
                                                                            <div>
                                                                                <div className="flex justify-between mb-1   " key={product.id}>
                                                                                    <p>{product.product_name}</p>
                                                                                    <p>{product.price}</p>
                                                                                </div>

                                                                                {productAddOnsMenu.filter((addons) => addons.product_id == product.id)
                                                                                    .map((addons) => (
                                                                                        <div className="flex justify-between">
                                                                                            <p className="italic text-sm">{addons.additional}</p>
                                                                                            <p className="italic text-sm">{addons.additional_price}</p>
                                                                                        </div>
                                                                                    ))
                                                                                }
                                                                            </div>
                                                                        ))}
                                                                </div>
                                                            </div>
                                                        ))}

                                                    </div>
                                                    <hr></hr>
                                                    <div className="grid grid-cols-2 gap-4 mt-3">
                                                        {packagesMenu.map((packages) => (
                                                            <div className="text-sm">
                                                                <div className="flex justify-between">
                                                                    <Typography variant="subtitle1">
                                                                        {packages.package_name}
                                                                    </Typography>
                                                                    <Typography variant="subtitle1">
                                                                        {packages.price}
                                                                    </Typography>
                                                                </div>

                                                                <div>
                                                                    {packages.products.map((products) => (
                                                                        <ul className="list-disc list-inside">
                                                                            <li>{products.product_name}</li>
                                                                        </ul>
                                                                    ))}
                                                                </div>
                                                            </div>
                                                        ))}
                                                    </div>
                                                </CardContent>
                                            </Card>
                                        </Grid>
                                        <Grid item md={6}>
                                            <TextField
                                                select
                                                label="Choose a Service"
                                                name="product1Field"
                                                fullWidth
                                                disabled={isDisabled}
                                                value={customizationValue ? customizationValue.length !== 0 ? products.find((item) => item.product_name == customizationValue.service_type).product_name
                                                    : formValues.product1Field : formValues.product1Field}
                                                // value={formValues.product1Field}
                                                onChange={handleProduct1Field}
                                            >
                                                {products.map((item, index) => (
                                                    <MenuItem key={index} value={item.product_name}>{item.product_name} - ₱{item.price}</MenuItem>
                                                ))}
                                                {packages.map((data, index1) => (
                                                    <MenuItem key={index1} value={data.package_name}>{data.package_name} - ₱{data.price}</MenuItem>
                                                ))}
                                            </TextField>
                                            {hasAddOns1 && formValues.product1Field && (
                                                <FormControl>
                                                    <RadioGroup
                                                        row
                                                        aria-label="addons"
                                                        name="addOns1"
                                                        value={formValues.addOns1}
                                                        onChange={handleAddOns1}
                                                    >
                                                        {addOns
                                                            .filter((addon) => addon.product_id === product1Details.id)
                                                            .map((addon, index) => (
                                                                <FormControlLabel
                                                                    name="productAddOns"
                                                                    key={index}
                                                                    value={addon.id}
                                                                    control={<Radio />}
                                                                    label={`${addon.additional} - ₱${addon.additional_price}`}
                                                                />
                                                            ))}
                                                        <FormControlLabel
                                                            name="productAddOns"
                                                            value=""
                                                            control={<Radio />}
                                                            label='None'
                                                        />

                                                    </RadioGroup>
                                                </FormControl>
                                            )}
                                            <TextField
                                                select
                                                label="Choose a Service"
                                                name="product2Field"
                                                sx={{ mt: 1.5 }}
                                                fullWidth
                                                disabled={isDisabled}
                                                value={customizationValue ? customizationValue.length !== 0 ? products.find((item) => item.product_name == customizationValue.nail_polish_brand).product_name
                                                    : formValues.product2Field : formValues.product2Field}
                                                // value={formValues.product2Field}
                                                onChange={handleProduct2Field}
                                            >
                                                <MenuItem value="None">--None--</MenuItem>
                                                {products.map((item, index) => (
                                                    <MenuItem key={index} value={item.product_name}>{item.product_name} - ₱{item.price}</MenuItem>
                                                ))}
                                                {packages.map((data, index1) => (
                                                    <MenuItem key={index1} value={data.package_name}>{data.package_name} - ₱{data.price}</MenuItem>
                                                ))}
                                            </TextField>
                                            {hasAddOns2 && formValues.product2Field && (
                                                <FormControl>
                                                    <RadioGroup
                                                        row
                                                        aria-label="addons"
                                                        name="addOns2"
                                                        value={formValues.addOns2}
                                                        onChange={handleAddOns2}
                                                    >
                                                        {addOns
                                                            .filter((addon) => addon.product_id === product2Details.id)
                                                            .map((addon, index) => (
                                                                <FormControlLabel
                                                                    name="productAddOns"
                                                                    key={index}
                                                                    value={addon.id}
                                                                    control={<Radio />}
                                                                    label={`${addon.additional} - ₱${addon.additional_price}`}
                                                                />
                                                            ))}
                                                        <FormControlLabel
                                                            name="productAddOns"
                                                            value=""
                                                            control={<Radio />}
                                                            label='None'
                                                        />

                                                    </RadioGroup>
                                                </FormControl>
                                            )}
                                            <TextField
                                                sx={{ mt: 1.5 }}

                                                select
                                                label="Choose a Service"
                                                name="product3Field"
                                                fullWidth
                                                value={formValues.product3Field}
                                                onChange={handleProduct3Field}
                                            >
                                                <MenuItem value="None">-- None --</MenuItem>
                                                {products.map((item, index) => (
                                                    <MenuItem key={index} value={item.product_name}>{item.product_name} - ₱{item.price}</MenuItem>
                                                ))}
                                                {packages.map((data, index1) => (
                                                    <MenuItem key={index1} value={data.package_name}>{data.package_name} - ₱{data.price}</MenuItem>
                                                ))}
                                            </TextField>
                                            {hasAddOns3 && formValues.product3Field && (
                                                <FormControl>
                                                    <RadioGroup
                                                        row
                                                        aria-label="addons"
                                                        name="addOns3"
                                                        value={formValues.addOns3}
                                                        onChange={handleAddOns3}
                                                    >
                                                        {addOns
                                                            .filter((addon) => addon.product_id === product3Details.id)
                                                            .map((addon, index) => (
                                                                <FormControlLabel
                                                                    name="productAddOns"
                                                                    key={index}
                                                                    value={addon.id}
                                                                    control={<Radio />}
                                                                    label={`${addon.additional} - ₱${addon.additional_price}`}
                                                                />
                                                            ))}
                                                        <FormControlLabel
                                                            name="productAddOns"
                                                            value=""
                                                            control={<Radio />}
                                                            label='None'
                                                        />

                                                    </RadioGroup>
                                                </FormControl>
                                            )}

                                            <TextField
                                                sx={{ mt: 1.5 }}
                                                name="totalPrice"
                                                label="Total Price"
                                                InputProps={{
                                                    startAdornment: (
                                                        <InputAdornment position="start">
                                                            ₱
                                                        </InputAdornment>
                                                    ),
                                                    readOnly: true
                                                }}
                                                variant="standard"
                                                fullWidth
                                                value={formValues.totalPrice}
                                            />

                                            <Divider sx={{ marginTop: "2rem" }}>
                                                <Chip icon={<PaletteIcon style={{ color: "#fff" }} />} label="Nail Customization" sx={{ backgroundColor: "#F8C5C5", color: "#fff" }} />
                                            </Divider>
                                            <FormControlLabel control={
                                                loading ? (
                                                    <CircularProgress />
                                                ) : (
                                                    <Checkbox
                                                        label="I want to booked my personalized / customized nails."
                                                        color="secondary"
                                                        sx={{
                                                            color: "#f8c5c5",
                                                            '&.Mui-checked': {
                                                                color: "#f8c5c5",
                                                            },
                                                        }}
                                                        checked={formValues.isChecked}
                                                        onChange={handleCheckBox}
                                                    />
                                                )
                                            }
                                                label="I want to book my personalized or customized nails."
                                            />

                                            {customizationValue && <Fragment>
                                                <div className="flex justify-center items-center mb-5">
                                                    {customizationValue.service_type == 'Manicure' &&
                                                        <svg height="300px" width="300px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                            xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496.158 496.158" space="preserve" fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" strokeWidth="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" strokeLinecap="round" strokeLinejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path style={{ fill: "#F9E2E1" }}
                                                                    d="M248.082,0.003C111.07,0.003,0,111.063,0,248.085c0,137.001,111.07,248.07,248.082,248.07 c137.006,0,248.076-111.069,248.076-248.07C496.158,111.062,385.088,0.003,248.082,0.003z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M329.289,233.257c-7.666-3.286-16.839,0.987-20.505,9.55l-45.263,107.684 c-3.318,7.762-0.395,16.479,6.557,19.458c6.943,2.973,15.274-0.911,18.6-8.682l48.927-105.637 C341.275,247.077,336.936,236.539,329.289,233.257z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M361.949,246.566c-8.007-3.29-18.065-0.056-21.606,8.563l-50.622,129.43 c-3.211,7.805,0.072,16.571,7.34,19.555c7.258,2.981,15.749-0.941,18.961-8.753l55.377-126.818 C374.93,259.926,369.958,249.857,361.949,246.566z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M394.111,260.418c-7.733-3.069-17.758,0.93-21.178,9.598l-41.261,107.071 c-3.432,8.651,0.071,18.157,7.81,21.225c7.745,3.072,16.795-1.461,20.229-10.115l44.161-105.917 C407.298,273.614,401.853,263.488,394.111,260.418z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M427.094,270.205c-7.323-2.779-17.57,1.292-20.874,9.984l-20.478,62.648 c-2.868,7.554-0.039,15.63,6.314,18.05c6.354,2.411,13.834-1.755,16.702-9.307l20.976-61.091 C433.046,281.784,434.411,272.987,427.094,270.205z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M351.273,148.413c0,0-29.284,18.644-44.187,27.445c-7.592,4.519-17.002,21.612-28.612,36.851 c-11.144,14.646-25.177,25.142-23.648,30.923c4.194,15.86,26.673,4.979,29.232,3.521c21.731-12.433,41.892-39.138,41.892-39.138 l36.729-10.467L351.273,148.413z">
                                                                    </path>
                                                                </g>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M253.889,246.228c15.527-3.569,17.231-24.763,17.231-24.763 C247.447,241.812,253.889,246.228,253.889,246.228z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M399.131,341.175c-4.684-1.585-9.055-1.179-11.042,4.691c-0.091,0.268-0.484,2.043-0.562,2.327 c-1.623,5.86,1.069,9.948,5.54,11.461c4.343,1.472,8.758,0.226,11.167-5.267c0.19-0.426,0.666-2.353,0.81-2.777 C407.033,345.742,403.812,342.763,399.131,341.175z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M398.855,341.85c-4.479-1.593-8.687-1.267-10.684,4.345c-0.092,0.257-1.185,4.255-1.266,4.525 c-1.642,5.61-1.488,12.165,4.074,14.144c5.559,1.981,9.5-2.697,11.9-7.941c0.186-0.407,1.361-4.547,1.505-4.953 C406.382,346.355,403.333,343.445,398.855,341.85z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M399.138,341.989c-4.476-1.593-8.684-1.268-10.681,4.345c-0.092,0.256-0.658,1.831-0.736,2.103 c-1.646,5.608,0.883,9.577,5.159,11.099c4.15,1.479,8.412,0.347,10.813-4.897c0.186-0.407,0.832-2.125,0.979-2.53 C406.67,346.495,403.615,343.584,399.138,341.989z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M348.844,374.517c-5.645-2.103-10.978-1.768-13.614,5.303c-0.116,0.325-0.665,2.471-0.77,2.813 c-2.191,7.074,0.937,12.149,6.321,14.155c5.23,1.951,10.654,0.596,13.789-6.001c0.248-0.512,0.9-2.841,1.09-3.349 C358.295,380.365,354.482,376.621,348.844,374.517z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M348.481,375.327c-5.391-2.104-10.524-1.861-13.163,4.897c-0.123,0.31-1.598,5.136-1.707,5.462 c-2.207,6.768-2.256,14.753,4.44,17.367c6.694,2.615,11.663-2.936,14.775-9.231c0.243-0.487,1.825-5.485,2.018-5.973 C357.483,381.089,353.871,377.433,348.481,375.327z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M348.822,375.507c-5.394-2.104-10.524-1.862-13.161,4.897c-0.123,0.31-0.87,2.205-0.977,2.532 c-2.21,6.768,0.726,11.692,5.871,13.701c5.002,1.953,10.233,0.731,13.345-5.565c0.244-0.489,1.095-2.556,1.285-3.043 C357.824,381.269,354.216,377.613,348.822,375.507z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M306.984,380.411c-5.49-2.475-10.838-2.496-13.936,4.386c-0.14,0.315-0.828,2.421-0.958,2.754 c-2.657,6.913,0.128,12.186,5.366,14.544c5.092,2.295,10.594,1.305,14.158-5.07c0.28-0.494,1.085-2.774,1.311-3.27 C316.025,386.874,312.471,382.884,306.984,380.411z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M306.567,381.193c-5.238-2.457-10.377-2.556-13.458,4.012c-0.145,0.3-1.937,5.018-2.066,5.336 c-2.652,6.606-3.23,14.57,3.273,17.624c6.507,3.055,11.834-2.153,15.357-8.228c0.276-0.47,2.188-5.352,2.41-5.827 C315.168,387.542,311.806,383.654,306.567,381.193z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M306.898,381.396c-5.24-2.456-10.379-2.557-13.46,4.011c-0.142,0.302-1.014,2.143-1.142,2.463 c-2.654,6.605-0.053,11.714,4.949,14.061c4.857,2.28,10.16,1.409,13.683-4.666c0.276-0.472,1.262-2.477,1.486-2.952 C315.494,387.745,312.137,383.857,306.898,381.396z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M280.089,347.055c-5.488-2.474-10.833-2.495-13.934,4.387c-0.14,0.315-0.828,2.421-0.955,2.754 c-2.657,6.912,0.125,12.185,5.365,14.544c5.093,2.294,10.593,1.304,14.159-5.071c0.28-0.495,1.085-2.774,1.308-3.27 C289.132,353.519,285.58,349.529,280.089,347.055z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M279.674,347.838c-5.238-2.456-10.377-2.556-13.458,4.012c-0.142,0.301-1.937,5.018-2.063,5.336 c-2.653,6.606-3.235,14.57,3.273,17.623c6.504,3.055,11.833-2.151,15.357-8.226c0.273-0.471,2.187-5.353,2.407-5.828 C288.274,354.186,284.914,350.299,279.674,347.838z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M280.006,348.04c-5.241-2.457-10.377-2.556-13.461,4.012c-0.139,0.301-1.014,2.143-1.141,2.462 c-2.655,6.605-0.054,11.714,4.948,14.063c4.86,2.28,10.158,1.408,13.686-4.666c0.273-0.472,1.259-2.478,1.481-2.951 C288.603,354.39,285.246,350.502,280.006,348.04z">
                                                                </path>
                                                                <path style={{ fill: "#CEA98D" }}
                                                                    d="M334.748,188.578c0,0-7.516,11.254-11.369,18.263c-3.813,6.934-11.877,29.192-11.877,29.192 s8.92-19.744,13.92-28.124c4.967-8.325,11.086-17.315,11.086-17.315L334.748,188.578z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M400.359,52.237l-20.152,54.974c-6.07,7.209-36.509,46.286-36.509,46.286l-38.531,98.764 l54.913,23.82l45.483,10.192l24.785,2.988c0,0,21.809-44.96,30.634-73.794c8.635-28.21,9.646-44.468,12.338-71.46 C456.594,107.868,431.435,76.435,400.359,52.237z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M152.46,153.496c0,0-30.438-39.076-36.509-46.286L95.799,52.238 c-31.076,24.198-56.234,55.631-72.961,91.77c2.691,26.992,3.703,43.25,12.338,71.459c8.825,28.834,30.634,73.794,30.634,73.794 l24.785-2.988l45.483-10.192l54.914-23.82L152.46,153.496z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M232.637,350.492l-45.263-107.684c-3.666-8.563-12.839-12.836-20.505-9.55 c-7.647,3.282-11.985,13.819-8.314,22.374l48.926,105.637c3.325,7.771,11.656,11.655,18.6,8.682 C233.031,366.971,235.955,358.254,232.637,350.492z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M206.437,384.558l-50.622-129.43c-3.54-8.619-13.6-11.853-21.606-8.563 c-8.009,3.291-12.98,13.36-9.449,21.976l55.378,126.818c3.211,7.812,11.702,11.735,18.96,8.753 C206.365,401.129,209.648,392.364,206.437,384.558z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M164.485,377.087l-41.261-107.071c-3.42-8.667-13.443-12.667-21.178-9.598 c-7.742,3.07-13.187,13.196-9.762,21.862l44.162,105.917c3.434,8.654,12.484,13.187,20.229,10.115 C164.414,395.244,167.918,385.738,164.485,377.087z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M110.416,342.837l-20.478-62.648c-3.304-8.692-13.551-12.763-20.874-9.984 c-7.317,2.781-5.952,11.578-2.641,20.284l20.976,61.091c2.868,7.551,10.349,11.718,16.702,9.307 C110.455,358.467,113.284,350.391,110.416,342.837z">
                                                                    </path>
                                                                    <path style={{ fill: `${skinColor}` }}
                                                                        d="M217.683,212.709c-11.61-15.239-21.021-32.333-28.611-36.851 c-14.903-8.801-44.188-27.445-44.188-27.445l-11.406,49.136l36.729,10.467c0,0,20.16,26.705,41.892,39.138 c2.561,1.457,25.038,12.339,29.232-3.521C242.86,237.851,228.827,227.354,217.683,212.709z">
                                                                    </path>
                                                                </g>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M225.039,221.465c0,0,1.703,21.194,17.23,24.763C242.269,246.228,248.711,241.812,225.039,221.465z"></path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M108.631,348.193c-0.077-0.283-0.471-2.059-0.562-2.327c-1.987-5.87-6.358-6.276-11.042-4.691 c-4.682,1.588-7.902,4.566-5.913,10.435c0.144,0.424,0.619,2.351,0.81,2.777c2.409,5.493,6.824,6.738,11.167,5.267 C107.561,358.141,110.254,354.053,108.631,348.193z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M109.252,350.719c-0.081-0.27-1.174-4.268-1.266-4.525c-1.997-5.612-6.205-5.938-10.684-4.345 c-4.477,1.595-7.526,4.506-5.529,10.119c0.144,0.405,1.318,4.546,1.504,4.953c2.4,5.244,6.342,9.922,11.9,7.941 C110.74,362.884,110.893,356.329,109.252,350.719z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M108.437,348.436c-0.078-0.272-0.645-1.846-0.736-2.103c-1.997-5.613-6.205-5.938-10.681-4.345 c-4.478,1.595-7.531,4.506-5.532,10.119c0.146,0.405,0.793,2.123,0.979,2.53c2.399,5.244,6.661,6.376,10.813,4.897 C107.555,358.014,110.084,354.044,108.437,348.436z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M161.698,382.633c-0.104-0.343-0.653-2.488-0.77-2.813c-2.637-7.071-7.97-7.406-13.614-5.303 c-5.639,2.104-9.451,5.848-6.816,12.921c0.189,0.508,0.842,2.837,1.09,3.349c3.135,6.597,8.559,7.953,13.789,6.001 C160.762,394.783,163.89,389.707,161.698,382.633z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M162.547,385.685c-0.109-0.326-1.584-5.152-1.707-5.462c-2.639-6.758-7.771-7-13.163-4.897 c-5.389,2.106-9.002,5.763-6.362,12.522c0.191,0.488,1.773,5.486,2.017,5.973c3.112,6.295,8.081,11.846,14.775,9.231 C164.803,400.439,164.755,392.454,162.547,385.685z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M161.474,382.936c-0.106-0.327-0.854-2.223-0.977-2.532c-2.636-6.759-7.768-7.001-13.161-4.897 c-5.394,2.106-9.002,5.762-6.363,12.521c0.19,0.487,1.041,2.555,1.285,3.043c3.111,6.296,8.343,7.518,13.345,5.565 C160.748,394.628,163.683,389.704,161.474,382.936z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M204.067,387.551c-0.13-0.333-0.818-2.439-0.958-2.754c-3.098-6.882-8.445-6.861-13.936-4.386 c-5.486,2.474-9.041,6.463-5.941,13.344c0.226,0.496,1.03,2.776,1.311,3.27c3.564,6.375,9.066,7.365,14.158,5.07 C203.939,399.737,206.725,394.464,204.067,387.551z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M205.115,390.541c-0.13-0.318-1.922-5.036-2.066-5.336c-3.081-6.568-8.22-6.468-13.458-4.012 c-5.237,2.46-8.601,6.349-5.517,12.917c0.223,0.475,2.134,5.357,2.41,5.827c3.524,6.075,8.851,11.282,15.357,8.228 C208.346,405.112,207.767,397.148,205.115,390.541z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M203.861,387.87c-0.128-0.32-1-2.161-1.141-2.463c-3.082-6.568-8.221-6.467-13.461-4.011 c-5.238,2.461-8.596,6.349-5.517,12.917c0.225,0.476,1.21,2.48,1.486,2.952c3.522,6.075,8.825,6.946,13.683,4.666 C203.914,399.583,206.516,394.475,203.861,387.87z">
                                                                </path>
                                                                <path style={{ fill: "#E8C7AF" }}
                                                                    d="M230.958,354.197c-0.127-0.333-0.815-2.439-0.955-2.754c-3.101-6.882-8.445-6.861-13.934-4.387 c-5.491,2.474-9.043,6.464-5.943,13.345c0.223,0.496,1.027,2.775,1.308,3.27c3.566,6.375,9.066,7.366,14.159,5.071 C230.833,366.381,233.615,361.109,230.958,354.197z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M232.006,357.186c-0.127-0.318-1.922-5.035-2.063-5.336c-3.081-6.567-8.22-6.468-13.458-4.012 c-5.24,2.461-8.601,6.348-5.517,12.917c0.221,0.475,2.134,5.357,2.407,5.828c3.524,6.075,8.854,11.281,15.357,8.226 C235.241,371.756,234.659,363.792,232.006,357.186z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M230.754,354.514c-0.127-0.319-1.001-2.161-1.141-2.462c-3.084-6.567-8.22-6.468-13.461-4.012 c-5.24,2.461-8.598,6.35-5.514,12.919c0.223,0.474,1.208,2.479,1.482,2.951c3.526,6.074,8.824,6.946,13.685,4.666 C230.808,366.228,233.409,361.12,230.754,354.514z">
                                                                </path>
                                                                <path style={{ fill: "#CEA98D" }}
                                                                    d="M172.779,206.84c-3.854-7.008-11.368-18.263-11.368-18.263l-1.761,2.016c0,0,6.12,8.99,11.087,17.315 c4.999,8.38,13.919,28.124,13.919,28.124S176.592,213.774,172.779,206.84z">
                                                                </path>
                                                                <path style={{ fill: "#FFFFFF" }}
                                                                    d="M363.969,225.062c-7.156-17.718-19.787-20.941-31.813-16.085 c-12.022,4.855-18.877,15.947-11.723,33.665c5.269,13.046,25.608,35.351,37.633,30.495 C370.09,268.282,368.869,237.198,363.969,225.062z">
                                                                </path>
                                                                <path style={{ fill: "#F4E028" }}
                                                                    d="M359.855,250.366c-3.229-7.997-8.243-7.764-13.666-5.574s-9.2,5.507-5.971,13.503 c3.227,7.991,14.389,16.755,17.656,15.435C361.283,272.354,363.082,258.356,359.855,250.366z">
                                                                </path>
                                                                <path style={{ fill: "#FFFFFF" }}
                                                                    d="M423.459,241.467c-6.387-11.286-18.279-16.631-34.91-7.223 c-12.246,6.928-31.702,30.006-25.318,41.292c6.386,11.287,37.044,6.017,48.436-0.427C428.297,265.7,429.842,252.754,423.459,241.467 z">
                                                                </path>
                                                                <path style={{ fill: "#F4E028" }}
                                                                    d="M389.783,260.057c-2.881-5.089-6.663-8.4-14.168-4.154c-7.501,4.244-14.732,16.455-12.997,19.521 c1.81,3.198,15.923,3.155,23.423-1.088C393.549,270.089,392.662,265.149,389.783,260.057z">
                                                                </path>
                                                                <path style={{ fill: "#FFFFFF" }}
                                                                    d="M414.658,291.597c-11.27-8.421-40.228-16.94-47.99-6.552c-7.761,10.39,9.406,36.332,19.892,44.164 c15.309,11.438,27.78,7.639,35.54-2.748C429.862,316.071,429.968,303.033,414.658,291.597z">
                                                                </path>
                                                                <path style={{ fill: "#F4E028" }}
                                                                    d="M389.627,288.478c-6.904-5.158-20.993-6.862-23.102-4.039c-2.198,2.943,3.522,15.846,10.427,21.004 c6.907,5.162,11.075,2.36,14.574-2.324C395.027,298.433,396.534,293.639,389.627,288.478z">
                                                                </path>
                                                                <path style={{ fill: "#FFFFFF" }}
                                                                    d="M356.851,288.622c-12.84-1.823-27.358,25.688-29.198,38.646 c-2.687,18.918,6.632,28.038,19.469,29.861c12.839,1.824,24.329-4.341,27.015-23.259 C376.113,319.939,369.691,290.446,356.851,288.622z">
                                                                </path>
                                                                <path style={{ fill: "#F4E028" }}
                                                                    d="M357.314,288.206c-3.637-0.517-12.211,10.694-13.422,19.226c-1.213,8.539,3.244,10.849,9.034,11.671 c5.79,0.823,10.721-0.155,11.933-8.693C366.071,301.877,360.805,288.701,357.314,288.206z">
                                                                </path>
                                                                <path style={{ fill: "#FFFFFF" }}
                                                                    d="M353.814,278.678c-2.769-12.668-33.616-16.679-46.401-13.884 c-18.669,4.081-23.965,15.993-21.194,28.662c2.768,12.667,12.553,21.284,31.22,17.205 C331.183,307.656,356.584,291.347,353.814,278.678z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: "#F4E028" }}
                                                                        d="M354.367,278.967c-0.785-3.59-14.281-7.712-22.701-5.873c-8.424,1.841-9.036,6.824-7.787,12.539 c1.249,5.712,3.887,9.991,12.311,8.149C344.608,291.942,355.12,282.41,354.367,278.967z">
                                                                    </path>
                                                                    <path style={{ fill: "#F4E028" }}
                                                                        d="M372.717,276.242c-2.643-6.547-10.374-9.604-17.26-6.824c-6.88,2.778-10.318,10.346-7.674,16.893 c2.645,6.548,10.373,9.607,17.253,6.828C371.922,290.359,375.362,282.79,372.717,276.242z">
                                                                    </path>
                                                                </g>
                                                                <path style={{ fill: "#E2CB23" }}
                                                                    d="M368.476,277.955c-1.625-4.024-6.628-5.801-11.172-3.967c-4.539,1.833-6.904,6.585-5.279,10.609 c1.625,4.026,6.628,5.803,11.167,3.97C367.736,286.733,370.101,281.98,368.476,277.955z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    }

                                                    {customizationValue.service_type == 'Pedicure' &&
                                                        <svg height="300px" width="300px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                            xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496.158 496.158" space="preserve" fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path style={{ fill: "#F9E2E1" }}
                                                                    d="M248.082,0.003C111.07,0.003,0,111.063,0,248.085c0,137.001,111.07,248.07,248.082,248.07 c137.006,0,248.076-111.069,248.076-248.07C496.158,111.062,385.088,0.003,248.082,0.003z">
                                                                </path>
                                                                <path style={{ fill: `${skinColor}` }}
                                                                    d="M74.532,70.834c-8.71,53.711-24.61,148.872-32.663,178.969c-5.811,21.717-9.94,26.916-10.398,38.845 c-0.27,7.013,7.34,22.94,19.729,19.728c0,0,3.211,21.105,25.693,20.188c0,0,2.293,22.023,27.069,21.564 c0,0-2.295,41.293,43.586,23.399l38.08-70.656c0,0,47.7-161.856,48.3-174.76c0.479-10.304,3.83-94.442,5.16-127.929 C175.092,2.464,117.277,28.976,74.532,70.834z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M69.246,233.745c-10.684-3.846-5.2,13.764-5.2,13.764s-17.588,50.009-12.847,60.867 c0,0-1.377-12.54,4.741-31.352C62.058,258.214,69.246,233.745,69.246,233.745z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M89.624,269.493c-2.478,7.519-4.015,16.555-4.015,16.555c-0.918,3.365-8.717,42.515-8.717,42.515 c1.835-4.128,9.787-42.668,9.787-42.668c2.294-8.106,8.106-26.458,8.106-26.458C94.15,259.628,91.383,264.154,89.624,269.493z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M113.138,325.07c-1.529,5.836-9.176,25.057-9.176,25.057c1.376-1.835,8.104-18.045,9.634-23.552 c1.53-5.505,3.059-16.364,3.059-16.364c1.553-5.364,3.365-24.262,3.635-27.146c-0.323,1.769-2.93,7.697-3.596,14.873 C115.661,309.064,114.024,321.684,113.138,325.07z M120.289,283.066c0.029-0.158,0.047-0.294,0.036-0.383 C120.325,282.683,120.312,282.826,120.289,283.066z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M154.889,269.837c0,0-0.764,49.398,2.142,54.75C157.03,324.587,175.383,298.283,154.889,269.837z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M229.674,189.087c0-21.563,3.212-50.927,3.212-60.562L153.972,268.46c0,0,9.176,23.399,7.34,40.375 c-0.175,1.612-0.312,2.932-0.416,4.005c-3.285,8.208-14.789,37.617-15.183,47.839c0,0-4.129,32.117,34.869,32.117 c0,0,44.045-9.176,49.092-51.386c0,0,0.459-33.035-7.341-51.387C222.333,290.024,229.674,210.651,229.674,189.087z">
                                                                    </path>
                                                                </g>
                                                                <path style={{ fill: `${skinColor}` }}
                                                                    d="M230.592,190.464c0-21.564,2.982-54.139,2.982-63.774l-80.291,141.542c0,0,10.782,25.005,8.946,41.98 c-0.175,1.612-0.312,2.931-0.416,4.004c-3.284,8.208-14.789,37.617-15.183,47.84c0,0-4.13,32.116,34.869,32.116 c0,0,44.045-9.176,49.092-51.387c0,0,0.458-33.033-7.341-51.386C223.251,291.4,230.592,212.028,230.592,190.464z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M182.432,345.729c-24.849-8.698-32.04,29.223-31.519,31.207c1.403,5.334,36.419,16.375,40.967,12.263 C193.4,387.822,207.279,354.428,182.432,345.729z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M182.11,346.61c-24.354-8.526-31.404,28.642-30.893,30.586c1.376,5.229,35.696,16.051,40.153,12.02 C192.863,387.867,206.466,355.136,182.11,346.61z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M182.11,346.61c-24.354-8.526-31.404,28.642-30.893,30.586 C152.594,382.426,206.466,355.136,182.11,346.61z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M182.11,346.61c-18.626-6.521-27.132,13.688-29.872,24.424c-0.087,0.342,40.972,14.345,41.072,14.076 C196.776,375.781,201.611,353.436,182.11,346.61z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M182.11,346.61c-18.626-6.521-27.132,13.688-29.872,24.424c-0.028,0.113,4.451,1.518,10.328,3.771 C163.722,375.246,201.611,353.436,182.11,346.61z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M126.587,352.694c-13.474-1.335-12.472,18.491-11.97,19.419c1.348,2.496,20.188,3.769,21.961,1.162 C137.172,372.403,140.061,354.03,126.587,352.694z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M126.533,353.174c-13.207-1.309-12.224,18.123-11.732,19.033c1.321,2.446,19.787,3.694,21.527,1.139 C136.909,372.491,139.74,354.482,126.533,353.174z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M126.533,353.174c-13.207-1.309-12.224,18.123-11.732,19.033 C116.122,374.652,139.74,354.482,126.533,353.174z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M126.533,353.174c-10.1-1.001-11.901,10.13-11.969,15.828c-0.003,0.182,22.216,2.203,22.233,2.057 C137.4,365.976,137.108,354.221,126.533,353.174z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M126.533,353.174c-10.1-1.001-11.901,10.13-11.969,15.828c-0.001,0.06,2.408,0.22,5.619,0.633 C120.813,369.716,137.108,354.221,126.533,353.174z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M94.857,321.807c-12.039,0.299-12.168,18.573-11.773,19.475c1.181,2.695,17.93,2.862,19.477,0.512 C103.137,340.92,106.898,321.51,94.857,321.807z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M94.835,322.283c-11.8,0.292-11.928,18.204-11.54,19.088c1.158,2.642,17.574,2.805,19.09,0.5 C102.949,341.014,106.636,321.991,94.835,322.283z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M94.835,322.283c-11.8,0.292,6.034,21.894,7.55,19.588 C102.949,341.014,106.636,321.991,94.835,322.283z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M94.835,322.283c-9.448,0.233-11.414,11.763-11.621,16.804c-0.007,0.146,19.822-0.169,19.846-0.347 C103.827,333.135,103.86,322.059,94.835,322.283z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M94.835,322.283c-9.448,0.233,2.627,16.688,3.192,16.656c2.882-0.164,5.023-0.14,5.032-0.199 C103.827,333.135,103.86,322.059,94.835,322.283z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M67.949,299.059c-11.266,0.108-11.646,17.199-11.29,18.049c1.066,2.537,16.729,2.932,18.211,0.755 C75.421,317.054,79.215,298.953,67.949,299.059z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M67.922,299.504c-11.042,0.106-11.417,16.857-11.067,17.689c1.046,2.488,16.397,2.875,17.85,0.74 C75.244,317.14,78.964,299.399,67.922,299.504z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M67.922,299.504c-11.042,0.106,5.33,20.564,6.782,18.43C75.244,317.14,78.964,299.399,67.922,299.504 z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M67.922,299.504c-8.842,0.083-10.844,10.841-11.11,15.552c-0.008,0.136,18.543,0.125,18.567-0.042 C76.178,309.783,76.365,299.424,67.922,299.504z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M67.922,299.504c-8.842,0.083,2.219,15.647,2.748,15.625c2.699-0.113,4.701-0.059,4.709-0.114 C76.178,309.783,76.365,299.424,67.922,299.504z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M49.254,280.478c-11.267,0.109-11.647,17.2-11.291,18.05c0.171,0.406,0.72,0.758,1.523,1.052 c-0.695-0.276-1.172-0.598-1.328-0.968c-0.068-0.165-0.107-0.967-0.042-2.136c0,0-0.001,0-0.001-0.001 c0.004-0.064,0.009-0.134,0.014-0.201c0.004-0.07,0.009-0.137,0.013-0.208c0.013-0.168,0.026-0.341,0.043-0.521 c0.004-0.042,0.009-0.086,0.013-0.129c0.016-0.158,0.032-0.319,0.053-0.485c0.008-0.072,0.018-0.146,0.026-0.22 c0.016-0.138,0.034-0.278,0.054-0.42c0.012-0.079,0.021-0.159,0.034-0.239c0.021-0.151,0.046-0.303,0.07-0.458 c0.012-0.072,0.022-0.144,0.035-0.217c0.039-0.228,0.079-0.459,0.125-0.693c0.002-0.01,0.004-0.021,0.006-0.031 c0.044-0.224,0.092-0.451,0.144-0.681c0.015-0.071,0.031-0.143,0.049-0.215c0.039-0.172,0.08-0.346,0.124-0.52 c0.021-0.081,0.042-0.162,0.063-0.244c0.047-0.179,0.097-0.359,0.147-0.54c0.02-0.069,0.038-0.136,0.06-0.205 c0.146-0.497,0.31-0.996,0.497-1.491c0.023-0.066,0.051-0.133,0.076-0.2c0.07-0.181,0.143-0.362,0.218-0.542 c0.032-0.076,0.064-0.15,0.097-0.226c0.079-0.182,0.161-0.362,0.247-0.542c0.03-0.062,0.058-0.124,0.088-0.186 c0.234-0.478,0.491-0.943,0.772-1.391c0.037-0.06,0.076-0.118,0.113-0.176c0.107-0.164,0.217-0.325,0.329-0.483 c0.048-0.065,0.095-0.13,0.143-0.195c0.116-0.157,0.237-0.31,0.361-0.46c0.043-0.053,0.086-0.106,0.13-0.158 c0.34-0.397,0.705-0.77,1.1-1.11c0.053-0.045,0.108-0.088,0.163-0.132c0.146-0.123,0.297-0.24,0.454-0.352 c0.065-0.048,0.133-0.096,0.201-0.142c0.158-0.108,0.32-0.21,0.486-0.309c0.063-0.037,0.123-0.076,0.188-0.112 c0.46-0.257,0.951-0.475,1.475-0.648c0.075-0.024,0.154-0.046,0.232-0.069c0.188-0.058,0.382-0.109,0.582-0.155 c0.093-0.021,0.187-0.041,0.281-0.059c0.2-0.04,0.406-0.071,0.614-0.098c0.09-0.011,0.178-0.024,0.269-0.034 c0.116-0.011,0.235-0.019,0.354-0.025c0.052-0.004,0.104-0.008,0.157-0.012c0.131-0.009,0.269-0.015,0.41-0.016 c0.235-0.003,0.461,0.006,0.685,0.021c0.052,0.003,0.104,0.006,0.157,0.01c0.216,0.018,0.429,0.04,0.633,0.072 c0.016,0.001,0.028,0.005,0.043,0.007c0.193,0.032,0.381,0.071,0.563,0.115c0.044,0.01,0.086,0.02,0.129,0.032 c0.19,0.05,0.374,0.104,0.552,0.167c0.021,0.008,0.04,0.017,0.061,0.023c0.162,0.059,0.318,0.124,0.471,0.193 c0.035,0.017,0.07,0.033,0.105,0.05c0.164,0.078,0.322,0.162,0.475,0.252c0.022,0.014,0.045,0.028,0.066,0.042 c0.137,0.084,0.268,0.172,0.395,0.264c0.027,0.019,0.056,0.038,0.081,0.058c0.012,0.009,0.023,0.017,0.035,0.025 c0.035-0.143,0.068-0.286,0.103-0.429C52.644,280.969,51.166,280.46,49.254,280.478z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M39.486,299.58c2.32,0.92,7.123,1.308,10.979,1.11c0-0.013,0.002-0.027,0.003-0.041 C46.635,300.839,41.902,300.467,39.486,299.58z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M38.116,296.476c-0.065,1.169-0.026,1.971,0.042,2.136c0.156,0.37,0.633,0.692,1.328,0.968 c2.416,0.887,7.148,1.259,10.981,1.069c0.08-1.279,0.219-2.65,0.409-4.094C45.439,296.588,38.145,296.561,38.116,296.476z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M48.657,280.95c0.03-0.003,0.061-0.003,0.092-0.004c0.022-0.002,0.042-0.005,0.065-0.007 C48.762,280.942,48.709,280.946,48.657,280.95z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M53.64,282.229c0.013,0.009,0.022,0.019,0.035,0.028c0,0,0-0.001,0-0.002 C53.663,282.246,53.651,282.238,53.64,282.229z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M48.303,280.975c0.078-0.008,0.161-0.008,0.241-0.014c0.038-0.003,0.075-0.009,0.113-0.011 C48.538,280.957,48.419,280.964,48.303,280.975z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M38.115,296.475C38.115,296.476,38.116,296.476,38.115,296.475c0.005-0.066,0.009-0.132,0.014-0.201 C38.124,296.341,38.119,296.411,38.115,296.475z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M44.85,282.038c0.46-0.257,0.952-0.475,1.475-0.648C45.801,281.563,45.309,281.782,44.85,282.038z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M50.388,294.585c-4.063-5.292-7.828-13.031-1.844-13.624c-0.08,0.006-0.163,0.006-0.241,0.014 c-0.091,0.01-0.179,0.023-0.269,0.034c-0.208,0.026-0.414,0.058-0.614,0.098c-0.095,0.019-0.188,0.038-0.281,0.059 c-0.199,0.045-0.394,0.097-0.582,0.155c-0.078,0.023-0.157,0.045-0.232,0.069c-0.522,0.173-1.015,0.391-1.475,0.648 c-0.064,0.036-0.125,0.075-0.188,0.112c-0.166,0.098-0.328,0.2-0.486,0.309c-0.068,0.046-0.136,0.094-0.201,0.142 c-0.157,0.112-0.308,0.229-0.454,0.352c-0.055,0.044-0.11,0.088-0.163,0.132c-0.395,0.34-0.76,0.712-1.1,1.11 c-0.044,0.052-0.087,0.105-0.13,0.158c-0.124,0.15-0.245,0.304-0.361,0.46c-0.048,0.065-0.095,0.13-0.143,0.195 c-0.112,0.158-0.222,0.32-0.329,0.483c-0.037,0.058-0.076,0.116-0.113,0.176c-0.281,0.448-0.538,0.914-0.772,1.391 c-0.03,0.063-0.058,0.125-0.088,0.186c-0.086,0.179-0.168,0.36-0.247,0.542c-0.032,0.076-0.064,0.15-0.097,0.226 c-0.075,0.179-0.147,0.361-0.218,0.542c-0.025,0.067-0.053,0.134-0.076,0.2c-0.188,0.495-0.352,0.995-0.497,1.491 c-0.021,0.069-0.04,0.136-0.06,0.205c-0.051,0.18-0.101,0.36-0.147,0.54c-0.021,0.082-0.042,0.163-0.063,0.244 c-0.044,0.174-0.085,0.347-0.124,0.52c-0.017,0.072-0.034,0.145-0.049,0.215c-0.052,0.229-0.1,0.457-0.144,0.681 c-0.002,0.01-0.004,0.021-0.006,0.031c-0.046,0.234-0.086,0.466-0.125,0.693c-0.013,0.073-0.023,0.146-0.035,0.217 c-0.024,0.155-0.05,0.308-0.07,0.458c-0.013,0.08-0.022,0.16-0.034,0.239c-0.02,0.143-0.038,0.282-0.054,0.42 c-0.009,0.074-0.019,0.147-0.026,0.22c-0.021,0.166-0.037,0.327-0.053,0.485c-0.004,0.043-0.009,0.087-0.013,0.129 c-0.017,0.181-0.03,0.354-0.043,0.521c-0.004,0.071-0.009,0.139-0.013,0.208c-0.005,0.069-0.009,0.135-0.013,0.202 c0.029,0.085,7.323,0.112,12.761,0.079c0.046-0.355,0.096-0.716,0.148-1.079C50.832,295.217,50.617,294.918,50.388,294.585z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M48.657,280.95c-0.038,0.002-0.075,0.008-0.113,0.011c0.03-0.001,0.064-0.003,0.096-0.005 c0.037-0.003,0.072-0.008,0.109-0.01C48.718,280.947,48.687,280.947,48.657,280.95z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M48.64,280.956c-0.031,0.002-0.065,0.004-0.096,0.005c-5.984,0.593-2.22,8.331,1.844,13.624 C47.59,290.529,42.665,281.552,48.64,280.956z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M48.814,280.938c-0.023,0.002-0.043,0.005-0.065,0.007c0.157-0.009,0.313-0.021,0.476-0.023 C49.083,280.924,48.947,280.931,48.814,280.938z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M50.388,294.585c0.229,0.333,0.444,0.632,0.638,0.892c0.004-0.024,0.008-0.048,0.011-0.07 C50.82,295.14,50.603,294.865,50.388,294.585z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M48.749,280.946c-0.037,0.002-0.072,0.007-0.109,0.01c0.193-0.012,0.384-0.031,0.585-0.033 C49.062,280.925,48.906,280.937,48.749,280.946z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M53.64,282.229c-0.025-0.021-0.054-0.039-0.081-0.058c-0.127-0.092-0.258-0.18-0.395-0.264 c-0.021-0.014-0.044-0.028-0.066-0.042c-0.152-0.09-0.312-0.174-0.475-0.252c-0.034-0.017-0.07-0.033-0.105-0.05 c-0.152-0.069-0.309-0.134-0.471-0.193c-0.021-0.007-0.039-0.016-0.061-0.023c-0.178-0.063-0.361-0.117-0.552-0.167 c-0.043-0.012-0.085-0.021-0.129-0.032c-0.183-0.044-0.37-0.083-0.563-0.115c-0.015-0.001-0.027-0.005-0.043-0.007 c-0.204-0.033-0.417-0.055-0.633-0.072c-0.053-0.004-0.105-0.007-0.157-0.01c-0.224-0.015-0.449-0.023-0.685-0.021 c-0.201,0.002-0.392,0.021-0.585,0.033c-5.975,0.596-1.05,9.573,1.748,13.629c0.216,0.28,0.433,0.555,0.648,0.821 c0.585-4.02,1.525-8.537,2.639-13.149C53.662,282.248,53.652,282.238,53.64,282.229z">
                                                                    </path>
                                                                </g>
                                                                <path style={{ fill: `${skinColor}` }}
                                                                    d="M464.687,288.648c-0.459-11.929-4.589-17.128-10.398-38.845 c-8.053-30.097-23.953-125.259-32.663-178.97C378.881,28.975,321.065,2.462,257.07,0.182c1.33,33.486,4.68,117.625,5.16,127.929 c0.6,12.903,48.299,174.76,48.299,174.76l38.081,70.656c45.881,17.894,43.586-23.399,43.586-23.399 c24.775,0.459,27.069-21.564,27.069-21.564c22.481,0.918,25.693-20.188,25.693-20.188 C457.348,311.588,464.956,295.661,464.687,288.648z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M432.111,247.509c0,0,5.484-17.61-5.199-13.764c0,0,7.188,24.47,13.306,43.28 c6.118,18.812,4.741,31.352,4.741,31.352C449.7,297.517,432.111,247.509,432.111,247.509z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M410.549,286.048c0,0-1.538-9.037-4.016-16.555c-1.758-5.339-4.525-9.865-5.161-10.056 c0,0,5.813,18.353,8.106,26.458c0,0,7.952,38.54,9.787,42.668C419.266,328.563,411.467,289.413,410.549,286.048z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M375.867,283.064c-0.021-0.239-0.035-0.381-0.035-0.381 C375.822,282.772,375.839,282.908,375.867,283.064z M383.02,325.07c-0.887-3.386-2.524-16.006-3.556-27.131 c-0.666-7.178-3.274-13.108-3.598-14.875c0.27,2.876,2.084,21.782,3.636,27.147c0,0,1.529,10.858,3.059,16.364 s8.258,21.717,9.635,23.552C392.196,350.127,384.55,330.906,383.02,325.07z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M341.269,269.837c-20.494,28.446-2.142,54.75-2.142,54.75 C342.033,319.235,341.269,269.837,341.269,269.837z">
                                                                    </path>
                                                                    <path style={{ fill: "#D3AB8D" }}
                                                                        d="M350.445,360.68c-0.394-10.222-11.897-39.631-15.183-47.839c-0.104-1.073-0.241-2.393-0.416-4.005 c-1.836-16.976,7.34-40.375,7.34-40.375l-78.914-139.935c0,9.635,3.212,38.999,3.212,60.562c0,21.564,7.341,100.937,7.341,100.937 c-7.8,18.352-7.341,51.387-7.341,51.387c5.046,42.21,49.092,51.386,49.092,51.386C354.574,392.796,350.445,360.68,350.445,360.68z">
                                                                    </path>
                                                                </g>
                                                                <path style={{ fill: `${skinColor}` }}
                                                                    d="M349.527,362.057c-0.394-10.223-11.898-39.632-15.183-47.84c-0.104-1.073-0.241-2.393-0.416-4.004 c-1.836-16.976,8.946-41.98,8.946-41.98l-80.291-141.542c0,9.635,2.982,42.21,2.982,63.774s7.341,100.937,7.341,100.937 c-7.799,18.353-7.341,51.386-7.341,51.386c5.047,42.21,49.092,51.387,49.092,51.387 C353.656,394.173,349.527,362.057,349.527,362.057z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M313.726,345.729c-24.848,8.699-10.969,42.093-9.448,43.47c4.548,4.112,39.563-6.929,40.967-12.263 C345.767,374.952,338.575,337.031,313.726,345.729z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M314.047,346.61c-24.354,8.526-10.752,41.257-9.26,42.606c4.457,4.031,38.777-6.791,40.152-12.02 C345.451,375.252,338.401,338.084,314.047,346.61z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M314.047,346.61c-24.354,8.526,29.518,35.816,30.893,30.586 C345.451,375.252,338.401,338.084,314.047,346.61z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M314.047,346.61c-19.5,6.827-14.666,29.171-11.199,38.5c0.101,0.269,41.158-13.734,41.071-14.076 C341.179,360.298,332.674,340.089,314.047,346.61z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M314.047,346.61c-19.5,6.827,18.39,28.637,19.544,28.195c5.877-2.253,10.357-3.659,10.328-3.771 C341.179,360.298,332.674,340.089,314.047,346.61z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M369.571,352.694c-13.475,1.335-10.585,19.709-9.991,20.581c1.773,2.607,20.613,1.334,21.961-1.162 C382.043,371.185,383.045,351.359,369.571,352.694z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M369.625,353.174c-13.207,1.309-10.376,19.317-9.795,20.172c1.74,2.555,20.206,1.307,21.527-1.139 C381.849,371.296,382.832,351.865,369.625,353.174z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M369.625,353.174c-13.207,1.309,10.411,21.479,11.732,19.033 C381.849,371.296,382.832,351.865,369.625,353.174z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M369.625,353.174c-10.575,1.047-10.867,12.802-10.266,17.885c0.018,0.146,22.237-1.875,22.234-2.057 C381.526,363.304,379.725,352.172,369.625,353.174z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M369.625,353.174c-10.575,1.047,5.72,16.542,6.35,16.461c3.211-0.413,5.62-0.573,5.619-0.633 C381.526,363.304,379.725,352.172,369.625,353.174z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M401.3,321.807c-12.04-0.297-8.278,19.113-7.703,19.987c1.548,2.351,18.296,2.184,19.478-0.512 C413.469,340.38,413.34,322.106,401.3,321.807z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M401.323,322.283c-11.802-0.292-8.115,18.731-7.55,19.588c1.516,2.305,17.932,2.142,19.09-0.5 C413.25,340.486,413.123,322.575,401.323,322.283z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M401.323,322.283c-11.802-0.292-8.115,18.731-7.55,19.588 C395.289,344.176,413.123,322.575,401.323,322.283z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M401.323,322.283c-9.026-0.223-8.992,10.852-8.225,16.457c0.023,0.178,19.853,0.493,19.846,0.347 C412.737,334.046,410.771,322.516,401.323,322.283z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M401.323,322.283c-9.026-0.223-8.992,10.852-8.225,16.457c0.009,0.059,2.15,0.035,5.032,0.199 C398.696,338.971,410.771,322.516,401.323,322.283z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M428.208,299.059c-11.265-0.107-7.471,17.994-6.921,18.805c1.482,2.177,17.145,1.781,18.211-0.755 C439.855,316.259,439.475,299.168,428.208,299.059z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M428.236,299.504c-11.042-0.104-7.322,17.636-6.782,18.43c1.452,2.135,16.803,1.748,17.849-0.74 C439.653,316.361,439.277,299.61,428.236,299.504z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M428.236,299.504c-11.042-0.104-7.322,17.636-6.782,18.43 C422.906,320.068,439.277,299.61,428.236,299.504z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M428.236,299.504c-8.444-0.08-8.256,10.279-7.458,15.511c0.024,0.166,18.576,0.178,18.568,0.042 C439.08,310.345,437.078,299.587,428.236,299.504z">
                                                                </path>
                                                                <path style={{ fill: `${colorNail}` }}
                                                                    d="M428.236,299.504c-8.444-0.08-8.256,10.279-7.458,15.511c0.009,0.056,2.011,0.001,4.71,0.114 C426.017,315.151,437.078,299.587,428.236,299.504z">
                                                                </path>
                                                                <path style={{ fill: "#D3AE92" }}
                                                                    d="M446.904,280.478c-1.913-0.018-3.391,0.491-4.523,1.348c0.033,0.143,0.067,0.287,0.104,0.429 c0.01-0.009,0.022-0.017,0.034-0.025c0.025-0.021,0.054-0.039,0.081-0.058c0.127-0.092,0.258-0.18,0.395-0.264 c0.021-0.014,0.044-0.028,0.066-0.042c0.152-0.09,0.311-0.174,0.475-0.252c0.035-0.017,0.07-0.033,0.105-0.05 c0.151-0.069,0.309-0.134,0.47-0.193c0.021-0.007,0.04-0.016,0.061-0.023c0.178-0.063,0.362-0.117,0.553-0.167 c0.043-0.012,0.085-0.021,0.129-0.032c0.183-0.044,0.37-0.083,0.563-0.115c0.014-0.001,0.027-0.005,0.042-0.007 c0.205-0.033,0.418-0.055,0.634-0.072c0.053-0.004,0.105-0.007,0.156-0.01c0.224-0.015,0.45-0.023,0.686-0.021 c0.142,0.001,0.278,0.007,0.41,0.016c0.053,0.004,0.105,0.007,0.156,0.012c0.12,0.007,0.238,0.014,0.354,0.025 c0.092,0.01,0.18,0.023,0.27,0.034c0.208,0.026,0.414,0.058,0.614,0.098c0.094,0.019,0.188,0.038,0.281,0.059 c0.199,0.045,0.393,0.097,0.582,0.155c0.078,0.023,0.156,0.045,0.232,0.069c0.523,0.173,1.015,0.391,1.475,0.648 c0.063,0.036,0.125,0.075,0.188,0.112c0.166,0.098,0.328,0.2,0.486,0.309c0.068,0.046,0.136,0.094,0.201,0.142 c0.156,0.112,0.307,0.229,0.454,0.352c0.054,0.044,0.109,0.087,0.162,0.132c0.396,0.34,0.761,0.712,1.101,1.11 c0.043,0.052,0.087,0.105,0.13,0.158c0.124,0.151,0.245,0.304,0.361,0.46c0.048,0.065,0.095,0.13,0.142,0.195 c0.113,0.158,0.223,0.32,0.329,0.483c0.038,0.058,0.077,0.116,0.114,0.176c0.281,0.448,0.537,0.914,0.772,1.391 c0.029,0.063,0.058,0.125,0.088,0.186c0.086,0.179,0.168,0.36,0.247,0.542c0.032,0.076,0.064,0.15,0.097,0.226 c0.075,0.18,0.147,0.361,0.218,0.542c0.025,0.067,0.052,0.134,0.076,0.2c0.187,0.495,0.352,0.995,0.497,1.491 c0.021,0.069,0.04,0.136,0.059,0.205c0.052,0.18,0.102,0.36,0.147,0.54c0.021,0.082,0.043,0.163,0.063,0.244 c0.045,0.174,0.086,0.347,0.125,0.52c0.018,0.072,0.033,0.145,0.049,0.215c0.052,0.229,0.1,0.457,0.143,0.681 c0.002,0.01,0.005,0.021,0.007,0.031c0.046,0.234,0.086,0.466,0.125,0.693c0.012,0.073,0.023,0.146,0.035,0.217 c0.024,0.155,0.049,0.307,0.07,0.458c0.012,0.08,0.022,0.16,0.034,0.239c0.02,0.143,0.037,0.282,0.054,0.42 c0.009,0.074,0.019,0.147,0.026,0.22c0.02,0.166,0.037,0.327,0.053,0.485c0.004,0.043,0.009,0.087,0.012,0.129 c0.018,0.181,0.031,0.354,0.043,0.521c0.005,0.071,0.01,0.139,0.014,0.208c0.004,0.067,0.01,0.137,0.014,0.201 c0,0.001-0.002,0.001-0.002,0.001c0.066,1.169,0.027,1.971-0.041,2.136c-0.156,0.37-0.634,0.692-1.328,0.968 c0.804-0.294,1.352-0.646,1.522-1.052C458.552,297.678,458.171,280.587,446.904,280.478z">
                                                                </path>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M445.69,300.649c0.001,0.013,0.003,0.027,0.003,0.041c3.854,0.198,8.658-0.19,10.979-1.11 C454.256,300.467,449.522,300.839,445.69,300.649z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M458.041,296.476c-0.028,0.085-7.322,0.112-12.76,0.079c0.19,1.444,0.329,2.815,0.409,4.094 c3.832,0.19,8.565-0.182,10.981-1.069c0.694-0.276,1.172-0.598,1.328-0.968C458.068,298.447,458.107,297.645,458.041,296.476z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.344,280.938c0.023,0.002,0.043,0.005,0.065,0.007c0.03,0.001,0.062,0.001,0.091,0.004 C447.449,280.946,447.396,280.942,447.344,280.938z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M442.484,282.255c0,0.001,0,0.002,0,0.002c0.012-0.009,0.021-0.019,0.034-0.028 C442.507,282.238,442.494,282.246,442.484,282.255z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.5,280.95c0.039,0.002,0.076,0.008,0.114,0.011c0.079,0.006,0.162,0.006,0.24,0.014 C447.738,280.964,447.62,280.957,447.5,280.95z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M458.029,296.274c0.004,0.069,0.009,0.135,0.012,0.202c0,0,0.002,0,0.002-0.001 C458.039,296.411,458.033,296.341,458.029,296.274z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M449.834,281.391c0.521,0.173,1.015,0.391,1.475,0.648 C450.849,281.782,450.357,281.563,449.834,281.391z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M458.029,296.274c-0.004-0.07-0.009-0.137-0.014-0.208c-0.012-0.168-0.025-0.341-0.043-0.521 c-0.003-0.042-0.008-0.086-0.012-0.129c-0.016-0.158-0.033-0.319-0.053-0.485c-0.008-0.072-0.018-0.146-0.026-0.22 c-0.017-0.138-0.034-0.278-0.054-0.42c-0.012-0.079-0.022-0.159-0.034-0.239c-0.021-0.15-0.046-0.303-0.07-0.458 c-0.012-0.072-0.023-0.144-0.035-0.217c-0.039-0.228-0.079-0.459-0.125-0.693c-0.002-0.01-0.005-0.021-0.007-0.031 c-0.043-0.224-0.091-0.451-0.143-0.681c-0.016-0.071-0.033-0.143-0.049-0.215c-0.039-0.172-0.08-0.346-0.125-0.52 c-0.02-0.081-0.041-0.162-0.063-0.244c-0.046-0.179-0.096-0.359-0.147-0.54c-0.019-0.069-0.038-0.136-0.059-0.205 c-0.146-0.497-0.311-0.996-0.497-1.491c-0.024-0.066-0.051-0.133-0.076-0.2c-0.07-0.181-0.143-0.363-0.218-0.542 c-0.032-0.076-0.064-0.15-0.097-0.226c-0.079-0.182-0.161-0.362-0.247-0.542c-0.03-0.062-0.059-0.124-0.088-0.186 c-0.235-0.478-0.491-0.943-0.772-1.391c-0.037-0.06-0.076-0.118-0.114-0.176c-0.106-0.164-0.216-0.325-0.329-0.483 c-0.047-0.065-0.094-0.13-0.142-0.195c-0.116-0.157-0.237-0.31-0.361-0.46c-0.043-0.053-0.087-0.106-0.13-0.158 c-0.34-0.397-0.705-0.77-1.101-1.11c-0.053-0.044-0.108-0.088-0.162-0.132c-0.147-0.123-0.298-0.24-0.454-0.352 c-0.065-0.048-0.133-0.096-0.201-0.142c-0.158-0.108-0.32-0.21-0.486-0.309c-0.063-0.037-0.124-0.076-0.188-0.112 c-0.46-0.257-0.953-0.475-1.475-0.648c-0.076-0.024-0.154-0.046-0.232-0.069c-0.189-0.058-0.383-0.109-0.582-0.155 c-0.093-0.021-0.188-0.041-0.281-0.059c-0.2-0.04-0.406-0.071-0.614-0.098c-0.09-0.011-0.178-0.024-0.27-0.034 c-0.078-0.008-0.161-0.008-0.24-0.014c5.984,0.593,2.22,8.331-1.844,13.624c-0.229,0.333-0.445,0.632-0.639,0.892 c0.053,0.363,0.103,0.724,0.149,1.079c5.438,0.033,12.731,0.006,12.76-0.079C458.038,296.409,458.033,296.343,458.029,296.274z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.5,280.95c-0.029-0.003-0.061-0.003-0.091-0.004c0.037,0.002,0.072,0.007,0.108,0.01 c0.032,0.002,0.065,0.004,0.097,0.005C447.576,280.958,447.539,280.953,447.5,280.95z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.614,280.961c-0.031-0.001-0.064-0.003-0.097-0.005c5.976,0.596,1.051,9.573-1.747,13.629 C449.834,289.292,453.599,281.554,447.614,280.961z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.344,280.938c-0.133-0.008-0.269-0.015-0.41-0.016c0.162,0.002,0.318,0.014,0.476,0.023 C447.387,280.944,447.367,280.94,447.344,280.938z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M445.121,295.406c0.004,0.022,0.008,0.046,0.011,0.07c0.193-0.26,0.409-0.559,0.639-0.892 C445.555,294.865,445.338,295.14,445.121,295.406z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.409,280.946c-0.157-0.009-0.313-0.021-0.476-0.023c0.201,0.002,0.391,0.021,0.584,0.033 C447.481,280.953,447.446,280.948,447.409,280.946z">
                                                                    </path>
                                                                    <path style={{ fill: `${colorNail}` }}
                                                                        d="M447.517,280.956c-0.193-0.012-0.383-0.031-0.584-0.033c-0.235-0.003-0.462,0.006-0.686,0.021 c-0.051,0.003-0.104,0.006-0.156,0.01c-0.216,0.018-0.429,0.04-0.634,0.072c-0.015,0.001-0.028,0.005-0.042,0.007 c-0.193,0.032-0.381,0.071-0.563,0.115c-0.044,0.01-0.086,0.02-0.129,0.032c-0.19,0.05-0.375,0.104-0.553,0.167 c-0.021,0.008-0.039,0.017-0.061,0.023c-0.161,0.059-0.318,0.124-0.47,0.193c-0.035,0.017-0.072,0.033-0.105,0.05 c-0.163,0.078-0.322,0.162-0.475,0.252c-0.022,0.014-0.045,0.028-0.066,0.042c-0.137,0.084-0.268,0.172-0.395,0.264 c-0.027,0.019-0.056,0.038-0.081,0.058c-0.013,0.009-0.022,0.019-0.034,0.028c1.111,4.612,2.053,9.129,2.637,13.149 c0.217-0.267,0.434-0.541,0.649-0.821C448.568,290.529,453.493,281.552,447.517,280.956z">
                                                                    </path>
                                                                </g>
                                                                <g>
                                                                    <ellipse style={{ fill: "#D10566" }} cx="245.189" cy="266.399" rx="27.333" ry="44"></ellipse>
                                                                    <ellipse transform="matrix(-0.7721 -0.6355 0.6355 -0.7721 281.5777 731.2943)" style={{ fill: "#D10566" }}
                                                                        cx="271.915" cy="315.158" rx="33.889" ry="21.591"></ellipse>
                                                                    <path style={{ fill: "#D10566" }}
                                                                        d="M245.417,293.631c-7.576-9.205-25.435-7.025-39.887,4.867 c-14.449,11.894-20.021,29.001-12.441,38.207c7.575,9.206,25.434,7.025,39.885-4.867 C247.423,319.944,252.996,302.838,245.417,293.631z">
                                                                    </path>
                                                                </g>
                                                                <ellipse style={{ fill: "#CE0658" }} cx="245.199" cy="291.739" rx="14.999" ry="24.15"></ellipse>
                                                                <ellipse style={{ fill: "#E20E64" }} cx="245.199" cy="294.399" rx="8.999" ry="14.487"></ellipse>
                                                                <g>
                                                                    <path style={{ fill: "#DB1675" }}
                                                                        d="M315.794,285.103c-0.256-4.153-1.354-8.855-3.479-11.572c-4.177-5.338-15.702-18.898-21.14-20.734 c-5.666-1.913-20-5-26,6.667s-12.167,21-20.833,25.667c0,0,0.313,0.016,0.878,0.044c-0.565,0.027-0.878,0.043-0.878,0.043 c8.666,4.667,14.833,14,20.833,25.667s20,8.667,26,6.667s16.963-15.396,21.14-20.734c2.126-2.717,3.224-7.419,3.479-11.572 c0.001-0.024-0.013-0.047-0.018-0.071C315.781,285.151,315.795,285.128,315.794,285.103z">
                                                                    </path>
                                                                    <path style={{ fill: "#DB1675" }}
                                                                        d="M245.795,285.167c-8.666-4.667-14.833-14-20.833-25.667s-20-8.667-26-6.667 s-16.963,15.396-21.14,20.734c-2.126,2.717-3.224,7.419-3.479,11.572c-0.001,0.024,0.013,0.047,0.018,0.071 c-0.005,0.024-0.019,0.047-0.018,0.071c0.256,4.153,1.354,8.855,3.479,11.572c4.177,5.338,15.702,18.898,21.14,20.734 c5.666,1.913,20,5,26-6.667s12.167-21,20.833-25.667c0,0-0.313-0.016-0.878-0.044C245.482,285.183,245.795,285.167,245.795,285.167 z">
                                                                    </path>
                                                                </g>
                                                                <circle style={{ fill: "#F9EDF3" }} cx="245.169" cy="286.219" r="6.333"></circle>
                                                            </g>
                                                        </svg>
                                                    }
                                                </div>

                                                {customizationValue.nail_size != null || customizationValue.has_extensions != null ?
                                                    <List>
                                                        <ListItem>
                                                            <ListItemIcon>
                                                                <CheckCircleIcon sx={{ color: "#f8c5c5" }} />
                                                            </ListItemIcon>
                                                            <ListItemText
                                                                primary="Nail Size:"
                                                                secondary={customizationValue.nail_size}
                                                            />

                                                            <ListItemIcon>
                                                                <CheckCircleIcon sx={{ color: "#f8c5c5" }} />
                                                            </ListItemIcon>
                                                            <ListItemText
                                                                primary="Has Extensions:"
                                                                secondary={customizationValue.has_extensions}
                                                            />
                                                        </ListItem>
                                                    </List>
                                                    : ''}
                                            </Fragment>
                                            }
                                        </Grid>
                                    </Grid>
                                </Fragment>
                            )}
                            {activeStep === 3 && (
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

                            {activeStep === 4 && (
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
                                                <b> Service Details</b>
                                            </Typography>
                                            <TextField
                                                sx={{ mt: 1.5 }}
                                                label="Service 1"
                                                fullWidth
                                                value={formValues.product1Field}
                                                InputProps={{
                                                    readOnly: true,
                                                }}
                                                variant="filled"

                                            />
                                            {formValues.addOns1 &&

                                                <TextField
                                                    sx={{ mt: 1.5 }}
                                                    label="Add Ons"
                                                    fullWidth
                                                    value={formValues.addOns1}
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
                                                value={formValues.product2Field ?? 'None'}
                                                InputProps={{
                                                    readOnly: true,
                                                }}
                                                variant="filled"

                                            />

                                            {formValues.addOns2 &&

                                                <TextField
                                                    sx={{ mt: 1.5 }}
                                                    label="Add Ons"
                                                    fullWidth
                                                    value={formValues.addOns2}
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
                                                value={formValues.product3Field === 'None' || formValues.product3Field === '' ? 'None' : formValues.product3Field}
                                                InputProps={{
                                                    readOnly: true,
                                                }}
                                                variant="filled"

                                            />

                                            {formValues.addOns3 &&

                                                <TextField
                                                    sx={{ mt: 1.5 }}
                                                    label="Add Ons"
                                                    fullWidth
                                                    value={formValues.addOns3}
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
                                                    <b>₱{formValues.totalPrice}</b>
                                                </Typography>
                                            </div>

                                            <div className="flex justify-between mb-3">
                                                <Typography variant="subtitle1">
                                                    Discount:
                                                </Typography>
                                                {userDetails.is_loyal == 1 ? <Chip
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
                                            <TextField
                                                select
                                                label="Choose a Discount"

                                            >
                                                <MenuItem value="None">--None--</MenuItem>
                                                {filteredDiscounts.map((item, index) => (
                                                    <MenuItem value={item.id}>{item.discount_name} - {item.discount_percent}</MenuItem>
                                                ))}
                                            </TextField>
                                            {/* {TODO: GET THE MODE FOR SERVICE TYPE AND ADD THE DISCOUNT AMOUNT ON THE TOTAL PRICE THEN SAVE THE ID OF THE DISCOUNT} */}
                                            <hr></hr>
                                            <div className="flex justify-end mt-3">
                                                <Typography variant="h4">
                                                    {userDetails.is_loyal == 1 ? <b>₱ {Number(formValues.totalPrice) * Number(0.9)}</b> : <b>₱{formValues.totalPrice}</b>}
                                                </Typography>
                                            </div>
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

export default AddBooking;

if (document.getElementById("add-booking")) {
    const element = document.getElementById('add-booking')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<AddBooking {...props} />, document.getElementById("add-booking"));
}