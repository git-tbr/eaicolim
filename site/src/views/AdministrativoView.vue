<template>
    <NavbarComponent />
    <main>
        <section class="container">
            <ul class="nav nav-tabs pt-3">
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active linkClass episodes" @click="loadContent('episodes')">Episódios</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link linkClass images" @click="loadContent('images')">Imagens</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link linkClass sponsors" @click="loadContent('sponsors')">Patrocinadores</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link linkClass redes" @click="loadContent('redes')">Redes Sociais</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link linkClass messages" @click="loadContent('messages')">Mensagens de contato</a>
                </li>
            </ul>
            <article class="p-3 border-start border-end border-bottom rounded-bottom">
                <EpisodesComponent v-if="actualPage == 'episodes'" />
                <ImageComponent v-if="actualPage == 'images'" />
                <SponsorsComponent v-if="actualPage == 'sponsors'" />
                <RedesComponent v-if="actualPage == 'redes'" />
                <MessagesComponent v-if="actualPage == 'messages'" />
            </article>
        </section>
    </main>
    <FooterComponent />
</template>

<script setup>
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import EpisodesComponent from '@/components/EpisodesComponent.vue';
import ImageComponent from '@/components/ImageComponent.vue';
import SponsorsComponent from '@/components/SponsorsComponent.vue';
import RedesComponent from '@/components/RedesComponent.vue';
import MessagesComponent from '@/components/MessagesComponent.vue';
import { ref } from 'vue';

const actualPage = ref('episodes')

const loadContent = (content) => {    
    const cl = document.querySelectorAll('.linkClass')
    cl.forEach(e => {
        e.classList.remove('active')
    })

    document.querySelector(`.${content}`).classList.add('active')
    actualPage.value = content
}

</script>