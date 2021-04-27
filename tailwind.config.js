const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    // important: true,
    purge: {
        mode: 'all',
        preserveHtmlElements: false,
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/**/*.php',
            './resources/js/app.js',
        ],
        options: {
            keyframes: true,
        },
    },

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            red: colors.red,
            blue: colors.blue,
            green: colors.green,
            yellow: colors.yellow,
        },

        fontSize: {
            '2xs': '.60rem',
            'xs': '.75rem',
            'sm': '.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
        },

        // screens: {
        //     'phone': '321px',
        //     // => @media (min-width: 321px) { ... }

        //     'tablet': '640px',
        //     // => @media (min-width: 640px) { ... }

        //     'laptop': '1024px',
        //     // => @media (min-width: 1024px) { ... }

        //     'desktop': '1280px',
        //     // => @media (min-width: 1280px) { ... }
        // },

        // container: {
        //     screens: {
        //         // DEFAULT: '321px',
        //         // => @media (min-width: 321px) { ... }

        //         DEFAULT: '640px',
        //         // => @media (min-width: 640px) { ... }

        //         'laptop': '1024px',
        //         // => @media (min-width: 1024px) { ... }

        //         'desktop': '1280px',
        //         // => @media (min-width: 1280px) { ... }
        //     },
        // },

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            //
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
        require('tailwindcss-textshadow'),
    ],
};
