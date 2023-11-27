/**
 * Docs useful for this
 * 
 * https://rxjs.dev/api/index/function/map#map
 * https://rxjs.dev/api/index/function/pipe#pipe
 */

import { from, map, tap } from 'rxjs'
import { getAuth, signInWithPhoneNumber, RecaptchaVerifier, UserCredential } from "firebase/auth"

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
 */
export const verifyOTP = (otpCode: string) => {
    return from(
        window.confirmationResult.confirm(otpCode)
    )
    .pipe(
        map((response: UserCredential) => response?.user?.uid),
    )
}
