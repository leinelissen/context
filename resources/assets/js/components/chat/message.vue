<template>
    <div class="message"
        v-bind:class="{ self: message.user.id === userid, teacher: isTeacher(message.user), new: !message.read}">
        <img
            v-if="group && message.user.id !== userid"
            v-bind:src="'https://api.adorable.io/avatars/50/' + message.user.id + '.png'">
        <div class="flex-container">
            <div class="info">
                <span class="user" v-if="message.user.id !== userid">{{ message.user.first_name}} {{ message.user.last_name}}</span>
                <span class="time">{{ message.created_at }}</span>
            </div>
            <p>{{ message.message }}</p>
        </div>
        <div v-if="!message.read && message.user.id !== userid" class="new-indicator"></div>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: [
            "message",
            "group"
        ],
        data() {
            return{
                userid: window.user.id
            };
        },
        methods: {
            isTeacher(user) {
                if(typeof user.roles === "undefined"){
                    return false;
                }

                var results = user.roles.filter(e => {
                    return e.name === "Teacher";
                });

                if(results.length > 0){
                    return true;
                }

                return false;
            }
        }
    };
</script>

<style lang="scss" scoped>
    // Import global variables
    @import "../../../sass/vue";

    // Set other variables
    $triangle-size: 10px;

    div.flex-container{
        position: relative;
        margin: 2px $triangle-size;
        display: inline-flex;
        max-width: 80%;
        flex-direction: column;

        &:after{
            content: "";
            position: absolute;
            left: -$triangle-size;
            bottom: 0;
            border-left: $triangle-size solid transparent;
            border-bottom: $triangle-size solid $grey;
        }

        &:hover span.time{
            opacity: 0.6;
            margin-top: 0;
        }
    }

    p{
        background-image: $grey-gradient;
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
        display: block;

        p{
            background-image: $blue-gradient;
            border-radius: $border-radius $border-radius 0 $border-radius;
        }

        div.info{
            height: 0px;
            transition: all 0.1s ease;
        }

        .flex-container:hover{
            div.info{
                height: 18px;
            }
        }

        div.flex-container:after{
            border-bottom: $triangle-size solid $blue-dark;
            border-right: $triangle-size solid transparent;
            border-left: 0;
            right: -$triangle-size;
            left: auto;
        }
    }

    div.message.group{
        div.new-indicator{
            left: 55px;
        }
    }

    div.message.teacher{
        p{
            background-image: $grey-dark-gradient;
        }

        div.flex-container:after{
            border-bottom: $triangle-size solid $grey-dark;
        }
    }

    div.message{
        display: flex;
        align-items: center;
        margin-top: 5px;
        position: relative;

        &.new{
            padding-right: 10px;
        }
    }

    div.message > img{
        border-radius: 25px;
        height: 50px;
        width: 50px;
        margin-right: 5px;
    }

    div.new-indicator{
        width: 10px;
        height: 10px;
        background-image: $blue-gradient;
        border-radius: 10px;
        z-index: 2;
        margin-top: -25px;
        margin-left: -5px;
    }
</style>
