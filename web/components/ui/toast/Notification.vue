<template>
    <div class="toast fade show" role="alert">
        <div class="toast-header">
            <img src="@/assets/images/logo.svg" alt="" class="me-2" height="18">
            <strong class="me-auto">{{ message.title }} </strong>
            <small class="text-muted">Just now</small>
            <button @click="$Toast.removeMessage(message.id);" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ message.content }}
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineProps } from "vue";
    import { Message } from "@/provider"
    import { CLOSE_TOAST_TIMEOUT } from "@/enum/constants"

    const { $Toast } = useNuxtApp()

    // define props 
    const props = defineProps<{
        message: Message
    }>();

    onMounted(
        () => {
            // close this toast after times
            setTimeout(() => $Toast.removeMessage(props.message.id), CLOSE_TOAST_TIMEOUT)
        }
    )
</script>