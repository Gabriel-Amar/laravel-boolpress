<template>
    <div>
        <div class="container">

    <div class="card m-auto" style="width: 18rem;">
        <img :src="`/storage/${post.image}`" class="card-img-top" width="100" alt="">
        <div class="card-body">
         <h1>
        {{post.title}}
    </h1>
    <p>
        {{post.content}}
    </p>
    <small>{{post.created_at}}</small>
    <h5>
        Pubblicato: {{post.published ? 'Published' : 'Unpublished'}}
    </h5>
        </div>
      </div>

    
    
</div>
    </div>
</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return{
            post: null,
        }
    },
    mounted(){
        const slug = this.$route.params.slug;
        axios.get(`/api/posts/${slug}`).then((response)=>{
            this.post = response.data;
        })
    }
}
</script>

<style lang="scss" scoped>

</style>