// resources/js/app.js (ou onde for seu entrypoint)
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import 'vue3-toastify/dist/index.css'
import Vue3Toastify from 'vue3-toastify'
import axios from 'axios'

axios.defaults.headers.common['X-CSRF-TOKEN'] =
  document.head.querySelector('meta[name="csrf-token"]').content;

// Carrega todas as Pages numa object-map
const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

createInertiaApp({
  resolve: name => {
    const page = pages[`./Pages/${name}.vue`]
    if (!page) {
      throw new Error(`Página "${name}" não encontrada em /Pages`) 
    }
    // aqui está o truque: retorna o componente default export
    return page.default 
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)               // injetando Inertia
      .use(Vue3Toastify, {       // seu toast
        autoClose: 3000,
        clearOnUrlChange: true,
        position: 'top-right',
      })
      .mount(el)
  },
})
