import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

// Carrega _todas_ as .vue em Pages automaticamente
const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

createInertiaApp({
    resolve: name => {
        // monta o caminho exato, incluindo a extensão
        const page = pages[`./Pages/${name}.vue`]
        if (!page) {
            throw new Error(`Página ${name} não encontrada em ./Pages`)
        }
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .mount(el)
    },
})
