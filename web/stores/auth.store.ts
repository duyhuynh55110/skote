import { User } from 'firebase/auth'
// import { ref, Ref } from "vue"

export const useAuthStore = defineStore('auth', {
    state: () => ({
        currentUser: null as User|null,
    }),
})
