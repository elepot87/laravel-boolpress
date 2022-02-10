//DIPENDENZE
import Vue from "vue";
import VueRouter from "vue-router";

// COMPONENTI PER ROTTA
import Home from "./pages/Home.vue";
import About from "./pages/About.vue";

// ATTIVAZIONE ROUTER IN VUE.JS
Vue.use(VueRouter);

// DEFINIZIONE DELLE ROTTE
const router = new VueRouter({
    mode: "history", //serve per evitare di avere in url l'#
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/about",
            name: "about",
            component: About,
        },
    ],
});

// EXPORT ROTTE PER ESSERE USATE CON IMPORT IN ALTRI FILE
export default router;
