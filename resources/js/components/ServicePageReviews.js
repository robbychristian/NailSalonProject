import React, { useState, useEffect, Fragment } from 'react';
import ReactDOM from "react-dom";
import { Box, Button, Typography, Pagination } from '@mui/material';
import axios from 'axios';
import Rating from '@mui/material/Rating';

function ServicePageReviews(props) {
    const itemsPerPage = 1; // Number of reviews per page
    const [currentPage, setCurrentPage] = useState(1);
    const [reviews, setReviews] = useState([]);

    useEffect(() => {
        axios.get('/api/getReviewsForServicePage')
            .then((response) => {
                console.log(response.data.reviews);
                setReviews(response.data.reviews)
            })
    }, [])

    console.log(reviews);

    const totalReviews = reviews.length;
    const totalPages = Math.ceil(totalReviews / itemsPerPage);

    // Function to handle page change
    const handlePageChange = (event, page) => {
        setCurrentPage(page);
    };

    // Calculate the start and end indices for the reviews to display on the current page
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    const reviewsToDisplay = reviews.slice(startIndex, endIndex);

    return (
        <div>
            {reviews.length > 0 ?
                <Fragment>
                    <h1
                        class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl uppercase mt-10 mb-10">
                        Services Reviews
                    </h1>

                    {reviewsToDisplay.map((review, index) => (
                        <section className="bg-white dark:bg-gray-900" key={index}>
                            <div className="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
                                <figure className="max-w-screen-md mx-auto">
                                    <svg className="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor" />
                                    </svg>
                                    <Rating name="read-only" value={review.review_score} readOnly precision={0.5} />

                                    <blockquote>
                                        <p className="text-2xl font-medium text-gray-900 dark:text-white">{review.review_desc}</p>
                                    </blockquote>
                                    <figcaption className="flex items-center justify-center mt-6 space-x-3 flex-col">

                                        <div className="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                                            <div className="pr-3 text-md font-medium text-gray-900 dark:text-white">{review.created_by.first_name} {review.created_by.last_name}</div>
                                        </div>
                                        <small>{`Technician: ${review.booking.staff_review.staff_name}`}</small>
                                    </figcaption>
                                </figure>
                            </div>
                        </section>
                    ))}

                    <Box display="flex" justifyContent="center" marginTop={2}>
                        <Pagination
                            count={totalPages}
                            page={currentPage}
                            onChange={handlePageChange}
                            color="primary"
                            variant="outlined"
                            shape="rounded"
                        />
                    </Box>
                </Fragment>

                : null}
        </div>
    );
}

export default ServicePageReviews;


if (document.getElementById("service-review")) {
    const element = document.getElementById('service-review')
    const props = Object.assign({}, element.dataset)

    ReactDOM.render(<ServicePageReviews {...props} />, document.getElementById("service-review"));
}