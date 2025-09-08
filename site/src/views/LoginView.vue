<template>
    <NavbarComponent />
    <main>
        <section class="container pt-2 pt-md-3 pt-lg-5">
            <div class="row">
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="p-3 rounded bg-light border border-3 border-primary-subtle shadow">
                        <form @submit.prevent="handleSubmit" class="container" id="login_form">
                            <div class="row mb-1">
                                <div class="col-12">
                                    <h3 class="text-center">
                                        Administrativo
                                    </h3>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email" class="fs-6">Email:</label>
                                        <input type="email" id="email" class="form-control" v-model="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password" class="fs-6">Senha:</label>
                                        <input type="password" id="password" class="form-control" v-model="password"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 d-grid">
                                    <button class="btn btn-primary bg-gradient" type="submit" form="login_form">
                                        <font-awesome-icon v-if="txt_submit_btn == 'Aguarde'" icon="fa-solid fa-spinner"
                                            spin />
                                        {{ txt_submit_btn }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <FooterComponent />
</template>

<script setup>
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import { inject, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useSiteStore } from '@/stores/store';

const swal = inject('$swal')
const email = ref('')
const password = ref('')
const txt_submit_btn = ref('Acessar')
const router = useRouter()
const siteStore = useSiteStore()

const handleSubmit = async () => {

    txt_submit_btn.value = 'Aguarde'

    const send_data = {
        email: email.value,
        password: password.value
    }

    try {
        const response = await fetch('//eaicolim.com.br/Apis/login.control.php', {
            method: 'POST',
            headers: new Headers(),
            body: JSON.stringify(send_data)
        })

        if (!response.ok) {
            txt_submit_btn.value = 'Acessar'
            throw new Error('Erro ao realizar o login. Verifique seu email ou senha informados')
        }

        const data = await response.json()
        if (data.code == 0) {
            txt_submit_btn.value = 'Acessar'
            throw new Error('Erro ao realizar o login. Verifique seu email ou senha informados')
        }

        siteStore.login({
            name: data.data.u_fullname,
            email: data.data.u_email
        })

        sessionStorage.setItem('isAuthenticated', true)
        sessionStorage.setItem('name', data.data.u_fullname)
        sessionStorage.setItem('email', data.data.u_email)

        router.push({ name: 'administrativo' })
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

</script>

<style scoped></style>