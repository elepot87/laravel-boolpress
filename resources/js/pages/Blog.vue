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
                    <div class="mb-4 date">
                        {{ formatDate(post.created_at) }}
                    </div>
                    <p class="psot-content">
                        {{ getExcerpt(post.content, 100) }}
                    </p>
                    <router-link
                        :to="{
                            name: 'post-detail',
                            params: { slug: post.slug },
                        }"
                    >
                        Read more
                    </router-link>
                </article>

                <!-- Paginazione -->
                <div class="pagination my-4">
                    <button
                        class="btn btn-primary mr-2"
                        :disabled="pagination.current === 1"
                        @click="getPosts(pagination.current - 1)"
                    >
                        Prev
                    </button>
                    <button
                        class="btn mr-2"
                        :class="
                            pagination.current === i
                                ? 'btn-primary'
                                : 'btn-secondary'
                        "
                        v-for="i in pagination.last"
                        :key="`page-${i}`"
                        @click="getPosts(i)"
                    >
                        {{ i }}
                    </button>
                    <button
                        class="btn btn-primary mr-2"
                        :disabled="pagination.current === pagination.last"
                        @click="getPosts(pagination.current + 1)"
                    >
                        Next
                    </button>
                </div>
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
            pagination: null,
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then((response) => {
                    //1. Senza paginazione
                    // this.posts = response.data;

                    // 2. Con paginazione
                    this.posts = response.data.data;
                    // Creo oggetto per la paginazione
                    this.pagination = {
                        current: response.data.current_page,
                        last: response.data.last_page,
                    };
                });
        },
        getExcerpt(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + "...";
            }
        },
        formatDate(postDate) {
            const date = new Date(postDate);
            console.log(date);

            const formatted = new Intl.DateTimeFormat("it-IT").format();

            return formatted;
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
