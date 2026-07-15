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
            },
            colors: {
                primary: {
                    50:  '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                accent: {
                    50:  '#f0fdfa',
                    100: '#ccfbf1',
                    200: '#99f6e4',
                    300: '#5eead4',
                    400: '#2dd4bf',
                    500: '#14b8a6',
                    600: '#0d9488',
                    700: '#0f766e',
                    800: '#115e59',
                    900: '#134e4a',
                },
                forest: {
                    50:  '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                leaf: {
                    50:  '#f7fee7',
                    100: '#ecfccb',
                    200: '#d9f99d',
                    300: '#bef264',
                    400: '#a3e635',
                    500: '#84cc16',
                    600: '#65a30d',
                    700: '#4d7c0f',
                    800: '#3f6212',
                    900: '#365314',
                },
            },
            borderRadius: {
                '4xl': '2rem',
            },
            boxShadow: {
                'eco': '0 4px 14px 0 rgba(34, 197, 94, 0.15)',
                'eco-lg': '0 10px 40px -10px rgba(34, 197, 94, 0.25)',
                'eco-xl': '0 20px 60px -15px rgba(34, 197, 94, 0.2)',
            },
        },
    },
    plugins: [forms],
};