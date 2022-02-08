<template>
    <div>
        <div class="container my-4">
            <div class="row">
                <h1>Il nostro blog</h1>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "App",
    components: {},
    data() {
        return {
            posts: null,
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            console.log("axios call here");
        },
    },
};
</script>

<style lang="scss">
div {
    h1 {
        text-transform: uppercase;
    }
}
</style>
