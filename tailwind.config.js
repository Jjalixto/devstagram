/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        //con esto entrara al archivo y buscara todos los archivos que tengan blade.php
    ],
    theme: {
        extend: {},
    },
    plugins: [],
}

