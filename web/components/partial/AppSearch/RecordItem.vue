<template>
    <div v-if="searchItem" class="item p-2" @click="handleClickItem(searchItem.slug_name)">
        <div class="row">
            <div class="col-4">
                <UiLazyImage :source="searchItem.full_path_image" />
            </div>
            <div class="col-8">
                <h6> {{ searchItem.name }} </h6>
                <h6 v-if="searchItem?.item_price" class="my-0 w-75"><b>${{ searchItem.item_price }}</b></h6>
            </div>
        </div>
    </div>
    <div v-else class="item p-2">
        <div class="row">
            <div class="col-4">
                <UiLazyImage skeletonHeight="6rem" />
            </div>
            <div class="col-8">
                <h6 class="skeleton"></h6>
                <p class="skeleton w-25"></p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import type { SearchItem } from '@/types';

const emit = defineEmits(['clear-list']);

defineProps<{
    searchItem?: SearchItem,
}>()

// event on click search item 
const handleClickItem = (slugName: string) => {
    emit('clear-list');
    navigateTo(`/products/${slugName}`);
}
</script>