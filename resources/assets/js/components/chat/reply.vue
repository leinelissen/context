<template>
    <footer>
        <div class="container">
            <input type="text"
                placeholder="Typ voor nieuw bericht..."
                v-model="messageText"
                @keyup.enter="sendMessage">
            <a href="#"
                v-on:click.prevent="sendMessage">
                <i class="icons icon-cursor"></i>
            </a>
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
                    this.messageText = "";
                }
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
        z-index: 5;
    }

    .container{
        display: flex;
        align-items: center;
        padding: 0.75em;

        @media($media-min-width){
            padding: 1em;
        }
    }

    input{
        margin: 0;
        background-color: $white;
    }

    a{
        width: 42px;
        height: 40px;
        margin-left: 10px;
        background-image: $blue-gradient;
        border-radius: 5px;
        border: 0;

        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 135%;
    }
</style>
