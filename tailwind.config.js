import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                typing: {
                  "0%": {
                    width: "0%",
                    visibility: "hidden"
                  },
                  "100%": {
                    width: "100%"
                  }
                },
                blink: {
                  "50%": {
                    borderColor: "transparent"
                  },
                  "100%": {
                    borderColor: "white"
                  }
                }
              },
              animation: {
                typing: "typing 2s steps(20) infinite alternate, blink .7s infinite"
              }
        },
        variants: {},
        plugins: [],
        experimental: {
          applyComplexClasses: true,
        },
        
    },
    
    plugins: [forms],
};
