/**
 * First we will load all of this project"s JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap.js");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("chat-container", require("./components/chat/container.vue"));
Vue.component("chat-message", require("./components/chat/message.vue"));
Vue.component("chat-reply", require("./components/chat/reply.vue"));
Vue.component("chat-channel-switcher", require("./components/chat/channel-switcher.vue"));
Vue.component("chat-create-channel-dialog", require("./components/chat/create-channel-dialog.vue"));
Vue.component("chat-create-chat-dialog", require("./components/chat/create-chat-dialog.vue"));
Vue.component("chat-profile", require("./components/chat/profile.vue"));

const app = new Vue({
    el: "#app"
});
