<template>
    <section class="container-fluid py-2 bg-darkblue">
        <div class="row justify-content-center icons-container">
            <div class="col-auto" v-if="instagram != ''" @click="OpenNewTab(instagram)" role="button">
                <font-awesome-icon icon="fa-brands fa-instagram" />
            </div>
            <div class="col-auto" v-if="facebook != ''" @click="OpenNewTab(facebook)" role="button">
                <font-awesome-icon icon="fa-brands fa-facebook" />
            </div>
            <div class="col-auto" v-if="twitter != ''" @click="OpenNewTab(twitter)" role="button">
                <font-awesome-icon icon="fa-brands fa-x-twitter" />
            </div>
            <div class="col-auto" v-if="tiktok != ''" @click="OpenNewTab(tiktok)" role="button">
                <font-awesome-icon icon="fa-brands fa-tiktok" />
            </div>
            <div class="col-auto" v-if="youtube != ''" @click="OpenNewTab(youtube)" role="button">
                <font-awesome-icon icon="fa-brands fa-youtube" />
            </div>
            <div class="col-auto" v-if="spotify != ''" @click="OpenNewTab(spotify)" role="button">
                <font-awesome-icon icon="fa-brands fa-spotify" />
            </div>
            <div class="col-auto" v-if="apple != ''" @click="OpenNewTab(apple)" role="button">
                <font-awesome-icon icon="fa-solid fa-podcast" />
            </div>
            <div class="col-auto" v-if="deezer != ''" @click="OpenNewTab(deezer)" role="button">
                <font-awesome-icon icon="fa-brands fa-deezer" />
            </div>
        </div>
    </section>
</template>

<script setup>
import { OpenNewTab } from '@/functions/OpenNewTab';
import { inject, onMounted, ref } from 'vue';

const instagram = ref('')
const facebook = ref('')
const twitter = ref('')
const tiktok = ref('')
const youtube = ref('')
const spotify = ref('')
const apple = ref('')
const deezer = ref('')

const swal = inject('$swal')

const getSocialMedia = async () => {
    try {
        const response = await fetch('//eaicolim.com.br/Apis/redes.control.php')
        if(!response.ok){
            throw new Error('Não foi possível carregar as redes sociais')
        }

        const dt = await response.json()

        instagram.value = dt.c_instagram
        facebook.value = dt.c_facebook
        twitter.value = dt.c_twitter
        tiktok.value = dt.c_tiktok
        youtube.value = dt.c_youtube
        spotify.value = dt.c_spotify
        apple.value = dt.c_apple
        deezer.value = dt.c_deezer

    } catch (error) {
        swal({
            title: "",
            text: error,
            icon: "info",
            showCancelButton: false,
            confirmButtonColor: "#3F51B5",
            confirmButtonText: "Ok",
            allowOutsideClick: false
        })
    }
}

onMounted(()=>{
    getSocialMedia()
})
</script>

<style scoped>
.bg-darkblue{
    background-color: #143160;
    color: white;
}
.icons-container *{
    font-size: 1.3rem;
}
</style>