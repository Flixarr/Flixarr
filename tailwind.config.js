const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin')

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      primary: colors.blue,

      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      red: colors.red,
      blue: colors.blue,
      green: colors.green,
    },
    extend: {}
  },
  variants: {
    extend: {
      backgroundColor: ['active', 'hover'],
      textColor: ['active', 'hover'],
    }
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/forms'),
    plugin(function ({ addUtilities }) {
      const newUtilities = {
        '.safe-top': {
          paddingTop: 'constant(safe-area-inset-top)',
          paddingTop: 'env(safe-area-inset-top)'
        },
        '.safe-bottom': {
          paddingBottom: 'constant(safe-area-inset-bottom)',
          paddingBottom: 'env(safe-area-inset-bottom)'
        },
        '.safe-y': {
          paddingTop: 'constant(safe-area-inset-top)',
          paddingTop: 'env(safe-area-inset-top)',
          paddingBottom: 'constant(safe-area-inset-bottom)',
          paddingBottom: 'env(safe-area-inset-bottom)'

        },
        '.safe-left': {
          paddingLeft: 'constant(safe-area-inset-left)',
          paddingLeft: 'env(safe-area-inset-left)'
        },
        '.safe-right': {
          paddingRight: 'constant(safe-area-inset-right)',
          paddingRight: 'env(safe-area-inset-right)'
        },
        '.safe-x': {
          paddingLeft: 'constant(safe-area-inset-left)',
          paddingLeft: 'env(safe-area-inset-left)',
          paddingRight: 'constant(safe-area-inset-right)',
          paddingRight: 'env(safe-area-inset-right)'
        },

      }

      addUtilities(newUtilities);
    })
  ],
}
