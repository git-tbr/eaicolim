<template>
    <main>
        <section class="container">
            <h1>
                Redes sociais
            </h1>
        </section>
        <section class="container mb-3">
            <div class="row">
                <div class="col-md-6">
                    <form @submit.prevent="handleSubmit">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-instagram" />
                            </span>
                            <input type="text" class="form-control" v-model="instagram">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-facebook" />
                            </span>
                            <input type="text" class="form-control" v-model="facebook">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-x-twitter" />
                            </span>
                            <input type="text" class="form-control" v-model="twitter">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-tiktok" />
                            </span>
                            <input type="text" class="form-control" v-model="tiktok">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-youtube" />
                            </span>
                            <input type="text" class="form-control" v-model="youtube">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-spotify" />
                            </span>
                            <input type="text" class="form-control" v-model="spotify">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-solid fa-podcast" />
                            </span>
                            <input type="text" class="form-control" v-model="apple">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <font-awesome-icon icon="fa-brands fa-deezer" />
                            </span>
                            <input type="text" class="form-control" v-model="deezer">
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto d-grid">
                                <button class="btn btn-primary px-5">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { inject, onMounted, ref } from 'vue';

const swal = inject('$swal')
const youtube = ref('')
const instagram = ref('')
const facebook = ref('')
const tiktok = ref('')
const spotify = ref('')
const apple = ref('')
const deezer = ref('')
const twitter = ref('')

const getRedes = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/redes.control.php')
    if(!response.ok){
        console.log('Erro ao carregar as redes')
        return false
    }
    const dt = await response.json()
    youtube.value = dt.c_youtube
    instagram.value = dt.c_instagram
    facebook.value = dt.c_facebook
    tiktok.value = dt.c_tiktok
    spotify.value = dt.c_spotify
    apple.value = dt.c_apple
    deezer.value = dt.c_deezer
    twitter.value = dt.c_twitter
}

const handleSubmit = async () => {
    let dataRedes = {
        youtube: youtube.value,
        instagram: instagram.value,
        facebook: facebook.value,
        tiktok: tiktok.value,
        spotify: spotify.value,
        apple: apple.value,
        deezer: deezer.value,
        twitter: twitter.value
    }

    try {
        const response = await fetch('//eaicolim.com.br/Apis/redes.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify(dataRedes)
        })

        if(!response.ok){
            throw new Error('Não foi possível salvar as alterações')
        }

        const dt = await response.json()
        youtube.value = dt.c_youtube
        instagram.value = dt.c_instagram
        facebook.value = dt.c_facebook
        tiktok.value = dt.c_tiktok
        spotify.value = dt.c_spotify
        apple.value = dt.c_apple
        deezer.value = dt.c_deezer
        twitter.value = dt.c_twitter

        swal({
            title: "",
            text: "Operação realizada com sucesso",
            icon: "success",
            showCancelButton: false,
            confirmButtonColor: "#3F51B5",
            confirmButtonText: "Ok",
            allowOutsideClick: false
        })
        
    } catch (error) {
        swal({
            title: "",
            text: error,
            icon: "success",
            showCancelButton: false,
            confirmButtonColor: "#3F51B5",
            confirmButtonText: "Ok",
            allowOutsideClick: false
        })
    }
}

onMounted(()=>{
    getRedes()
})
</script>