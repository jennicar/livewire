const { argv } = require('yargs');
const mix = require('laravel-mix');
const config = require('./webpack.config');

require('laravel-mix-criticalcss');
require('laravel-mix-eslint');

mix.webpackConfig(config);

mix
  .copy('node_modules/fg-loadcss/dist/cssrelpreload.min.js', 'public/js/cssrelpreload.min.js')
  .js('resources/js/front/global/index.js', 'public/js/global.js')
  .js('resources/js/front/navigation/index.js', 'public/js/navigation.js')
  .js('resources/js/front/sentry/index.js', 'public/js/sentry.js')
  .eslint({
    cache: true,
    formatter: require('eslint-formatter-friendly'),
    emitWarning: false,
    failOnError: true,
  })
  .sass('resources/styles/front/global/index.scss', 'public/css/global.css')
  .options({
    postCss: [
      require('autoprefixer'),
    ],
  })
  .sourceMaps('source-map')

const criticalCss = Boolean(process.env.npm_config_criticalcss);

if (mix.inProduction()) {
  if (criticalCss) {
    require('laravel-mix-criticalcss');

    mix.criticalCss({
      enabled: criticalCss,
      paths: {
        base: 'http://localhost',
        templates: './public/css-critical/',
        suffix: '-critical',
      },
      urls: [
      ],
      options: {
        minify: true,
        height: 1200,
        width: 1200,
        ignore: {
          atrule: ['@font-face'],
        },
        timeout: 600000,
      },
    });
  } else {
    // Apply UUID Version Query String (ex: global.css?id=d15ecfe222c7a35fedd3)
    mix.version();
  }
}
