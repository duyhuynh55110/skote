import { Carousel } from "bootstrap";

export default defineNuxtPlugin(() => ({
  provide: {
    bootstrap: {
        Carousel,
    },
  },
}));