import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
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
