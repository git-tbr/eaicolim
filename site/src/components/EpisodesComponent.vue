<template>
    <main>
        <section class="container">
            <h1>
                Episódios
            </h1>
        </section>
        <section class="container mb-3">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <button class="btn btn-primary rounded-3 px-5" @click="newEpisode()">
                        Nova publicação
                    </button>
                </div>
                <div class="col-sm-5 col-md-4 col-lg-3">
                    <input type="text" v-model="searchQuery" class="form-control rounded-3 border-secondary"
                        placeholder="Busca" aria-label="Busca">
                </div>
            </div>
        </section>
        <section class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="bg-dark text-light text-center rounded-start">Programa</th>
                        <th class="bg-dark text-light text-center">Título</th>
                        <th class="bg-dark text-light text-center">Descrição</th>
                        <th class="bg-dark text-light text-center">Editar/Ver</th>
                        <th class="bg-dark text-light text-center rounded-end">Ativar</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr v-for="d in filteredData" :key="d.e_id">
                        <td class="text-center">{{ d.e_order }}</td>
                        <td>{{ d.e_title }}</td>
                        <td>{{ d.e_description }}</td>
                        <td class="d-grid">
                            <button class="btn btn-sm btn-primary bg-gradient" @click="editEpisode(d)">
                                <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                            </button>
                        </td>
                        <td class="">
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    :checked="d.e_active == 'y'" @change="inactivateEpisode(d)">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <dialog id="caixa" class="rounded-4 border border-secondary">
        <div class="p-3">
            <h3 class="text-center">Editando Episódio</h3>
            <hr class="border border-secondary border-2 mb-3">
            <form @submit.prevent="episodeEdit">
                <div class="mb-2">
                    <label>Ordem do programa</label>
                    <input type="number" v-model="order" step="1" class="form-control border-secondary" required>
                </div>
                <div class="mb-2">
                    <label>Título do Episódio</label>
                    <input type="text" v-model="title" class="form-control border-secondary">
                </div>
                <div class="mb-2">
                    <label>Capa do episódio</label>
                    <input type="file" @change="handleFileUpload" class="form-control border-secondary">
                    <img :src="imgUrl" alt="" v-if="imgUrl != ''" class="my-2 w-100">
                    <p class="text-danger" v-if="errorImg != ''">
                        {{ errorImg }}
                    </p>
                </div>
                <div class="mb-2">
                    <label>Descrição do Episódio</label>
                    <textarea v-model="description" class="form-control border-secondary"></textarea>
                </div>
                <div class="mb-2">
                    <label>Link Youtube</label>
                    <input type="text" v-model="youtube" class="form-control border-secondary">
                </div>
                <div class="mb-2">
                    <label>Link Spotify</label>
                    <input type="text" v-model="spotify" class="form-control border-secondary">
                </div>
                <div class="mb-2">
                    <label>Link Apple</label>
                    <input type="text" v-model="apple" class="form-control border-secondary">
                </div>
                <div class="mb-2">
                    <label>Link Deezer</label>
                    <input type="text" v-model="deezer" class="form-control border-secondary">
                </div>
                <div class="mt-3">
                    <div class="row justify-content-end">
                        <div class="col-6 col-md-3 d-grid">
                            <button type="button" class="btn btn-secondary" @click="closeModal">Fechar</button>
                        </div>
                        <div class="col-6 col-md-3 d-grid">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </dialog>
</template>

<script setup>
import { computed, inject, onMounted, ref } from 'vue'
const swal = inject('$swal')
const data = ref([])
const searchQuery = ref('')
const title = ref('')
const description = ref('')
const youtube = ref('')
const spotify = ref('')
const apple = ref('')
const deezer = ref('')
const id = ref(0)
const order = ref(0)
const imgUrl = ref('')
const errorImg = ref('')
const active = ref('')
const complementoNome = Date.now()

async function dynamicModuleAndUpload(file) {
    try {
        const { Upload } = await import("https://js.tbr.com.br/upload.js");
        console.log("Módulo Upload carregado:", Upload);

        const { Token } = await import("https://js.tbr.com.br/token.js");
        console.log("Módulo Token carregado:", Token);

        let token = await Token.get('file', 3600);
        console.log("Token obtido:", token);

        let upload = new Upload({
            token: token,
            bucket: 'tbr-public',
            path: `podcast/${file.type}`,
            file: complementoNome + file.name,
            type: file.type,
        })

        upload.start(file)

        upload.on('start', hash => {
            console.log('UPLOADSTART', hash)
        })

        upload.on('progress', data => {
            console.log(data)
        })

        upload.on('end', data => {
            console.log('UPLOADEND', data)
            let caminho = `https://files.tbr.com.br/podcast/${file.type}/${complementoNome}${file.name}`;
            imgUrl.value = caminho
            errorImg.value = ''
        })

    } catch (error) {
        console.error("Erro ao carregar módulos dinamicamente:", error);
    }
}

const handleFileUpload = (event) => {
    const file = event.target.files[0]

    if (file.type.indexOf('image') == -1) {
        swal('Atenção', 'Formato não suportado', 'info')
        return false
    } else if (file.size > 500000) {
        swal('Atenção', 'O tamanho excede o máximo permitido', 'info')
        return false
    } else {
        dynamicModuleAndUpload(file);
    }
}

const inactivateEpisode = (dt) => {
    order.value = dt.e_order
    title.value = dt.e_title
    description.value = dt.e_description
    youtube.value = dt.e_youtube
    spotify.value = dt.e_spotify
    apple.value = dt.e_apple
    deezer.value = dt.e_deezer
    imgUrl.value = dt.e_cover
    id.value = dt.e_id
    active.value = dt.e_active == 'y' ? 'n' : 'y',

    episodeEdit()
}

const editEpisode = (dt) => {
    id.value = dt.e_id
    order.value = dt.e_order
    title.value = dt.e_title
    description.value = dt.e_description
    youtube.value = dt.e_youtube
    spotify.value = dt.e_spotify
    apple.value = dt.e_apple
    deezer.value = dt.e_deezer
    imgUrl.value = dt.e_cover
    document.querySelector('#caixa').showModal()
}

const newEpisode = () => {
    id.value = 0
    order.value = 0
    title.value = ''
    description.value = ''
    youtube.value = ''
    spotify.value = ''
    apple.value = ''
    deezer.value = ''
    imgUrl.value = ''
    document.querySelector('#caixa').showModal()
}

const closeModal = () => {
    document.querySelector('#caixa').close()
}

const episodeEdit = async () => {
    let dataEpisode = {
        id: id.value,
        order: order.value,
        title: title.value,
        description: description.value,
        youtube: youtube.value,
        spotify: spotify.value,
        apple: apple.value,
        deezer: deezer.value,
        cover: imgUrl.value,
        active: active.value
    }

    try {
        const response = await fetch('//eaicolim.com.br/Apis/episodes.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify(dataEpisode)
        })

        if (!response.ok) {
            throw new Error('Não foi possível salvar as alterações')
        }

        const dt = await response.json()
        data.value = dt
        document.querySelector('#caixa').close()

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
            icon: "error",
            showCancelButton: false,
            confirmButtonColor: "#3F51B5",
            confirmButtonText: "Ok",
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#caixa').close()
            }
        })
    }

}

const getEpisodes = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/episodes.control.php')
    if (!response.ok) {
        console.log('Erro ao carregar os episódios')
        return false
    }
    const responseData = await response.json()
    data.value = responseData
}

onMounted(() => {
    getEpisodes()
})

const filteredData = computed(() => {
    const query = searchQuery.value.toLocaleLowerCase()
    return data.value.filter(element =>
        element.e_title.toLocaleLowerCase().includes(query) || element.e_description.toLocaleLowerCase().includes(query)
    )
})
</script>

<style scoped>
::backdrop {
    background-image: linear-gradient(45deg,
            #999,
            #222);
    opacity: 0.75;
}

dialog {
    width: 100%;
    max-width: 600px;
    margin: auto;
    animation: surgir 0.3s ease-out forwards;
}

@keyframes surgir {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>