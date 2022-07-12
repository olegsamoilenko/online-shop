<template>
  <div class="bg-[#F9F9FA]">
    <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">
      <div class="py-[20px]">
        <app-breadcrumb
          :crumbData="crumbData"
        ></app-breadcrumb>
      </div>

      <div v-if="loader" class="flex items-center justify-center mt-10">
        <moon-loader :loading="loader" color="blue" size="40px"></moon-loader>
      </div>

      <div v-else>
        <div v-if="loadedProducts.length">
          <app-product-card
            :loadedProducts="loadedProducts"
            :title="category.title"
          ></app-product-card>

          <div class="">
            <laravel-vue-pagination :data="paginateData" :limit="2" @pagination-change-page="loadProducts"/>
          </div>
        </div>
        <div v-else class="mt-[20px]">
          <p class="text-[20px]">There are no products in this category</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppPagination from "../../components/app/AppPagination";
import AppBreadcrumb from "../../components/app/AppBreadcrumb";
import AppProductCard from "../../components/app/AppProductCard";
import axios from "axios";
import LaravelVuePagination from 'laravel-vue-pagination';
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';

export default {
  name: "CategoryMain",
  props: {
    category: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      loader: false,
      page: 1,
      loadedProducts: [],
      crumbData: [
        {url: this.category.slug, title: this.category.title}
      ],
      paginateData: {},
      links: [],
    }
  },
  methods: {
    loadProducts(page = 1) {
      this.loader = true
      return new Promise((res, rej) => {
        axios.get(`/category/{category:slug}/p?page=${page}`, {
          params: {
            categoryId: this.category.id,
            slug: this.category.slug
          }
        })
          .then(response => {
            this.loadedProducts = response.data.products.data
            this.paginateData = response.data.products
            this.loader = false
          })
          .catch(err => {
            console.log(rej(err))
            this.loader = false
          })
      })
    }
  },
  created() {
    document.title = 'Online.shop' + ' ' + '|' + ' ' + this.category.title;

  },
  mounted() {
    this.loadProducts()
  },

  components: {
    AppBreadcrumb,
    AppProductCard,
    AppPagination,
    LaravelVuePagination,
    MoonLoader
  }
}
</script>

<style scoped>

</style>