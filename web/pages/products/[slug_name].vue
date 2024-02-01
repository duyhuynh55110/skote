<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div
          class="page-title-box d-flex align-items-center justify-content-between"
        >
          <h4 class="mb-0 font-size-18">Product Detail</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item text-capitalize">
                <a href="javascript: void(0);"> {{ $t('PRODUCTS') }} </a>
              </li>
              <li class="breadcrumb-item active"> {{ product?.name }} </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6">
              <div class="product-detai-imgs">
                <div class="row">
                  <div class="col-md-2 col-3">
                    <div
                      class="nav flex-column nav-pills"
                      id="v-pills-tab"
                      role="tablist"
                      aria-orientation="vertical"
                    >
                      <a
                        class="nav-link active"
                        id="product-1-tab"
                        data-toggle="pill"
                        href="#product-1"
                        role="tab"
                        aria-controls="product-1"
                        aria-selected="true"
                      >
                        <img
                          :src="product?.full_path_image"
                          alt=""
                          class="img-fluid mx-auto d-block rounded"
                        />
                      </a>
                    </div>
                  </div>
                  <div class="col-md-7 offset-md-1 col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="product-1"
                        role="tabpanel"
                        aria-labelledby="product-1-tab"
                      >
                        <div>
                          <img
                            :src="product?.full_path_image"
                            alt=""
                            class="img-fluid mx-auto d-block"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button
                        type="button"
                        class="btn btn-primary waves-effect waves-light mt-2 me-1"
                      >
                        <i class="bx bx-cart me-2"></i> Add to cart
                      </button>
                      <button
                        type="button"
                        class="btn btn-success waves-effect waves-light mt-2"
                      >
                        <i class="bx bx-shopping-bag me-2"></i>Buy now
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="mt-4 mt-xl-3">
                <a v-for="category in categories" :key="category.slug_name" href="#" class="text-primary me-1">#{{category.name}}</a>
                <h4 class="mt-1 mb-3"> {{  product?.name }} </h4>

                <div class="d-flex">
                  <ProductStarRating :summaryRating="product?.summary_rating" class="me-1" />

                  <p class="text-muted mb-4">({{product?.count_rating}} Customers Review)</p>
                </div>
                <!-- <h6 class="text-success text-uppercase">20 % Off</h6> -->
                <h5 class="mb-4">
                  Price:
                  <!-- <span class="text-muted me-2"><del>$240 USD</del></span> -->
                  <b>${{ product?.item_price }}</b>
                </h5>
                <div class="text-muted mb-4" v-html="product?.description"></div>
              </div>
            </div>
          </div>
          <!-- end row -->

          <div class="mt-5">
            <h5 class="mb-3 text-capitalize">{{ $t('SPECIFICATIONS') }}:</h5>

            <div class="table-responsive">
              <table class="table mb-0 table-bordered">
                <tbody>
                  <tr>
                    <th scope="row"><div class="text-capitalize">{{ $t('CATEGORY') }}</div></th>
                    <td>
                      <span v-for="category in categories" :key="category.slug_name"> #{{ category.name }} </span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row "><span class="text-capitalize"> {{ $t('BRAND') }} </span></th>
                    <td> 
                      <NuxtLink to="#" class="text-link text-decoration-underline"> {{ product?.brand?.name}} </NuxtLink>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end Specifications -->
        </div>
      </div>
      <!-- end card -->
    </div>
    <!-- end row -->

    <div class="row mt-3">
      <div class="col-lg-12">
          <div>
              <h5 class="mb-3 text-capitalize"> {{ $t('RELATE_PRODUCTS') }}:</h5>

              <div class="row">
                  <div v-for="product in relatedProducts" :key="product?.slug_name" class="col-xl-4 col-sm-6">
                      <div class="card">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-md-4">
                                      <img :src="product.full_path_image" alt="" class="img-fluid mx-auto d-block">
                                  </div>
                                  <div class="col-md-8">
                                      <div class="text-center text-md-left pt-3 pt-md-0">
                                          <h5 class="mb-3 text-truncate"><a href="#" class="text-dark"> {{ product.name }} </a></h5>
                                          <ProductStarRating :summaryRating="product.summary_rating" class="me-1" />
                                          <h5 class="my-0"><b>$135</b></h5>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- end row -->
          </div>
      </div>
    </div>
    <!-- Relation products -->
  </div>
</template>

<script lang="ts" setup>
import { getProductBySlugName, getProductsByCategorySlug } from "@/services"
import type { Product } from "@/types"

const route = useRoute()

const isFetching = ref(false)
const product = ref<Product|null>(null)

const isFetchingRelatedProducts = ref(false)
const categories = computed(() => product.value?.categories ?? [])
const relatedProducts = ref<Product[]>([])

// API fetch product detail by slug_name
const fetchProduct = async () => {
  // show isFetching animation
  isFetching.value = true;

  const slugName = route.params?.slug_name as string

  // API fetch 
  (await getProductBySlugName(slugName)).subscribe({
    next: ({ data }) => {
      const { getProductBySlugName } = data.value;
      
      product.value = getProductBySlugName;
    },
    complete: () => {
      isFetching.value = false;
    }
  })
}

// API fetch related products with this product
const fetchRelatedProducts = async () => {
  isFetchingRelatedProducts.value = true;

  const categorySlugNameList = product.value!.categories?.map(category => category.slug_name) as string[]|undefined;

  if(categorySlugNameList === undefined) return;

  // API fetch 
  (await getProductsByCategorySlug(categorySlugNameList)).subscribe({
    next: ({ data }) => {
      console.log(data);
      const { getProducts } = data.value;

      relatedProducts.value = getProducts.data;
    },
    complete: () => {
      isFetchingRelatedProducts.value = false;
    }
  })
}

// created hook
await fetchProduct()
await fetchRelatedProducts()
</script>
