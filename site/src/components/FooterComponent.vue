<template>
  <footer class="footer bg-dark">
    <section class="container">
      <div class="row py-3 justify-content-between">
        <div class="col-auto text-white">
          &copy; <a href="https://tbr.com.br" target="_blank" rel="Site da TBR Produções" class="text-white text-decoration-none">TBR Produções</a>. Todos os direitos reservados.
        </div>
        <div class="col-auto">
          <a href="https://privacidade.tbr.com.br/" target="_blank" rel="Política de privacidade da TBR Produções" class="text-decoration-none text-white">Política de Privacidade</a>
          &nbsp;&nbsp;
          <RouterLink to="/suporte" class="text-white text-decoration-none"><i class="bi bi-question-circle"></i> Suporte</RouterLink>
        </div>
      </div>
    </section>
  </footer>
</template>
<script setup>
import { RouterLink } from 'vue-router';
</script>