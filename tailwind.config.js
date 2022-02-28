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
                main: "#cfdfef",
                secondary: "#cccaf0",
                tertiary: "#f7cee2",
                success: "#FDC910",
                error: "#FDC910",
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
