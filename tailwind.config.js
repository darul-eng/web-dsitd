/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Http/Livewire/**/*.php",
    "./app/View/Components/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        dsitd: {
          blue: {
            DEFAULT: '#01036f',
            dark: '#010483',
            light: '#0205a1',
          },
          teal: {
            DEFAULT: '#1acc8d',
            dark: '#17b57d',
            light: '#34e5a6',
          },
        }
      },
      fontFamily: {
        sans: ['"Open Sans"', 'sans-serif'],
        montserrat: ['Montserrat', 'sans-serif'],
        poppins: ['Poppins', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
