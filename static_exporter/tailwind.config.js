import defaultTheme from 'tailwindcss/defaultTheme.js';
import forms from '@tailwindcss/forms';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        path.resolve(__dirname, '../resources/views/**/*.blade.php'),
        path.resolve(__dirname, '../resources/js/**/*.js'),
        path.resolve(__dirname, 'dist/**/*.html'),
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['"Anton"', ...defaultTheme.fontFamily.sans],
                body: ['"Inter"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ink: '#05070f',
                navy: {
                    950: '#040a18',
                    900: '#081029',
                    800: '#0c1a3e',
                    700: '#122756',
                    600: '#1a3574',
                },
            },
            boxShadow: {
                glow: '0 0 60px -15px rgba(59,130,246,0.55)',
            },
        },
    },

    plugins: [forms],
};
