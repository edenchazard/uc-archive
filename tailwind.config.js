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
      'uc-blue': '#5ba0d6',
      'uc-ltbrown': '#f7f4cc',
      'uc-mdbrown': '#dfd1a6',
      'uc-dkbrown': '#2e260f',
      'uc-grad-begin': '#599fd5',
      'uc-grad-end': '#abe4fe',
      'uc-glow': 'rgba(200,204,179,0.9)'
    }
  },
  plugins: [],
}

