<template>
  <img
    v-if="source"
    class="img-fluid mx-auto d-block"
    :data-url="source" alt=""  v-lazy-load 
  />
  <div v-else class="skeleton" :style="{ 'height': skeletonHeight }"></div>
</template>

<script setup lang="ts">
// source is true: display image; false: display skeleton
withDefaults(
  defineProps<{
    source?: string,
    skeletonHeight?: string
  }>(),
  {
    source: "",
    skeletonHeight: "18rem"
  }
);
</script>
