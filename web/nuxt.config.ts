// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  // false -> using client-side rendering
  ssr: false,
  
  // https://nuxt.com/docs/guide/going-further/runtime-config
  runtimeConfig: {
    // Keys within public, will be also exposed to the client-side
    public: {
      FB_API_KEY: process.env.FB_API_KEY,
      FB_AUTH_DOMAIN: process.env.FB_AUTH_DOMAIN,
      FB_PROJECT_ID: process.env.FB_PROJECT_ID,
      FB_STORAGE_BUCKET: process.env.FB_STORAGE_BUCKET,
      FB_MESSAGING_SENDER_ID: process.env.FB_MESSAGING_SENDER_ID,
      FB_APP_ID: process.env.FB_APP_ID,
      FB_MEASUREMENT_ID: process.env.FB_MEASUREMENT_ID,
    }
  },

  // define attrs for body tag
  app: {
    head: {
      bodyAttrs: {
        "data-topbar": "dark",
        "data-layout": "horizontal"
      }
    }
  },

  // global css file
  css: [
    '~/assets/scss/bootstrap.scss',
    '~/assets/scss/icons.scss',
    '~/assets/scss/app.scss'
  ],

  plugins: [
    // avoid call bootstrap event on server hook
    { src: '~/plugins/bootstrap.client', mode: 'client' },
    { src: '~/plugins/directive.client', mode: 'client' },
    { src: '~/plugins/firebase.client', mode: 'client' },
  ],

  modules: [
    [
      '@nuxtjs/i18n',
      {
        locales: ['en'],
        defaultLocale: 'en',
        vueI18n: './nuxt-i18n.ts'
      }
    ]
  ],
});
