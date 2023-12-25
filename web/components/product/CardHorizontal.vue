<template>
    <div class="card">
        <div class="card-body">
            <div class="product-img position-relative">
                <!-- <div class="avatar-sm product-ribbon">
                    <span class="avatar-title rounded-circle  bg-primary">
                        - 25 %
                    </span>
                </div> -->
                <img :src="product.full_path_image" alt="" class="img-fluid mx-auto d-block">
            </div>
            <div class="mt-4 text-center">
                <h5 class="mb-3 text-truncate"><a href="#" class="text-dark"> {{ product.name }}</a></h5>
                
                <p class="text-muted">
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                    <i class="bx bx-star text-warning"></i>
                </p>
                <h5 class="my-0">
                    <b>${{ product.item_price }} </b>
                </h5>
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
