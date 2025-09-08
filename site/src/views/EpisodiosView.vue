<template>
    <NavbarComponent />
    <main class="bg-darkblue">
        <div class="container my-5">
            <h1 class="text-light mb-1 fw-bold text-center">
                EPISÓDIOS
            </h1>
            <p class="mb-5 text-center">
                Assista nossos programas e envie suas sugestões.
            </p>
            <div class="row mb-3" v-if="episodes.length > 0">
                <div class="col-md-4" v-for="ep in episodes" :key="ep.e_id" @click="$router.push({ path: 'episodio', query: {id: ep.e_id} })" role="button">
                    <div class="p-3">
                        <img :src="ep.e_cover" class="w-100 mb-3" alt="...">
                        <div class="text-white">
                            <p class="text-center fs-4 fw-bold">
                                E aí, Colim? {{ ep.e_title }}
                            </p>
                            <p class="text-center">
                                <font-awesome-icon class="fs-5" icon="fa-solid fa-calendar-week" /> &nbsp; {{ dateFormat(ep.e_date) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 g-3" v-else>
                <div class="col">
                    <p class="fs-5 text-center">
                        Aguarde novas publicações!
                    </p>
                </div>
            </div>
        </div>
    </main>
    <FooterSiteComponent />
    <FooterComponent />
</template>

<script setup>
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterSiteComponent from '@/components/FooterSiteComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import { onMounted, ref } from 'vue';

const episodes = ref([])

const dateFormat = (date) => {
    const d = new Date(date + 'T00:00:00')
    const options = {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    }
    const formater = new Intl.DateTimeFormat('pt-Br', options)
    return formater.format(d)
}

const loadEpisodes = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/episodes.control.php')

    if (!response.ok) {
        console.log('Erro ao carregar os episódios')
        return
    }

    const data = await response.json()
    episodes.value = data.filter(function(element){
        return element.e_active == 'y'
    })
}

onMounted(() => {
    loadEpisodes()
})

</script>

<style scoped>
main.bg-darkblue{
    min-height: calc(100vh - 444px);
}
</style>