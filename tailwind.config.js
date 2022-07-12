const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        fontFamily: {
            "gilroy-700": ['Gilroy-Bold', 'sans-serif'],
            "gilroy-400": ['Gilroy-Regular', 'sans-serif'],
            "gilroy-600": ['Gilroy-SemiBold', 'sans-serif'],
            "gilroy-500": ['Gilroy-Medium', 'sans-serif'],
            "gilroy-300": ['Gilroy-Light', 'sans-serif'],
            "gochi": ['Gochi Hand', 'cursive', 'sans-serif'],
            "montserrat": ['Montserrat', 'sans-serif'],
            "nunito": ['Nunito', 'sans-serif'],
            "inter": ['Inter', 'sans-serif'],

        },
        fontSize: {
            12: ['12px', '15px'],
            14: ['14px', '18px'],
            16: ['16px', '20px'],
            18: ['18px', '22px'],
            20: ['20px', '24px'],
            22: ['22px', '26px'],
            24: ['24px', '30px'],
            26: ['26px', '32px'],
            28: ['28px', '34px'],
            30: ['30px', '36px'],
            32: ['32px', '40px'],
            36: ['36px', '44px'],
            48: ['48px', '56px'],
        },
        extend: {
            // fontFamily: {
            //     sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            // },

            boxShadow: {
                'form': '0px 4px 10px 3px rgba(0, 0, 0, 0.11)',
                'card': '0px 2px 1px rgba(0, 0, 0, 0.14)',
                'img': '0px 0px 5px 3px rgba(0, 0, 0, 0.14)',
                'card-active': '0px 10px 30px rgba(0, 0, 0, 0.15), 0px 2px 1px rgba(0, 0, 0, 0.14)',
            },
            flex: {
                '25': '0 1 25%',
                '34': '0 1 34%',
                '41': '0 1 41%',
                '50': '0 1 50%',
            },
            flexBasis: {
                '48': '48%',
                '32': '32%',
                '24': '24%',
                '75': '75%',
            },
            screens: {
                'mobile-m': '350px',
                'mobile-l': '425px',
                'mobile-xl': '640px',
                'laptop': '1024px',
            },
            colors: {
                'blue': '#405FD4',
            },
            rotate: {
                '225': '225deg',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
