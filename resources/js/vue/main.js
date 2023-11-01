import { createApp } from "vue";

//tailwind
import '../../css/vue.css'

//oruga
import Oruga from '@oruga-ui/oruga-next';
import '@oruga-ui/oruga-next/dist/oruga.css';
import '@oruga-ui/oruga-next/dist/oruga-full.css';
import '@oruga-ui/oruga-next/dist/oruga-full-vars.css'




//material Design
import '@mdi/font/css/materialdesignicons.min.css';

import axios from 'axios';

import App from "./App.vue";

//vue router
import router from "./router.js";

const app = createApp(App).use(Oruga).use(router)

app.config.globalProperties.$axios = axios
window.axios = axios  


app.mount('#app')