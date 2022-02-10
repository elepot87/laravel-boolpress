<template>
    <section class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>
            <p>{{ post.content }}</p>
        </div>
        <div v-else>Loading post</div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "Post Detail",
    data() {
        return {
            post: null,
        };
    },
    created() {
        this.getPostDetail();
    },
    methods: {
        getPostDetail() {
            // Get post from api
            axios
                .get(
                    `http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`
                )
                .then((res) => {
                    console.log(res.data);
                    this.post = res.data;
                })
                .catch((err) => log.error(err));
        },
    },
};
</script>

<style></style>
