const tailwindLabels = require('./labels');
const scales = require('./scales');

class Scale {
  #scale;
  #accuracy;
  #classPrefix;
  constructor(scale = 'goldenSection', classPrefix = '', accuracy = 3) {
    this.#scale = scale;
    this.#accuracy = accuracy;
    this.#classPrefix = classPrefix;
  }

  value(n = 1, units) {
    return units ? `${modularScale(n, this.#scale).toFixed(this.#accuracy)}${units}` : modularScale(n, this.#scale);
  }

  rem(n = 1) {
    return this.value(n, 'rem');
  }

  em(n = 1) {
    return this.value(n, 'em');
  }

  scale(units, labels = tailwindLabels, start = -2) {
    const scale = {};
    for (let i = start; i < labels.length - Math.abs(start); i += 1) {
      scale[this.#classPrefix + labels[i + Math.abs(start)]] = this.value(i, units);
    }

    return scale;
  }
}

function modularScale(v = 1, s = 'goldenSection') {
  return scales[s] ** v;
}

module.exports = Scale;
