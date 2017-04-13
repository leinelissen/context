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
    $border-radius: 11px;

    div.message{
        position: relative;
        margin-left: 1.5em;
        margin-bottom: 0.5em;

        &:after{
            content: "";
            width: 0;
            height: 0;
            position: absolute;
            display: inline-block;
            left: -$triangle-size;
            bottom: 0px;
            border-left: $triangle-size solid transparent;
            border-bottom: $triangle-size solid #232323;
        }
    }

    span{
        background-color: $grey;
        background-image: linear-gradient(-180deg, #444444 0%, #232323 100%);
        color: $white;
        display: inline-block;
        padding: 0.75em 1em;
        max-width: 40%;
        border-radius: $border-radius $border-radius $border-radius 0;
    }

    div.self{
        text-align: right;
        margin-right: 1.5em;

        span{
            background-image: linear-gradient(-180deg, #00C1FF 0%, #40B2FF 78%);
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
