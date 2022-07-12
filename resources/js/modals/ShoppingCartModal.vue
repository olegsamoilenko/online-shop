<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <div dusk="shopping-cart-modal" v-if="shoppingCart">
        <div class="px-5 py-6 text-gray-700 border-b max-h-[65vh] overflow-y-auto">
          <app-shopping-cart-card
            v-for="product in shoppingCart"
            :key="product.id"
            :product="product"
            @remove="removeProductFromCart"
            @count="total"
          ></app-shopping-cart-card>
        </div>
        <div class="mt-[20px] px-5 font-gilroy-700 text-20 text-blue">
          <span class="mr-[20px]">Total amount:</span><span dusk="shopping-cart-modal-total">{{getCurrency($store.state.totalAmount)}}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center px-5 py-3 mt-[20px]">
          <button dusk="shopping-cart-modal-button-continue" type="submit" class="flex-1 order-2 sm:order-1 sm:flex-none px-1 sm:px-3 py-1 text-white rounded-md text-blue border-2 border-solid border-blue text-sm hover:bg-gray-50 focus:outline-none" @click.prevent="$emit('close')">
            Continue
          </button>
          <button dusk="shopping-cart-modal-button-ordering" type="submit" class="flex-1 order-1 sm:order-2 sm:flex-none px-1 sm:px-3 py-1 mb-[20px] sm:mb-0 bg-blue text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none" @click.prevent="$emit('ordering', shoppingCart)">
            Ordering
          </button>
        </div>
      </div>
      <div v-else>
        <h1 class="text-center">Shopping cart is empty</h1>
      </div>
    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppShoppingCartCard from "../components/app/AppShoppingCartCard";
import getCurrency from "../mixins/getCurrency";
export default {
  name: "ShoppingCartModal",
  props: {
    modalTitle: {
      type: String
    }
  },
  emits: ['close', 'ordering'],
  data() {
    return {
      shoppingCart: [],
      // totalAmount: 0
    }
  },
  mounted() {
    this.shoppingCart = JSON.parse(localStorage.getItem("shoppingCart"))
    if (this.shoppingCart) {
      const totalAmount = this.shoppingCart.reduce((sum, p) => sum + (p.price * p.count), 0)
      this.$store.commit('totalAmountInShoppingCart', totalAmount)
    }
  },
  methods: {
    total() {
      const totalProducts = this.shoppingCart.length
      this.$store.commit('totalProductsInShoppingCart', totalProducts)

      const totalAmount = this.shoppingCart.reduce((sum, p) => sum + (p.price * p.count), 0)
      this.$store.commit('totalAmountInShoppingCart', totalAmount)
    },
    removeProductFromCart(id) {
      this.shoppingCart = this.shoppingCart.filter(p => p.id !== id)
      localStorage.setItem("shoppingCart", JSON.stringify(this.shoppingCart));
      this.total()
    },
  },
  components: {
    BaseModal,
    AppShoppingCartCard
  },
  mixins: [getCurrency]
}
</script>

<style scoped>

</style>