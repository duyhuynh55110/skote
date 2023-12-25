<template>
    <div class="card">
        <div class="row no-gutters align-items-center">
            <div class="col-md-4">
                <img class="card-img img-fluid p-1" :src="product.full_path_image" alt="Card image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"> {{ product.name }} </h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import type { Product } from "@/types"

    const props = defineProps<{
        product: Product
    }>();
</script>
