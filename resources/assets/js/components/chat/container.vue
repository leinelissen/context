<template>
    <div class="chat-container">
        <chat-channel-switcher
            v-on:switchchannel="switchChannel"
            :currentChannel="currentChannelId">
        </chat-channel-switcher>
        <div class="channel-name">
            <h2>{{ channel.name_extension }} <b>{{ channel.name }}</b></h2>
        </div>
        <div v-if="channel.group" class="channel-announcement">
            <div class="container">
                <p>
                    <b>Last announcement:</b>
                    {{ channel.announcement }}
                </p>
            </div>
        </div>
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
                channel: {},
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
                    console.log(response.data);

                    this.messages = response.data.messages;
                    this.channel = response.data.channel;
                    this.scrollToBottom();
                });

                // Leave any current channels
                Echo.leave(this.currentChannel);

                // Then install a listener for any new messages
                Echo.join("Channel." + channelid)
                    .listen("MessageCreated", e => {
                        this.messages.push(e.message);
                        this.scrollToBottom();
                        iziToast.show({
                            "title": "New message from " + e.message.user.first_name + " " + e.message.user.last_name,
                            "message": "\"" + e.message.message + "\""
                        });
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


    div.channel-announcement,
    div.channel-name{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        z-index: 10;
    }

    div.channel-name{
        height: 60px;
        background-color: $grey-light;
        display: flex;
        align-items: center;
        justify-content: center;

        h2 {
            font-weight: 500;
            font-size: 24px;
            margin: 0;
            margin-left: 60px;

            @media($media-min-width){
                font-size: 32px;
                margin-left: 0;
            }

            b{
                font-weight: 800;
            }
        }

        @media($media-min-width){
            font-size: 32px;
            height: 70px;
            margin-left: 0;
        }

    }

    div.channel-announcement{
        top: 60px;
        background-color: $grey-very-light;
        padding: 15px 0;

        @media($media-min-width){
            top: 70px;
            padding: 25px 0;
        }

        p{
            margin-bottom: 0;
        }
    }

    div.chat-container{
        height: 100%;
    }

</style>
