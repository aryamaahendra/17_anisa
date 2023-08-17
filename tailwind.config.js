/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            width: {
                filepond2: "calc(50% - 0.5em)",
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["cmyk"],
    },
};
