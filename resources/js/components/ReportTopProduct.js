import React, { useEffect, useState, Fragment } from "react";
import ReactDOM from "react-dom";
import {
    Card,
    CardContent,
    FormControl,
    FormControlLabel,
    Grid,
    InputAdornment,
    MenuItem,
    Radio,
    RadioGroup,
    TextField,
    Typography,
} from "@mui/material";
import { Bar } from "react-chartjs-2";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
} from "chart.js";
import axios from "axios";

ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend
);

const ReportTopProduct = (props) => {
    const currentMonth = new Date().getMonth() + 1; // JavaScript months are 0-indexed
    const formattedMonth =
        currentMonth < 10 ? `0${currentMonth}` : `${currentMonth}`;

    const [month, setMonth] = useState(formattedMonth);
    const [year, setYear] = useState(new Date().getFullYear());
    const [topProducts, setTopProducts] = useState([]);

    useEffect(() => {
        axios
            .get(`/api/getTopAvailedProducts/${month}/${year}`)
            .then((response) => {
                setTopProducts(response.data.topProducts);
            });
    }, [month, year]);

    const [monthPackage, setMonthPackage] = useState(formattedMonth);
    const [yearPackage, setYearPackage] = useState(new Date().getFullYear());
    const [topPackages, setTopPackages] = useState([]);

    useEffect(() => {
        axios
            .get(`/api/getTopAvailedPackages/${monthPackage}/${yearPackage}`)
            .then((response) => {
                setTopPackages(response.data.topPackages);
            });
    }, [monthPackage, yearPackage]);

    return (
        <Fragment>
            <div className="mt-4">
                <div className="grid grid-cols-12 gap-10">
                    <div className="col-span-12 xl:col-span-6">
                        <div className="px-5 py-6 shadow-lg rounded bg-white h-full">
                            <div className="flex justify-between items-center mt-4">
                                <h4 className="text-2xl font-semibold text-gray-700">
                                    Top 10 Availed Products
                                </h4>
                                <div>
                                    <TextField
                                        label="Month"
                                        sx={{
                                            width: "150px",
                                            marginRight: "1rem",
                                        }}
                                        select
                                        value={month}
                                        onChange={(e) =>
                                            setMonth(e.target.value)
                                        }
                                    >
                                        <MenuItem value="01">January</MenuItem>
                                        <MenuItem value="02">February</MenuItem>
                                        <MenuItem value="03">March</MenuItem>
                                        <MenuItem value="04">April</MenuItem>
                                        <MenuItem value="05">May</MenuItem>
                                        <MenuItem value="06">June</MenuItem>
                                        <MenuItem value="07">July</MenuItem>
                                        <MenuItem value="08">August</MenuItem>
                                        <MenuItem value="09">
                                            September
                                        </MenuItem>
                                        <MenuItem value="10">October</MenuItem>
                                        <MenuItem value="11">November</MenuItem>
                                        <MenuItem value="12">December</MenuItem>
                                    </TextField>

                                    <TextField
                                        label="Year"
                                        sx={{ width: "100px" }}
                                        select
                                        value={year}
                                        onChange={(e) =>
                                            setYear(e.target.value)
                                        }
                                    >
                                        <MenuItem value="2023">2023</MenuItem>
                                        <MenuItem value="2024">2024</MenuItem>
                                        <MenuItem value="2025">2025</MenuItem>
                                    </TextField>
                                </div>
                            </div>

                            <div className="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                <table className="w-full text-sm text-left text-gray-900">
                                    <thead className="text-xs text-gray-700 uppercase bg-dark-pink">
                                        <tr>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                #
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                Name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {topProducts.length > 0 ? (
                                            <>
                                                {topProducts.map(
                                                    (product, index) => (
                                                        <tr className="bg-white border-b">
                                                            <th
                                                                scope="row"
                                                                className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                                            >
                                                                {index + 1}
                                                            </th>
                                                            <td className="px-6 py-4">
                                                                {
                                                                    product.product_name
                                                                }
                                                            </td>
                                                        </tr>
                                                    )
                                                )}
                                            </>
                                        ) : (
                                            <tr>
                                                <td
                                                    className="px-6 py-4 text-center"
                                                    colspan="2"
                                                >
                                                    There are no data available.
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div className="col-span-12 xl:col-span-6">
                        <div className="px-5 py-6 shadow-lg rounded bg-white h-full">
                            <div className="flex justify-between items-center mt-4">
                                <h4 className="text-2xl font-semibold text-gray-700">
                                    Top 10 Availed Packages
                                </h4>
                                <div>
                                    <TextField
                                        label="Month"
                                        sx={{
                                            width: "150px",
                                            marginRight: "1rem",
                                        }}
                                        select
                                        value={monthPackage}
                                        onChange={(e) =>
                                            setMonthPackage(e.target.value)
                                        }
                                    >
                                        <MenuItem value="01">January</MenuItem>
                                        <MenuItem value="02">February</MenuItem>
                                        <MenuItem value="03">March</MenuItem>
                                        <MenuItem value="04">April</MenuItem>
                                        <MenuItem value="05">May</MenuItem>
                                        <MenuItem value="06">June</MenuItem>
                                        <MenuItem value="07">July</MenuItem>
                                        <MenuItem value="08">August</MenuItem>
                                        <MenuItem value="09">
                                            September
                                        </MenuItem>
                                        <MenuItem value="10">October</MenuItem>
                                        <MenuItem value="11">November</MenuItem>
                                        <MenuItem value="12">December</MenuItem>
                                    </TextField>

                                    <TextField
                                        label="Year"
                                        sx={{ width: "100px" }}
                                        select
                                        value={yearPackage}
                                        onChange={(e) =>
                                            setYearPackage(e.target.value)
                                        }
                                    >
                                        <MenuItem value="2023">2023</MenuItem>
                                        <MenuItem value="2024">2024</MenuItem>
                                        <MenuItem value="2025">2025</MenuItem>
                                    </TextField>
                                </div>
                            </div>

                            <div className="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                                <table className="w-full text-sm text-left text-gray-900">
                                    <thead className="text-xs text-gray-700 uppercase bg-dark-pink">
                                        <tr>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                #
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3"
                                            >
                                                Name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {topPackages.length > 0 ? (
                                            <>
                                                {topPackages.map(
                                                    (item, index) => (
                                                        <tr className="bg-white border-b">
                                                            <th
                                                                scope="row"
                                                                className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                                            >
                                                                {index + 1}
                                                            </th>
                                                            <td className="px-6 py-4">
                                                                {
                                                                    item.package_name
                                                                }
                                                            </td>
                                                        </tr>
                                                    )
                                                )}
                                            </>
                                        ) : (
                                            <tr>
                                                <td
                                                    className="px-6 py-4 text-center"
                                                    colspan="2"
                                                >
                                                    There are no data available.
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Fragment>
    );
};

export default ReportTopProduct;

if (document.getElementById("sales-top-product")) {
    // const element = document.getElementById('sales-top-product')
    // const props = Object.assign({}, element.dataset)
    ReactDOM.render(
        <ReportTopProduct />,
        document.getElementById("sales-top-product")
    );
}
