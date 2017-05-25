<template>
    <section v-bind:class="{active: isActive}">
        <a href="#" class="activator" v-on:click.prevent="isActive = !isActive">
            <img v-if="!isActive" src="/images/context-icon-white.svg">
            <i v-if="isActive" class="icons icon-close"></i>
        </a>
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
                            {{ channel.name }}
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
                            v-on:click.prevent="switchChannel(channel.id)"
                            v-if="channel.users.length">
                            {{ channel.users[0].first_name }} {{ channel.users[0].last_name }}
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
            };
        },
        created(){
            // Retrieve available channels
            axios.get("/api/channel/")
            .then(response => {
                this.channels.group = response.data.filter(function(element){
                    return element.group;
                });
                this.channels.user = response.data.filter(function(element){
                    return !element.group;
                });

                console.log(this.channels.user);
            });
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
                    this.channels.user.push(response.data);
                    this.switchChannel(response.data.id);
                    this.createUserChannel = false;
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
                display: block;
                padding: 10px 20px;
                margin: 0;

                &:hover{
                    background-color: rgba($white, 0.05);
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
</style>
