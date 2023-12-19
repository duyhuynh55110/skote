<template>
  <form class="form-horizontal" @submit="onSubmit">
    <div class="row">
      <div class="col-4">
        <div class="form-group">
          <label for="countryCode" class="text-capitalize">
            {{ $t("COUNTRY_CODE") }}
          </label>
          <select
            name="country_code"
            id="countryCode"
            class="custom-select"
            v-bind="countryCode"
          >
            <option value="+84">(+84) VN</option>
          </select>
          <div v-if="errors.country_code" class="invalid-feedback">
            {{ errors.country_code }}
          </div>
        </div>
      </div>
      <!-- Country code -->

      <div class="col-8">
        <div class="form-group">
          <label for="phoneNumber" class="text-capitalize">
            {{ $t("PHONE_NUMBER") }}
          </label>
          <input
            type="text"
            class="form-control"
            id="phoneNumber"
            :placeholder="$t('ENTER_PHONE_NUMBER')"
            autocomplete="off"
            v-bind="phoneNumber"
            v-mask="'___-___-___'"
          />
          <div v-if="errors.phone_number" class="invalid-feedback">
            {{ errors.phone_number }}
          </div>
        </div>
      </div>
      <!-- Phone number -->
    </div>

    <div class="mt-1">
        <button
            :class="{
                'btn btn-primary btn-block waves-effect waves-light w-100 text-capitalize': true,
                'btn--loading': isProcessing
            }"
            type="submit"
            :disabled="isProcessing"
        >
            <div class="btn__text">{{ $t("GET_OTP_CODE")  }}</div>
        </button>
    </div>
    <!-- Submit button -->
  </form>
</template>

<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import { map, finalize } from 'rxjs';
import { RecaptchaVerifier } from 'firebase/auth';
import { type InputPhoneNumberForm } from '@/types/form';
import { PHONE_REG_EXP } from "@/utils/constants";
import { signInUsingPhoneNumber } from "@/services/auth.service";

// validator 
import { useForm } from "vee-validate";
import * as yup from "yup";

// set up form validate
const { errors, handleSubmit, defineInputBinds } = useForm<InputPhoneNumberForm>({
  validationSchema: yup.object({
    country_code: yup.string().required(),
    phone_number: yup
      .string()
      .matches(PHONE_REG_EXP, "Phone number is not valid")
      .required(),
  }),
  initialValues: {
    country_code: "+84",
    phone_number: "___-___-___",
  },
});

const countryCode = defineInputBinds("country_code");
const phoneNumber = defineInputBinds("phone_number");

// https://viblo.asia/p/ref-va-reactive-trong-vue-3-m2vJPORl4eK
const isProcessing = ref(false);

// https://vuejs.org/guide/components/events.html#declaring-emitted-events
const emit = defineEmits(['sentOTPCode'])

const nuxtApp = useNuxtApp()

// mounted hook
// https://vuejs.org/api/composition-api-lifecycle.html#onmounted
onMounted(() => {
  window.recaptchaVerifier = new RecaptchaVerifier(nuxtApp.$auth, 'recaptcha-container', {
    'size': 'invisible',
    'callback': (response) => {
      // reCAPTCHA solved, allow signInWithPhoneNumber.
    }
  });
})

// Creates a submission handler. It validate all fields and doesn't call your function unless all fields are valid
const onSubmit = handleSubmit((values: InputPhoneNumberForm) => {
    // disable submit multiple and load proccessing animation
    isProcessing.value = true;

    const phoneNumber = values.country_code + values.phone_number.replace(/-/g, '');
    
    // call API send OTP code
    signInUsingPhoneNumber(phoneNumber, window.recaptchaVerifier)
    .pipe(
        map(() => {
            emit('sentOTPCode', values)
        }),
        finalize(() => isProcessing.value = false)
    )
    .subscribe();
});
</script>
