<template>
    <div>
        <div class="row pb-3">
            <div class="col-2">
                <div class="categories-dropdown-wrap card">
                    <div class="categories-dropdown-inner card-body py-3">
                        <ul>
                            <li v-for="(category, i) in categoriesRef" :key="i">
                                <a href="#" class="text-muted d-flex align-items-center mb-3">
                                    <img :src="category.full_path_image" class="img-fluid me-2" width="20"> {{ category.name }}
                                </a>
                            </li>
                        </ul> 
                        <!-- Categories list -->
                    </div>
                </div>
            </div>
            <div class="col-10">
                <Flicking id="introduceCarousel" ref="introduceCarousel" :options="{ align: 'prev' }">
                    <div class="panel rounded">
                        <img src="https://nest.botble.com/storage/sliders/2-1.png" class="img-responsive">
                    </div>
                    <div class="panel rounded">
                        <img src="https://nest.botble.com/storage/sliders/2-2.png" class="img-responsive">
                    </div>
                </Flicking>
                <!-- Introduce Slides -->
            </div>
        </div>

        <UiPageTitle title="POPULAR_PRODUCTS" />
        <div class="row">
            <div v-for="(product, i) in popularProductsRef" :key="i" class="col-xl-3 col-sm-6">
                <ProductCardHorizontal :product="product" />
            </div>
        </div>
        <!-- Popular products -->

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <UiPageTitle title="TOP_SELLING" />
                <div class="row">
                    <div v-for="(product, i) in topSellingProductsRef" :key="i" class="col-lg-12">
                        <ProductCardVertical :product="product" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <UiPageTitle title="TRENDING_PRODUCTS" />
                <div class="row">
                    <div v-for="(product, i) in trendingProductsRef" :key="i" class="col-lg-12">
                        <ProductCardVertical :product="product" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <UiPageTitle title="RECENTLY_ADDED" />
                <div class="row">
                    <div v-for="(product, i) in recentlyProductsRef" :key="i" class="col-lg-12">
                        <ProductCardVertical :product="product" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style src="./Home.scss" lang="scss" scoped></style>

<script lang="ts" setup>
    import { ref } from "vue";
    import Flicking from "@egjs/vue3-flicking";
    import type { Category, Product } from "@/types";
    import { getHomepageData } from "@/services";

    // categories list state
    const categoriesRef = ref<Category[]>([]);

    // popular products state
    const popularProductsRef = ref<Product[]>([]);
    
    // recently products state
    const recentlyProductsRef = ref<Product[]>([]);

    // recently products state
    const trendingProductsRef = ref<Product[]>([]); 

    // recently products state
    const topSellingProductsRef = ref<Product[]>([]); 

    // API fetch master data for this page
    const fetchPageData = async () => {
        (await getHomepageData()).subscribe({
            next: ({ pending, data }) => {
                const { 
                    getCategories,
                    getPopularProducts,
                    getRecentlyProducts,
                    getTrendingProducts,
                    getTopSellingProducts
                } = data.value;

                if(!pending.value) {
                    categoriesRef.value = getCategories;
                    popularProductsRef.value = getPopularProducts.data;
                    recentlyProductsRef.value = getRecentlyProducts.data;
                    trendingProductsRef.value = getTrendingProducts.data;
                    topSellingProductsRef.value = getTopSellingProducts.data;
                }
            },
        })
    }

    await fetchPageData()
</script>
