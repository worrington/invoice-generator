import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/server'
import { h } from 'vue'

createServer(page =>
  createInertiaApp({
    page,
    render: require('@vue/server-renderer').renderToString,
    resolve: name => require(`./Pages/${name}.vue`),
    setup({ App, props, plugin }) {
      return createApp({ render: () => h(App, props) }).use(plugin)
    },
  })
)