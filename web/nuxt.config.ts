// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
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
