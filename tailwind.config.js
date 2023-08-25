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
        themes: [
            "corporate",
            {
                mytheme: {
                    primary: "#2563eb",
                    secondary: "#f97316",
                    accent: "#14b8a6",
                    neutral: "#6b7280",
                    "base-100": "#f3f4f6",
                    info: "#0ea5e9",
                    success: "#4ade80",
                    warning: "#facc15",
                    error: "#e11d48",
                },
            },
        ],
    },
};
