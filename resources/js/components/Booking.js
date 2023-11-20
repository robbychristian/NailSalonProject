import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import Paper from "@mui/material/Paper";
import Stepper from "@mui/material/Stepper";
import Step from "@mui/material/Step";
import StepLabel from "@mui/material/StepLabel";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import DateForm from "./DateForm";
import ServicesForm from "./ServicesForm";
import TechnicianForm from "./TechnicianForm";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import moment from "moment";
import SummaryForm from "./SummaryForm";
import CustomerForm from "./CustomerForm";
import axios from "axios";

const steps = ["Customer Details", "Pick Schedule and Branch", "Choose Services", "Assigned Technician", "Summary Form"];

const Booking = (props) => {
  //USER FORM
  const [selectedUser, setSelectedUser] = useState("None");
  const handleUserChange = (user) => {
    setSelectedUser(user);
  }

  // DATE FORM
  const [selectedDate, setSelectedDate] = useState("");
  const [selectedTime, setSelectedTime] = useState(moment('11:00 AM', 'h:mm A').format('LT'));
  const [selectedBranch, setSelectedBranch] = useState("None");

  const handleDateChange = (date) => {
    setSelectedDate(date);
  };

  const handleTimeChange = (time) => {
    setSelectedTime(time);
  };

  const handleBranchChange = (branch) => {
    setSelectedBranch(branch);
    //clear errors
    setDateFormError({});
  };

  //dateForm validation
  const [dateFormError, setDateFormError] = useState({});

  //END OF DATE FORM

  //SERVICES FORM
  const [selectedService1, setSelectedService1] = useState(null);
  const [selectedService2, setSelectedService2] = useState(null);
  const [selectedService3, setSelectedService3] = useState(null);

  const [serviceTypeId1, setServiceTypeId1] = useState("");
  const [serviceTypeId2, setServiceTypeId2] = useState("");
  const [serviceTypeId3, setServiceTypeId3] = useState("");

  const [selectedAddonId1, setSelectedAddonId1] = useState("");
  const [selectedAddonId2, setSelectedAddonId2] = useState("");
  const [selectedAddonId3, setSelectedAddonId3] = useState("");

  const [price, setPrice] = useState(null);

  const [nailCustomizationId, setNailCustomizationId] = useState("");

  const handleService1Change = (s1) => {
    setSelectedService1(s1);
  }

  const handleService2Change = (s2) => {
    setSelectedService2(s2);
  }

  const handleService3Change = (s3) => {
    setSelectedService3(s3);
  }

  const handleServiceTypeId1Change = (id1) => {
    setServiceTypeId1(id1)
  }

  const handleServiceTypeId2Change = (id2) => {
    setServiceTypeId2(id2)
  }

  const handleServiceTypeId3Change = (id3) => {
    setServiceTypeId3(id3)
  }

  const handleAddOn1Change = (addon1) => {
    setSelectedAddonId1(addon1);
  }

  const handleAddOn2Change = (addon2) => {
    setSelectedAddonId2(addon2);
  }


  const handleAddOn3Change = (addon3) => {
    setSelectedAddonId3(addon3);
  }


  const handlePrice = (price) => {
    setPrice(price);
  }

  const handleNailCustomization = (id) => {
    setNailCustomizationId(id);
  }

  //TECHNICIAN FORM
  const [selectedStaff, setSelectedStaff] = useState(null);

  const handleSelectedStaff = (staff) => {
    setSelectedStaff(staff);
  }

  const [activeStep, setActiveStep] = useState(0);
  const handleNext = () => {
    if (activeStep === 0) {
      if (selectedUser == "None") {
        toast.error('User is required!');
      } else {
        setActiveStep(activeStep + 1);
      }

    } else if (activeStep === 1) {
      if (
        selectedDate === null ||
        selectedTime === null ||
        selectedBranch == "None" ||
        moment(selectedDate).isBefore(moment().startOf('day')) ||
        moment(selectedTime, 'h:mm A').isBefore(moment('11:00 AM', 'h:mm A')) ||
        moment(selectedTime, 'h:mm A').isAfter(moment('10:00 PM', 'h:mm A'))
      ) {
        let tempError = {};
        if (selectedDate === null) {
          tempError = { ...tempError, dateError: true };
          toast.error('Date Field is required!');
        }
        if (moment(selectedDate).isBefore(moment().startOf('day'))) {
          toast.error('Selected date cannot be in the past.');
        }
        if (selectedTime === null) {
          toast.error('Time Field is required!');
        }
        if (moment(selectedTime, 'h:mm A').isBefore(moment('11:00 AM', 'h:mm A')) || moment(selectedTime, 'h:mm A').isAfter(moment('10:00 PM', 'h:mm A'))) {
          toast.error('Selected time is outside the allowed range (11:00 AM - 10:00 PM).');
        }
        if (selectedBranch == "None") {
          tempError = { ...tempError, branchError: true };
          toast.error('Branch Field is required!');
        }

        setDateFormError(tempError);
      } else {
        console.log(selectedDate);
        console.log(selectedTime);
        console.log(selectedBranch);
        setActiveStep(activeStep + 1);
      }
    } else if (activeStep === 2) {
      if (selectedService1 == null) {
        toast.error('Choose atleast 1 service!');
      } else if (selectedService1 === selectedService2 || selectedService1 === selectedService3) {
        toast.error('Same service has been selected! Choose different service!');
      } else if (selectedService2 !== null) {
        if (selectedService2 === selectedService1 || selectedService2 === selectedService3) {
          toast.error('Same service has been selected! Choose different service!');
        } else {
          setActiveStep(activeStep + 1);
        }
      } else if (selectedService3 !== null) {
        if (selectedService3 === selectedService1 || selectedService3 === selectedService2) {
          toast.error('Same service has been selected! Choose different service!');
        } else {
          setActiveStep(activeStep + 1);
        }
      } else {
        console.log(selectedService1);
        console.log(selectedService2);
        console.log(selectedService3);
        setActiveStep(activeStep + 1);
      }
    } else if (activeStep === 3) {
      if (selectedStaff == null) {
        toast.error('Choose a technician!');
      } else {
        setActiveStep(activeStep + 1);
      }
    } else if (activeStep === 4) {
      const formdata = new FormData();
      formdata.append('user_id', selectedUser);
      formdata.append('date', moment(selectedDate).format('YYYY-MM-DD h:mm A'));
      formdata.append('time_in', moment(`${selectedDate} ${selectedTime}`, 'YYYY-MM-DD h:mm A').format('YYYY-MM-DD h:mm A'));
      formdata.append('time_out', moment(`${selectedDate} ${selectedTime}`, 'YYYY-MM-DD h:mm A').add(1, 'hour').add(30, 'minutes').format('YYYY-MM-DD h:mm A'));
      formdata.append('branch', selectedBranch);
      formdata.append('staff_id', selectedStaff);

      formdata.append('service1', selectedService1);
      formdata.append('addon1', selectedAddonId1);
      formdata.append('service2', selectedService2);
      formdata.append('addon2', selectedAddonId2);
      formdata.append('service3', selectedService3);
      formdata.append('addon3', selectedAddonId3);

      formdata.append('total_price', price);
      formdata.append('nail_customization_id', nailCustomizationId)

      console.log([...formdata]);
      axios.post('/booking', formdata)
        .then((response) => {
          console.log(response)
          setActiveStep(activeStep + 1);
        })
    }
  };
  const handleBack = () => {
    setSelectedAddonId1("");
    setSelectedAddonId2("");
    setSelectedAddonId3("");
    setActiveStep(activeStep - 1);
  };

  useEffect(() => {
    if (JSON.parse(props.auth).user_role == 2) {
      setActiveStep(1)
      setSelectedUser(JSON.parse(props.auth).id)
      setSelectedDate(moment().add(1, 'days').format('YYYY-MM-DD'))
    } else {
      setSelectedDate(moment().format('YYYY-MM-DD'))
      setActiveStep(0)
    }
  }, [])


  return (
    <React.Fragment>
      <div>

        <ToastContainer
          position='top-right'
          autoClose={5000}
          hideProgressBar={false}
          newestOnTop={false}
          closeOnClick
          rtl={false}
          pauseOnFocusLoss
          draggable
          pauseOnHover
          theme='light'
        />
      </div>
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
            <React.Fragment>
              <Typography variant="h5" gutterBottom>
                Thank You for Booking With Us!
              </Typography>
              <Typography variant="subtitle1">
                Thank you for your reservation. Payment can be done on-site or through GCash on your mobile application.
              </Typography>
            </React.Fragment>
          ) : (
            <React.Fragment>
              {/* {getStepContent(activeStep)} */}
              {activeStep === 0 && (
                <CustomerForm
                  onUserChange={handleUserChange}
                  authUser={JSON.parse(props.auth)}
                />
              )}
              {activeStep === 1 && (
                <DateForm
                  userRole={JSON.parse(props.auth).user_role}
                  onDateChange={handleDateChange}
                  onTimeChange={handleTimeChange}
                  onBranchChange={handleBranchChange}
                  errors={dateFormError}
                />
              )}
              {activeStep === 2 && (
                <ServicesForm
                  onService1Change={handleService1Change}
                  onService2Change={handleService2Change}
                  onService3Change={handleService3Change}
                  onServiceTypeId1Change={handleServiceTypeId1Change}
                  onServiceTypeId2Change={handleServiceTypeId2Change}
                  onServiceTypeId3Change={handleServiceTypeId3Change}
                  onAddOn1Change={handleAddOn1Change}
                  onAddOn2Change={handleAddOn2Change}
                  onAddOn3Change={handleAddOn3Change}
                  onPriceChange={handlePrice}
                  userIdValue={selectedUser}
                  onNailCustomization={handleNailCustomization}
                />)}
              {activeStep === 3 &&
                <TechnicianForm
                  onStaffChange={handleSelectedStaff}
                  userIdValue={selectedUser}
                  dateValue={selectedDate}
                  timeValue={selectedTime}
                  serviceType1Value={serviceTypeId1}
                  serviceType2Value={serviceTypeId2}
                  serviceType3Value={serviceTypeId3}
                />}
              {activeStep === 4 &&
                <SummaryForm
                  dateValue={selectedDate}
                  timeValue={selectedTime}
                  branchValue={selectedBranch}
                  service1Value={selectedService1}
                  service2Value={selectedService2}
                  service3Value={selectedService3}
                  addOn1Value={selectedAddonId1}
                  addOn2Value={selectedAddonId2}
                  addOn3Value={selectedAddonId3}
                  technicianValue={selectedStaff}
                  priceValue={price}
                  userValue={selectedUser}
                />
              }
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
            </React.Fragment>
          )}
        </Paper>
      </Container>
      {/* {console.log(moment().add(1, 'days').format('YYYY-MM-DD'))}
      {console.log(moment('10:00 AM', 'h:mm A').format('LT'))} */}
      {/* {console.log(selectedDate, selectedTime, selectedBranch)}
      {console.log(selectedService1)}
      {console.log(selectedService2)}
      {console.log(selectedService3)}
      {console.log(selectedUser)} */}
      {/* {console.log(selectedService1)}
      {console.log(selectedService2)}
      {console.log(selectedService3)} */}
      {/* {console.log(`Service Id: ${serviceTypeId1}`)}
      {console.log(`Service Id: ${serviceTypeId2}`)}
      {console.log(`Service Id: ${serviceTypeId3}`)} */}
      {console.log(nailCustomizationId)}
    </React.Fragment>
  );
};

export default Booking;

if (document.getElementById("booking")) {
  const element = document.getElementById('booking')
  const props = Object.assign({}, element.dataset)
  ReactDOM.render(<Booking {...props} />, document.getElementById("booking"));
}
