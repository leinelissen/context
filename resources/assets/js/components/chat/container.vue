<template>
    <div class="chat-container">
        <chat-channel-switcher
            v-on:switchchannel="switchChannel"
            :currentChannel="currentChannelId">
        </chat-channel-switcher>
        <div class="container">
            <div class="messages">
                <chat-message
                    v-for="message in messages"
                    :message="message"
                    :key="message.id">
                </chat-message>
                <div class="empty" v-show="messages.length === 0">
                    No messages to show.
                </div>
            </div>
        </div>
        <chat-reply
            v-on:messagesent="addMessage">
        </chat-reply>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: [
            "channelid"
        ],
        data() {
            return{
                messages: [],
                currentChannel: "",
                currentChannelId: 0,
            };
        },
        created(){
            this.init(this.channelid);
        },
        methods: {
            init(channelid) {
                // Firstly, retrieve all current messages
                axios.get("/api/channel/" + channelid)
                .then(response => {
                    this.messages = response.data;
                    this.scrollToBottom();
                });

                // Leave any current channels
                Echo.leave(this.currentChannel);

                // Then install a listener for any new messages
                Echo.join("Channel." + channelid)
                    .listen("MessageCreated", e => {
                        this.messages.push(e.message);
                        this.scrollToBottom();
                });

                this.currentChannel = "Channel." + channelid;
                this.currentChannelId = channelid;
            },
            addMessage(message) {
                // Add channelid to object
                message.channel_id = this.channelid;

                // Create message in backend
                axios.post("/api/message", message)
                .then(() => {
                    // Add new message to message stack
                    this.messages.push({
                        message: message.message,
                        user:{
                            id: window.userid
                        },
                        channel:{
                            id: this.channelid
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
            switchChannel(id) {
                this.init(id);
            },
            scrollToBottom() {
                // Target containing div

                // Scroll to bottom of containing div
                // NOTE: The scroll function is executed with a sligt timeout,
                // so we can wait for the element to be added to the dom
                setTimeout(function(){
                    window.scrollTo(0,document.body.scrollHeight);
                }, 100);
            }
        }
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    div.messages{
        height: 100%;
        padding: 85px 0;

        flex-direction: column;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;

        // Enable inertial scrolling for iOS devices
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
    }

    div.chat-container{
        height: 100%;
    }

</style>
