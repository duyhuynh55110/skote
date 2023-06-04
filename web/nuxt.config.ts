// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  app: {
    head: {
      bodyAttrs: {
        "data-topbar": "dark",
        "data-layout": "horizontal"
      }
    }
  },

  css: [
    '~/assets/scss/bootstrap.scss',
    '~/assets/scss/icons.scss',
    '~/assets/scss/app.scss'
  ],
});
