const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: { 
        extend: {
            fontFamily: {
                sans: [
                    "Poppins",
                    "Arimo",
                    "Libre Baskerville",
                    ...defaultTheme.fontFamily.sans
                ]
            },
            colors: { 
                custom_red: "#fe5454",
                custom_green: "#53dcbe",
                custom_blue: "#102343",
                main: "#CFDFEF", // light blue
                secondary: "#CCCAF0", // Perple
                tertiary: "#F7CEE2", // Rose
                forth: "#F7E3CC", // Brown
                success: "#5D8233",
                error: "#D54C4C",
                "bg-color": "#fffAe6",
            },
            maxHeight: {
                "1/3": "33.333334%",
                "1/2": "50%",
                "2/3": "66.666667%"
            }
        }
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
