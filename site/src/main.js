import './assets/css/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import VueSweetalert2 from 'vue-sweetalert2'

import 'sweetalert2/dist/sweetalert2.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
//import 'bootstrap-icons/font/bootstrap-icons.css'

import App from './App.vue'
import router from './router'
import icons from './fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add({...icons})

const app = createApp(App)

app.component("font-awesome-icon", FontAwesomeIcon)
app.use(createPinia())
app.use(router)
app.use(VueSweetalert2)


app.mount('#app')