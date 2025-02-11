import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		 './storage/framework/views/*.php',
		 './resources/views/**/*.blade.php',
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
        "./resources/views/Livewire/**/*.blade.php",
	],

    theme: {

        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('daisyui'),
	],
    daisyui: {
        styled: true,
        themes: [
            {
                jjl: {
                    "primary": "#2A6F46",
                    "secondary": "#d1d5db",
                    "accent": "#fffF00",
                    "neutral": "#1f2937",
                    "base-100": "#ffffff",
                    "info": "#607D8B",
                    "success": "#2a6f46",
                    "warning": "#d97706",
                    "error": "#be123c"
                }
            },
            'dark',
        ],
        base: true,
        utils: true,
        logs: true,
        rtl: false,
    },
};
