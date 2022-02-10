//DIPENDENZE
import Vue from "vue";
import VueRouter from "vue-router";

// COMPONENTI PER ROTTA

// ATTIVAZIONE ROUTER IN VUE.JS
Vue.use(VueRouter);

// DEFINIZIONE DELLE ROTTE
const router = new VueRouter({
    mode: "history", //serve per evitare di avere in url l'#
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
    ],
});
