/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    colors: {
      'uc': {
        'blue': '#5ba0d6',
        'ltbrown': '#f7f4cc',
        'mdbrown': '#dfd1a6',
        'dkbrown': '#2e260f',
        'grad-begin': '#599fd5',
        'grad-end': '#abe4fe',
        'glow': 'rgba(200,204,179,0.9)'
      }
    }
  },
  plugins: [],
}

