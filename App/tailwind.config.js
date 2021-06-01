const colors = require('tailwindcss/colors')

module.exports = {
  // mode: 'jit',
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
      primary: colors.orange[600],
      muted: colors.gray[600],
      // ---
      transparent: 'transparent',
      current: 'currentColor',
      black: '#000',
      white: '#FFF',
      gray: colors.gray,
      red: colors.red,
      blue: colors.blue,
      green: colors.green,
      yellow: colors.yellow
    },
    extend: {
      maxHeight: {
        '3/4': '75%',
      }
    },
  },
  variants: {
    extend: {
      opacity: ['disabled'],
      cursor: ['disabled'],
    }
  },
  plugins: [
    require('@tailwindcss/forms'),

  ],
}