var Encore = require('@symfony/webpack-encore');
var UglifyJSPlugin = require('uglifyjs-webpack-plugin');

Encore
    //.createSharedEntry('vendor', ['babel-polyfill'])
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
     .addStyleEntry('css/sui', './assets/semantic/dist/semantic.min.css')
     //.addStyleEntry('css/sui', './node_modules/semantic-ui-css/semantic.css')
     .addStyleEntry('css/front', './assets/scss/front.scss')
     .addStyleEntry('css/back', './assets/scss/back.scss')
     .addStyleEntry('css/security', './assets/scss/security.scss')
     .addEntry('js/sui', './assets/semantic/dist/semantic.js')
     .addEntry('js/vue', './assets/js/vue.js')
     .addEntry('js/app', './assets/js/app.js')
     .addEntry('js/ingredient-add', './assets/js/ingredient-add.js')
     .addEntry('main', './assets/vue/main.js')
     .addEntry('dashboard', './assets/dashboard/main.js')
    //.enableVueLoader()
    .enableVueLoader(function(options) {
        // https://vue-loader.vuejs.org/en/configurations/advanced.html

        options.loaders = [ "style-loader", "css-loader", "sass-loader", "file-loader", "url-loader" ]
    })

    // uncomment if you use Sass/SCSS files
     .enableSassLoader()
   //  .enableSassLoader()
   //  .enableSassLoader()
     //.enablePostCssLoader()
    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()

  /*  .configureBabel(function(babelConfig) {
         //add additional presets
         babelConfig.presets.push('es2017');
    })*/
/*    .configureUglifyJsPlugin(function(options){
        options = {
            cache: false,
            parallel: false,
            uglifyOptions: {
                compress: false,
                ecma: 2017,
                mangle: false
            },
            sourceMap: false
        }
    })*/
    .isProduction(true)
;

/*if (Encore.isProduction()) {
    for (const plugin of Encore.getWebpackConfig()) {
        if (plugin instanceof webpack.optimize.UglifyJsPlugin) {
            plugin.options.mangle = false;
        }
    }
}*/

const config = Encore.getWebpackConfig();
for (const rule of config.module.rules) {
    if (rule.use){
        for (loader of rule.use){
            (loader.loader === 'babel-loader')
            {
                delete rule.exclude;
            }

            }
        }
}

module.exports = config;