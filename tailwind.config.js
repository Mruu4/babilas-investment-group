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
                display: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'big-navy': { DEFAULT: '#0B2340', dark: '#071A2F', light: '#102D4F' },
                'big-gold': { DEFAULT: '#D4AF37', light: '#E5C45C', dark: '#C9A227' },
                'big-black': { DEFAULT: '#0A0A0A', deep: '#050505' },
            },
            fontSize: {
                'hero-xl': ['3.25rem', { lineHeight: '1.1' }],
                'hero-sub': ['1.125rem', { lineHeight: '1.6' }],
            },
            boxShadow: {
                'navy-lg': '0 20px 60px -15px rgba(7, 26, 47, 0.5)',
                'gold': '0 10px 30px -8px rgba(201, 162, 39, 0.35)',
            },
            backgroundImage: {
                'gold-gradient': 'linear-gradient(135deg, #E5C45C 0%, #D4AF37 50%, #C9A227 100%)',
                'hero-gradient': 'linear-gradient(160deg, #071A2F 0%, #0B2340 60%, #102D4F 100%)',
            },
            keyframes: {
                'fade-in': { '0%': { opacity: 0, transform: 'translateY(8px)' }, '100%': { opacity: 1, transform: 'translateY(0)' } },
                'pulse-gold': { '0%,100%': { opacity: 1 }, '50%': { opacity: 0.4 } },
            },
            animation: {
                'fade-in': 'fade-in 0.5s ease-out',
                'pulse-gold': 'pulse-gold 2s ease-in-out infinite',
            },
        },
    },
    plugins: [forms],
};
