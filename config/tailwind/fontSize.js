const Scale = require('./helpers/modularScale');

module.exports = {
  desktopScale: new Scale('majorThird', 'md').scale('em'),
  mobileScale: new Scale('majorSecond').scale('em'),
};
