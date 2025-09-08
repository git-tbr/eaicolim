<template>
    <NavbarComponent />
    <main class="bg-secondary-subtle">
        <section class="pt-3 pt-lg-5">
            <h1 class="fw-bold text-center text-darkblue">
                PATROCINADORES E PARCEIROS
            </h1>
            <p class="text-center fs-5">
                Essas marcas acreditam no nosso trabalho e tornam tudo isso possível. Nosso muito obrigado!
                <br>
                Seja você também nosso apoiador e parceiro.
            </p>
        </section>
        <section class="container mb-3">
            <div class="row">
                <div class="col-6 col-md-4 p-3" v-for="sp in sponsors" :key="sp.id">
                    <img :src="sp.s_image_url" :alt="sp.s_name" class="rounded w-100">
                </div>
            </div>
        </section>
        <section class="container mb-3">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button class="btn btn-primary rounded-pill fs-5 btn-lg px-5 py-2 bg-gradient" @click="router.push({name: 'patrocinador'})">
                        Quero me tornar um patrocinador
                    </button>
                </div>
            </div>
        </section>
    </main>
    <FooterSiteComponent />
    <FooterComponent />
</template>

<script setup>
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import FooterSiteComponent from '@/components/FooterSiteComponent.vue';
import { onMounted, ref } from 'vue';
import router from '@/router';

const sponsors = ref([])

const loadSponsors = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/patrocinadores.control.php')

    if (!response.ok) {
        console.log('Erro ao carregar os patrocinadores')
        return
    }

    const data = await response.json()
    sponsors.value = data
}

onMounted(()=>{
    loadSponsors()
})

</script>

<style scoped>
main.bg-secondary-subtle{
    min-height: calc(100vh - 444px);
}

.text-darkblue{
    color: #143160;
}
</style>