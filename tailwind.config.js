const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    purge: {
        mode: 'all',
        preserveHtmlElements: false,
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/**/*.php',
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
            //
            indigo: colors.indigo,
        },

        screens: {
            // Un-comment 'phone' when building for Galaxy Fold and iPhone SE

            'phone': '321px',
            // => @media (min-width: 321px) { ... }

            'tablet': '640px',
            // => @media (min-width: 640px) { ... }

            'laptop': '1024px',
            // => @media (min-width: 1024px) { ... }

            'desktop': '1280px',
            // => @media (min-width: 1280px) { ... }

            // -------

            // 'ultrawide': { 'max': '1535px' },
            // // => @media (max-width: 1535px) { ... }

            // 'desktop': { 'max': '1279px' },
            // // => @media (max-width: 1279px) { ... }

            // 'laptop': { 'max': '1023px' },
            // // => @media (max-width: 1023px) { ... }

            // 'tablet': { 'max': '767px' },
            // // => @media (max-width: 767px) { ... }

            // 'phone': { 'max': '639px' },
            // // => @media (max-width: 639px) { ... }
        },

        container: {
            screens: {
                // DEFAULT: '321px',
                // => @media (min-width: 321px) { ... }

                DEFAULT: '640px',
                // => @media (min-width: 640px) { ... }

                'laptop': '1024px',
                // => @media (min-width: 1024px) { ... }

                'desktop': '1280px',
                // => @media (min-width: 1280px) { ... }
            },
        },

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-textshadow'),
    ],
};
