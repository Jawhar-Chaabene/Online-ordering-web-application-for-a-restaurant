import { createApp } from 'vue';
import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./routes";
import "@fortawesome/fontawesome-free/css/all.css";
import 'bootstrap/dist/css/bootstrap.min.css'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css'
import App from './App.vue'
import store from "./store"
let app = createApp(App)
const router = createRouter({
history: createWebHistory(),
routes: routes,
})
app.use(router).use(PrimeVue);
app.use(store)
app.mount("#app")
router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.isAuth)) {
    let token = localStorage.getItem('token');
    if (!token) {
    next("/");
    } else {
    console.log(token);
    next(); // Mettre next() ici après avoir vérifié
    
    
    }
    } else {
    next(); // Mettre next() ici si la route n'a pas besoin

    }
    });