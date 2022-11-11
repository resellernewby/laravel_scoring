/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        'bg-green-100',
        'text-green-800',
        'bg-blue-100',
        'text-blue-800',
        'bg-red-100',
        'text-red-800',
        'bg-orange-100',
        'text-orange-800',
        'bg-gray-100',
        'text-gray-800',
        'sm:max-w-sm',
        'sm:max-w-md',
        'sm:max-w-md md:max-w-lg',
        'sm:max-w-md md:max-w-xl',
        'sm:max-w-md md:max-w-xl lg:max-w-2xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-4xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-6xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-7xl',
        'justify-end'
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
}
