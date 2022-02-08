<template>
    <div>
        <div class="container">
            <h1 class="my-4">Il nostro blog</h1>
            <div class="container-posts" v-if="posts">Post list here</div>
            <div class="loader" v-else>Loading...</div>
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
            axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
                this.posts = response.data;
            });
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
