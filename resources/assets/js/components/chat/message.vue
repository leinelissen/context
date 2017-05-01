<template>
    <div class="message" v-bind:class="{self: (message.user.id === userid)}">
        <div class="flex-container">
            <div class="info">
                <span class="user" v-if="message.user.id !== userid">{{ message.user.first_name}} {{ message.user.last_name}}</span>
                <span class="time">{{ message.created_at }}</span>
            </div>
            <p>{{ message.message }}</p>
        </div>
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

    div.flex-container{
        position: relative;
        margin: 0.5em 1.5em 0 1.5em;
        display: inline-flex;
        max-width: 80%;
        flex-direction: column;

        &:after{
            content: "";
            position: absolute;
            left: -$triangle-size;
            bottom: 0;
            border-left: $triangle-size solid transparent;
            border-bottom: $triangle-size solid $grey-dark;
        }

        &:hover span.time{
            opacity: 0.6;
            margin-top: 0;
        }
    }

    p{
        background-image: $grey-dark-gradient;
        color: $white;
        display: inline-block;
        padding: 0.6em 0.9em;
        border-radius: $border-radius $border-radius $border-radius 0;
        text-align: left;
        margin: 0;

        @media($media-min-width){
            padding: 0.75em 1em;
        }
    }

    div.info{
        display: flex;
        height: 18px;
        overflow: hidden;
        width: auto;

        span{
            font-size: 11px;
            color: $grey;
            padding: 0 $border-radius;

            &.time{
                opacity: 0.1;
                margin-top: 15px;
                transition: 0.1s all ease;
                margin-left: auto;
            }
        }
    }

    div.message.self{
        text-align: right;

        p{
            background-image: $blue-gradient;
            border-radius: $border-radius $border-radius 0 $border-radius;
        }

        div.flex-container:after{
            border-bottom: $triangle-size solid $blue-dark;
            border-right: $triangle-size solid transparent;
            border-left: 0;
            right: -$triangle-size;
            left: auto;
        }
    }
</style>
