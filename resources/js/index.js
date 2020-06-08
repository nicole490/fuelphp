import Vue from "vue"
import './bootstrap'
import store from './store'
import router from './router'
import App from "./App"

new Vue({
    el: "#app",
    router,
    store,
    template: "<App/>",
    components: { App }
})