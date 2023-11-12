import MenuItem from "@mui/material/MenuItem";
import { Grid, TextField, Typography } from "@mui/material";
import axios from "axios";
import React, { useEffect, useState } from "react";
import { Fragment } from "react";

const CustomerForm = ({ onUserChange, authUser }) => {
    const [users, setUsers] = useState([]);
    const [userDetail, setUserDetail] = useState([]);
    const [fname, setFname] = useState("");
    const [lname, setLname] = useState("");
    const [email, setEmail] = useState("");
    const [number, setNumber] = useState("");

    useEffect(() => {
        axios.get('/api/getAllUsers')
            .then((response) => {
                setUsers(response.data.users)
            })

            .catch((error) => {
                console.log(error);
            })

    }, []);

    useEffect(() => {
        axios.get(`/api/getUser/${userDetail}`)
            .then((response) => {
                setFname(response.data.selectedUser.first_name)
                setLname(response.data.selectedUser.last_name)
                setEmail(response.data.selectedUser.email)
                setNumber(response.data.selectedUserProfile[0].contact_no)
            })
    }, [userDetail])

    return (
        <Fragment>
            <TextField
                select
                label="Choose a User"
                defaultValue="None"
                onChange={(e) => {
                    onUserChange(e.target.value)
                    setUserDetail(e.target.value)
                }}
                fullWidth

            >
                <MenuItem value="None">-- Choose a User --</MenuItem>
                {users.map((item, index) => (
                    <MenuItem key={index} value={item.id}>
                        {`${item.first_name} ${item.last_name} - ${item.email} - ${item.is_loyal == 1 ? 'Loyal Customer' : 'Non-Loyal Customer'}`}
                    </MenuItem>
                ))}
            </TextField>
            <Typography variant="caption" className="text-gray-500">
                Note: If user is not yet registered, register <a href="/users/create" className="underline"> here</a>.
            </Typography>
            {userDetail != "None" && fname &&
                <Fragment>
                    <Typography variant="subtitle1" sx={{ mt: 3 }}>
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
                </Fragment>
            }
        </Fragment >
    )
}

export default CustomerForm;