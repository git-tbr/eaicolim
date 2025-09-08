<template>
  <header>
    <SocialMediaComponent/>
    <nav :class="navClass" data-bs-theme="light">
      <div class="container">
        <RouterLink class="navbar-brand" to="/">
          <img src="../assets/img/logo.png" alt="Logo do site" height="65px" />
        </RouterLink>
        <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item ms-lg-4">
              <RouterLink to="/" class="nav-link text-principal">Início</RouterLink>
            </li>
            <li class="nav-item ms-lg-4">
              <RouterLink to="/sobre" class="nav-link text-principal">Sobre</RouterLink>
            </li>
            <li class="nav-item ms-lg-4">
              <RouterLink to="/episodios" class="nav-link text-principal">Episódios</RouterLink>
            </li>
            <li class="nav-item ms-lg-4">
              <RouterLink to="/patrocinio" class="nav-link text-principal">Patrocínio</RouterLink>
            </li>
            <!--
            <li class="nav-item ms-lg-4">
              <RouterLink to="/contato" class="nav-link text-principal">Contato</RouterLink>
            </li> -->
            <li class="nav-item ms-lg-4" v-if="isAuthenticated">
              <RouterLink to="/administrativo" class="nav-link text-principal">ADMIN</RouterLink>
            </li>
          </ul>
          <ul class="navbar-nav  mb-2 mb-lg-0">
            <!-- <li class="nav-item">
              <RouterLink to="/contato" class="nav-link text-principal">Pesquisa</RouterLink>
            </li> -->
            <li class="nav-item ms-lg-3" v-if="isAuthenticated">
              <a href="javascript:void(0)" @click="logout" class="nav-link text-principal">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import { useSiteStore } from '@/stores/store';
import { computed, inject, onMounted, ref } from 'vue';
import { useRouter, RouterLink } from 'vue-router';
import SocialMediaComponent from './SocialMediaComponent.vue';

const siteStore = useSiteStore()
const isAuthenticated = computed(() => siteStore.isAuthenticated)
const swal = inject('$swal')
const router = useRouter()
const navClass = ref('navbar navbar-expand-lg shadow bg-light')

const logout = () => {
  swal({
    title: "",
    text: "Deseja sair?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#005a4b",
    confirmButtonText: "Sim, sair",
    cancelButtonText: "Não",
    allowOutsideClick: false
  }).then((result) => {
    if (result.isConfirmed) {
      siteStore.logout();
      router.push({ name: 'home' });
    }
  });
}

const onScroll = () => {
  window.addEventListener('scroll', function(){
    if(this.window.pageYOffset >= 100){
      navClass.value = 'navbar navbar-expand-lg shadow fixed-top bg-light'
    }else{
      navClass.value = 'navbar navbar-expand-lg shadow bg-light'
    }
  })
}

onMounted(()=>{
  onScroll()
})

</script>

<style scoped>
.text-principal{
  color: #0051D5;
  font-size: 1.2rem;
}
</style>