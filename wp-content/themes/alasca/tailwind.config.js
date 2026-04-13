/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './src/**/*.css',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#1A40FF',
          hover: '#1533CC',
          light: '#4D6AFF',
        },
        dark: {
          DEFAULT: '#000000',
          card: '#1A1A1A',
          border: '#1A1A1A',
          lighter: '#111111',
        },
        danger: {
          DEFAULT: '#2D1010',
          border: '#E34F4F',
        }
      },
      fontFamily: {
        sans: ['Figtree', 'system-ui', '-apple-system', 'sans-serif'],
        heading: ['Chivo', 'system-ui', '-apple-system', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
