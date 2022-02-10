<template>
    <section class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>
            <h3 class="my-3">Categoria: {{ post.category.name }}</h3>

            <Tags :list="post.tags" class="mb-5" />

            <p>{{ post.content }}</p>
        </div>
        <div v-else>Loading post</div>
    </section>
</template>

<script>
import axios from "axios";
import Tags from "../components/Tags.vue";

export default {
    name: "Post Detail",
    components: {
        Tags,
    },
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
                    // console.log(res.data);

                    if (res.data.not_found) {
                        // console.log("404");
                        this.$router.push({ name: "not-found" });
                    } else {
                        this.post = res.data;
                    }
                })
                .catch((err) => log.error(err));
        },
    },
};
</script>

<style></style>
