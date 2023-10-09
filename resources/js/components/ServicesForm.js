import { Card, CardContent, FormControl, FormControlLabel, Grid, InputAdornment, Radio, RadioGroup, TextField, Typography } from "@mui/material";
import React, { Fragment, useEffect, useState } from "react";
import { styled } from "@mui/material/styles";
import Paper from "@mui/material/Paper";
import MenuItem from "@mui/material/MenuItem";
import axios from "axios";

const ServicesForm = ({ onService1Change, onService2Change, onService3Change, onAddOn1Change, onAddOn2Change, onAddOn3Change, onPriceChange }) => {
    const [products, setProducts] = useState([]);
    const [addOns, setAddOns] = useState([]);
    const [packages, setPackages] = useState([]);
    const [selectedPrice1, setSelectedPrice1] = useState("");
    const [selectedPrice2, setSelectedPrice2] = useState("");
    const [selectedPrice3, setSelectedPrice3] = useState("");
    const [totalPrice, setTotalPrice] = useState(0);

    const [hasAddons1, setHasAddons1] = useState(false);
    const [hasAddons2, setHasAddons2] = useState(false);
    const [hasAddons3, setHasAddons3] = useState(false);

    const [selectedProduct1, setSelectedProduct1] = useState(null);
    const [selectedProduct2, setSelectedProduct2] = useState(null);
    const [selectedProduct3, setSelectedProduct3] = useState(null);

    // const [selectedAddonId1,  setSelectedAddonId1] = useState("");
    // const [selectedAddonId2, setSelectedAddonId2] = useState("");
    // const [selectedAddonId3, setSelectedAddonId3] = useState("");

    const [selectedAddonPrice1, setSelectedAddonPrice1] = useState(0);
    const [selectedAddonPrice2, setSelectedAddonPrice2] = useState(0);
    const [selectedAddonPrice3, setSelectedAddonPrice3] = useState(0);

    const Item = styled(Paper)(({ theme }) => ({
        backgroundColor: "#fff",
        ...theme.typography.body2,
        padding: theme.spacing(1),
        color: theme.palette.text.secondary,
    }));

    useEffect(() => {
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

    const [servicesMenu, setServicesMenu] = useState([]);
    const [productsMenu, setProductsMenu] = useState([]);
    const [productAddOnsMenu, setProductAddOnsMenu] = useState([]);
    const [packagesMenu, setPackagesMenu] = useState([]);

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
            })
    }, []);

    useEffect(() => {
        const price1 = parseFloat(selectedPrice1) || 0;
        const price2 = parseFloat(selectedPrice2) || 0;
        const price3 = parseFloat(selectedPrice3) || 0;

        if (!hasAddons1 || !selectedProduct1) {
            setSelectedAddonPrice1(0)
        }

        if (!hasAddons2 || !selectedProduct2) {
            setSelectedAddonPrice2(0)
        }

        if (!hasAddons3 || !selectedProduct3) {
            setSelectedAddonPrice2(0)
        }

        const addonPrice1 = parseFloat(selectedAddonPrice1) || 0;
        const addonPrice2 = parseFloat(selectedAddonPrice2) || 0;
        const addonPrice3 = parseFloat(selectedAddonPrice3) || 0;


        const newTotalPrice = price1 + price2 + price3 + addonPrice1 + addonPrice2 + addonPrice3
        console.log(`ito yung prices 1 ${price1}`)
        console.log(`ito yung prices 2 ${price2}`)
        console.log(`ito yung prices 3 ${price3}`)
        console.log(`ito yung prices add1 ${addonPrice1}`)
        console.log(`ito yung prices add2 ${addonPrice2}`)
        console.log(`ito yung prices add3 ${addonPrice3}`)
        setTotalPrice(newTotalPrice);
        onPriceChange(newTotalPrice);
    }, [selectedPrice1, selectedPrice2, selectedPrice3, selectedAddonPrice1, selectedAddonPrice2, selectedAddonPrice3]);

    const addonsMap = {};

    for (const addon of addOns) {
        addonsMap[addon.product_id] = true;
    }

    return (
        <Fragment>
            <Grid container spacing={2}>
                <Grid item xs={6}>
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
                <Grid item xs={6}>
                    <TextField
                        fullWidth
                        label="Choose a Service"
                        select
                        defaultValue=""
                        onChange={(e) => {
                            onService1Change(e.target.value);
                            const selectedProduct = products.find((item) => item.product_name === e.target.value);
                            const selectedPackage = packages.find((data) => data.package_name === e.target.value);
                            const selectedPrice = selectedProduct ? selectedProduct.price : (selectedPackage ? selectedPackage.price : "");
                            setSelectedPrice1(selectedPrice);

                            const hasAddons = selectedProduct ? selectedProduct.id in addonsMap : false;
                            setHasAddons1(hasAddons);
                            setSelectedProduct1(selectedProduct);

                        }}
                    >
                        {products.map((item, index) => (
                            <MenuItem key={index} value={item.product_name}>{item.product_name} - ₱{item.price}</MenuItem>
                        ))}
                        {packages.map((data, index1) => (
                            <MenuItem key={index1} value={data.package_name}>{data.package_name} - ₱{data.price}</MenuItem>
                        ))}
                    </TextField >
                    {hasAddons1 && selectedProduct1 && (
                        <FormControl>
                            <RadioGroup
                                row
                                aria-label="addons"
                                name="addons"
                                onChange={(e) => {
                                    const addonId = e.target.value;
                                    onAddOn1Change(addonId);
                                    const selectedAddOn1 = addOns.find((item) => item.id == addonId);
                                    const addonPrice1 = selectedAddOn1.additional_price
                                    setSelectedAddonPrice1(addonPrice1);
                                    // console.log(`ito yung addon ${addonPrice1}`)
                                }}
                            >
                                {addOns
                                    .filter((addon) => addon.product_id === selectedProduct1.id)
                                    .map((addon, index) => (
                                        <FormControlLabel
                                            name="productAddOns"
                                            key={index}
                                            value={addon.id}
                                            control={<Radio />}
                                            label={`${addon.additional} - ₱${addon.additional_price}`}
                                        />
                                    ))}
                            </RadioGroup>
                        </FormControl>
                    )}
                    <TextField
                        sx={{ mt: 1.5 }}
                        fullWidth
                        label="Choose a Service"
                        select
                        defaultValue="None"
                        onChange={(e) => {
                            onService2Change(e.target.value);
                            const selectedProduct = products.find((item) => item.product_name === e.target.value);
                            const selectedPackage = packages.find((data) => data.package_name === e.target.value);
                            const selectedPrice = selectedProduct ? selectedProduct.price : (selectedPackage ? selectedPackage.price : "");
                            setSelectedPrice2(selectedPrice);

                            const hasAddons = selectedProduct ? selectedProduct.id in addonsMap : false;
                            setHasAddons2(hasAddons);
                            setSelectedProduct2(selectedProduct);

                        }}
                    >
                        <MenuItem value="None">-- None --</MenuItem>
                        {products.map((item, index) => (
                            <MenuItem key={index} value={item.product_name}>{item.product_name} - ₱{item.price}</MenuItem>
                        ))}
                        {packages.map((data, index1) => (
                            <MenuItem key={index1} value={data.package_name}>{data.package_name} - ₱{data.price}</MenuItem>
                        ))}
                    </TextField >
                    {hasAddons2 && selectedProduct2 && (
                        <FormControl>
                            <RadioGroup
                                row
                                aria-label="addons"
                                name="addons"
                                onChange={(e) => {
                                    const addonId = e.target.value;
                                    onAddOn2Change(addonId);

                                    const selectedAddOn2 = addOns.find((item) => item.id == addonId);
                                    const addonPrice2 = selectedAddOn2.additional_price
                                    setSelectedAddonPrice2(addonPrice2);
                                }}
                            >
                                {addOns
                                    .filter((addon) => addon.product_id === selectedProduct2.id)
                                    .map((addon, index) => (
                                        <FormControlLabel
                                            name="productAddOns"
                                            key={index}
                                            value={addon.id}
                                            control={<Radio />}
                                            label={`${addon.additional} - ₱${addon.additional_price}`}
                                        />
                                    ))}
                            </RadioGroup>
                        </FormControl>
                    )}


                    <TextField
                        sx={{ mt: 1.5 }}
                        fullWidth
                        label="Choose a Service"
                        select
                        defaultValue="None"
                        onChange={(e) => {
                            onService3Change(e.target.value);
                            const selectedProduct = products.find((item) => item.product_name === e.target.value);
                            const selectedPackage = packages.find((data) => data.package_name === e.target.value);
                            const selectedPrice = selectedProduct ? selectedProduct.price : (selectedPackage ? selectedPackage.price : "");
                            setSelectedPrice3(selectedPrice);

                            const hasAddons = selectedProduct ? selectedProduct.id in addonsMap : false;
                            setHasAddons3(hasAddons);
                            setSelectedProduct3(selectedProduct);
                        }}
                    >
                        <MenuItem value="None">-- None --</MenuItem>
                        {products.map((item, index) => (
                            <MenuItem key={index} value={item.product_name}>{item.product_name} - ₱{item.price}</MenuItem>
                        ))}
                        {packages.map((data, index1) => (
                            <MenuItem key={index1} value={data.package_name}>{data.package_name} - ₱{data.price}</MenuItem>
                        ))}
                    </TextField >
                    {hasAddons3 && selectedProduct3 && (
                        <FormControl>
                            <RadioGroup
                                row
                                aria-label="addons"
                                name="addons"
                                onChange={(e) => {
                                    const addonId = e.target.value;
                                    onAddOn3Change(addonId);
                                    const selectedAddOn3 = addOns.find((item) => item.id == addonId);
                                    const addonPrice3 = selectedAddOn3.additional_price
                                    setSelectedAddonPrice3(addonPrice3);
                                }}
                            >
                                {addOns
                                    .filter((addon) => addon.product_id === selectedProduct3.id)
                                    .map((addon, index) => (
                                        <FormControlLabel
                                            name="productAddOns"
                                            key={index}
                                            value={addon.id}
                                            control={<Radio />}
                                            label={`${addon.additional} - ₱${addon.additional_price}`}
                                        />
                                    ))}
                            </RadioGroup>
                        </FormControl>
                    )}

                    <TextField
                        sx={{ mt: 1.5 }}
                        id="input-with-icon-textfield"
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
                        value={totalPrice}
                    />
                </Grid>
            </Grid >
        </Fragment >
    )
}

export default ServicesForm;
