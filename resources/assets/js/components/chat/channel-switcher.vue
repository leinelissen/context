<template>
    <section v-bind:class="{active: isActive}">
        <a href="#" class="activator" v-on:click.prevent="isActive = !isActive">
            OP
        </a>
        <div class="channels" v-show="isActive">

            <div v-if="channels.group.length > 0">
                <h4>Channels</h4>
                <ul>
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

            <div v-if="channels.user.length > 0">
                <h4>Users</h4>
                <ul>
                    <li
                        v-for="channel in channels.user"
                        v-bind:class="{active: currentChannel == channel.id}">
                        <a v-bind:href="channel.id"
                            v-on:click.prevent="switchChannel(channel.id)">
                            {{ channel.name }}
                        </a>
                    </li>
                </ul>
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
            });
        },
        methods: {
            switchChannel(id){
                this.$emit("switchchannel", id);
                history.pushState(null, null, window.base_url + "/channel/" + id);
                this.isActive = false;
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
        width: 50px;
        height: 50px;
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

            @media($media-min-width){
                width: 300px;
            }
        }
    }

    a.activator{
        display: flex;
        height: 50px;
        width: 50px;
        justify-content: center;
        align-items: center;

        @media($media-min-width){
            width: 70px;
            height: 70px;
        }
    }

    a{
        border: 0;
        color: white;
    }

    .channels{
        h4{
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
    }
</style>
