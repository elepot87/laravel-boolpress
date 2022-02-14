<template>
    <section class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>
            <h3 class="my-3" v-if="!post.category">
                Categoria: {{ post.category.name }}
            </h3>
            <h3 v-else>Non ci sono categorie per questo post</h3>

            <Tags :list="post.tags" class="mb-5" />

            <figure class="img-post" v-if="post.cover">
                <img :src="post.cover" :alt="post.title" />
            </figure>

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

<style lang="scss" scoped>
.img-post img {
    max-width: 400px;
}
</style>
