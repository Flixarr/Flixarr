const mix = require('laravel-mix')

mix.disableNotifications()

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ])

mix.browserSync({
    proxy: "http://localhost:8000",
    notify: false
})

