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

const ViewReview = (props) => {

    return (
        <Fragment>
            <Rating name="read-only" value={JSON.parse(props.review).review_score} readOnly precision={0.5} />
            <blockquote>
                <p class="text-sm font-medium text-gray-900">
                    {JSON.parse(props.review).review_desc}
                </p>
            </blockquote>
        </Fragment>
    );
};

export default ViewReview;

if (document.getElementById("view-review")) {
    const element = document.getElementById('view-review')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<ViewReview {...props} />, document.getElementById("view-review"));
}
