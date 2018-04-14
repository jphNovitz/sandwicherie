var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
     .addStyleEntry('css/app', './assets/scss/app.scss')
     .addStyleEntry('css/sui', './node_modules/semantic-ui-css/semantic.css')
     .addStyleEntry('css/front', './assets/scss/front.scss')
     .addEntry('js/app', './assets/js/app.js')
    .addEntry('main', './assets/vue/main.js')
    //.enableVueLoader()
    .enableVueLoader(function(options) {
        // https://vue-loader.vuejs.org/en/configurations/advanced.html

        options.loaders = [ "style-loader", "css-loader", "sass-loader" ]
    })

    // uncomment if you use Sass/SCSS files
     .enableSassLoader()
   //  .enableSassLoader()
   //  .enableSassLoader()
     //.enablePostCssLoader()
    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
