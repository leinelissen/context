/**
 * First we will load all of this project"s JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";

window.axios = require("axios");
window.axios.defaults.headers.common["X-CSRF-TOKEN"] = document.head.querySelector("meta[name=csrf-token]").content;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const chatContainer = Vue.component("chat-container", require("./components/chat/container.vue"));
const chatMessage = Vue.component("chat-message", require("./components/chat/message.vue"));
const chatReply = Vue.component("chat-reply", require("./components/chat/reply.vue"));

/* global app */
const app = new Vue({
    el: "#app",
    components:{
        "chat-container": chatContainer,
        "chat-message": chatMessage,
        "chat-reply": chatReply
    }
});
