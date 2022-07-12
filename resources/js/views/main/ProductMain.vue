<template>
  <div class="bg-[#F9F9FA]">
    <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">

      <div class="py-[20px]">
        <app-breadcrumb
          :crumbData="crumbData"
        ></app-breadcrumb>
      </div>

      <div class="lg:flex mb-[60px] sm:mb-[60px] mx-[20px] sm:mx-[0px]">
        <product-images
          :images="product.images"
          :tags="product.tags"
        ></product-images>

        <product-info
          :product="product"
          :category="category"
          @orderInOneClick="orderInOneClick"
        ></product-info>

      </div>

      <div class="mb-[20px]">
        <app-tabs-button
          :border="descriptionBorder"
          title="Description"
          @action="active = 'description'"
        ></app-tabs-button>

        <app-tabs-button
          :border="characteristicsBorder"
          title="Characteristics"
          @action="active = 'characteristics'"
        ></app-tabs-button>
      </div>

      <div class="sm:mb-[40px] mb-[60px]">
        <keep-alive>
          <component
            :is="componentName"
            :product="product"
          ></component>
        </keep-alive>
      </div>


      <app-product-card
        :loadedProducts="viewedProducts"
        title="Products viewed"
      ></app-product-card>

    </div>
  </div>
</template>

<script>
import AppBreadcrumb from "../../components/app/AppBreadcrumb";
import ProductImages from "../../components/pages/product/ProductImages";
import ProductInfo from "../../components/pages/product/ProductInfo";
import AppTabsButton from "../../components/app/AppTabsButton";
import ProductDescription from "../../components/pages/product/ProductDescription";
import ProductCharacteristics from "../../components/pages/product/ProductCharacteristics";
import AppProductCard from "../../components/app/AppProductCard";

export default {
  name: "ProductMain",
  props: {
    category: {
      type: Object,
      required: true
    },
    product: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      crumbData: [
        {url: this.product.slug, title: this.product.title},
      ],
      images: [],
      active: 'description',
      viewedProducts: [],
      showShoppingCartModal: false,
    }
  },
  mounted() {
    document.title = 'Online.shop' + ' ' + '|' + ' ' + this.product.title;
    if (localStorage.getItem("viewedProducts")) {
      this.viewedProducts = (JSON.parse(localStorage.getItem("viewedProducts")))

      const isAlready = this.viewedProducts.find(p => p.id === this.product.id)
      if (!isAlready && this.viewedProducts.length >= 4) {
        this.viewedProducts.splice(0, 1)
        this.viewedProducts.push(this.product)
      } else if (!isAlready && this.viewedProducts.length < 4) {
        this.viewedProducts.push(this.product)
      }

      localStorage.setItem("viewedProducts", JSON.stringify(this.viewedProducts.slice(-4)));
    } else {
      this.viewedProducts.push(this.product)
      localStorage.setItem("viewedProducts", JSON.stringify(this.viewedProducts));
    }

  },
  methods: {
    orderInOneClick(phoneNumber, product) {
      console.log(phoneNumber)
      console.log(product)
    },

  },
  computed: {
    descriptionBorder() {
      return this.active === 'description' ? 'border-[#405FD4] border shadow-img' : 'shadow-card'
    },
    characteristicsBorder() {
      return this.active === 'characteristics' ? 'border-[#405FD4] border shadow-img' : 'shadow-card'
    },
    componentName() {
      return 'product-' + this.active
    }
  },
  components: {
    AppBreadcrumb,
    ProductImages,
    ProductInfo,
    AppTabsButton,
    ProductDescription,
    ProductCharacteristics,
    AppProductCard,
  }
}
</script>

<style scoped>

</style>