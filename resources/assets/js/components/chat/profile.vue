<template>
    <div class="profile"
        v-bind:class="{active: visible}">
        <img v-bind:src="'https://api.adorable.io/avatars/200/' + user.id + '.png'">
        <h3>{{ user.first_name }} {{ user.last_name }}</h3>
        <p v-if="typeof user.roles !== 'undefined'">
            <span v-for="(role, index) in user.roles">
                <span v-if="index > 0">, </span>
                {{role.name}}
            </span>
        </p>
        <a class="button" v-bind:href="'mailto:' + user.email">
            Email
        </a>
        <a class="button" v-on:click.prevent="message">
            Message
        </a>
        <a class="button"
            v-bind:href="'tel:' + user.telephone"
            v-if="currentUser.roles[0].name === 'Teacher'">
            Telephone
        </a>
        <a class="button" href="#"
            v-if="currentUser.roles[0].name === 'Teacher'">
            Message Parent
        </a>
        <div class="close">
            <a href="#" v-on:click.prevent="visible = false">
                <i class="icons icon-close"></i>
            </a>
        </div>
    </div>
</template>

<script type="text/javascript">
    import { EventBus } from "../../eventbus.js";

    export default {
        data() {
            return{
                user:{
                    "first_name": "",
                    "last_name": "",
                },
                visible: false,
                currentUser: {
                    roles: [
                        {
                            name: ""
                        }
                    ]
                },
            };
        },
        mounted() {
            EventBus.$on("openProfile", userId => {
                this.setUser(userId);
                this.visible = true;
            });

            this.currentUser = window.user;
        },
        methods: {
            setUser(id){
                axios.get("/api/user/" + id)
                .then(e => {
                    this.user = e.data;
                });
            },
            message(){
                axios.post("/api/channel", {
                    group: false,
                    name: null,
                    user: this.user.id
                })
                .then(response => {
                    this.switchChannel(response.data.id);
                });
            },
            switchChannel(id){
                this.$emit("switchchannel", id);
                history.pushState(null, null, window.base_url + "/channel/" + id);
                this.visible = false;
            },
        }

    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    div.profile{
        background-image: $blue-gradient;
        position: fixed;
        right: -150px;
        width: 150px;
        opacity: 0;
        top: 0;
        z-index: 20;
        color: white;
        text-align: center;
        padding: 50px 0;
        transition: all 0.1s ease;

        &.active{
            display: block;
            width: 100%;
            height: 100%;
            max-width: 500px;
            right: 0;
            opacity: 1;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;

            @media($media-min-width){
                width: 300px;
            }
        }

        img{
            border-radius: 200px;
            margin-bottom: 50px;
        }

        h3{
            margin: 0;
        }

        .button{
            width: 250px;
            color: white;
            margin-bottom: 5px;
        }

        div.close{
            position: absolute;
            right: 0;
            top: 0;
            font-size: 24px;
            height: 60px;
            width: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 20;

            a{
                border: 0;
                color: white;
            }

            @media($media-min-width){
                width: 70px;
                height: 70px;
            }
        }
    }
</style>
