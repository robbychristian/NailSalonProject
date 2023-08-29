/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'pink': '#f9e2e1',
                'dark-pink': '#f8c5c5',
                'darker-pink': '#d3587b',
                'darker-pink-90': '#d3587be6'
            }
        },
    },
    plugins: [],
};
