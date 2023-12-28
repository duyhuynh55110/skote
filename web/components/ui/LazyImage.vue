<template>
    <img class="img-fluid mx-auto d-block" src="@/assets/images/loading.svg" :data-url="source" :alt="source"  v-lazy-load />
</template>

<script setup lang="ts">
    defineProps<{
        source: string
    }>()
</script>
