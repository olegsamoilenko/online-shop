<template>
  <div dusk="shopping-cart-card" class="sm:flex justify-start bg-white mb-[30px] shadow-card border-1 rounded-[6px] relative pt-2.5">
    <button dusk="shopping-cart-modal-button-remove-product" v-if="closeButton" class="absolute top-[4px] right-[11px]" @click.prevent="$emit('remove', product.id)">
      <unicon name="times" fill="red" width="20" height="20"/>
    </button>
    <div dusk="shopping-cart-modal-product-img" class="sm:mr-[10px] sm:max-w-[220px] sm:w-full md:w-auto md:max-w-auto p-[15px] mx-auto flex-none">
      <img class="h-[100%]  object-cover" :src="'/' + 'storage/images/products/' + product.images[0].thumbnail" alt="">
    </div>
    <div class="px-[10px]">
      <div dusk="shopping-cart-modal-product-title">
        <h1 class="font-gilroy-600 text-16 mobile-l:text-18 sm:text-20 uppercase mt-[15px] mb-[10px]">{{ product.title }}</h1>
      </div>
      <div dusk="shopping-cart-modal-product-category" class="mb-[15px]">
        <p class="font-gilroy-600 text-16 text-[#B6B5B5]">{{ product.category.title }}</p>
      </div>
      <div class="flex flex-wrap mb-[15px]">
        <span dusk="shopping-cart-modal-product-price" class="mr-[15px] font-gilroy-700 text-20 mobile-l:text-24 sm:text-28">{{ getCurrency(product.price) }} / шт</span>
        <span dusk="shopping-cart-modal-product-old-price" class="font-gilroy-400 text-14 mobile-l:text-16 sm:text-18 text-[#405FD4] line-through">{{ getCurrency(product.old_price) }}</span>
      </div>
      <div  class="relative inline-block mb-[15px] mr-[10px] flex-none">
        <img dusk="shopping-cart-modal-product-reduce-number" class="absolute left-[15px] top-[21px] cursor-pointer" @click="minus" src="../../../images/minus.svg" alt="">
        <input name="count" dusk="shopping-cart-modal-product-count" class="w-[92px] placeholder:font-gilroy-400 bg-[#F2F2FF] placeholder:ml-[10px] pl-10 border border-[#D2D7E7] rounded-lg"
               type="number" v-model="product.count" disabled>
        <img dusk="shopping-cart-modal-product-increase-number" class="absolute right-[15px] top-[17px] cursor-pointer" @click="plus" src="../../../images/plus.svg" alt="">
      </div>
    </div>
    <div class="flex-1"></div>
  </div>
</template>

<script>
import getCurrency from "../../mixins/getCurrency";

export default {
  name: "AppShoppingCartCard",
  props: {
    product: {
      type: Object
    },
    closeButton: {
      type: Boolean,
      default: true,
    },
    countButton: {
      type: Boolean,
      default: true,
    },
    // count: {
    //   type: Number
    // }
  },
  emits: ['remove', 'count'],
  data() {
    return {
    }
  },
  mounted() {
  },
  methods: {
    minus() {
      if (this.product.count > 1 && this.countButton) {
        this.product.count--
        this.$emit('count')
      }
    },
    plus() {
      if (this.countButton) {
        this.product.count++
        this.$emit('count')
      }
    }
  },
  watch: {

  },
  mixins: [getCurrency]
}
</script>

<style scoped>

</style>