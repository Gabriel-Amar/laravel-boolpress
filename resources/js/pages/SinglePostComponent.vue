<template>
    <div>
        <div class="container">
            <div class="card m-auto" style="width: 18rem">
                <img
                    :src="`/storage/${post.image}`"
                    class="card-img-top"
                    width="100"
                    alt=""
                />
                <div class="card-body">
                    <h1>
                        {{ post.title }}
                    </h1>
                    <p v-html="post.content"></p>
                    <small>{{ post.created_at }}</small>
                    <h5>
                        Pubblicato:
                        {{ post.published ? "Published" : "Unpublished" }}
                    </h5>
                    <form @submit.prevent="addComment()">
                        <label for="username">Inserisci il nome</label>
                        <input v-model="formData.username" type="text" />
                        <label for="content">Inserisci il contenuto</label>
                        <input v-model="formData.content" type="text" />
                        <button type="submit">Invia</button>
                    </form>
                <div v-if="post.comments.length > 0">
                    <h4>Commenti</h4>
                    <div v-for="comment in post.comments" :key="comment.id">
                        {{ comment.content }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SinglePostComponent",
    data() {
        return {
            post: null,
            formData: {
                username: "",
                content: "",
                post_id: "",
            },
        };
    },
    methods: {
        addComment() {
            axios
                .post("/api/comments", this.formData)
                .then((response) => {
                    this.post.comments.push(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        const slug = this.$route.params.slug;
        axios
            .get(`/api/posts/${slug}`)
            .then((response) => {
                this.post = response.data;
                this.formData.post_id = this.post.id;
            })
            .catch((error) => {
                console.log(error);
                this.$router.push({ name: "page-404" });
            });
    },
};
</script>

<style lang="scss" scoped></style>
