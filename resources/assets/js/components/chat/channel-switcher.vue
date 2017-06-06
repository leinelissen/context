<template>
    <section v-bind:class="{active: isActive}">
        <a href="#" class="activator" v-on:click.prevent="isActive = !isActive">
            <img v-if="!isActive" src="/images/context-icon-white.svg">
            <i v-if="isActive" class="icons icon-close"></i>
        </a>
        <div class="currentuser">
            <div>
                <b>{{ currentUser.first_name }}</b>
                <p>{{ currentUser.roles[0].name }}</p>
            </div>
            <img v-bind:src="'https://api.adorable.io/avatars/50/' + currentUser.id + '.png'">
        </div>
        <div class="channels" v-show="isActive">

            <div>
                <div class="flex-header">
                    <h4>Channels</h4>
                    <a class="dialog-switch" href="#"
                        v-on:click.prevent="createChannel = !createChannel; createUserChannel = false"
                        v-bind:class="{active: createChannel}">
                        <i class="icons icon-plus"></i>
                    </a>
                </div>
                <chat-create-channel-dialog
                    :active="createChannel">
                </chat-create-channel-dialog>
                <ul v-if="channels.group.length > 0">
                    <li
                        v-for="channel in channels.group"
                        v-bind:class="{active: currentChannel == channel.id}">
                        <a v-bind:href="channel.id"
                            v-on:click.prevent="switchChannel(channel.id)">
                            <span>{{ channel.name }}</span>
                            <span class="receipts"
                                v-if="channel.read_receipts > 0">{{ channel.read_receipts }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <div class="flex-header">
                    <h4>Users</h4>
                    <a class="dialog-switch" href="#"
                        v-bind:class="{active: createUserChannel}"
                        v-on:click.prevent="createUserChannel = !createUserChannel; createChannel = false">
                        <i class="icons icon-plus"></i>
                    </a>
                </div>
                <chat-create-chat-dialog
                    :active="createUserChannel"
                    v-on:createchat="createChat">
                </chat-create-chat-dialog>
                <ul v-if="channels.user.length > 0">
                    <li
                        v-for="channel in channels.user"
                        v-bind:class="{active: currentChannel == channel.id}">
                        <a v-bind:href="channel.id"
                            v-on:click.prevent="switchChannel(channel.id)">
                            <span>{{ channel.user.first_name }} {{ channel.user.last_name }}</span>
                            <span class="receipts"
                                v-if="channel.read_receipts > 0">{{ channel.read_receipts }}</span>
                        </a>
                    </li>
                </ul>
                <h6 v-if="channels.user.length <= 0">
                    <i>None</i>
                </h6>
            </div>

        </div>
    </section>
</template>

<script type="text/javascript">
    export default {
        props: ["currentChannel"],
        data() {
            return{
                channels: {
                    "group": [],
                    "user": []
                },
                isActive: false,
                createChannel: false,
                createUserChannel: false,
                currentUser: {},
            };
        },
        created(){
            this.load();
            this.currentUser = window.user;
        },
        methods: {
            switchChannel(id){
                this.$emit("switchchannel", id);
                history.pushState(null, null, window.base_url + "/channel/" + id);
                this.isActive = false;
            },
            createChat(user){
                axios.post("/api/channel", {
                    group: false,
                    name: null,
                    user: user.id
                })
                .then(response => {
                    if(response.data.error !== "exists"){
                        this.channels.user.push(response.data);
                    }

                    this.switchChannel(response.data.id);
                    this.createUserChannel = false;
                });
            },
            load(){
                // Retrieve available channels
                axios.get("/api/channel/")
                    .then(response => {
                        this.channels.group = response.data.filter(channel => {
                            return channel.group;
                        });
                        this.channels.user = response.data.filter(channel => {
                            return !channel.group;
                        });
                    });
            }
        }
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    section{
        position: fixed;
        top: 0;
        left: 0;
        z-index: 11;
        background: $grey-dark;
        color: white;
        width: 60px;
        height: 60px;
        transition: width 0.1s ease;
        overflow: hidden;

        @media($media-min-width){
            width: 70px;
            height: 70px;
        }

        &.active{
            width: 100%;
            height: 100%;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;

            a.activator{
                background: transparent;
            }

            @media($media-min-width){
                width: 300px;
            }
        }
    }

    a.activator{
        display: flex;
        height: 60px;
        width: 60px;
        justify-content: center;
        align-items: center;
        background-image: $blue-gradient;

        @media($media-min-width){
            width: 70px;
            height: 70px;
        }

        img{
            height: 20px;
            width: auto;
        }

        i{
            font-size: 22px;
        }
    }

    a{
        border: 0;
        color: white;
    }

    .channels{
        h4, h6{
            padding-left: 20px;
        }

        ul{
            list-style: none;
            padding: 0;


            li{
                margin: 0;

                &:nth-child(even){
                    background-color: lighten($grey-dark, 1)
                }

                &.active{
                    background: $blue-gradient;
                }
            }

            a{
                display: flex;
                padding: 10px 20px;
                margin: 0;
                justify-content: space-between;

                &:hover{
                    background-color: rgba($white, 0.05);
                }

                span.receipts{
                    padding: 0px 13px;
                    border-radius: $border-radius;
                    background-image: $grey-gradient;
                }
            }
        }

        .flex-header{
            display: flex;
            justify-content: space-between;
            align-items: center;

            & > *{
                margin-bottom: 0;
                padding: 0 20px;
            }

            a{
                padding: 5px 20px;
            }
        }

        .create-dialog{
            background-image: $blue-gradient;
            transition: all 0.1s ease;
            overflow: hidden;
            max-height: 0;
            padding: 0;

            &.active{
                max-height: 800px;
                padding: 20px;
            }

            h4, h6{
                padding: 0;
            }
        }

        a.dialog-switch{
            height: 50px;
            width: 50px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;

            &.active{
                background: $blue;

                &:after{
                    content: "";
                    position: absolute;
                    left: -50px;
                    bottom: 0;
                    border-left: 50px solid transparent;
                    border-bottom: 50px solid $blue;
                }
            }
        }
    }

    div.currentuser{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px;

        b, p{
            margin:0;
        }

        img{
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-left: 25px;
        }
    }
</style>
