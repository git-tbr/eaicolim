<template>
    <main>
        <section class="container">
            <h1>
                Patrocinadores
            </h1>
        </section>
        <section class="container mb-3">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <button class="btn btn-primary rounded-3 px-5" @click="newSponsor()">
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
                        <th class="bg-dark text-light text-center rounded-start">#</th>
                        <th class="bg-dark text-light text-center">Nome</th>
                        <th class="bg-dark text-light text-center col-1">Editar/Ver</th>
                        <th class="bg-dark text-light text-center col-1">Ativar</th>
                        <th class="bg-dark text-light text-center rounded-end col-1">Excluir</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr v-for="d in filteredData" :key="d.s_id">
                        <td class="text-center">{{ d.s_id }}</td>
                        <td>{{ d.s_name }}</td>
                        <td class="d-grid">
                            <button class="btn btn-sm btn-primary bg-gradient" @click="editImage(d)">
                                <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                            </button>
                        </td>
                        <td class="">
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    :checked="d.s_active == 'y'" @change="inactivateImage(d)">
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn-danger btn btn-sm bg-gradient" @click="removeImage(d)">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <dialog id="caixa" class="rounded-4 border border-secondary">
        <div class="p-3">
            <h3 class="text-center">Editando Patrocinador</h3>
            <hr class="border border-secondary border-2 mb-3">
            <form @submit.prevent="imageEdit">
                <div class="mb-2">
                    <label>Nome</label>
                    <input type="text" v-model="name" class="form-control border-secondary" required>
                </div>
                <div class="mb-2">
                    <label>Site</label>
                    <input type="text" v-model="siteUrl" class="form-control border-secondary" required>
                </div>
                <div class="mb-2">
                    <label>Arquivo</label>
                    <input type="file" @change="handleFileUpload" class="form-control border-secondary">
                    <img :src="imgUrl" alt="" v-if="imgUrl != ''" class="my-2 w-100">
                    <p class="text-danger" v-if="errorImg != ''">
                        {{ errorImg }}
                    </p>
                </div>
                <div class="mb-2">
                    <label>Ativo?</label>
                    <select v-model="active" class="form-select border-secondary">
                        <option value="" selected disabled>Selecione</option>
                        <option value="y">Sim</option>
                        <option value="n">Não</option>
                    </select>
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

const name = ref('')
const active = ref('')
const imgUrl = ref('')
const errorImg = ref('')
const id = ref(0)
const complementoNome = Date.now()
const siteUrl = ref('')

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

const editImage = (dt) => {
    name.value = dt.s_name
    active.value = dt.s_active
    imgUrl.value = dt.s_image_url
    siteUrl.value = dt.s_url
    id.value = dt.s_id
    document.querySelector('#caixa').showModal()
}

const newSponsor = () => {
    name.value = ''
    active.value = ''
    imgUrl.value = ''
    siteUrl.value = ''
    id.value = 0
    document.querySelector('#caixa').showModal()
}

const closeModal = () => {
    document.querySelector('#caixa').close()
}

const imageEdit = async () => {

    if(imgUrl.value == ''){
        errorImg.value = 'Por favor, insira uma imagem!'
        return false
    }

    let dataImage = {
        name: name.value,
        image: imgUrl.value,
        active: active.value,
        siteUrl: siteUrl.value,
        id: id.value
    }

    try {
        const response = await fetch('//eaicolim.com.br/Apis/patrocinadores.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify(dataImage)
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

const handleFileUpload = async (event) => {
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

const inactivateImage = async (dt) => {
    name.value = dt.s_name
    active.value = dt.s_active == 'y' ? 'n' : 'y'
    imgUrl.value = dt.s_image_url
    siteUrl.value = dt.s_url
    id.value = dt.s_id

    imageEdit()
}

const getImages = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/patrocinadores.control.php')
    if (!response.ok) {
        console.log('Erro ao carregar as imagens')
        return false
    }
    const responseData = await response.json()
    data.value = responseData
}

const removeImageConfirm = async (dt) => {
    let dataImage = {
        id: dt.s_id,
        control: 'delete'
    }

    try {
        const response = await fetch('//eaicolim.com.br/Apis/patrocinadores.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify(dataImage)
        })

        if(!response.ok){
            throw new Error('Não foi possível excluir o arquivo')
        }

        const dt = await response.json()
        data.value = dt
        
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

const removeImage = (dataImage) => {
    swal({
        title: "",
        text: "Deseja realmente excluir?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3F51B5",
        confirmButtonText: "Sim, remover",
        cancelButtonText: "Não",
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            //excluir
            removeImageConfirm(dataImage)
        }
    })
}

onMounted(() => {
    getImages()
})

const filteredData = computed(() => {
    const query = searchQuery.value.toLocaleLowerCase()
    return data.value.filter(element =>
        element.s_name.toLocaleLowerCase().includes(query)
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