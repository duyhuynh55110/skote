<template>
  <div class="otp-container" ref="otpCont">
    <!-- input fields for OTP digits -->
    <input
      v-for="(el, ind) in digitCount"
      :key="ind"
      type="text"
      class="form-control otp-input"
      pattern="\d"
      maxlength="1"
      v-model="digits[ind]"
      :disabled="ind !== 0"
      :autofocus="ind === 0"
      @keydown="handleKeyDown($event, ind)"
    />
  </div>
</template>

<style lang="scss" scoped>
.otp-container {
  display: flex;
  gap: 1.5rem;

  .otp-input {
    border-radius: 0.25rem;
    width: 15%;
    line-height: 2.5rem;
    text-align: center;

    &:disabled {
      background: #eff2f7;
    }
  }
}
</style>

<script lang="ts" setup>
import { ref, reactive } from "vue";

interface Props {
  digitCount: number;
}

// define props
const props = withDefaults(defineProps<Props>(), {
  digitCount: 6,
});

const digits = reactive([]);

// add items to state.digits
for (let i = 0; i < props.digitCount; i++) {
  digits[i] = null;
}

const otpCont = ref(null);

// event when user input a key
const handleKeyDown = function (event, ind) {
  // block input special key
  if (
    event.key !== "Tab" &&
    event.key !== "ArrowRight" &&
    event.key !== "ArrowLeft"
  ) {
    event.preventDefault();
  }

  if (event.key === "Backspace") {
    digits[ind] = null;

    if (ind != 0) {
      otpCont.value.children[ind - 1].focus();
    }

    return;
  }

  // Only accept digit was valid
  if (new RegExp("^([0-9])$").test(event.key)) {
    digits[ind] = event.key;

    if (ind != props.digitCount - 1) {
      let input = otpCont.value.children[ind + 1];

      input.removeAttribute("disabled");
      input.focus();
    }

    // check user input full digit or not
    if (isDigitsFull()) {
        emit("update:otp", digits.join(""));
    }
  }
};

const emit = defineEmits(["update:otp"]);

// Check user input full digit
const isDigitsFull = function () {
  for (const elem of digits) {
    if (elem == null || elem == undefined) {
      return false;
    }
  }

  return true;
};
</script>
