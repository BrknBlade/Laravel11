module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: ['eslint: recommended', 'prettier'],
    overrides: [
        {
            env: {
                node: true,
            },
            parserOptions: {
                sourceType: 'script',
            },
        },
    ],
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
    },
    rules: {},
}
