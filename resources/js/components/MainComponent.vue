<template>
    <div>
        <div class="container">
            <div class="row">
                
                    <!-- <ul> -->
                        <!-- <li v-for="(post, index) in posts" :key='index'> -->
                            <!-- {{post.title}} -->
                            <!-- <a href="#" @click='getDetail(post.slug, index)'>Vedi dettaglio</a> -->
                            <!-- <span v-if="post.detail">
                            {{post.detail.slug}}
                            </span> -->
                        <!-- </li> -->
                    <!-- </ul> -->
                        <div v-for="(post, index) in posts" :key='index' class="card col-4 " style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{post.title}}</h5>
                                <p class="card-text">{{post.content}}</p>
                                <a href="#" class="card-link">Card link</a>
                            </div>
                        </div>
                    
                
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    name: 'MainComponent',
    data(){
        return {
            posts: [],
        }
    },
    methods:{
        getDetail(slug, index){
            axios.get('/api/posts/' + slug).then((response)=>{
            console.log(response.data);
            this.posts[index].detail = response.data;
            })
        }
    },
    created(){
        axios.get('/api/posts').then((response)=>{
            console.log(response.data);
            this.posts = response.data;
        })
    },
}
</script>

<style lang="scss" scoped>
ul{
    list-style-type: none;
}
</style>