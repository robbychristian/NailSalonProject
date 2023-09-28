import React, { useState } from 'react';
import ReactDOM from "react-dom";
import Box from '@mui/material/Box';
import Container from '@mui/material/Container';
import Paper from '@mui/material/Paper';
import Stepper from '@mui/material/Stepper';
import Step from '@mui/material/Step';
import StepLabel from '@mui/material/StepLabel';
import Button from '@mui/material/Button';
import Typography from '@mui/material/Typography';
import DateForm from './DateForm';
import ServicesForm from './ServicesForm';
import TechnicianForm from './TechnicianForm';

const steps = ['Pick Schedule and Branch', 'Choose Services', 'Assigned Technician'];

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
  const [selectedDate, setSelectedDate] = useState(null);
  const [selectedTime, setSelectedTime] = useState(null);
  const [selectedBranch, setSelectedBranch] = useState(null);

  const handleDateChange = (date) => {
    setSelectedDate(date);
  }

  const handleTimeChange = (time) => {
    setSelectedTime(time);
  }

  const handleBranchChange = (branch) => {
    setSelectedBranch(branch);
  }

  //END OF DATE FORM

  const [activeStep, setActiveStep] = useState(0);
  const handleNext = () => {
    if (activeStep === 0) {
      if (selectedDate === null || selectedTime === null || selectedBranch == null) {
        console.log('error');
      } else {
        setActiveStep(activeStep + 1);
      }
    }
  };
  const handleBack = () => {
    setActiveStep(activeStep - 1);
  };

  return (
    <React.Fragment>
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
                Your order number is #2001539. We have emailed your order
                confirmation, and will send you an update when your order has
                shipped.
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
                />
              )}
              {activeStep === 1 && (
                <ServicesForm />
              )}
              {activeStep === 2 && (
                <TechnicianForm />
              )}
              <Box sx={{ display: 'flex', justifyContent: 'flex-end' }}>
                {activeStep !== 0 && (
                  <Button onClick={handleBack} sx={{ mt: 3, ml: 1 }}>
                    Back
                  </Button>
                )}

                <Button
                  variant="contained"
                  onClick={handleNext}
                  sx={{ mt: 3, ml: 1 }}
                >
                  {activeStep === steps.length - 1 ? 'Place order' : 'Next'}
                </Button>
              </Box>
            </React.Fragment>
          )}
        </Paper>
      </Container>
      {console.log(selectedDate, selectedTime, selectedBranch)}
    </React.Fragment>
  );
}

export default Booking;

if (document.getElementById('booking')) {
  ReactDOM.render(<Booking />, document.getElementById('booking'));
}
