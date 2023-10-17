import React, { useEffect, useState, Fragment } from "react";
import ReactDOM from "react-dom";
import Rating from '@mui/material/Rating';
import Box from '@mui/material/Box';
import StarIcon from '@mui/icons-material/Star';
import moment from "moment";
import axios from "axios";
import FullCalendar from "@fullcalendar/react";
import timeGridPlugin from '@fullcalendar/timegrid';
import { Card, CardContent, FormControl, FormControlLabel, Grid, InputAdornment, Radio, RadioGroup, TextField, Typography } from "@mui/material";
import Button from '@mui/material/Button';
import { ToastContainer, toast } from "react-toastify";

const Review = (props) => {
    const [value, setValue] = React.useState(0);
    const [hover, setHover] = React.useState(-1);
    const [reviewDesc, setReviewDesc] = useState("");

    const labels = {
        0.5: 'Useless',
        1: 'Useless+',
        1.5: 'Poor',
        2: 'Poor+',
        2.5: 'Ok',
        3: 'Ok+',
        3.5: 'Good',
        4: 'Good+',
        4.5: 'Excellent',
        5: 'Excellent+',
    };

    function getLabelText(value) {
        return `${value} Star${value !== 1 ? 's' : ''}, ${labels[value]}`;
    }

    const handleSubmit = () => {
        const formdata = new FormData();
        formdata.append('user_id', JSON.parse(props.auth))
        formdata.append('booking_id', JSON.parse(props.booking))
        formdata.append('review_score', value);
        formdata.append('review_desc', reviewDesc);
        // console.log([...formdata]);

        axios.post('/saveReviews', formdata)
            .then((response) => {
                console.log(response)
                toast.success('Review saved successfully!');
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                }
            })
            .catch((error) => {
                console.error(error);
            });

    }

    return (
        <Fragment>
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
            <Typography variant="subtitle1">
                Overall Rating:
            </Typography>
            <Box
                sx={{
                    width: 200,
                    display: 'flex',
                    alignItems: 'center',
                    marginBottom: 2
                }}
            >
                <Rating
                    name="hover-feedback"
                    value={value}
                    precision={0.5}
                    getLabelText={getLabelText}
                    onChange={(event, newValue) => {
                        setValue(newValue);
                    }}
                    onChangeActive={(event, newHover) => {
                        setHover(newHover);
                    }}
                    emptyIcon={<StarIcon style={{ opacity: 0.55 }} fontSize="inherit" />}
                />
                {value !== null && (
                    <Box sx={{ ml: 2 }}>{labels[hover !== -1 ? hover : value]}</Box>
                )}
            </Box>
            {/* 
            <Typography variant="subtitle1" sx={{ marginBottom: 1 }}>
                Rating Content:
            </Typography> */}
            <TextField
                id="outlined-multiline-static"
                label="Review Content"
                multiline
                fullWidth
                rows={4}
                defaultValue=""
                onChange={(e) => { setReviewDesc(e.target.value) }}
            />
            <div className="flex justify-between mt-3">
                <Button variant="outlined">Back</Button>
                <Button variant="contained" onClick={handleSubmit}>Submit</Button>
            </div>
        </Fragment>
    );
};

export default Review;

if (document.getElementById("review")) {
    const element = document.getElementById('review')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Review {...props} />, document.getElementById("review"));
}
