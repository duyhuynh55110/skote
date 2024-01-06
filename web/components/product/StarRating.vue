<template>
    <p class="text-muted">
        <i v-for="line in maxRate" :class="['bx bx-star', { 'text-warning': colorStar(line) }]"></i>
    </p>
</template>

<script setup lang="ts">
    const props = withDefaults(defineProps<{
        summaryRating: number
    }>(), {
        summaryRating: 0
    })

    const maxRate = 5;

    // condition to color a star
    const colorStar = (line: number) => {
        return line <= props.summaryRating + 1;
    }
</script>