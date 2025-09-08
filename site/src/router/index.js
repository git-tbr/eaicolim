import { createRouter, createWebHashHistory } from 'vue-router'
import homeView from '../views/HomeView.vue'
import { useSiteStore } from '@/stores/store'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: homeView,
    },
    {
      path: '/sobre',
      name: 'sobre',
      component: () => import('../views/SobreView.vue'),
    },
    {
      path: '/episodios',
      name: 'episodios',
      component: () => import('../views/EpisodiosView.vue'),
    },
    {
      path: '/episodio',
      name: 'episodio',
      component: () => import('../views/EpisodioView.vue'),
    },
    {
      path: '/patrocinio',
      name: 'patrocinio',
      component: () => import('../views/PatrocinioView.vue'),
    },
    {
      path: '/patrocinador',
      name: 'patrocinador',
      component: () => import('../views/PatrocinadorView.vue'),
    },
    {
      path: '/contato',
      name: 'contato',
      component: () => import('../views/ContatoView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
    },
    {
      path: '/suporte',
      name: 'suporte',
      component: () => import('../views/SuporteView.vue'),
    },
    {
      path: '/administrativo',
      name: 'administrativo',
      component: () => import('../views/AdministrativoView.vue'),
      meta: {
        requiresAuth: true
      },
    },
  ],
})

router.beforeEach((to, from, next) => {
  const siteStore = useSiteStore()
  if(to.meta.requiresAuth && !siteStore.isAuthenticated){
    next('/home')
  }else{
    next()
  }
})

export default router