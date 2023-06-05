const mix = require('laravel-mix')

require('./nova.mix')

mix.setPublicPath('dist')
    .js('resources/js/tool.js', 'js')
    .sass('resources/sass/tool.scss', 'css')
    .vue({version: 3})
    .nova('mostafaznv/nova-laracache')

if (mix.inProduction()) {
    mix.version()
}
