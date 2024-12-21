require('./bootstrap');

import { Inertia } from '@inertiajs/inertia'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

createInertiaApp({
    title: title => `${title} - Matt Strauss | Software Developer`,
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el) 
    },
})

