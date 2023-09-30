import React, { useState } from "react";
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

const steps = ["Pick Schedule and Branch", "Choose Services", "Assigned Technician"];

// function getStepContent(step) {
//   switch (step) {
//     case 0:
//       return <DateForm />
//     case 1:
//       return <ServicesForm />;
//     case 2:
//       return <TechnicianForm />;
//     default:
//       throw new Error('Unknown step');
//   }
// }

const Booking = () => {
  // DATE FORM
  const [selectedDate, setSelectedDate] = useState(moment().add(1, 'days').format('YYYY-MM-DD'));
  const [selectedTime, setSelectedTime] = useState(moment('10:00 AM', 'h:mm A').format('LT'));
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

  const [activeStep, setActiveStep] = useState(0);
  const handleNext = () => {
    if (activeStep === 0) {
      if (
        selectedDate === null ||
        selectedTime === null ||
        selectedBranch == "None" ||
        moment(selectedDate).isBefore(moment().startOf('day')) ||
        moment(selectedTime, 'h:mm A').isBefore(moment('10:00 AM', 'h:mm A')) ||
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
        if (moment(selectedTime, 'h:mm A').isBefore(moment('10:00 AM', 'h:mm A')) || moment(selectedTime, 'h:mm A').isAfter(moment('10:00 PM', 'h:mm A'))) {
          toast.error('Selected time is outside the allowed range (10:00 AM - 10:00 PM).');
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
    }
  };
  const handleBack = () => {
    setActiveStep(activeStep - 1);
  };

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
                Thank you for your order.
              </Typography>
              <Typography variant="subtitle1">
                Your order number is #2001539. We have emailed
                your order confirmation, and will send you an
                update when your order has shipped.
              </Typography>
            </React.Fragment>
          ) : (
            <React.Fragment>
              {/* {getStepContent(activeStep)} */}
              {activeStep === 0 && (
                <DateForm
                  onDateChange={handleDateChange}
                  onTimeChange={handleTimeChange}
                  onBranchChange={handleBranchChange}
                  errors={dateFormError}
                />
              )}
              {activeStep === 1 && <ServicesForm />}
              {activeStep === 2 && <TechnicianForm />}
              <Box
                sx={{
                  display: "flex",
                  justifyContent: "flex-end",
                }}
              >
                {activeStep !== 0 && (
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
      {console.log(selectedDate, selectedTime, selectedBranch)}
    </React.Fragment>
  );
};

export default Booking;

if (document.getElementById("booking")) {
  ReactDOM.render(<Booking />, document.getElementById("booking"));
}