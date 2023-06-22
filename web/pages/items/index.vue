<template>
  <div>
    <UiPageTitle title="ITEMS" />
    <div class="row">
      <div v-for="i in 16" :key="i" class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="product-img position-relative">
              <div class="avatar-sm product-ribbon">
                <span class="avatar-title rounded-circle bg-primary">
                  - 25 %
                </span>
              </div>
              <img
                :src="`https://nest.botble.com/storage/products/${i}-400x400.jpg`"
                alt=""
                class="img-fluid mx-auto d-block"
              />
            </div>
            <div class="mt-4 text-center">
              <h5 class="mb-3 text-truncate">
                <a href="#" class="text-dark">Half sleeve T-shirt </a>
              </h5>

              <p class="text-muted">
                <i class="bx bx-star text-warning"></i>
                <i class="bx bx-star text-warning"></i>
                <i class="bx bx-star text-warning"></i>
                <i class="bx bx-star text-warning"></i>
                <i class="bx bx-star text-warning"></i>
              </p>
              <h5 class="my-0">
                <span class="text-muted mr-2"><del>$500</del></span> <b>$450</b>
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup></script>
