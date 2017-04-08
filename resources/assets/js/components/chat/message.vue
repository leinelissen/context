<template>
    <div class="message" v-bind:class="{self: message.self}">
        <span>{{ message.message }}</span>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: ["message"]
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    // Set other variables
    $triangle-size: 10px;

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
            border-bottom: $triangle-size solid $grey;
        }
    }

    span{
        background-color: $grey;
        color: $white;
        display: inline-block;
        padding: 0.75em 1em;
        max-width: 40%;
    }

    div.self{
        text-align: right;
        margin-right: 1.5em;

        span{
            background-color: $blue;
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
