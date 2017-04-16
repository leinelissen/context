<template>
    <div class="message" v-bind:class="{self: (message.user.id === userid)}">
        <span>{{ message.message }}</span>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: ["message"],
        data() {
            return{
                userid: window.userid
            };
        },
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    // Set other variables
    $triangle-size: 10px;

    div.message{
        position: relative;
        margin: 0.5em 1.5em 0 1.5em;

        &:after{
            content: "";
            position: absolute;
            left: -$triangle-size;
            bottom: 0;
            border-left: $triangle-size solid transparent;
            border-bottom: $triangle-size solid $grey-dark;
        }
    }

    span{
        background-image: $grey-dark-gradient;
        color: $white;
        display: inline-block;
        padding: 0.6em 0.9em;
        max-width: 80%;
        border-radius: $border-radius $border-radius $border-radius 0;
        text-align: left;

        @media($media-min-width){
            padding: 0.75em 1em;
        }
    }

    div.self{
        text-align: right;

        span{
            background-image: $blue-gradient;
            border-radius: $border-radius $border-radius 0 $border-radius;
        }

        &:after{
            border-bottom: $triangle-size solid $blue;
            border-right: $triangle-size solid transparent;
            border-left: 0;
            right: -$triangle-size;
            left: auto;
        }
    }
</style>
