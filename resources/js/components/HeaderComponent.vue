<template>
    <div>
        <header>
            <ul class="d-flex justify-content-around p-3">
                <li><a class="underline" href="/">Home</a></li>
                <li>BOOLPRESS</li>
                <li><a class="underline" href="/admin">Area Riservata</a></li>
            </ul>
        </header>
    </div>
</template>

<script>
export default {
    name:'HeaderComponent',
}
</script>

<style lang="scss" scoped>
ul{
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

</style>