<template>
    <div>
        Tags:
        <span
            class="badge badge-primary mr-3"
            v-for="tag in list"
            :key="`tag-${tag.id}`"
        >
            {{ tag.name }}
        </span>
    </div>
</template>

<script>
export default {
    name: "Tags",
    props: {
        list: Array,
    },
};
</script>

<style></style>
