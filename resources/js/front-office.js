//Importa Dependencies
import Vue from "vue";
import App from "./views/App";

// Init Vue Instance
const root = new Vue({
    el: "#root",
    render: (h) => h(App),
});
