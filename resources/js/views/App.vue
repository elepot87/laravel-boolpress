<template>
    <div>
        <div class="container">
            <h1 class="my-5">Il nostro blog</h1>
            <div class="container-posts" v-if="posts">
                <article
                    class="mb-4"
                    v-for="post in posts"
                    :key="`post-${post.id}`"
                >
                    <h2>{{ post.title }}</h2>
                    <div class="mb-4 date">{{ post.created_at }}</div>
                    <p class="psot-content">{{ post.content }}</p>
                </article>
            </div>
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
