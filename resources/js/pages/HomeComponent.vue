<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <ul>
                        <li v-for="(category, index) in categories" :key="index">
                            <router-link :to="{ name: 'category', params: {slug: category.slug} }">{{category.name}} </router-link>
                        </li>
                    </ul>
                </div>
                <div class="col-8">
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HomeComponent',
    data(){
        return{
            categories: [],
            posts: [],
        }
    },
    mounted() {
        axios.get('/api/categories').then((res) =>{
            this.categories = res.data;
        }).catch((err) =>{
            console.log(err);
        });
        axios.get('/api/posts').then((res) =>{
            this.posts = res.data.slice(3);
        }).catch((err) =>{
            console.log(err);
        })
    },
}
</script>

<style lang="scss" scoped>

</style>