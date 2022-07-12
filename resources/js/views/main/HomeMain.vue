<template>
  <div>
    <div class="mx-auto 2xl:max-w-[1280px]">
      <home-image></home-image>
    </div>

    <div class="container mx-auto px-[15px] xl:max-w-[1024px]">
      <home-advantage/>
    </div>

    <div class="bg-[#F9F9FA]">
      <div class="container mx-auto pt-10 px-[15px]  xl:max-w-[1024px]">
        <home-categories-card
          v-if="categories"
          :categories="categories"
          title="Categories"
          :images="images"
        ></home-categories-card>
      </div>
    </div>

    <div class="bg-[#F9F9FA]">
      <div class="container mx-auto pt-10 px-[15px]  xl:max-w-[1024px]">
        <app-product-card
          v-if="products"
          :loadedProducts="loadedProducts"
          :title="tag.title"
        ></app-product-card>

        <div class="bg-[#F9F9FA] text-center pt-2 pb-16">
          <app-button
            title="Show more"
            @action="load(products[products.length - 1].id)"
          ></app-button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import HomeAdvantage from "../../components/pages/home/HomeAdvantage";
import HomeImage from "../../components/pages/home/HomeImage";
import HomeCategoriesCard from "../../components/pages/home/HomeCategoriesCard";
import AppButton from "../../components/app/AppButton";
import AppProductCard from "../../components/app/AppProductCard";

import axios from "axios";

export default {
  name: "HomeMain",
  props: {
    categories: {
      type: Array,
      default: false
    },
    images: {
      type: Array,
      default: false
    },
    products: {
      type: Array,
      default: ''
    },
    tag: {
      type: Object,
      default: false
    },
  },
  data() {
    return {
      productId: 0,
      loadedProducts: this.products,
    }
  },
  mounted() {
    document.title = 'Online.shop';
  },
  methods: {
    load(id) {
      this.productId = id
      this.loadProduct()
    },

    loadProduct() {
      return new Promise((res, rej) => {
        axios.get(`/tag/get`, {params: {id: this.productId}})
          .then(response => {
            this.loadedProducts = this.loadedProducts.concat(response.data.products)
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
  },
  components: {
    HomeAdvantage,
    HomeImage,
    HomeCategoriesCard,
    AppProductCard,
    AppButton
  }
}
</script>

<style scoped>

</style>