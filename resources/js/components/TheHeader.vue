<template>
  <header>
    <div class="container mx-auto px-[15px] xl:max-w-[1024px] relative">
      <div class="h-[77px] flex items-center justify-between mx-[20px] sm:mx-0 md:border-b-2 md:border-solid">
        <div dusk="header-logo">
          <a href="/" class="text-black font-gochi text-30">Logo</a>
        </div>
        <div class="flex items-center justify-center">
          <div>
            <form class="hidden lg:flex relative">
              <input
                v-model="searchInput"
                class="bg-[#F6F6F6] border border-solid border-[#EBEBEB] rounded-l-[2px] border-r-0 placeholder:font-gilroy-400 placeholder:text-[#7F7F7F] placeholder:text-16 placeholder:pl-[25px] w-[300px] h-[40px]"
                type="search"
                name="search"
                placeholder="Поиск...">
              <button dusk="search-button" class="border border-solid border-[#EBEBEB] rounded-r-[2px] w-[58px]" type="submit"
                      @click.prevent="search">
                <unicon class="absolute right-[16px] top-[9px] cursor-pointer" name="search" fill="#242424" width="22"
                        height="22"/>
              </button>

            </form>
          </div>
          <div>
            <div class="font-gilroy-400 relative ml-11 pl-[35px] py-[10px]" v-if="user"
                 @mouseover="showUserMenu = true" @mouseleave="showUserMenu = false">
              <a dusk="account" class="cursor-pointer">
                <span class="hidden md:inline-block">Account</span>
                <unicon class="absolute left-[6px] top-[10px]" name="user" fill="#242424" width="22" height="22"/>
                <ul class="absolute w-[170px] top-[44px] left-[0px] md:left-[0px] pt-[10px]  bg-[#ffffff] z-10"
                    v-show="showUserMenu">
                  <li class="pl-[35px] font-gilroy-400 text-16 mb-2">
                    <a dusk="my-account-link" :href="'/account/' + user.id" @click="showUserMenu = false">My Account</a>
                  </li>
                  <li v-if="userHasRole('admin')" class="pl-[35px] font-gilroy-400 text-16 mb-2">
                    <a href="/admin" @click="showUserMenu = false">Admin panel</a>
                  </li>
                  <li class="pl-[35px]"><a dusk="account-logout" @click="logout" href="/login">Logout</a></li>
                </ul>
              </a>
            </div>
            <div v-else class="ml-[40px]">
              <a href="/login">Login</a> |
              <a href="/register">Register</a>
            </div>

          </div>
          <a dusk="shopping-cart" @click="showShoppingCartModal = true" class="relative pl-[35px] ml-7 md:ml-11 cursor-pointer">
            <div class="absolute top-[-15px] md:top-[10px] left-[2px]">
              <unicon name="shopping-cart" fill="#242424" width="30" height="30"/>
              <div
                class="absolute w-[16px] h-[16px] rounded-full bg-[#405FD4] text-[#ffffff] text-12 flex items-center justify-center top-[-4px] right-[0]">
                {{ $store.state.totalProducts }}
              </div>
            </div>
            <div class="hidden md:block">
              <h3 class="font-gilroy-400 text-14 text-[#696969]">Cart</h3>
              <span class="font-gilroy-400 text-18 text-[#242424]">{{ getCurrency($store.state.totalAmount) }}</span>
            </div>
          </a>
          <button class="flex flex-col items-end ml-7 md:hidden" @click="showMainMenu = !showMainMenu">
            <div class="h-[1.5px] w-[15px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
            <div class="h-[1.5px] w-[9px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
            <div class="h-[1.5px] w-[15px] mb-[4px] border-b-[1.5px] border-[#000000]"></div>
          </button>
        </div>
      </div>
      <ul class="main-menu" :class="{'hidden': !showMainMenu , 'md:flex': !showMainMenu}">
        <li dusk="header-menu-category" v-for="link in categories.slice(0,8)" :key="link.title">
          <a :href="'/category/' + link.slug" class="font-montserrat" @click="showMainMenu = false">{{ link.title }}</a>
        </li>
<!--        <li dusk="header-menu-tag" v-for="link in tags.slice(0,2)" :key="link.title">-->
<!--          <a :href="'/tag/' + link.slug" class="font-montserrat" @click="showMainMenu = false">{{ link.title }}</a>-->
<!--        </li>-->
      </ul>
      <teleport to="#modal">
        <shopping-cart-modal
          v-if="showShoppingCartModal"
          modalTitle="Shopping cart"
          @close="closeShoppingCartModal"
          @ordering="goToCheckout"
        ></shopping-cart-modal>
      </teleport>
    </div>
  </header>
</template>

<script>
import ShoppingCartModal from "../modals/ShoppingCartModal";
import userHasRole from "../mixins/userHasRole";
import getCurrency from "../mixins/getCurrency";
import axios from "axios";
export default {
  name: "TheHeader",
  props: {
    user: {
      type: Object,
      required: false
    }
  },
  data() {
    return {
      categories: [],
      tags: [],
      showUserMenu: false,
      showMainMenu: false,
      showShoppingCartModal: false,
      searchInput: '',
      shoppingCart: JSON.parse(localStorage.getItem("shoppingCart")),
    }
  },
  methods: {
    getCategories() {
      return new Promise((res, rej) => {
        axios.get('/categories/get')
          .then(response => {
            this.categories = response.data.categories
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    getTags() {
      return new Promise((res, rej) => {
        axios.get('/tags/get')
          .then(response => {
            this.tags = response.data.tags
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    logout() {
      this.showUserMenu = false
      return new Promise((res, rej) => {
        axios.post('/logout')
          .then(response => {

          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    closeShoppingCartModal() {
      this.showShoppingCartModal = false
    },
    goToCheckout(products) {
      localStorage.setItem("shoppingCart", JSON.stringify(products));
      document.location.href = '/ordering'
    },
    search() {
      document.location.href = `/search?s=${this.searchInput}`
      // let params = {
      //   s: this.searchInput,
      // }
      // return new Promise((res, rej) => {
      //   axios.get(`/search/s`, {params})
      //     .then(response => {
      //       this.$store.commit('search', response.data.products)
      //       document.location.href = `/search?s=${this.searchInput}`
      //     })
      //     .catch(err => {
      //       console.log(rej(err))
      //     })
      // })
    },

  },
  created() {
    this.getCategories()
    this.getTags()
  },
  mounted() {
    if (this.shoppingCart) {
      const totalProducts = this.shoppingCart.length
      this.$store.commit('totalProductsInShoppingCart', totalProducts)

      const totalAmount = this.shoppingCart.reduce((sum, p) => sum + (p.price * p.count), 0)
      this.$store.commit('totalAmountInShoppingCart', totalAmount)
    }
  },

  computed: {

  },
  components: {
    ShoppingCartModal
  },
  mixins: [getCurrency, userHasRole]
}
</script>

<style scoped>

</style>