import { type User } from 'firebase/auth'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        currentUser: null as User|null,
    }),
})
