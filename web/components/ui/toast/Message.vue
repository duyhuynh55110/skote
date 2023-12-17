<template>
    <div :class="toastClass" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <div v-html="message?.content"></div>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" @click="$Toast.removeMessage(message.id)"></button>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineProps, computed, onMounted } from "vue";
    import { MessageType, Message } from "@/provider"
    import { CLOSE_TOAST_TIMEOUT } from "@/enum/constants"

    const { $Toast } = useNuxtApp()

    // define props have interface
    const props = defineProps<{
        message: Message
    }>();

    // toast class by message prop
    const toastClass = computed(() => {
        let customClass = 'bg-danger';

        switch(props.message?.type) {
            case MessageType.SUCCESS:
                customClass = 'bg-primary';
                break;
            case MessageType.WARNING:
                customClass = 'bg-warning';
                break;
            default:
                customClass = 'bg-danger';
        }

        return 'toast mb-2 fade show text-white ' + customClass;
    })

    onMounted(
        () => {
            // close this toast after times
            setTimeout(() => $Toast.removeMessage(props.message.id), CLOSE_TOAST_TIMEOUT)
        }
    )
</script>