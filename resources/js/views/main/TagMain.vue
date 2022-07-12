<template>
  <div class="bg-[#F9F9FA]">
    <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">
      <div class="py-[20px]">
        <app-breadcrumb
          :crumbData="crumbData"
        ></app-breadcrumb>
      </div>

      <div v-if="loadedProducts.length">
        <app-product-card
          :loadedProducts="loadedProducts"
          :title="tag.title"
        ></app-product-card>

        <div class="">
          <app-pagination
            :paginateData="paginateData"
            :links="links"
          ></app-pagination>
        </div>
      </div>
      <div v-else class="mt-[20px]">
        <p class="text-[20px]">There are no products with this tag</p>
      </div>
    </div>
  </div>
</template>

<script>
import AppPagination from "../../components/app/AppPagination";
import AppBreadcrumb from "../../components/app/AppBreadcrumb";
import AppProductCard from "../../components/app/AppProductCard";
import axios from "axios";

export default {
  name: "TagMain",
  props: {
    tag: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      page: 1,
      loadedProducts: [],
      crumbData: [
        {url: this.tag.slug, title: this.tag.title}
      ],
      paginateData: {},
      links: [],
    }
  },
  created() {
    console.log(this.tag)
    let page = location.search.split('page=')[1]
    return new Promise((res, rej) => {
      axios.get(`/tag/{tag:slug}/p?page=${page}`, {params: {tagId: this.tag.id, slug: this.tag.slug}})
        .then(response => {
          this.loadedProducts = response.data.products.data
          this.paginateData = response.data.products
          if (response.data.products.links.length <= 6) {
            this.links = response.data.products.links.slice(1, -1)
          } else if (response.data.products.current_page < 3) {
            this.links = response.data.products.links.slice(1, -1).slice(0, 5)
          } else {
            this.links = response.data.products.links.slice(1, -1).slice(response.data.products.current_page - 2, response.data.products.current_page + 3)
          }

        })
        .catch(err => {
          console.log(rej(err))
        })
    })
  },
  methods: {},
  components: {
    AppBreadcrumb,
    AppProductCard,
    AppPagination
  }
}
</script>

<style scoped>

</style>