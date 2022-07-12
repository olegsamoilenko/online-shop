export default {
  data() {
    return {
      shoppingCart: [],
      showShoppingCartModal: false
    }
  },
  methods: {
    countProducts() {
      const totalProducts = this.shoppingCart.length
      this.$store.commit('totalProductsInShoppingCart', totalProducts)
    },
    addToShoppingCart(product) {
      let count = this.$store.getters.numberOfProductsInShoppingCart
      console.log()
      console.log(product)
      event.preventDefault()
      if (localStorage.getItem("shoppingCart")) {
        this.shoppingCart = JSON.parse(localStorage.getItem("shoppingCart"))
        let check = this.shoppingCart.find(p => p.id === product.id)
        if (check) {
          check.count = check.count + count
          this.shoppingCart.filter(p => p.id !== check.id).push(check)
        } else {
          this.shoppingCart.push({count: count, ...product})
        }

        localStorage.setItem("shoppingCart", JSON.stringify(this.shoppingCart));
        this.countProducts()
      } else {
        this.shoppingCart.push({count: count, ...product})
        localStorage.setItem("shoppingCart", JSON.stringify(this.shoppingCart));
        this.countProducts()
      }
      this.showShoppingCartModal = true
    },
    closeShoppingCartModal() {
      this.showShoppingCartModal = false
    },
    goToCheckout(products) {
      localStorage.setItem("shoppingCart", JSON.stringify(products));
      document.location.href = '/ordering'
    },
  }
}