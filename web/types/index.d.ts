export {}
import { RecaptchaVerifier, ConfirmationResult } from "firebase/auth";

declare global {
  interface Window {
    // determine for use firebase
    confirmationResult: ConfirmationResult;
    recaptchaVerifier: RecaptchaVerifier;
  }
}