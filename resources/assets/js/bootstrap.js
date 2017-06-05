/**
 * Vue
 * ----------------------------------------------------------------
 * Vue is our Javascript front-end rendering engine. It renders Vue
 * components provided in the /components folder into HTML, CSS and
 * Javascript.
 */

window.Vue = require("vue");

/**
 * Axios
 * ----------------------------------------------------------------
 * Axios is a library for performing easy HTTP requests. Axios is
 * setup with a CSRF token provided in the CSRF Meta-tag. By
 * combining this with Laravel-provided cookies, the user is
 * automatically authenticated.
 */

window.axios = require("axios");
window.axios.defaults.headers.common["X-CSRF-TOKEN"] = document.head.querySelector("meta[name=csrf-token]").content;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.interceptors.response.use(null, function(error) {
    if (error.status === 401) {
        window.location.href = "/";
    }

    return Promise.reject(error);
});

/**
 * Laravel Echo
 * -------------------------------------------------------------------
 * Laravel Echo is an event broadcasting wrapper. It communicates
 * between a supplied Socket.IO server and the frontend. The Socket.IO
 * server communicates with Laravel Events via Redis.
 */

import Echo from "laravel-echo";

window.io = require("socket.io-client");

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ":6001"
});

/**
 * iziToast
 * ----------------------------------------------------------------
 * iziToast is a library for showing simple in-browser notifications
 */

window.iziToast = require("izitoast");
window.iziToast.settings({
    timeout: 45000,
    resetOnHover: true,
    transitionIn: "fadeInLeft",
    transitionOut: "fadeOutRight",
    position: "topRight",
});
