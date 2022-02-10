//Importa Dependencies
import Vue from "vue";
import App from "./views/App";

// App router (rotte per l'app)
import router from "./routes";

// Init Vue Instance
const root = new Vue({
    el: "#root",
    router, //router: router,
    render: (h) => h(App),
});
