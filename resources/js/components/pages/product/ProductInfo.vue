<template>
  <div class="flex flex-col basis-1/3 justify-between">
    <div>
      <div dusk="product-title">
        <h1 class="font-gilroy-600 text-18 sm:text-20 uppercase mt-[25px] mb-[20px]">{{ product.title }}</h1>
      </div>

      <div>
        <p dusk="category-title" class="font-gilroy-600 text-16 text-[#B6B5B5] mb-[30px]">{{ category.title }}</p>
      </div>

      <div class="mb-[55px]">
        <div class="relative mb-[15px]">
          <p class="font-gilroy-600 text-16 text-[#405FD4] pl-[25px] underline">5% discount when paying on the site</p>
          <img class="absolute left-0 top-[2px]" src="../../../../images/discount.svg" alt="">
        </div>
        <div class="relative">
          <p class="font-gilroy-600 text-16 text-[#405FD4] pl-[25px] underline">Warranty</p>
          <img class="absolute left-0 top-[2px]" src="../../../../images/guarantee.svg" alt="">
        </div>
      </div>
    </div>


    <div>
      <div class="flex flex-wrap mb-[25px]">
        <span dusk="product-price" class="mr-[15px] font-gilroy-700 text-24 sm:text-28">{{
            getCurrency(product.price)
          }} / шт</span>
        <span dusk="product-old-price"
              class="font-gilroy-400 text-18 text-[#405FD4] line-through">{{ getCurrency(product.old_price) }}</span>
      </div>

      <app-add-to-cart-button
        @action="addToShoppingCart(product)"
        :width="'sm:w-[225px]'"
        :img="imgButton"
      ></app-add-to-cart-button>

      <Form @submit="storeOneClickOrder" class="bg-white rounded-lg shadow-card p-[20px]" :validation-schema="schema">
        <h3 class="mb-[6px] font-gilroy-600 text-16 sm:text-18 text-[#333333] uppercase">Order in one click</h3>
        <div class="relative flex items-center">
          <Field class="border-y-2 border-[#D2D7E7] rounded-l-[8px] w-[150px] h-[48px] mt-[1px] flex-1"
                 v-model="phoneNumber"
                 type="number"
                 name="phone"
                 placeholder="380951111111"
          />
          <div class="absolute right-[-3px] top-0">
            <app-button
              title="ORDER"
              :width="'w-auto'"
              :actionButton="false"
            ></app-button>
          </div>

        </div>
        <ErrorMessage class="text-red-500" name="phone"/>
        <div v-if="errors.phone">
          <span class="text-red-500">{{ errors.phone[0] }}</span>
        </div>

      </Form>
    </div>
    <teleport to="#modal">
      <alert-modal
        v-if="showSuccessModal"
        modalTitle="Thanks for your order!"
        alertTitle="We will call you back shortly to clarify the information."
        buttonTitle="Ок"
        @close="closeSuccessModal"
      ></alert-modal>


      <shopping-cart-modal
        v-if="showShoppingCartModal"
        modalTitle="Cart"
        @close="closeShoppingCartModal"
        @ordering="goToCheckout"
      ></shopping-cart-modal>

    </teleport>

  </div>

</template>

<script>
import AppButton from "../../app/AppButton";
import {Form, Field, ErrorMessage} from 'vee-validate';
import * as yup from 'yup';
import getCurrency from "../../../mixins/getCurrency";
require("yup-phone");
import AlertModal from "../../../modals/AlertModal";
import axios from "axios";
import AppAddToCartButton from "../../app/AppAddToCartButton";
import ShoppingCartModal from "../../../modals/ShoppingCartModal";
import addToShoppingCart from "../../../mixins/addToShoppingCart"
import getWindowWidth from "../../../mixins/getWindowWidth";

export default {
  name: "ProductInfo",
  props: {
    product: {
      type: Object,
      required: true
    },
    category: {
      type: Object,
      required: true
    }
  },
  emits: ['orderInOneClick'],
  data() {
    return {
      errors: [],
      phoneNumber: '',
      schema: yup.object().shape({
        phone: yup.string().required('The phone is required').matches(/^\+?\d{11}$/, 'Please enter the phone number in the format 12345678987'),
      }),

      showSuccessModal: false,
    }
  },
  methods: {
    storeOneClickOrder() {
      return new Promise((res, rej) => {
        axios.post('/one-click-orders', {phone: this.phoneNumber, productId: this.product.id})
          .then(response => {
            this.showSuccessModal = true
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.errors = err.response.data.errors
            } else {
              console.log(rej(err))
            }
          })
      })
    },

    closeSuccessModal() {
      this.showSuccessModal = false

    },
  },
  computed: {
    imgButton() {
      if (this.windowWidth > 640) {
        return true
      } else {
        return false
      }
    }
  },
  mounted() {
  },
  components: {
    AppButton,
    Form,
    Field,
    ErrorMessage,
    AlertModal,
    AppAddToCartButton,
    ShoppingCartModal
  },
  mixins: [getCurrency, addToShoppingCart, getWindowWidth]
}
</script>

<style scoped>

</style>