<template>
    <div>
        <router-view>
            
        </router-view>
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
}
</script>

<style lang="scss" scoped>
ul{
    list-style-type: none;
}
</style>