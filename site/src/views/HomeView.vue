<template>
    <NavbarComponent />
    <FloatBtnComponent />
    <main>
        <section>
            <div id="carouselAbout" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- <div class="carousel-item active" data-bs-interval="6000">
                        <img src="../assets/img/banner_1.png" class="d-block w-100">
                    </div> -->
                    <div :class="i === 0 ? 'carousel-item active' : 'carousel-item'" data-bs-interval="6000"
                        v-for="(c, i) in carroussel" :key="c.i_id">
                        <img :src="c.i_url" class="d-block w-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselAbout"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-black rounded" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselAbout"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-black rounded" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <section class="bg-blue">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="container-fluid">
                            <div class="row justify-content-between">
                                <div class="col-lg-8 py-5">
                                    <h1 class="fw-bold mb-3 pt-5">
                                        Perguntas, respostas e boas conversas
                                    </h1>
                                    <p class="text-justify fs-5">
                                        Sabe aquela pergunta que todo mundo quer fazer? No podcast "E aí, Colim?", o
                                        jornalista
                                        Alexandre Colim transforma essas dúvidas em pauta. Com informação de qualidade,
                                        bom humor e
                                        a experiência de anos de jornalismo, ele traz respostas claras e objetivas sobre
                                        os temas
                                        que mais mexem com a cidade e o país.
                                    </p>
                                    <p class="text-justify pb-5 fs-5">
                                        Política, economia, cultura, esportes... tudo tratado com profundidade,
                                        convidados que
                                        entendem do assunto e aquele jeitão direto que aproxima o público da notícia.
                                        Aqui, o espaço
                                        é aberto para perguntar, entender e debater. Quer ficar por dentro? Então é só
                                        dar o play!
                                    </p>
                                </div>
                                <div class="col-lg-2 bg-mosaic d-none d-lg-flex">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row justify-content-between">
                    <div class="col-lg-8 py-5">
                        <h1 class="fw-bold mb-3">
                            Perguntas, respostas e boas conversas
                        </h1>
                        <p class="text-justify">
                            Sabe aquela pergunta que todo mundo quer fazer? No podcast "E aí, Colim?", o jornalista
                            Alexandre Colim transforma essas dúvidas em pauta. Com informação de qualidade, bom humor e
                            a experiência de anos de jornalismo, ele traz respostas claras e objetivas sobre os temas
                            que mais mexem com a cidade e o país.
                        </p>
                        <p class="text-justify">
                            Política, economia, cultura, esportes... tudo tratado com profundidade, convidados que
                            entendem do assunto e aquele jeitão direto que aproxima o público da notícia. Aqui, o espaço
                            é aberto para perguntar, entender e debater. Quer ficar por dentro? Então é só dar o play!
                        </p>
                    </div>
                    <div class="col-lg-2 bg-mosaic d-none d-lg-flex">

                    </div>
                </div> -->
            </div>
        </section>

        <section class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 align-self-center p-3 d-none d-lg-flex">
                        <img src="../assets/img/microphone.png" alt="microfone" class="w-100">
                    </div>
                    <div class="col-lg-9 align-self-center py-5">
                        <h1 class="fw-bold mb-3 text-blue">
                            Episódios recentes
                        </h1>
                        <p class="mb-3">
                            Assista aos temas que você quiser a qualquer momento. No YouTube ou nas principais
                            plataformas de áudio. É só clicar.
                        </p>
                        <div class="container">
                            <div class="row mb-4 g-3" v-if="episodes.length > 0">
                                <div class="col-md-4" v-for="ep in episodes" :key="ep.e_id" @click="$router.push({ path: 'episodio', query: {id: ep.e_id} })" role="button">
                                    <div class="card">
                                        <img :src="ep.e_cover" class="card-img-top" alt="...">
                                        <div class="card-body bg-secondary text-white">
                                            <p class="card-text">{{ ep.e_title }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 g-3" v-else>
                                <div class="col">
                                    <p class="fs-5">
                                        Aguarde novas publicações!
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn px-3 btn-blue btn-lg"
                                        @click="router.push({ name: 'episodios' })">
                                        Conferir todos os episódios &nbsp; <font-awesome-icon class="fs-5"
                                            icon="fa-solid fa-caret-right" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-darkblue">
            <div class="container py-5">
                <h1 class="fw-bold mb-3 text-center">
                    PATROCINADORES E PARCEIROS
                </h1>
                <p class="mb-3 text-center fs-5">
                    Essas marcas acreditam no nosso trabalho e tornam tudo isso possível. Nosso muito obrigado!<br>
                    Seja você também nosso apoiador e parceiro.<br>
                    Clique aqui para conhecer as formas para sua participação.
                </p>
                <div class="row">
                    <div class="col-6 col-md-4 p-3" v-for="sp in sponsors" :key="sp.id">
                        <img :src="sp.s_image_url" :alt="sp.s_name" class="rounded w-100"
                            @click="openSite(`${sp.s_url}`)" role="button">
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-body-secondary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col d-none d-xl-flex bg-mosaic-blue">

                    </div>
                    <div class="col-xl-9 py-5">
                        <div class="container">
                            <div class="row mb-5">
                                <div class="col-lg-10 mx-auto">
                                    <h1 class="fw-bold mb-3 text-principal">
                                        Tem sugestões de temas para o programa? <br> Conta pra gente!
                                    </h1>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <p class="fs-5">
                                                    Aqui o espaço é seu! Mande sugestões de temas, dúvidas
                                                    ou tópicos que você gostaria de ver nos próximos episódios. Sua
                                                    ideia pode virar pauta e fazer parte das nossas conversas!
                                                </p>
                                            </div>
                                            <div class="col-lg-8">
                                                <form @submit="handleSubmit" class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nome" class="text-blue fw-bold">
                                                                Nome
                                                            </label>
                                                            <input type="text" name="nome" id="nome"
                                                                class="form-control" v-model="name_m" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="text-blue fw-bold">
                                                                Email
                                                            </label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" v-model="email_m" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="assunto" class="text-blue fw-bold">
                                                                Assunto
                                                            </label>
                                                            <input type="text" name="assunto" id="assunto"
                                                                class="form-control" v-model="subject_m" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="form-group">
                                                            <label for="mensagem" class="text-blue fw-bold">
                                                                Mensagem
                                                            </label>
                                                            <textarea name="mensagem" id="mensagem" class="form-control"
                                                                rows="4" v-model="body_m">
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-auto mx-auto">
                                                                <button type="submit" class="btn btn-blue px-5 btn-lg">
                                                                    {{ txt_submit }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-10 mx-auto">
                                    <h1 class="text-principal mb-3 fw-bold">
                                        Estamos nas plataformas digitais
                                    </h1>

                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <img src="../assets/img/youtube.png" alt="" height="60px"
                                                        class="max-size">
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="../assets/img/spotify.png" alt="" height="60px"
                                                        class="max-size">
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="../assets/img/apple.png" alt="" height="60px"
                                                        class="max-size">
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="../assets/img/deezer.png" alt="" height="60px"
                                                        class="max-size">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-xl-flex">

                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- footer -->
    <FooterSiteComponent />
    <FooterComponent />
</template>

<script setup>
import FooterComponent from '@/components/FooterComponent.vue';
import NavbarComponent from '@/components/NavbarComponent.vue';
import FloatBtnComponent from '@/components/FloatBtnComponent.vue';
import FooterSiteComponent from '@/components/FooterSiteComponent.vue';
import { inject, onMounted, ref } from 'vue';
import router from '@/router';

const swal = inject('$swal')
const sponsors = ref([])
const episodes = ref([])
const carroussel = ref([])
const name_m = ref('')
const email_m = ref('')
const subject_m = ref('')
const body_m = ref('')
const txt_submit = ref('Enviar')

const handleSubmit = async (e) => {
    e.preventDefault()

    try {
        const response = await fetch('//eaicolim.com.br/Apis/contact_message.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify({
                name: name_m.value,
                email: email_m.value,
                subject: subject_m.value,
                body: body_m.value
            })
        })

        if (!response.ok) {
            throw new Error('Não foi possível enviar sua mensagem. Por favor, tente novamente mais tarde')
        }

        name_m.value = ''
        email_m.value = ''
        subject_m.value = ''
        body_m.value = ''

        swal({
            title: "",
            text: "Mensagem enviada com sucesso",
            icon: "success",
            showCancelButton: false,
            confirmButtonColor: "#3F51B5",
            confirmButtonText: "Ok",
            allowOutsideClick: false
        })
    } catch (error) {

        name_m.value = ''
        email_m.value = ''
        subject_m.value = ''
        body_m.value = ''

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

const loadImages = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/images.control.php')

    if (!response.ok) {
        console.log('Erro ao carregar os patrocinadores')
        return
    }

    const data = await response.json()
    carroussel.value = data.filter(function (element) {
        return element.i_active == 'y'
    })
}

const loadSponsors = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/patrocinadores.control.php')

    if (!response.ok) {
        console.log('Erro ao carregar os patrocinadores')
        return
    }

    const data = await response.json()
    sponsors.value = data
}

const loadEpisodes = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/episodes.control.php')

    if (!response.ok) {
        console.log('Erro ao carregar os episódios')
        return
    }

    const data = await response.json()
    episodes.value = data.filter(function (element) {
        return element.e_active == 'y'
    })
}

const openSite = (link) => {
    if (!link) {
        window.alert('O site não pôde ser aberto. Por favor, tente novamente.');
        return
    }

    window.open(link, '_blank');
}

onMounted(() => {
    loadImages()
    loadSponsors()
    loadEpisodes()
})

</script>

<style scoped>
.max-size {
    max-width: 100%;
}

.text-principal {
    color: #0051D5;
}

.text-blue {
    color: #143160;
}

.btn-blue {
    background-color: #0051D5;
    color: white;
}

.btn-blue:hover {
    background-color: #0347b4;
    color: white;
}

.bg-mosaic {
    background-image: url(../assets/img/mosaic_white.png);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.bg-mosaic-blue {
    background-image: url(../assets/img/mosaic_blue.png);
    background-position: left center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>