<template>
    <main>
        <section class="container">
            <h1>
                Mensagens de contato
            </h1>
        </section>
        <section class="container mb-3">
            <div class="row justify-content-end">
                <div class="col-sm-5 col-md-4 col-lg-3">
                    <input type="text" v-model="searchQuery" class="form-control rounded-3 border-secondary" placeholder="Busca" aria-label="Busca">
                </div>
            </div>
        </section>
        <section class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="bg-dark text-light text-center rounded-start">#</th>
                        <th class="bg-dark text-light text-center">Assunto</th>
                        <th class="bg-dark text-light text-center">Nome</th>
                        <th class="bg-dark text-light text-center col-1">Ver</th>
                        <th class="bg-dark text-light text-center col-1 rounded-end">Lido</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <tr v-for="d in filteredData" :key="d.cm_id">
                        <td class="text-center">{{ d.cm_id }}</td>
                        <td>{{ d.cm_subject }}</td>
                        <td>{{ d.cm_name }}</td>
                        <td class="d-grid">
                            <button class="btn btn-sm btn-primary bg-gradient" @click="seeMessage(d)">
                                <font-awesome-icon icon="fa-solid fa-eye" />
                            </button>
                        </td>
                        <td class="">
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input" type="checkbox" role="switch" :checked="d.cm_read == 'y'" @change="readMessage(d)">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <dialog id="caixa" class="rounded-4 border border-secondary">
        <div class="p-3">
            <h3 class="text-center">Mensagem:</h3>
            <hr class="border border-secondary border-2 mb-3">
            <p class="fs-5">
                <b>Assunto:</b> {{ subject_m }}
            </p>
            <p class="fs-5">
                <b>Nome:</b> {{ name_m }}
            </p>
            <p class="fs-5">
                <b>Email:</b> {{ email_m }}
            </p>
            <p class="fs-5">
                <b>Mensagem:</b> {{ body_m }}
            </p>
            <div class="mt-3">
                <div class="row justify-content-end">
                    <div class="col-6 col-md-3 d-grid">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </dialog>
</template>

<script setup>
import { computed, inject, onMounted, ref } from 'vue'
const swal = inject('$swal')
const data = ref([])
const searchQuery = ref('')
const subject_m = ref([])
const name_m = ref('')
const email_m = ref('')
const body_m = ref('')
const date_m = ref('')
const read_m = ref('n')
const id_m = ref(0)

const seeMessage = (dt) => {
    subject_m.value = dt.cm_subject
    name_m.value = dt.cm_name
    email_m.value = dt.cm_email
    body_m.value = dt.cm_body
    date_m.value = dt.cm_date
    document.querySelector('#caixa').showModal()
}

const readMessage = (dt) => {
    id_m.value = dt.cm_id
    read_m.value = dt.cm_read == 'y' ? 'n' : 'y'

    messageEdit()
}

const closeModal = () => {
    document.querySelector('#caixa').close()
}

const messageEdit = async () => {
    let dataEpisode = {
        id: id_m.value,        
        read: read_m.value
    }

    try {
        const response = await fetch('//eaicolim.com.br/Apis/contact_message.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify(dataEpisode)
        })

        if (!response.ok) {
            throw new Error('Não foi possível salvar as alterações')
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

const getMessages = async () => {
    const response = await fetch('//eaicolim.com.br/Apis/contact_message.control.php')
    if (!response.ok) {
        console.log('Erro ao carregar os episódios')
        return false
    }
    const responseData = await response.json()
    data.value = responseData
}

onMounted(() => {
    getMessages()
})

const filteredData = computed(() => {
    const query = searchQuery.value.toLocaleLowerCase()
    return data.value.filter(element =>
        element.cm_subject.toLocaleLowerCase().includes(query) || element.cm_body.toLocaleLowerCase().includes(query) || element.cm_name.toLocaleLowerCase().includes(query)
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