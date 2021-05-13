const colors = require('tailwindcss/colors')

module.exports = {
  mode: 'jit',
  darkMode: false, // or 'media' or 'class'
  purge: {
    enabled: false,
    mode: 'all',
    preserveHtmlElements: true,
    content: [
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
    ],
    options: {
      keyframes: true,
    },
  },
  theme: {
    colors: {
      primary: colors.blue[600],
      muted: colors.gray[600],
      // ---
      transparent: 'transparent',
      current: 'currentColor',
      white: colors.white,
      gray: colors.gray,
      blue: colors.blue,

    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    // require('@tailwindcss/forms'),

  ],
}