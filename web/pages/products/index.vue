<template>
  <div>
    <div class="d-flex justify-content-between">
      <UiPageTitle title="PRODUCTS" />
      <div class="filter">
        <div class="btn-group">
          <button class="btn btn-info dropdown-toggle btn-sm text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ $t('ORDER_BY') }}: <span class="text-capitalize">{{ $t(ORDER_PRODUCTS[productsRef.orderBy]) }}  <i class="mdi mdi-chevron-down"></i></span>
          </button>
          <div class="dropdown-menu" style="">
              <span v-for="(item, index) in ORDER_PRODUCTS" :key="index" class="dropdown-item text-capitalize" @click="handleChangeSelectOrder(index)"> {{ $t(item) }} </span>
          </div>
        </div>
        <!-- Order by -->
      </div>
    </div>
    <div class="row">
      <div v-for="(product, i) in productsRef.paginator.data" :key="i" class="col-xl-3 col-sm-6">
        <ProductCardHorizontal :product="product" :key="product.slug_name" />
      </div>
      <div v-if="productsRef.loading" class="list-loading"></div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { reactive, watch } from "vue";
import { getProducts } from "@/services";
import type { Product, Paginator } from "@/types";
import { ORDER_PRODUCTS, ORDER_BY_NEWEST } from "@/enum/constants";

// products state
const productsRef = reactive<{
  loading: boolean,
  orderBy: number,
  paginator: Paginator<Product>
}>({
  loading: false,
  orderBy: ORDER_BY_NEWEST,
  paginator: {
    data: [],
    paginatorInfo: {}
  }
});

// API fetch products list 
const fetchProducts = async () => {
  // show loading animation
  productsRef.loading = true;

  const page = (productsRef.paginator?.paginatorInfo?.current_page ?? 0) + 1;

  (await getProducts(page, productsRef.orderBy, 20)).subscribe({
    next: ({ pending, data }) => {
      const { getProducts } = data.value;
      
      productsRef.paginator.data.push(...getProducts.data);
      productsRef.paginator.paginatorInfo = getProducts.paginatorInfo;
    },
    complete: () => {
      productsRef.loading = false;
    }
  })
}

// event when change order selection value
const handleChangeSelectOrder = (orderBy: number|string) => {
  productsRef.orderBy = parseInt(orderBy as string);
}

// refetch products list when change order value
watch(() => productsRef.orderBy, async () => {
  productsRef.paginator = { data: [], paginatorInfo: {} };
  
  await fetchProducts();
})

// created hook - fetching data on first load
await fetchProducts()

// onMounted(
//   () => {
//     window.onscroll = async () => {
//       if ((window.scrollY + window.innerHeight >= document.body.scrollHeight) && !productsRef.loading) {
//         await fetchProducts()
//       }
//     }
//   }
// )
</script>
