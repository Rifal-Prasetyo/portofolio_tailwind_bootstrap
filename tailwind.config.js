/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "*.{html,php,js}",
    "admin/*.{html,php,js}",
    "app/template/*.{php. html, js}",
    "blog/*.{php,html,js}",
  ],
  theme: {
    fontFamily: {
      montserrat: ["Montserrat Alternates", "arial"],
      roboto: ["Roboto", "arial"],
    },
    extend: {},
  },
  plugins: [],
  prefix: "tw-",
  important: false,
  corePlugins: {
    preflight: false,
  },
};
