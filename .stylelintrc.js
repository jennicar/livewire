module.exports = {
  "plugins": [
    "stylelint-selector-bem-pattern",
  ],
  "extends": "stylelint-config-standard",
  "ignoreFiles" : [
    "nova-components/**",
    "vendor/**",
    "public/**",
  ],
  "rules": {
    "selector-class-pattern": null,
    "indentation": 2,
    "function-parentheses-space-inside": "never-single-line",
    "property-no-vendor-prefix": [
      true,
      {
        "ignoreProperties": [
          "box-orient",
        ]
      }
    ],
    "value-no-vendor-prefix": [
      true,
      {
        "ignoreValues": [
          "box",
        ]
      }
    ],
    "at-rule-no-unknown": [ true, {
        "ignoreAtRules": [
            "extends",
            "apply",
            "tailwind",
            "components",
            "utilities",
            "screen"
        ]
    }],
  },
  "plugin/selector-bem-pattern": {
    "componentName": "[A-Z]+",
    "componentSelectors": {
      "initial": "^\\.{componentName}(?:-[a-z]+)?$",
      "combined": "^\\.combined-{componentName}-[a-z]+$"
    },
    "utilitySelectors": "^\\.util-[a-z]+$"
  }
}
