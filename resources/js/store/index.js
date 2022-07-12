import { createStore } from 'vuex'


export const store = createStore({
  state () {
    return {
      sidebarOpen: false,
      totalProducts: 0,
      totalAmount: 0,
      numberOfProductsInShoppingCart: 1,
    }
  },
  getters: {
    sidebarOpen(state) {
      return state.sidebarOpen;
    },
    numberOfProductsInShoppingCart(state) {
      return state.numberOfProductsInShoppingCart;
    }
  },
  mutations: {
    totalProductsInShoppingCart(state, payload) {
      state.totalProducts = payload
    },
    totalAmountInShoppingCart(state, payload) {
      state.totalAmount = payload
    },
    sidebarState(state, payload) {
      state.sidebarOpen = payload;
    },
    incrementNumberOfProductsInShoppingCart(state) {
      state.numberOfProductsInShoppingCart--;
    },
    decrementNumberOfProductsInShoppingCart(state) {
      state.numberOfProductsInShoppingCart++;
    }
  }
})

export default store