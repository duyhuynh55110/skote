<template>
    <div>
        <div class="row pb-3">
            <div class="col-2">
                <div class="categories-dropdown-wrap card">
                    <div class="categories-dropdown-inner card-body py-3">
                        <ul>
                            <li v-for="i in 12" :key="i">
                                <a href="https://nest.botble.com/product-categories/milks-and-dairies" class="text-muted d-flex align-items-center mb-3">
                                    <img :src="`https://nest.botble.com/storage/product-categories/icon-${i}.png`" class="img-fluid me-2" width="20"> Milks and Dairies 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div ref="introCarousel" style="border-radius: 30px" class="overflow-hidden carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <!-- [End] Indicators -->

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://nest.botble.com/storage/sliders/5-1.png" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="https://nest.botble.com/storage/sliders/5-2.png" class="d-block w-100">
                        </div>
                    </div>
                    <!-- [End] Slide -->
                </div>
                <!-- [End] Intro Carousel -->
            </div>
        </div>

        <!-- <UiPageTitle title="TOP_CATEGORIES" />
        <div class="row">
            <div class="col-12">
                <div ref="categoriesCarousel" class="text-thu">
                    <div v-for="i in 12" :key="i" style="background-color: red">
                        <div class="card-body">
                            <img src="https://nest.botble.com/storage/product-categories/image-1-400x400.png" class="img-fluid" style="max-width: 80px">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- [END] Top Categories -->

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
        <!-- [END] Popular products -->

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

<style src="./home.scss" lang="scss" scoped></style>

<script lang="ts" setup>
    import { ref, onMounted, defineComponent } from 'vue'
    import { Carousel } from 'bootstrap'

    // optional style for arrows & dots
    import 'flickity/css/flickity.css'

    const { $bootstrap } = useNuxtApp();

    // declare a ref to hold the element reference
    // the name must match template ref value
    const introCarousel = ref();
    const categoriesCarousel = ref();

    // mounted hook
    onMounted(() => {
        initIntroCarousel()
        // initTopCategoriesCarousel()
    })

    //initial bootstrap carousel
    const initIntroCarousel = async () => {
        const Flickity = await import('flickity');

        return new Flickity.default(introCarousel.value, {
            interval: 2000,
            wrap: true,
            touch: true,
        })
    }

    const initTopCategoriesCarousel = async () => {
        // https://flickity.metafizzy.co/
        const Flickity = await import('flickity');

        return new Flickity.default(categoriesCarousel.value, {
            cellAlign: 'left',
            contain: true,
            pageDots: false,
        });
    }
</script>
