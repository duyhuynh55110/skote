<template>
  <div>
    <div class="d-flex justify-content-between">
      <UiPageTitle title="PRODUCTS" />
      <div class="filter">
        <div class="btn-group">
          <button class="btn btn-info dropdown-toggle btn-sm text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ $t('ORDER_BY') }}: <span class="text-capitalize">{{ $t(ORDER_PRODUCTS[currentOrderBy]) }}  <i class="mdi mdi-chevron-down"></i></span>
          </button>
          <div class="dropdown-menu" style="">
              <span v-for="(item, index) in ORDER_PRODUCTS" :key="index" :class="['dropdown-item text-capitalize', { 'active': index === currentOrderBy }]" @click="handleChangeSelectOrder(index as string)"> {{ $t(item) }} </span>
          </div>
        </div>
        <!-- Order by -->
      </div>
    </div>
    
    <div class="row">
      <div v-for="(product, i) in paginator.data" :key="i" class="col-xl-3 col-sm-6">
        <ProductCardHorizontal :product="product" :key="product.slug_name" />
      </div>
      <div v-if="loading" class="list-loading"></div>
    </div>
    <!-- Products list -->

    <div class="row">
      <div class="col-lg-12">
        <UiPagination v-if="paginator.paginatorInfo" :lastPage="paginator.paginatorInfo?.last_page" :currentPage="currentPage" @page-change="handlePageChange" />
      </div>
    </div>
    <!-- Pagination -->
  </div>
</template>

<script lang="ts" setup>
import { ref, watch } from "vue";
import { getProducts } from "@/services";
import type { Product, Paginator } from "@/types";
import { ORDER_PRODUCTS, ORDER_BY_NEWEST } from "@/enum/constants";

// products state
const loading = ref(false);
const paginator = ref<Paginator<Product>>({
  data: [],
  paginatorInfo: undefined
});

const route = useRoute()

// list current page
const requestPage = route.query?.page as string;
const currentPage = ref<number>(requestPage ? parseInt(requestPage) :  1);

// list ordering by
const requestOrderBy= route.query?.order_by as string;
const currentOrderBy = ref<string>(requestOrderBy ? requestOrderBy : ORDER_BY_NEWEST);

// API fetch products list 
const fetchProducts = async () => {
  // show loading animation
  loading.value = true;

  (await getProducts(currentPage.value, currentOrderBy.value)).subscribe({
    next: ({ data }) => {
      const { getProducts } = data.value;
      
      paginator.value.data = getProducts.data;
      paginator.value.paginatorInfo = getProducts.paginatorInfo;
    },
    complete: () => {
      loading.value = false;
    }
  })
}

// event when change order selection value
const handleChangeSelectOrder = (orderBy: string) => {
  currentOrderBy.value = orderBy;
}

// [Emit] event on change current page by Pagination component
const handlePageChange = (page: number) => {
  currentPage.value = page;
}

// refetch products list when change order value
watch(() => currentOrderBy.value, async (newVal, oldVal) => {
  currentPage.value = 1;

  // save value to URL
  setRouteQuery({ order_by: newVal, page: 1 })

  // reset list
  paginator.value.data = [];
  
  await fetchProducts();
})

// watcher on change currentPage -> update to query on URL
watch(() => currentPage.value, async (newVal, oldVal) => {
  // save value to URL
  setRouteQuery({ page: newVal })

  // reset list
  paginator.value.data = [];

  await fetchProducts();
})

// created hook - fetching data on first load
await fetchProducts()
</script>
