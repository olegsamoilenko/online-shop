<template>
  <form class="flex items-center relative mb-[25px]">
    <div class="relative inline-block flex-none">
      <img class="absolute left-[15px] top-[24px] cursor-pointer" @click="minus" src="../../../images/minus.svg" alt="">
      <input
        class="w-[102px] h-[50px] placeholder:font-gilroy-400 bg-[#F2F2FF] placeholder:ml-[10px] pl-10 pr-[20px] border border-[#D2D7E7] rounded-lg"
        type="number" v-model="count" disabled>
      <img class="absolute right-[24px] top-[19px] cursor-pointer" @click="plus" src="../../../images/plus.svg" alt="">
    </div>
    <div class="relative left-[-10px] inline-block flex-1">
      <app-button
        title="ADD TO CART"
        :width="width"
        @action="$emit('action')"
      ></app-button>
      <unicon v-if="img" class="absolute left-[16px] top-[13px]" name="shopping-cart" fill="#ffffff"
              width="24" height="24"/>
    </div>

  </form>
</template>

<script>
import AppButton from "./AppButton";
export default {
  name: "AppAddToCartButton",
  props: {
    width: {
      type: String,
      default: 'w-full'
    },
    img: {
      type: Boolean,
      default: true
    }
  },
  emits: ['action'],
  data() {
    return {
    }
  },
  methods: {
    minus() {
      if (this.count > 1) {
        this.$store.commit('incrementNumberOfProductsInShoppingCart')
      }
    },
    plus() {
      this.$store.commit('decrementNumberOfProductsInShoppingCart')
    }
  },
  computed: {
    count() {
      return this.$store.getters.numberOfProductsInShoppingCart
    }
  },
  mounted() {
  },
  components: {
    AppButton
  }
}
</script>

<style scoped>

</style>