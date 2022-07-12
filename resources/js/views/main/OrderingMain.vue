<template>
  <div class="bg-[#F9F9FA]">
    <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">
      <div class="py-[20px]">
        <app-breadcrumb
          :crumbData="crumbData"
        ></app-breadcrumb>
      </div>
      <div class="mt-[20px] mb-[30px]">
        <app-page-title
          title="Ordering"
        ></app-page-title>
      </div>

      <Form @submit="checkout" :validation-schema="schema">
        <div class="lg:flex">
          <div class="mb-[30px] lg:mr-[20px] basis-75">
            <h3 class="font-gilroy-600 text-16 sm:text-18 text-[#405FD4] mb-[10px]">Personal data:</h3>
            <div class="flex justify-between flex-wrap mb-[25px]">
              <div class="sm:w-auto sm:basis-48 mb-4">
                <Field
                  type="text"
                  name="name"
                  class="form-input w-full"
                  v-model="orderData.name"
                  placeholder="Name"
                />
                  <ErrorMessage class="text-red-500" name="name"/>
                <div v-if="errors.name">
                  <span class="text-red-500">{{ errors.name[0] }}</span>
                </div>
              </div>
              <div class="sm:w-auto sm:basis-48 mb-4">
                <Field
                  type="text"
                  name="surname"
                  class="form-input w-full"
                  v-model="orderData.surname"
                  placeholder="Surname"
                />
                <ErrorMessage class="text-red-500" name="surname"/>
                <div v-if="errors.surname">
                  <span class="text-red-500">{{ errors.surname[0] }}</span>
                </div>
              </div>

              <div class="sm:w-auto sm:basis-48 mb-4">
                <Field
                  type="tel"
                  name="phone"
                  class="form-input w-full"
                  v-model="orderData.phone"
                  placeholder="12345678987"
                />
                <ErrorMessage class="text-red-500" name="phone"/>
                <div v-if="errors.phone">
                  <span class="text-red-500">{{ errors.phone[0] }}</span>
                </div>
              </div>

              <div class="sm:w-auto sm:basis-48 mb-4">
                <Field
                  type="text"
                  name="city"
                  class="form-input w-full"
                  v-model="orderData.city"
                  placeholder="City"
                />
                <ErrorMessage class="text-red-500" name="city"/>
                <div v-if="errors.city">
                  <span class="text-red-500">{{ errors.city[0] }}</span>
                </div>
              </div>


            </div>

            <div class="mb-[25px]">
              <h3 class="font-gilroy-600 text-16 sm:text-18 text-[#405FD4] mb-[10px]">Choice of delivery and payment
                methods</h3>
              <div class="mb-[10px]">
                <Field type="radio" v-model="orderData.shipping" value="pickupFromTheStore" name="delivery"/>
                <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">Pickup from the store</label>
              </div>

              <div class="mb-[10px]">
                <Field type="radio" v-model="orderData.shipping" value="addressDelivery" name="delivery"/>
                <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">Address delivery</label>
                <div v-if="orderData.shipping === 'addressDelivery'">
                  <Field
                    type="text"
                    name="address"
                    class="form-input w-full"
                    v-model="orderData.address"
                    placeholder="Enter shipping address"
                  />
                  <ErrorMessage class="text-red-500" name="address"/>
                </div>

              </div>

              <div class="mb-[10px]">
                <Field type="radio" v-model="orderData.shipping" value="toYourPostOffice" name="delivery"/>
                <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">To your post office</label>
                <div v-if="orderData.shipping === 'toYourPostOffice'">
                  <Field
                    type="text"
                    name="postOffice"
                    class="form-input w-full"
                    v-model="orderData.postOffice"
                    placeholder="Enter post office number"
                  />
                  <ErrorMessage class="text-red-500" name="postOffice"/>
                </div>

              </div>
            </div>

            <div class="mb-[20px]">
              <h3 class="font-gilroy-600 text-16 sm:text-18 text-[#405FD4] mb-[10px]">Payment Information</h3>
              <div class="mb-[10px]">
                <Field type="radio" v-model="orderData.payment" value="cash" name="paymentMethod"/>
                <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">Cash</label>
              </div>

              <div class="mb-[10px]">
                <Field type="radio" v-model="orderData.payment" value="card" name="paymentMethod"/>
                <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">Payment by Mastercard/Visa</label>
              </div>

              <div class="mb-[10px]">
                <Field type="radio" v-model="orderData.payment" value="paymentAccount" name="paymentMethod"/>
                <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">Payment to current account </label>
              </div>
              <ErrorMessage class="text-red-500" name="paymentMethod"/>
            </div>

            <textarea class="form-input w-full mb-[10px]" name="orderComment" v-model="orderData.orderComment" id=""
                      cols="25" rows="6" placeholder="our comment on the order"></textarea>

            <div class="mb-[10px]">
              <input type="checkbox" v-model="orderData.noConfirmationCall" name="noConfirmationCall"/>
              <label class="font-gilroy-600 text-16 sm:text-18 pl-[12px]">You can not call to confirm the order</label>
            </div>

          </div>

          <div>
            <h3 class="font-gilroy-600 text-16 sm:text-18 text-[#405FD4] mb-[10px]">Your order:</h3>
            <div v-if="shoppingCart.length" class="">
              <app-shopping-cart-card
                v-for="product in shoppingCart"
                :key="product.id"
                :product="product"
                @remove="removeProductFromCart"
                @count="total"
              ></app-shopping-cart-card>
            </div>
            <div v-else>There are no items in the cart</div>

            <div class="my-[20px] font-gilroy-600 text-16 sm:text-18 text-[#405FD4]">
              <span class="mr-[20px]">Total amount:</span><span>{{ getCurrency(totalAmount) }}</span>
            </div>

          </div>
        </div>

        <div>
          <app-button
            title="Ordering"
            smWidth="lg:w-[54%]"
            :disabled="shoppingCart.length === 0"
            :actionButton="false"
          ></app-button>
        </div>
      </Form>
      <teleport to="#modal">
        <alert-modal
          v-if="showSuccessModal"
          modalTitle="Thanks for your order!"
          alertTitle="We will call you back shortly to clarify the information."
          buttonTitle="Ок"
          @close="closeSuccessModal"
        ></alert-modal>
      </teleport>
    </div>
  </div>

</template>

<script>
import AppBreadcrumb from "../../components/app/AppBreadcrumb";
import AppPageTitle from "../../components/app/AppPageTitle";
import AppShoppingCartCard from "../../components/app/AppShoppingCartCard";
import AppButton from "../../components/app/AppButton";
import {Form, Field, ErrorMessage} from 'vee-validate';
import axios from "axios";
import * as yup from 'yup';
import getCurrency from "../../mixins/getCurrency";
import AlertModal from "../../modals/AlertModal";
require("yup-phone");
export default {
  name: "OrderingMain",
  data() {
    return {
      crumbData: [
        {url: '/ordering', title: 'Ordering'},
      ],
      orderData: {
        name: '',
        surname: '',
        phone: '',
        city: '',
        shipping: 'pickupFromTheStore',
        address: '',
        postOffice: '',
        payment: 'cash',
        orderComment: '',
        noConfirmationCall: false,
        products: [],
      },

      shoppingCart: [],
      totalAmount: 0,

      errors: [],

      schema: yup.object().shape({
        name: yup.string().required('The name is required').matches(/^[A-Za-z']+$/, 'Please enter name correctly'),
        surname: yup.string().required('The surname is required').matches(/^[A-Za-z']+$/, 'Please enter last name correctly!'),
        phone: yup.string().required('The phone is required').matches(/^\+?\d{11}$/, 'Please enter the phone number in the format 12345678987'),
        delivery: yup.string().required('The delivery is required'),
        city: yup.string()
          .when('delivery', {
            is: 'addressDelivery',
            then: yup.string().required('The city is required')
          })
          .when('delivery', {
            is: 'toYourPostOffice',
            then: yup.string().required('The city is required')
          }).matches(/^[A-Za-z0-9.,' ]+$/, 'Please enter city correctly'),
        address: yup.string()
          .when('delivery', {
            is: 'addressDelivery',
            then: yup.string().required('The address is required')
          }),
        // .matches(/^[A-Za-z0-9.,' ]+$/, 'Please enter address correctly'),
        postOffice: yup.number().typeError('Enter post office number').min(1, 'Post office number must be a number'),
        paymentMethod: yup.string().required('Enter payment method')
      }),

      showSuccessModal: false,
      messageSuccess: ''
    }
  },
  mounted() {
    document.title = 'Online.shop' + ' ' + '|' + ' ' + 'Ordering';
    this.shoppingCart = JSON.parse(localStorage.getItem("shoppingCart"))
    if (this.shoppingCart) {
      this.totalAmount = this.shoppingCart.reduce((sum, p) => sum + (p.price * p.count), 0)
    }

  },
  methods: {
    total() {
      this.totalAmount = this.shoppingCart.reduce((sum, p) => sum + (p.price * p.count), 0)
    },

    removeProductFromCart(id) {
      this.shoppingCart = this.shoppingCart.filter(p => p.id !== id)
      localStorage.setItem("shoppingCart", JSON.stringify(this.shoppingCart));
      this.total()
    },


    closeSuccessModal() {
      this.showSuccessModal = false
      document.location.href = '/'
    },

    checkout() {
      this.shoppingCart.forEach(p => {
        this.orderData.products.push([p.id, ['count', p.count]])
      })

      console.log(this.orderData)

      return new Promise((res, rej) => {
        const config = {'content-type': 'multipart/form-data'}
        axios.post('/orders', this.orderData, config)
          .then(response => {
            localStorage.removeItem('shoppingCart');
            this.showSuccessModal = true
            this.messageSuccess = response.data.message
            this.errors = []
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

  },
  watch: {},
  components: {
    AppBreadcrumb,
    AppPageTitle,
    AppShoppingCartCard,
    AppButton,
    Form,
    Field,
    ErrorMessage,
    AlertModal
  },
  mixins: [getCurrency]
}
</script>

<style scoped>

</style>