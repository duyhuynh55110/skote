/**
 * Docs useful for this
 * 
 * https://rxjs.dev/api/index/function/map#map
 * https://rxjs.dev/api/index/function/pipe#pipe
 */

import { from, map } from 'rxjs'
import { getAuth, signInWithPhoneNumber, RecaptchaVerifier, type UserCredential, type User } from "firebase/auth"
import { useAuthStore } from '@/stores/auth.store'

/**
 * Sign in by phone number
 * 
 * @param phoneNumber 
 * @param appVerifier 
 */
export const signInUsingPhoneNumber = (phoneNumber: string, appVerifier: RecaptchaVerifier) => {
    const auth = getAuth();

    return from(
        signInWithPhoneNumber(auth, phoneNumber, appVerifier)
    ).pipe(
        map(confirmationResult => {
            // SMS sent. Prompt user to type the code from the message, then sign the
            // user in with confirmationResult.confirm(code).
            window.confirmationResult = confirmationResult;
        })
    );
}

/**
 * Verify OTP code 
 * 
 * @param otpCode  
 * @return User
 */
export const verifyOTP = (otpCode: string) => {
    return from(
        window.confirmationResult.confirm(otpCode)
    )
    .pipe(
        map((response: UserCredential): User => response?.user),
    )
}

/**
 * Firebase API fetch user's data 
 */
export const identity = () => {
    const { $auth } = useNuxtApp()
    const authStore = useAuthStore()

    return from(
        new Promise<User|null>((resolve, reject) => {
            $auth.onAuthStateChanged((user: User|null) => {
                return resolve(user);
            });
        })
    ).pipe(
        map(
            (user: User|null) => {
                // update user's inform to store
                authStore.currentUser = user;
            }
        )
    );
}

/**
 * Firebase API fetch user's data 
 */
export const signOut = () => {
    const { $auth } = useNuxtApp()
    const authStore = useAuthStore()

    return from(
        $auth.signOut()
    )
    .pipe(
        map(
            () => {
                authStore.currentUser = null;
            }
        )
    );
}
