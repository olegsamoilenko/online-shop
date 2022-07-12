<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <Form class="bg-white" @submit="updateOrder" :validation-schema="schema">
        <div class="">
          <div>
            <div class="flex">
              <div class="px-5 py-2 text-gray-700 border-b flex flex-col">
                <app-select
                  label="Status:"
                  name="orderStatus"
                  :options="statusOrderData"
                  v-model="order.status"
                ></app-select>
              </div>

              <div class="px-5 py-2 text-gray-700 border-b flex flex-col">
                <app-select
                  label="Payment:"
                  name="orderPayment"
                  :options="statusPaymentData"
                  v-model="order.paid"
                ></app-select>
              </div>

              <div class="px-5 py-2 text-gray-700 border-b flex flex-col">
                <app-select
                  v-if="orderConfirmation"
                  label="Confirmation:"
                  name="orderConfirmation"
                  :options="confirmationData"
                  v-model="order.no_confirmation_call"
                ></app-select>
              </div>
            </div>

            <div>
              <div class="flex">
                <div class="px-5 py-2 text-gray-700 border-b">
                  <label class="text-xs">Name</label>
                  <div class="mt-2 relative rounded-md shadow-sm">
                    <Field
                      type="text"
                      v-model="order.name"
                      name="name"
                      placeholder="Enter name"
                      class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-indigo-600"/>
                  </div>
                  <ErrorMessage class="text-red-500" name="name"/>
                  <div v-if="errors.name">
                    <span class="text-red-500">{{ errors.name[0] }}</span>
                  </div>
                </div>

                <div class="px-5 py-2 text-gray-700 border-b">
                  <label class="text-xs">Surname</label>
                  <div class="mt-2 relative rounded-md shadow-sm">
                    <Field
                      type="text"
                      v-model="order.surname"
                      name="surname"
                      placeholder="Enter surname"
                      class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-indigo-600"/>
                  </div>
                  <ErrorMessage class="text-red-500" name="surname"/>
                  <div v-if="errors.surname">
                    <span class="text-red-500">{{ errors.surname[0] }}</span>
                  </div>
                </div>

                <div class="px-5 py-2 text-gray-700 border-b">
                  <label class="text-xs">Phone</label>
                  <div class="mt-2 relative rounded-md shadow-sm">
                    <Field
                      type="text"
                      v-model="order.phone"
                      name="phone"
                      placeholder="Enter phone"
                      class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-indigo-600"/>
                  </div>
                  <ErrorMessage class="text-red-500" name="phone"/>
                  <div v-if="errors.phone">
                    <span class="text-red-500">{{ errors.phone[0] }}</span>
                  </div>
                </div>
              </div>
              <div class="px-5 py-2 text-gray-700 border-b">
                <label class="text-xs">Comments</label>
                <div class="mt-2 relative rounded-md shadow-sm">
                  <textarea name="order_comment" id="" cols="30" v-model="order.order_comment" rows="10"></textarea>
                </div>
              </div>
            </div>

            <div>
              <div class="flex">
                <div class="px-5 py-2 text-gray-700 border-b flex flex-col">
                  <app-select
                    label="Payment method:"
                    name="paymentMethod"
                    :options="paymentData"
                    v-model="order.payment"
                  ></app-select>
                  <ErrorMessage class="text-red-500" name="paymentMethod"/>
                  <div v-if="errors.payment">
                    <span class="text-red-500">{{ errors.payment[0] }}</span>
                  </div>
                </div>

                <div class="px-5 py-2 text-gray-700 border-b flex flex-col">
                  <app-select
                    label="Delivery:"
                    name="delivery"
                    :options="shippingData"
                    v-model="order.shipping"
                  ></app-select>
                  <ErrorMessage class="text-red-500" name="delivery"/>
                  <div v-if="errors.shipping">
                    <span class="text-red-500">{{ errors.shipping[0] }}</span>
                  </div>
                </div>
              </div>

              <div>
                <div class="flex" v-if="order.shipping === 'addressDelivery' || order.shipping === 'toYourPostOffice'">
                  <div class="px-5 py-2 text-gray-700 border-b">
                    <label class="text-xs">City</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                      <Field
                        type="text"
                        v-model="order.city"
                        name="city"
                        class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-indigo-600"/>
                    </div>
                    <div v-if="errors.city">
                      <span class="text-red-500">{{ errors.city[0] }}</span>
                    </div>
                    <ErrorMessage class="text-red-500" name="city"/>
                  </div>

                  <div v-if="order.shipping === 'addressDelivery'" class="">
                    <div class="px-5 py-2 text-gray-700 border-b">
                      <label class="text-xs">Address</label>
                      <div class="mt-2 relative rounded-md shadow-sm">
                        <Field
                          type="text"
                          v-model="order.address"
                          name="address"
                          class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-indigo-600"/>
                      </div>
                      <ErrorMessage class="text-red-500" name="address"/>
                      <div v-if="errors.address">
                        <span class="text-red-500">{{ errors.address[0] }}</span>
                      </div>
                    </div>
                  </div>


                  <div v-if="order.shipping === 'toYourPostOffice'" class="">
                    <div class="px-5 py-2 text-gray-700 border-b">
                      <label class="text-xs">Отделение</label>
                      <div class="mt-2 relative rounded-md shadow-sm">
                        <Field
                          type="text"
                          v-model="order.post_office"
                          name="postOffice"
                          class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-indigo-600"/>
                      </div>
                      <ErrorMessage class="text-red-500" name="postOffice"/>
                      <div v-if="errors.post_office">
                        <span class="text-red-500">{{ errors.post_office[0] }}</span>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="mt-[20px]">
            <h3 class="font-gilroy-600 text-20 mb-[20px]">Ordered goods</h3>
            <app-shopping-cart-card
              v-for="product in products"
              :key="product.id"
              :product="product"
              @remove="removeProductFromOrder"
              @count="changeTotalAmount"
            ></app-shopping-cart-card>

            <div class="my-[20px] font-gilroy-600 text-16 sm:text-18 text-[#405FD4]">
              <span class="mr-[20px]">Total amount:</span><span>{{ getCurrency(totalAmount) }}</span>
            </div>
          </div>

        </div>

        <div class="flex justify-between items-center px-5 py-3">
          <app-button
            title="Update"
            smWidth="lg:w-[54%]"
            :disabled="!products.length"
            :actionButton="false"
          ></app-button>
        </div>
      </Form>
    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppShoppingCartCard from "../components/app/AppShoppingCartCard";
import {Form, Field, ErrorMessage} from 'vee-validate';
import getCurrency from "../mixins/getCurrency";
import * as yup from 'yup';
require("yup-phone");
// import ordersMapData from "../mixins/ordersMapData";
import editOrdersData from "../mixins/editOrdersData";
import AppSelect from "../components/app/AppSelect";
import AppButton from "../components/app/AppButton";
export default {
  name: "EditOrderModal",
  props: {
    modalTitle: {
      type: String,
      required: true,
    },
    order: {
      type: Object,
      required: true,
    },
    orderProducts: {
      type: Object,
      required: true,
    },
    orderConfirmation: {
      type: Boolean,
      default: true
    },
    errors: {
      type: Object,
      required: false
    }
  },
  emits: ['close', 'update'],
  data() {
    return {
      // order: this.editableOrder,
      orderStatus: null,
      totalAmount: null,
      changedProducts: [],
      products: this.orderProducts,

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

    }
  },
  mounted() {
    this.total()
  },
  methods: {
    updateOrder() {
      this.changedProducts = []
      this.products = this.orderProducts
      this.products.forEach(p => {
        this.changedProducts.push([p.id, ['count', p.count]])
      })
      let del = delete this.order.products
      let data = {products: this.changedProducts, ...this.order,}
      let id = this.order.id
      this.$emit('update', id, data)

      // return new Promise((res, rej) => {
      //   axios.put(`/admin/orders/${this.order.id}`, data)
      //     .then(response => {
      //       this.$emit('update')
      //     })
      //     .catch(err => {
      //       if (err.response.status === 422) {
      //         this.errors = err.response.data.errors
      //       } else {
      //         console.log(rej(err))
      //       }
      //     })
      // })
    },
    removeProductFromOrder(id) {
      this.products = this.products.filter(p => p.id !== id)
    },
    total() {
      this.totalAmount = this.products.reduce((sum, p) => sum + (p.price * p.count), 0)
    },
    changeTotalAmount() {
      this.total()
    }
  },
  computed: {},
  watch: {
    products: {
      deep: true,
      handler(data) {
        data.forEach(d => {
          if (d.count) {
            this.total()
          }
        })
      }
    },
    order() {
      console.log(this.order)
    },
  },
  components: {
    BaseModal,
    AppShoppingCartCard,
    Form,
    Field,
    ErrorMessage,
    AppSelect,
    AppButton,
  },
  mixins: [
    getCurrency,
    editOrdersData,
    // ordersMapData
  ]
}
</script>

<style scoped>

</style>