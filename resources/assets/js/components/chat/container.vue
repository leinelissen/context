<template>
    <div class="chat-container">
        <div class="container">
            <chat-message
                v-for="message in messages"
                :message="message"
                :key="message.id">
            </chat-message>
            <div class="empty" v-show="messages.lenth === 0">
                No messages to show.
            </div>
        </div>
        <chat-reply
            v-on:messagesent="addMessage">
        </chat-reply>
    </div>
</template>

<script type="text/javascript">
    export default {
        data() {
            return{
                messages: [],
            };
        },
        created(){
            // Firstly, retrieve all current messages
            axios.get("/api/messages")
            .then(response => {
                this.messages = response.data;
                this.scrollToBottom();
            });

            // Then install a listener for any new messages
            Echo.join("chat")
                .listen("MessageCreated", e => {
                    this.messages.push(e.message);
                    this.scrollToBottom();
                });
        },
        methods: {
            addMessage(message) {
                // Create message in backend
                axios.post("/api/messages", message)
                .then(() => {
                    // Add new message to message stack
                    this.messages.push({
                        message: message.message,
                        user:{
                            id: window.userid
                        }
                    });

                    // Then show new message by scrolling
                    this.scrollToBottom();
                })
                .catch(error => {
                    alert("Your message could not be sent!");
                    console.log(error);
                });
            },
            scrollToBottom() {
                // Target containing div
                var container = this.$el.querySelector(".chat-container > div");

                // Scroll to bottom of containing div
                // NOTE: The scroll function is executed with a sligt timeout,
                // so we can wait for the element to be added to the dom
                setTimeout(function(){
                    container.scrollTop = container.scrollHeight;
                }, 1);
            }
        }
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    div.container{
        height: 100%;
        padding: 75px 0;

        // Enable inertial scrolling for iOS devices
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
    }

    div.chat-container{
        height: 100%;
    }

</style>
