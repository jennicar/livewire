const StylelintPlugin = require('stylelint-webpack-plugin');
const fs = require('fs');
const path = require('path');

// Create a file that is used by the helper method `createNonBlockingStyleLinkTag`
// to determine whether webpack-dev-server is running in hot mode or not.
class HotFlag {
  apply({ hooks }) {
    hooks.done.tap('HotFlag', stats => {
      const isHot = stats.compilation.options.devServer.hot === true;
      fs.writeFileSync(path.resolve(__dirname, 'public/hot-output.ini'), `hmr = ${isHot}`, 'utf8');
    });
  }
}

module.exports = {
  output: {
      chunkFilename: 'js/async/[name].[chunkhash].js',
  },
  plugins: [
    new StylelintPlugin(),
    new HotFlag(),
  ],
  resolve: {
    alias: {
      '@Core': path.resolve(__dirname, 'resources/js/core'),
      '@Utility$': path.resolve(__dirname, 'resources/js/core/utility'),
      '@Front': path.resolve(__dirname, 'resources/js/front'),
    },
  },
};
