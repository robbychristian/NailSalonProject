import { Box, Button, Card, CardActions, CardContent, CardMedia, FormControl, FormControlLabel, Grid, ImageList, ImageListItem, Modal, Radio, RadioGroup, TextField, Typography } from "@mui/material";
import React, { Fragment, useEffect, useState } from "react";
import { styled } from "@mui/material/styles";
import Paper from "@mui/material/Paper";
import axios from "axios";
import VisibilityIcon from '@mui/icons-material/Visibility';
import moment from "moment";
import Alert from '@mui/material/Alert';
import AlertTitle from '@mui/material/AlertTitle';

const TechnicianForm = ({ onStaffChange, ...props }) => {
    const [staff, setStaff] = useState([]);
    const [openedStaff, setOpenedStaff] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);

    const Item = styled(Paper)(({ theme }) => ({
        backgroundColor: "#fff",
        ...theme.typography.body2,
        padding: theme.spacing(1),
        color: theme.palette.text.secondary,
    }));

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

    useEffect(() => {
        let time_in = moment(`${props.dateValue} ${props.timeValue}`, 'YYYY-MM-DD hh:mm A').format('YYYY-MM-DD hh:mm A')
        let time_out = moment(`${props.dateValue} ${props.timeValue}`, 'YYYY-MM-DD hh:mm A').add(1, 'hour').add(30, 'minutes').format('YYYY-MM-DD hh:mm A')

        console.log(time_in);
        console.log(time_out);
        axios.get('/api/getAvailableStaff', {
            params: {
                time_in: time_in,
                time_out: time_out,
                serviceType1: props.serviceType1Value,
                serviceType2: props.serviceType2Value,
                serviceType3: props.serviceType3Value,
                userId: props.userIdValue
            }
        })
            .then((response) => {
                setStaff(response.data.staff)
                console.log(response.data.staff)
            })
    }, []);

    const handleOpenModal = (staffMember) => {
        setIsModalOpen(true);
        setOpenedStaff(staffMember)
    };

    const handleCloseModal = () => {
        setIsModalOpen(false);
    }
    return (
        <Fragment>
            {staff.length > 0 ? (
                <FormControl>
                    <RadioGroup
                        aria-labelledby="demo-radio-buttons-group-label"
                        name="radio-buttons-group"
                        onChange={(e) => onStaffChange(e.target.value)}
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
                                                name="staff"
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
    )
}

export default TechnicianForm;
