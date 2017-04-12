module.exports = {
    "env": {
        "browser": true,
        "es6": true,
        "commonjs": true,
        "atomtest": true,
    },
    "plugins": [
        "vue"
    ],
    "extends": ["eslint:recommended"],
    "parserOptions": {
        "sourceType": "module"
    },
    "globals":{
        "window": true,
        "vue": true,
        "app": true,
        "axios": true,
    },
    "rules": {
        "indent": [
            "error",
            4
        ],
        "linebreak-style": [
            "error",
            "unix"
        ],
        "quotes": [
            "error",
            "double"
        ],
        "semi": [
            "error",
            "always"
        ],
        "no-console" : 0,
        "no-unused-vars" : [
            "error", {
                "varsIgnorePattern": "app"
            }
        ],
    }
};
