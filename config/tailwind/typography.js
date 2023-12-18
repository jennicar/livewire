module.exports = theme => ({
  DEFAULT: {
    css: {
      color: theme('colors.black'),
      fontSize: theme('fontSize.base'),
      h1: {
        fontSize: theme('fontSize.4xl'),
        fontWeight: '800',
      },
      h2: {
        fontSize: theme('fontSize.3xl'),
        fontWeight: '700',
      },
      h3: {
        fontSize: theme('fontSize.2xl'),
        fontWeight: '600',
      },
      h4: {
        fontSize: theme('fontSize.xl'),
        fontWeight: '600',
      },
    },
  },
  md: {
    css: {
      color: theme('colors.black'),
      fontSize: theme('fontSize.mdbase'),
      h1: {
        fontSize: theme('fontSize.md4xl'),
        fontWeight: '800',
      },
      h2: {
        fontSize: theme('fontSize.md3xl'),
        fontWeight: '700',
      },
      h3: {
        fontSize: theme('fontSize.md2xl'),
        fontWeight: '600',
      },
      h4: {
        fontSize: theme('fontSize.mdxl'),
        fontWeight: '600',
      },
    },
  },
});
