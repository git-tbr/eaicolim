<template>
    <NavbarComponent />
    <main class="bg-darkblue">
        <section class="container my-5">
            <div class="text-light">
                <h2 class="fw-bold">
                    E AÍ, COLIM? #{{ id }} - {{ title }}
                </h2>
            </div>
            <div class="row g-3">
                <div class="col-lg-6">
                    <iframe class="aspectRatio w-100 mb-3" :src="'https://www.youtube.com/embed/' + linkYoutube"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                    <div class="row">
                        <div class="col">
                            <font-awesome-icon class="fs-5" icon="fa-solid fa-calendar-week" /> &nbsp; {{ formatedDate }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <iframe
                        data-testid="embed-iframe" 
                        style="border-radius:12px" 
                        :src="'https://open.spotify.com/embed/episode/' + linkSpotify + '?utm_source=generator'" width="100%" 
                        height="200" 
                        frameBorder="0" 
                        allowfullscreen="" 
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                        loading="lazy">
                    </iframe>
                    <div class="row">
                        <div class="col px-3">
                            <p class="fs-5">
                                {{ description }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col px-3">
                            <p class="fs-5 fw-bold">
                                Disponível também nas plataformas:
                            </p>

                            <div class="mb-3 d-flex" v-if="linkApple != ''" @click="OpenNewTab(linkApple)" role="button">
                                <font-awesome-icon icon="fa-solid fa-podcast" class="border border-1 border-primary p-1 rounded text-dark bg-primary" /> &nbsp; Apple Podcast
                            </div>
                            <div class="mb-3 d-flex" v-if="linkDeezer != ''" @click="OpenNewTab(linkDeezer)" role="button">
                                <font-awesome-icon icon="fa-brands fa-deezer" class="border border-1 border-primary p-1 rounded text-dark bg-primary" /> &nbsp; Deezer
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <FooterSiteComponent />
    <FooterComponent />
</template>

<script setup>
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterSiteComponent from '@/components/FooterSiteComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import { OpenNewTab } from '@/functions/OpenNewTab';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute()
const title = ref('')
const formatedDate = ref('')
const linkYoutube = ref('')
const linkSpotify = ref('')
const linkApple = ref('')
const linkDeezer = ref('')
const id = ref('')
const description = ref('')

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

const loadEpisode = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/episodes.control.php?id=' + id.value)

    if (!response.ok) {
        console.log('Erro ao carregar os episódios')
        return false
    }

    const data = await response.json()
    title.value = data.e_title
    formatedDate.value = dateFormat(data.e_date)
    linkSpotify.value = data.e_spotify.split('/')[4].split('?')[0]
    console.log(linkSpotify.value)
    linkYoutube.value = data.e_youtube.split('?')[1].split('=')[1]
    linkApple.value = data.e_apple
    linkDeezer.value = data.e_deezer
    description.value = data.e_description
}

onMounted(() => {
    id.value = route.query.id
    loadEpisode()
})

</script>

<style scoped>
main.bg-darkblue {
    min-height: calc(100vh - 444px);
}

.aspectRatio {
    aspect-ratio: 16/10;
}
</style>