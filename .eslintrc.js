// npm install -g eslint eslint-plugin-vue@beta
// eslint . --ext .js,.vue --fix
// https://eslint.org/docs/rules/

module.exports = {
    'env': {
        'browser': true,
        'es6': true,
        'jquery': true,
        'node': true,
    },
    'extends': [
        'eslint:recommended',
        'plugin:vue/recommended',
    ],
    'parserOptions': {
        'sourceType': 'module',
    },
    'globals': {
        '_': false,
    },
    'rules': {
        'array-bracket-spacing': [
            'error',
            'never',
        ],
        'brace-style': [
            'error',
            '1tbs',
            { 'allowSingleLine': true },
        ],
        'camelcase': [
            'warn',
        ],
        'comma-dangle': [
            'error',
            'always-multiline',
        ],
        'comma-spacing': [
            'error',
        ],
        'computed-property-spacing': [
            'error',
        ],
        'eqeqeq': [
            'error',
        ],
        'func-name-matching': [
            'error',
        ],
        'function-paren-newline': [
            'error',
            'consistent',
        ],
        'indent': [
            'error',
            4,
        ],
        'linebreak-style': [
            'error',
            'unix',
        ],
        'no-extra-parens': [
            'error',
            'all',
        ],
        'no-tabs': [
            'error',
        ],
        'no-trailing-spaces': [
            'error',
        ],
        'quotes': [
            'error',
            'single',
        ],
        'semi': [
            'error',
            'always',
            { 'omitLastInOneLineBlock': true },
        ],
        // VueJS
        'vue/html-indent': [
            'error',
            4,
        ],
        'vue/max-attributes-per-line': [
            'error',
            { 'singleline': 10 },
        ],
    }
};
