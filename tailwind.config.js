let plugin = require("tailwindcss/plugin");
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("flowbite/plugin")],
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    plugins: [
        plugin(function ({ addVariant }) {
            addVariant("current", "&.active");
        }),
    ],
};
