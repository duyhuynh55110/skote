import { initializeApp } from 'firebase/app'
import { getAuth } from "firebase/auth"

export default defineNuxtPlugin(() => {
    const config = useRuntimeConfig()

    const firebaseConfig = {
        apiKey: config.public.FB_API_KEY,
        authDomain: config.public.FB_AUTH_DOMAIN,
        projectId: config.public.FB_PROJECT_ID,
        storageBucket: config.public.FB_STORAGE_BUCKET,
        messagingSenderId: config.public.FB_MESSAGING_SENDER_ID,
        appId: config.public.FB_APP_ID,
        measurementId: config.public.FB_MEASUREMENT_ID
    };
    
    const app = initializeApp(firebaseConfig)
    const auth = getAuth(app)

    return {
        provide: {
            auth // add auth to global -> $auth
        }
    }
})