<template>
  <app-block :title="title">
    <template v-slot>
      <div @mouseover="addToCart = idx" @mouseleave="addToCart = false" dusk="product-card" v-if="loadedProducts.length"
           class="relative w-full mobile-m:max-w-[160px] mobile-l:max-w-none lg:max-w-[290px]  mobile-m:basis-48 mobile-xl:basis-32 laptop:basis-24 mb-5 sm:mb-7  bg-white pb-6 rounded-lg shadow-card hover:shadow-card-active cursor-pointer text-black hover:text-[#405FD4] flex flex-col relative mr-[6px] sm:mr-[7px]"
           v-for="(product, idx) in loadedProducts"
           :key="product.id"
      >
        <div v-if="product.tags.length" class="absolute top-[11px] left-[19px] mobile-m:max-w-[160px] flex flex-wrap sm:flex-nowrap">
          <app-tag-label
            v-for="tag in product.tags"
            :key="tag.id"
            :tag="tag"
          ></app-tag-label>
        </div>

        <a :href="'/products/' + product.slug" class="m-5 ">
          <img v-if="product.images[0]" class="mx-auto h-[200px]  object-cover" :src="'/'+ 'storage/images/products/' + product.images[0].thumbnail" alt="">
        </a>
        <div class="mx-5 h-[114px] flex flex-col justify-between content-between">
          <div dusk="product-card-product-title" class=" overflow-hidden mb-[24px]">
            <a :href="'/products/' + product.slug"  class="font-gilroy-400 text-16 capitalize">{{ product.title }}</a>
          </div>

          <div class="mb-0 mobile-m:max-w-[160px] flex flex-wrap sm:flex-nowrap">
            <span dusk="product-card-product-price" class="font-gilroy-600 text-16 text-[#333333] mr-[8px]">{{ getCurrency(product.price) }}</span>
            <span v-if="product.old_price"
              class="font-gilroy-400 text-14 text-[#777777] line-through">{{ getCurrency(product.old_price) }}</span>
          </div>
        </div>
        <div class="absolute hidden  sm:block bottom-[-50px] left-[10px] right-[0px]" v-if="addToCart === idx">
          <app-add-to-cart-button
            @action="addToShoppingCart(product)"
            :img="false"
          ></app-add-to-cart-button>
        </div>
      </div>
      <teleport to="#modal">
        <shopping-cart-modal
          v-if="showShoppingCartModal"
          modalTitle="Shopping cart"
          @close="closeShoppingCartModal"
          @ordering="goToCheckout"
        ></shopping-cart-modal>
      </teleport>
    </template>
  </app-block>
</template>

<script>
import AppBlock from "./AppBlock";
import AppButton from "./AppButton";
import AppTagLabel from "./AppTagLabel";
import getCurrency from "../../mixins/getCurrency";
import AppAddToCartButton from "./AppAddToCartButton";
import addToShoppingCart from "../../mixins/addToShoppingCart";
import ShoppingCartModal from "../../modals/ShoppingCartModal";
export default {
  name: "AppProductCard",
  props: {
    loadedProducts: {
      type: Array,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    slug: {
      type: String
    }
  },
  data() {
    return {
      addToCart: false,
    }
  },
  methods: {

  },
  components: {
    AppBlock,
    AppButton,
    AppTagLabel,
    AppAddToCartButton,
    ShoppingCartModal
  },
  mixins: [getCurrency, addToShoppingCart]
}
</script>

<style scoped>

</style>