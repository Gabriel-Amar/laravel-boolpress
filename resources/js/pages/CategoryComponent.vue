<template>
    <div>
        <section>
    <h1 class="text-center">{{category.name}}</h1>
    <div class="container" v-if="category && category.posts.length > 0">
        <div class="row justify-content-center" v-for="(post,index) in category.posts" :key="index">
            <div class="col-8 my-3">
                <div class= "card">
                    <div class="title-box p-2 rounded-top text-center">
                        <h4>{{post.title}}</h4>
                    </div>
                    <div class="p-2">
                        <p v-html="post.content"></p>
                        <router-link :to="{ name:'single-post', params:{slug: post.slug} }" >Visualizza post</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
    </div>
</template>

<script>
    export default {
        name: 'CategoryComponent',
        data(){
            return{
                category: null,

            }
        },
        mounted(){
            const slug = this.$route.params.slug;
        axios
            .get(`/api/categories/${slug}`)
            .then((response) => {
                this.category = response.data;
            })
            .catch((error) => {
                console.log(error);
                this.$router.push({ name: "page-404" });
            });
        }
    }
</script>

<style lang="scss" scoped>

</style>