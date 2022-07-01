<template>
    <div>
        <div class="container">
                <div class="">
                    <ul class="d-flex justify-content-between py-3">
                        <li :style="{backgroundColor: randomColor(index)}" v-for="(category, index) in categories" :key="index">
                            <router-link :to="{ name: 'category', params: {slug: category.slug} }">{{category.name}} </router-link>
                        </li>
                    </ul>
                </div>
                
                    <!-- <agile v-if="isActive" :dots="true" :infinite="false" :autoplay-speed="5000" >
                        <div class="slide"  v-for="post in posts" :key="post.id">
                            <h3>{{post.title}}</h3>
                            <img class="img-fluid" :src="`storage/${post.image}`" alt="">
                        </div>
                    </agile> -->
                    <carousel :paginationActiveColor="randomColor()"  :paginationColor="randomColor()" :navigationEnabled="true">
                        <slide v-for="post in posts" :key="post.id">
                            <h3>{{post.title}}</h3>
                            <img :src="`storage/${post.image}`" alt="">
                        </slide>
                    </carousel>
                
        </div>
    </div>
</template>

<script>
import { VueAgile } from 'vue-agile'
import { Carousel, Slide } from 'vue-carousel';
export default {
    name: 'HomeComponent',
    components: {
        agile: VueAgile, 
        
    },
    data(){
        return{
            categories: [],
            posts: [],
            colorCache: {},
            isActive: true,
        }
    },
    methods: {
    randomColor(index) {
        const r = () => Math.floor(256 * Math.random());
        return this.colorCache[index] || (this.colorCache[index] = `rgb(${r()}, ${r()}, ${r()})`);
        },
    },
    mounted() {
        axios.get('/api/categories').then((res) =>{
            this.categories = res.data;
        }).catch((err) =>{
            console.log(err);
        });
        axios.get('/api/posts').then((res) =>{
            this.posts = res.data.slice(0, 7);
            console.log(this.posts);
        }).catch((err) =>{
            console.log(err);
        })
    },
}
</script>

<style lang="scss" scoped>
ul{
    list-style: none;
}
li{
    background-color: #495056;
    padding: 5px 18px;
    border-radius: 60px;
}
a{
    color: white;
    list-style: none;
}
img{
    width:  100%;
    height: 100%;
    object-fit: cover;
    border-radius: 40px;
}
.VueCarousel-slide{
    padding: 15px;
    margin-bottom: 25px;
}
</style>