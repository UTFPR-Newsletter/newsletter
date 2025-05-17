import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import 'vue3-toastify/dist/index.css'
import Vue3Toastify from 'vue3-toastify'

// Carrega _todas_ as .vue em Pages automaticamente
const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

createInertiaApp({
    resolve: name => {
        const page = pages[`./Pages/${name}.vue`]
        return page
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.use(plugin)
        app.use(Vue3Toastify, {
            autoClose: 3000,
            clearOnUrlChange: true,
            position: "top-right",
        })
        app.mount(el)
    },
})
