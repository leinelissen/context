<template>
    <div class="chat-container">
        <div class="container">
            <chat-message
                v-for="message in messages"
                :message="message"
                :key="message.id">
            </chat-message>
        </div>
        <chat-reply
            v-on:messagesent="addMessage">
        </chat-reply>
    </div>
</template>

<script type="text/javascript">
    export default {
        data() {
            return {
                messages: [
                    {
                        "message": "Message one!",
                        "self": false
                    },
                    {
                        "message": "Message two!",
                        "self": true
                    },
                    {
                        "message": "Message three!",
                        "self": false
                    }
                ]
            };
        },
        methods: {
            addMessage(message) {
                // Add new message to message stack
                this.messages.push(message);

                // Scroll to bottom of containing div
                var container = this.$el.querySelector(".chat-container > div");
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
        overflow: auto;
        height: 100%;
        padding: 25px 0;
    }

    div.chat-container{
        height: 100%;
    }

</style>
