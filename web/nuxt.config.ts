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
  
  vite: {
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: `
            @import "~/assets/scss/plugins/bootstrap.scss";
            @import "~/assets/scss/variables.scss";
          `,
        },
      },
    },
  },

  css: ['~/assets/scss/app.scss'],
});
