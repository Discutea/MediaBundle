const Encore = require('@symfony/webpack-encore');
const StyleLintPlugin = require('stylelint-webpack-plugin');

Encore
    .setOutputPath('Resources/public/')
    .enableLessLoader(function(options) {
        options.relativeUrls = true;
    })
    .setPublicPath('/public')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enablePostCssLoader(function(options) {
        options.config = {
            path: './postcss.config.js'
        };
    })
    .addEntry('js/main', [
        './assets/js/main.js'
    ])
    .addStyleEntry('css/main', [
        './assets/less/main.less'
    ])
    .addStyleEntry('css/carousel', [
        './assets/less/carousel.less'
    ])
    .addLoader(
        {
            test: /\.(eot|svg|svgz|ico|ttf)([?]?.*)$/,
            loader: 'file-loader'
        },
        {
            test: /\.woff(\?v=\d+\.\d+\.\d+)?$/,
            loader: 'url-loader?limit=10000&mimetype=application/font-woff'
        },
        {
            test: /\.woff2(\?v=\d+\.\d+\.\d+)?$/,
            loader: 'url-loader?limit=10000&mimetype=application/font-woff'
        }
    )
    .addLoader({
        enforce: 'pre',
        test: /\.jsx?$/,
        exclude: /(node_modules|var\/)/,
        loader: 'eslint-loader',
        options: {
            cache: true
        }
    })

    .addPlugin(new StyleLintPlugin({
        files: ['assets/less/**/*.less']
    }));

module.exports = Encore.getWebpackConfig();
