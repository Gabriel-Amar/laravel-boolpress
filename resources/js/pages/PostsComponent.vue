<template>
    <div>
        <div class="container">
            <div class="row py-5" v-if="posts.length > 0">
                <div v-for="post in posts" :key='post.id' class="card col-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{post.title}}</h5>
                        <p class="card-text " v-html="post.content"></p>
                        <router-link :to="{ name: 'single-post', params: {slug: post.slug} }" class="nav-link">Visualizza il post</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PostsComponent',
        data(){
            return{
                posts: [],
            }
        },
        created(){
            axios.get('/api/posts').then((response)=>{
                this.posts = response.data;
            })
        }
    }
</script>

<style lang="scss" scoped>

</style>