<template>
    <footer>
        <div class="container">
            <input type="text"
                placeholder="Typ voor nieuw bericht..."
                v-model="messageText"
                @keyup.enter="sendMessage">
            <a href="#" @click="sendMessage">Send</a>
        </div>
    </footer>
</template>

<script type="text/javascript">
    export default {
        data() {
            return {
                messageText: ""
            };
        },
        methods:{
            sendMessage: function() {
                // Check for empty messages
                if(this.messageText !== ""){
                    // Emit event to parent
                    this.$emit("messagesent", {
                        message: this.messageText
                    });

                    // Reset reply element
                    this.messageText = "";                }
            }
        }
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    footer{
        position: fixed;
        bottom: 0;
        background-color: $grey-very-light;
        width: 100%;
    }

    .container{
        display: flex;
        align-items: center;
        padding: 1em;
    }

    input{
        width: 100%;
        height: 40px;
        margin: 0;
        border-radius: 0;
        background-color: $white;
    }

    a{
        display: block;
        color: $white;
        background-color: $brand-primary;
        height: 100%;
        padding: 0.5em;
        margin-left: 0.5em;
        text-decoration: none;

        &:hover{
            background-color: $brand-secondary;
        }
    }
</style>
