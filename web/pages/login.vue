<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
          <div class="bg-soft-primary">
            <div class="row">
              <div class="col-7">
                <div class="text-primary p-4">
                  <h5 class="text-primary">Welcome Back !</h5>
                  <p>Sign in to continue to Skote.</p>
                </div>
              </div>
              <div class="col-5 align-self-end">
                <img
                  src="@/assets/images/profile-img.png"
                  alt=""
                  class="img-fluid"
                />
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div>
              <div class="avatar-md profile-user-wid mb-4">
                <span class="avatar-title rounded-circle bg-light">
                  <img
                    src="@/assets/images/logo.svg"
                    alt=""
                    class="rounded-circle"
                    height="34"
                  />
                </span>
              </div>
            </div>
            <div class="p-2">
               <AuthInputPhoneNumberForm 
                  v-if="isStep == AUTH_INPUT_PHONE_NUMBER_FORM" 
                  @sentOTPCode="sentOTPCode"
                />
                <!-- Step1 - Input phone number -->

                <AuthInputOTPCodeForm 
                  v-else-if="isStep == AUTH_INPUT_OTP_CODE_FORM"
                  @update:otp="verifiedOTPSuccess"
                />
                <!-- Step2 - Input OTP code -->
            </div>
            <!-- Sign up by phone number -->
          </div>
        </div>
      </div>
    </div>

    <div id="recaptcha-container"></div>
  </div>
</template>

<script lang="ts" setup>
definePageMeta({
  layout: "authenticate",
});

import { type InputPhoneNumberForm } from '@/types/form';
import { ref } from 'vue';
import { AUTH_INPUT_PHONE_NUMBER_FORM, AUTH_INPUT_OTP_CODE_FORM } from "@/utils/constants";
import { type User } from "firebase/auth"

const { $Toast, $i18n } = useNuxtApp()

const isStep = ref(AUTH_INPUT_PHONE_NUMBER_FORM)

// send OTP code success -> go to next step
const sentOTPCode = (values: InputPhoneNumberForm) => {
  isStep.value++;
}

// event when user input OTP code success
const verifiedOTPSuccess = async (user: User) => {
  $Toast.info($i18n.t('WELCOME'), $i18n.t("SYSTEM_MESSAGES.WELCOME_BACK", { username: user?.phoneNumber }));

  // go to homepage
  await navigateTo('/')
}
</script>
