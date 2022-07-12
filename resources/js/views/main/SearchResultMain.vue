<template>
  <div class="bg-[#F9F9FA]">
    <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">
      <div class="py-[20px]">
      <app-breadcrumb
        :crumbData="crumbData"
      ></app-breadcrumb>
      </div>

      <div v-if="loadedProducts.length" class="mt-[30px] font-gilroy-400">
        <app-product-card
          :loadedProducts="loadedProducts"
          :title="'Search results for the query: ' + searchParams"
        ></app-product-card>

        <div class="bg-[#F9F9FA] text-center pt-2 pb-16">
          <app-button
            title="Show more"
            @action="loadProduct"
          ></app-button>
        </div>
      </div>

      <div v-if="loadedProducts.length === 0" class="mt-[30px] font-gilroy-400 text-30">On this query: <span class="bold font-gilroy-700">{{searchParams}}</span> nothing found</div>



    </div>
  </div>
</template>

<script>
import AppBreadcrumb from "../../components/app/AppBreadcrumb";
import AppProductCard from "../../components/app/AppProductCard";
import AppButton from "../../components/app/AppButton";
import axios from "axios";
export default {
  name: "SearchResultMain",
  props: {
    products: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      crumbData: [
        {url: 'search', title: 'Search'}
      ],
      searchParams: '',
      loadedProducts: this.products
    }
  },
  mounted() {
    let uri = window.location.search.substring(1);
    let params = new URLSearchParams(uri);
    this.searchParams = params.get("s")
  },
  methods: {
    loadProduct() {
      let params = {
        s: this.searchParams,
        length: this.loadedProducts.length,
      }
      return new Promise((res, rej) => {
        axios.get(`/search/s`, {params})
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
    AppBreadcrumb,
    AppProductCard,
    AppButton
  }
}
</script>

<style scoped>

</style>