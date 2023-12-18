module.exports = {
  extends: ['airbnb-base', 'eslint:recommended', 'problems'],
  env: {
    es6: true,
    browser: true,
  },
  parser: 'babel-eslint',
  parserOptions: {
    ecmaVersion: 2019,
    sourceType: 'module',
  },
  plugins: [
    'compat',
    'import',
  ],
  settings: {
    polyfills: ['IntersectionObserver', 'Object.assign', 'window.requestIdleCallback'],
    'import/resolver': {
      webpack: {
        config: 'webpack.config.js',
      },
    },
  },
  rules: {
    indent: ['warn', 2],
    'linebreak-style': ['error', 'unix'],
    'lines-between-class-members': ['warn', 'always', { exceptAfterSingleLine: true }],
    quotes: ['error', 'single'],
    semi: ['error', 'always'],
    'no-return-assign': 'off',
    'no-console': 'off',
    'no-extra-semi': 'warn',
    'no-underscore-dangle': ['error', { allowAfterThis: true }],
    'no-unused-vars': 'warn',
    'no-multiple-empty-lines': 'warn',
    'space-before-function-paren': 'off',
    'arrow-parens': 'off',
    'comma-dangle': ['warn', 'always-multiline'],
    'compat/compat': 'error',
    'max-len': ['error', { code: 140 }],
  },
  ignorePatterns: ['nova-components', 'webpack.*.js'],
};
