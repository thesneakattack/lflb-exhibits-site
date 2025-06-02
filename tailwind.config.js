import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import preset from "./vendor/filament/support/tailwind.config.preset";
import fs from "fs";
import path from "path";

const themeFilePath = path.resolve(__dirname, "theme.json");
const activeTheme = fs.existsSync(themeFilePath) ? JSON.parse(fs.readFileSync(themeFilePath, "utf8")).name : "anchor";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/views/components/**/*.blade.php",
        "./resources/views/components/blade.php",
        "./wave/resources/views/**/*.blade.php",
        "./resources/themes/" + activeTheme + "/**/*.blade.php",
        "./resources/plugins/**/*.php",
        "./config/*.php",
    ],

    theme: {
        extend: {
            animation: {
                marquee: "marquee 25s linear infinite",
            },
            keyframes: {
                marquee: {
                    from: { transform: "translateX(0)" },
                    to: { transform: "translateX(-100%)" },
                },
            },
            colors: {
                lfnavy: {
                    50: "#F1F5F9",
                    100: "#E2E8F0",
                    200: "#CBD5E1",
                    300: "#94A3B8",
                    400: "#64748B",
                    500: "#1C2F5F", // your “base” navy
                    600: "#16254E",
                    700: "#0F1A3A",
                    800: "#0A1228",
                    900: "#050915",
                },
            },
        },
    },

    plugins: [forms, require("@tailwindcss/typography")],
};
