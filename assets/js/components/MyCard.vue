<template>
    <div class="w-20 m-1">
        <span class="big">{{ title }}</span>
    </div>
</template>

<script>
    export default {
        name: "my-card",
        props: {
            id: Number,
            title: String,
        },
        // data: function() {
        //     return {
        //         title: null,
        //     }
        // },
    }
    // console.log('js-Block von der MyCard.vue Component wird geladen!');
</script>

<style scoped>
    .big {
        font-size: 20px;
    }
</style>