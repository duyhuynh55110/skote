<template>
    <div>
        <div class="row pb-3">
            <div class="col-2">
                <div class="categories-dropdown-wrap card">
                    <div class="categories-dropdown-inner card-body py-3">
                        <div v-if="categoriesRef.loading" class="list-loading"></div>
                        <ul v-else>
                            <li v-for="(category, i) in categoriesRef.data" :key="i">
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
            <div v-for="i in 12" :key="i" class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-img position-relative">
                            <div class="avatar-sm product-ribbon">
                                <span class="avatar-title rounded-circle  bg-primary">
                                    - 25 %
                                </span>
                            </div>
                            <img :src="`https://nest.botble.com/storage/products/${i}-400x400.jpg`" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <div class="mt-4 text-center">
                            <h5 class="mb-3 text-truncate"><a href="#" class="text-dark">Half sleeve T-shirt </a></h5>
                            
                            <p class="text-muted">
                                <i class="bx bx-star text-warning"></i>
                                <i class="bx bx-star text-warning"></i>
                                <i class="bx bx-star text-warning"></i>
                                <i class="bx bx-star text-warning"></i>
                                <i class="bx bx-star text-warning"></i>
                            </p>
                            <h5 class="my-0"><span class="text-muted mr-2"><del>$500</del></span> <b>$450</b></h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popular products -->

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <UiPageTitle title="TOP_SELLING" />
                <div class="row">
                    <div v-for="i in 3" :key="i" class="col-lg-12">
                        <div class="card">
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-4">
                                    <img class="card-img img-fluid" :src="`https://nest.botble.com/storage/product-categories/image-${i}-400x400.png`" alt="Card image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <UiPageTitle title="TRENDING_PRODUCTS" />
            </div>
            <div class="col-md-6 col-lg-4">
                <UiPageTitle title="RECENTLY_ADDED" />
            </div>
        </div>
    </div>
</template>

<style src="./Home.scss" lang="scss" scoped></style>

<script lang="ts" setup>
    import { reactive } from "vue";
    import Flicking from "@egjs/vue3-flicking";
    import type { Category } from "@/types/category";
    import { getCategories } from "@/services/category.service";
    import type { AQRGetCategories } from '@/types/apolloQueryReturn';

    // config page
    definePageMeta({
        middleware: "fetch-user"
    })

    // state data
    const categoriesRef = reactive<{
        loading: boolean,
        data: Category[]
    }>({
        loading: false,
        data: []
    });
    
    // call API fetch categories list
    const fetchCategories = () => {
        categoriesRef.loading = true;

        getCategories().subscribe({
            next: (result: AQRGetCategories) => {
                categoriesRef.loading = result.loading;
                
                // set data when fetch completed
                if(!result.loading) {
                    categoriesRef.data = result?.data?.getCategories;
                }
            },
            error: (err) => {
                // Handle errors from the RxJS Observable
                console.error('Error:', err);
            },
        });
    }

    fetchCategories()
</script>
