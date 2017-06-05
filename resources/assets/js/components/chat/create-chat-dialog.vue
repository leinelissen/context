<template>
    <div class="create-dialog"
        v-bind:class="{active: active}">
        <h4>Create New Chat</h4>
        <p>With whom would you like to connect?</p>
        <input type="text" placeholder="John Appleseed"
            v-model="name"
            v-on:keyup="findUsers"
            ref="usernameInput">
        <ul v-if="users.length > 0">
            <li v-for="user in users">
                <a href="#"
                    v-on:click.prevent="createChat(user)">
                    <div>
                        <b>{{user.first_name}} {{user.last_name}}</b>
                        <span v-if="user.roles.length > 0">{{user.roles[0].name}}</span>
                    </div>
                    <i class="icons icon-plus"></i>
                </a>
            </li>
        </ul>
    </div>
</template>

<style lang="scss" scoped>
    ul{
        list-style: none;
    }

    li{
        font-weight: 300;
        margin: 0 -20px;

        &:nth-child(even) > a{
            background-color: rgba(#fff, 0.15);
        }
    }

    a{
        display: block;
        color: white;
        border: 0;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;

        &:hover{
            background-color: rgba(#fff, 0.3) !important;
        }
    }
</style>

<script type="text/javascript">
    export default {
        props: [
            "active"
        ],
        data() {
            return{
                name: null,
                users: [],
            };
        },
        methods:{
            findUsers(e){
                axios.get("/api/users/" + e.target.value)
                .then(response => {
                    this.users = response.data;
                });
            },
            createChat(user){
                this.$emit("createchat", user);
                this.name = null;
                this.users = [];
            },
            focus(){
                Vue.nextTick(() => {
                    this.$refs.usernameInput.focus();
                });
            }
        },
        watch: {
            active: function (newValue) {
                if(newValue === true){
                    this.focus();
                }
            }
        }
    };
</script>
