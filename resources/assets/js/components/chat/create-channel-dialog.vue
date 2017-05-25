<template>
    <div class="create-dialog"
        v-bind:class="{active: active}">
        <h4>Create New Channel</h4>
        <p>Which channel would you like to use as basis?</p>
    </div>
</template>

<style lang="scss" scoped>
</style>

<script type="text/javascript">
    export default {
        props: [
            "active"
        ],
    };
</script>
