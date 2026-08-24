/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/Livewire/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        red: {
          50: '#f3f5fb',
          100: '#e8ecf8',
          200: '#cdd5ef',
          300: '#aab8e4',
          400: '#778fd4',
          500: '#4968c5',
          600: '#3857b2',
          700: '#324d9f',
          800: '#2a4084',
          900: '#213369',
          950: '#152042',
        },
        primary: {
          50: '#f3f5fb',
          100: '#e8ecf8',
          200: '#cdd5ef',
          300: '#aab8e4',
          400: '#778fd4',
          500: '#4968c5',
          600: '#3857b2',
          700: '#324d9f',
          800: '#2a4084',
          900: '#213369',
          950: '#152042',
        },
        secondary: {
          50: '#fffbea',
          100: '#fef3c7',
          200: '#fde68a',
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#f59e0b',
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
          950: '#451a03',
        }
      },
    },
  },
  plugins: [],
}
