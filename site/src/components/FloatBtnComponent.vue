<template>
    <button @click="scrollToTop" :class="classes">
        <font-awesome-icon icon="fa-solid fa-arrow-up" />
    </button>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const classes = ref('btn btn-primary border border-white border-2 shadow btn-scroll rounded-4 bg-gradient');

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
    })
}

const onScroll = () => {
    window.addEventListener('scroll', function(){
        if(this.window.pageYOffset >= 100){
            classes.value = 'btn btn-primary border border-white border-2 shadow btn-scroll rounded-4 bg-gradient'
        }else{
            classes.value = 'btn btn-primary border border-white border-2 shadow btn-scroll rounded-4 bg-gradient d-none'
        }
    })
}

onMounted(()=>{
    onScroll()
})
</script>

<style scoped>
.btn-scroll{
    position: fixed;
    right: 15px;
    bottom: 15px;
    width: 60px;
    font-size: 1.5rem;
}
</style>