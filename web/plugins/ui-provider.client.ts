import { $Toast } from "@/provider";

export default defineNuxtPlugin(() => ({
  provide: {
    Toast: $Toast,
  },
}));