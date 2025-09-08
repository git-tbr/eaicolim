<template>
    <section class="bg-blue text-white mt-auto">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex align-self-center">
                    <img src="../assets/img/footer_logo.png" alt="logo" class="p-3">
                </div>
                <div class="col-lg-3">
                    <p class="fs-4 fw-bold">
                        ACESSO RÁPIDO
                    </p>
                    <ul class="list-unstyled">
                        <li>
                            <RouterLink to="/sobre" class="text-white text-decoration-none fs-5">Sobre</RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/episodios" class="text-white text-decoration-none fs-5">Episódios
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/patrocinio" class="text-white text-decoration-none fs-5">Patrocínio
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/contato" class="text-white text-decoration-none fs-5">Contato
                            </RouterLink>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="fs-4 fw-bold">
                        REDES SOCIAIS
                    </p>
                    <ul class="list-unstyled">
                        <li>
                            <a :href="instagram" target="_blank" class="text-white text-decoration-none fs-5" v-if="instagram != ''">
                                <font-awesome-icon icon="fa-brands fa-instagram" /> /eaicolim_podcast
                            </a>
                        </li>
                        <li>
                            <a :href="facebook" target="_blank" class="text-white text-decoration-none fs-5" v-if="facebook != ''">
                                <font-awesome-icon icon="fa-brands fa-facebook" /> /eaicolim
                            </a>
                        </li>
                        <li>
                            <a :href="twitter" target="_blank" class="text-white text-decoration-none fs-5" v-if="twitter != ''">
                                <font-awesome-icon icon="fa-brands fa-x-twitter" /> /eaicolim
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="fs-4 fw-bold">
                        CONTATO
                    </p>
                    <ul class="list-unstyled">
                        <li>
                            <a :href="'tel:' + cellphone" class="text-white text-decoration-none fs-5" v-if="cellphone != ''">
                                {{ cellphone }}
                            </a>
                        </li>
                        <li>
                            <a :href="'mailto:' + email" class="text-white text-decoration-none fs-5" v-if="email != ''">
                                {{ email }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { inject, onMounted, ref } from 'vue';

const instagram = ref('')
const facebook = ref('')
const twitter = ref('')
const cellphone = ref('')
const email = ref('')

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
        cellphone.value = dt.c_cellphone
        email.value = dt.c_email
        
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