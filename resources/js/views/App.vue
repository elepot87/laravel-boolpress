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
