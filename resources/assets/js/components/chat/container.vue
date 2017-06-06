<template>
    <div class="chat-container">
        <chat-channel-switcher
            v-on:switchchannel="switchChannel"
            :currentChannel="currentChannelId"
            ref="channelSwitcher">
        </chat-channel-switcher>
        <div class="channel-name"
            v-bind:class="{ group: channel.group, user: !channel.group}">
            <h2 v-if="channel.group">
                {{ channel.name_extension }} <b>{{ channel.name }}</b>
            </h2>
            <div v-else class="container">
                <div>
                    <h2>
                        {{ channel.user.first_name }}
                        {{ channel.user.last_name }}
                    </h2>
                    <p v-if="typeof channel.user.roles !== 'undefined'">
                        <span v-for="(role, index) in channel.user.roles">
                            <span v-if="index > 0">, </span>
                            {{role.name}}
                        </span>
                    </p>
                </div>
                <a href="#" class="avatar"
                    v-on:click.prevent="showProfile()">
                    <img v-bind:src="'https://api.adorable.io/avatars/50/' + channel.user.id + '.png'">
                </a>
            </div>
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
                    v-for="message in channel.messages"
                    :message="message"
                    :group="channel.group"
                    :key="message.id">
                </chat-message>
                <div class="empty" v-show="channel.messages.length === 0">
                    No messages yet. Care to strike up a conversation?
                </div>
            </div>
        </div>
        <chat-reply
            v-on:messagesent="addMessage">
        </chat-reply>
        <chat-profile
            v-on:switchchannel="switchChannel">
        </chat-profile>
    </div>
</template>

<script type="text/javascript">
    import { EventBus } from "../../eventbus.js";

    export default {
        props: [
            "channelid"
        ],
        data() {
            return{
                channel: {
                    messages: [],
                    user: [
                        {
                            first_name: "",
                            last_name: "",
                            roles: [
                                {
                                    name: "",
                                }
                            ]
                        }
                    ],
                },
                currentChannel: "",
                currentChannelId: 0,
            };
        },
        created(){
            this.init(this.channelid);
            Echo.private("App.User." + window.user.id)
                .notification(e => {
                    if(e.type === "App\\Notifications\\NewMessage"){
                        var channelName = e.message.channel.group ? " in " + e.message.channel.name : "";
                        iziToast.show({
                            "title": "New message from " + e.message.user.first_name + " " + e.message.user.last_name + channelName,
                            "message": "\"" + e.message.message + "\""
                        });
                        this.$refs.channelSwitcher.load();
                    } else if(e.type === "App\\Notifications\\MessageRead"){
                        this.$refs.channelSwitcher.load();
                    }
                });
        },
        methods: {
            init(channelid) {
                // Firstly, retrieve all current messages
                axios.get("/api/channel/" + channelid)
                .then(response => {
                    this.channel = response.data;
                    this.scrollToBottom();
                });

                // Leave any current channels
                Echo.leave(this.currentChannel);

                // Then install a listener for any new messages
                Echo.join("Channel." + channelid)
                    .listen("MessageCreated", e => {
                        this.channel.messages.push(e.message);
                        this.scrollToBottom();
                    })
                    .listen("NewAnnouncement", e => {
                        this.channel.announcement = e.channel.announcement;
                    });

                this.currentChannel = "Channel." + channelid;
                this.currentChannelId = channelid;
            },
            addMessage(message) {
                // Add channelid to object
                message.channel_id = this.currentChannelId;

                // Create message in backend
                axios.post("/api/message", message)
                .then(() => {
                    //
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
                Vue.nextTick(() => {
                    window.scrollTo(0, document.body.scrollHeight);
                });
            },
            showProfile() {
                EventBus.$emit("openProfile", this.channel.user.id);
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
        padding-left: 60px;

        @media($media-min-width){
            padding-left: 70px;
        }

        &.user{
            h2{
                font-size: 20px;
                font-weight: 600;

                @media($media-min-width){
                    font-size: 24px;
                }
            }
            p{
                font-size: 12px;

                @media($media-min-width){
                    font-size: 14px;
                }
            }
        }

        .container{
            width: 100%;
            justify-content: space-between;
            align-items: center;
            display: flex;

            a.avatar{
                border: 0;
                align-items: center;
                display: flex;

                img{
                    width: 35px;
                    height: 35px;
                    border-radius: 20px;

                    @media($media-min-width){
                        width: 40px;
                        height: 40px;
                        border-radius: 20px;
                    }
                }
            }
        }

        h2 {
            font-weight: 500;
            font-size: 24px;
            margin: 0;

            @media($media-min-width){
                font-size: 32px;
            }

            b{
                font-weight: 800;
            }
        }

        p{
            margin: 0;
            font-size: 14px;
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

    div.empty{
        text-align: center;
        line-height: 3;
        color: $grey;
        font-weight: 200;
        opacity: 0.5;
        position: absolute;
        width: 100%;
        bottom: 100px;
        left: 0;
    }

</style>
