<template>
  <form class="form-horizontal">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="otpCode" class="text-capitalize">
            {{ $t("OTP_CODE") }}
          </label>

          <AuthOTPInput @update:otp="updateOtp" class="mb-2" />
          <div v-if="errorMessage" class="invalid-feedback">
            {{ $t(errorMessage) }}
          </div>
        </div>
      </div>
    </div>
    <!-- Input OTP code -->
  </form>
</template>

<script lang="ts" setup>
import { ref, defineEmits } from "vue";
import { verifyOTP } from "@/services/auth.service";
import { map, catchError, of, finalize } from "rxjs";
import { AuthErrorCodes, User } from "firebase/auth";
import { useAuthStore } from '@/stores/auth.store'

const authStore = useAuthStore()

// https://vuejs.org/guide/essentials/template-refs.html#accessing-the-refs
const btnSubmit = ref(null);
const isProcessing = ref(false);
const errorMessage = ref("");
const emit = defineEmits(['update:otp']);

// event when submit form
const updateOtp = (otpCode: string) => {
  // prevent call API multiples in one times
  if (isProcessing.value) {
    return;
  }

  isProcessing.value = true;

  // call API verify OTP code
  verifyOTP(otpCode, window.recaptchaVerifier)
    .pipe(
      map((user: User)  => {
        // update state user in store apply change
        authStore.currentUser = user;

        // callback after verify OTP success
        emit('update:otp', user);
      }),
      catchError((err) => {
        switch (err.code) {
          case AuthErrorCodes.INVALID_CODE:
            errorMessage.value = "MESSAGES.INVALID_CODE";
            break;
          case AuthErrorCodes.TOO_MANY_ATTEMPTS_TRY_LATER:
            errorMessage.value = "MESSAGES.TOO_MANY_TIME";
            break;
          default:
            errorMessage.value = "MESSAGES.SOMETHING_WAS_WRONG";
        }

        // enable button to try again
        isProcessing.value = false;

        return of(false);
      }),
      finalize(() => (isProcessing.value = false))
    )
    .subscribe();
};
</script>
