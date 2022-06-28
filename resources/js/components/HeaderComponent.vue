<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <!-- <router-link :to="{ name: menuItem[0].routeName }" class="navbar-brand">{{menuItem[0].label}}</router-link> -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <div v-for="(item, index) in menuItem" :key="index">
                    <router-link :to="{ name: item.routeName }" class="nav-link">{{item.label}}</router-link>
                  </div>
                </div>
              </div>
                <a class="underline" href="/admin">Area Riservata</a>
            </div>
          </nav>
            
           
        </header>
    </div>
</template>

<script>
export default {
    name:'HeaderComponent',
    data(){
      return{
        menuItem:[
        {
          label: 'Home',
          routeName: 'home'
        },
        {
          label: 'Posts',
          routeName: 'posts'
        },
        {
          label: 'Chi Siamo',
          routeName: 'about'
        },
        {
          label: 'Contatti',
          routeName: 'contact'
        }
    ]
      }
    }
    
}
</script>

<style lang="scss" scoped>
ul li{
    list-style: none;
}
a{
  text-decoration: none;
  color: #d96d00;
}
.underline{
  position: relative;
}

.underline::before{
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  width: 0;
  height: 2px;
  background-color: #d96d00;
  transition: width 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}

@media (hover: hover) and (pointer: fine) {
  .underline:hover::before{
    left: 0;
    right: auto;
    width: 100%;
  }
}
.router-link-active{
    color: rgb(255, 255, 255) !important;
}

</style>