<template>
  <app-page-title-admin
    title="Orders"
  ></app-page-title-admin>

  <div v-if="loader" class="flex items-center justify-center mt-10">
    <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
  </div>

  <div v-else class="mt-8">
    <div class="mt-6" v-if="oneClickOrders.length">

      <div class="mb-[20px] flex flex-wrap">

        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Sort by:"
            name="oneClickOrdersSortBy"
            :options="ordersSortByData"
            v-model="oneClickOrdersSortBy"
          ></app-select>
        </div>

        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Status:"
            name="oneClickOrdersStatus"
            :options="statusOrderMap"
            v-model="oneClickOrdersStatus"
          ></app-select>
        </div>


        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Payment:"
            name="oneClickOrdersPayment"
            :options="statusPaymentMap"
            v-model="oneClickOrdersPayment"
          ></app-select>
        </div>


        <div class="mr-[20px]">
          <app-select
            label="Per page:"
            name="oneClickOrdersPerPage"
            :options="ordersPerPageData"
            v-model="oneClickOrdersPerPage"
          ></app-select>
        </div>

      </div>

      <div v-if="loadedOrders.length" class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">

        <div  class="mb-[20px]">
          <one-click-orders-table
            :thead="thead"
            :loadedOrders="loadedOrders"
            @editOrder="editOrderModal"
            @delOrder="delOrderConfirm"
          ></one-click-orders-table>
        </div>

        <div class="mx-[20px] sm:mx-[10px]">
          <laravel-vue-pagination :data="paginateData" :limit="2" @pagination-change-page="loadOrders"/>
        </div>
      </div>
      <div v-else class="mt-7">
        <p>No orders were found for these search parameters..

        </p>
      </div>

    </div>
    <div v-else class="mt-[10px]">
      <p>There are no orders in the database.</p>
    </div>
  </div>

  <teleport to="#modal">
    <edit-order-modal
      v-if="showEditOrderModal"
      modalTitle="Change order"
      :orderConfirmation="false"
      :order="editableOrder"
      :errors="errors"
      :orderProducts="editableOrderProducts"
      @close="closeEditOrderModal"
      @update="updateOrder"
    ></edit-order-modal>

    <deletion-confirm-modal
      v-if="showDeleteOrderConfirmModal"
      title="Do you want to delete this order?"
      :objectToBeDeleted="deletedOrder"
      @del="deleteOrder"
      @close="closeDeleteOrderConfirmModal"
    ></deletion-confirm-modal>

    <alert-modal
      v-if="showDeleteOrderAlertModal"
      alertTitle="You have successfully deleted the order"
      buttonTitle="Ок"
      @close="closeDeleteOrderAlertModal"
    ></alert-modal>
  </teleport>

</template>

<script>
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js'
import AppPagination from "../../components/app/AppPagination";
import EditOrderModal from "../../modals/EditOrderModal";
import AppButton from "../../components/app/AppButton";
import axios from "axios";
import AppPageTitleAdmin from "../../components/app/AppPageTitleAdmin";
import AlertModal from "../../modals/AlertModal";
import ordersMapData from "../../mixins/ordersMapData";
import AppSelect from "../../components/app/AppSelect";
import OneClickOrdersTable from "../../components/tables/OneClickOrdersTable";
import DeletionConfirmModal from "../../modals/DeletionConfirmModal";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
  name: "OneClickOrdersAdmin",
  props: {
    oneClickOrders: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      loader: false,

      oneClickOrdersStatus: 'all',
      oneClickOrdersPayment: 'all',
      date: null,

      paginateData: {},
      links: [],

      loadedOrders: [],
      oneClickOrdersSortBy: 'no',
      oneClickOrdersOrderBy: 'id',
      oneClickOrdersDirection: 'ASC',
      oneClickOrdersPerPage: 10,

      products: [],
      showEditOrderModal: false,
      showDeleteOrderConfirmModal: false,
      showDeleteOrderAlertModal: false,


      thead: ['Name', 'Phone', 'Status', 'Payment', 'Data', 'Edit'],

      editableOrder: null,
      editableOrderProducts: [],
      deletedOrder: null,

      errors: {},
    }
  },

  methods: {
    loadOrders(page = 1) {
      this.loader = true
      let params = {
        oneClickOrdersStatus: this.oneClickOrdersStatus,
        oneClickOrdersPayment: this.oneClickOrdersPayment,
        oneClickOrdersConfirmation: this.oneClickOrdersConfirmation,
        oneClickOrdersOrderBy: this.oneClickOrdersOrderBy,
        oneClickOrdersDirection: this.oneClickOrdersDirection,
        oneClickOrdersPerPage: this.oneClickOrdersPerPage,
      }
      return new Promise((res, rej) => {
        axios.get(`one-click-orders/p?page=${page}`, {params})
          .then(response => {
            this.loadedOrders = response.data.orders.data
            this.paginateData = response.data.orders

            this.loader = false

          })
          .catch(err => {
            console.log(rej(err))
            this.loader = false
          })
      })
    },

    editOrderModal(order) {
      this.editableOrderProducts = []
      this.editableOrder = order

      order.products.map(p => {
        this.editableOrderProducts.push({count: p.pivot.count, ...p})
      })
      this.showEditOrderModal = true
    },

    closeEditOrderModal() {
      this.showEditOrderModal = false
      this.errors = {}
      this.loadOrders()
    },

    updateOrder(id, data) {
      return new Promise((res, rej) => {
        axios.put(`/admin/one-click-orders/${id}`, data)
          .then(response => {
            this.showEditOrderModal = false
            this.errors = {}
            this.loadOrders()
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

    delOrderConfirm(order) {
      this.showDeleteOrderConfirmModal = true
      this.deletedOrder = order
    },

    deleteOrder(id) {
      this.showDeleteOrderConfirmModal = false
      return new Promise((res, rej) => {
        axios.delete(`/admin/one-click-orders/${id}`)
          .then(response => {
            this.showDeleteOrderAlertModal = true
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    closeDeleteOrderConfirmModal() {
      this.showDeleteOrderConfirmModal = false
      this.loadOrders()
    },

    closeDeleteOrderAlertModal() {
      this.showDeleteOrderAlertModal = false
      this.loadOrders()
    },

  },
  watch: {
    oneClickOrdersStatus() {
      localStorage.setItem("oneClickOrdersStatus", JSON.stringify(this.oneClickOrdersStatus));
      this.loadOrders()
    },
    oneClickOrdersPayment() {
      localStorage.setItem("oneClickOrdersPayment", JSON.stringify(this.oneClickOrdersPayment));
      this.loadOrders()
    },

    oneClickOrdersSortBy() {
      if (this.oneClickOrdersSortBy === 'No') {
        this.oneClickOrdersOrderBy = 'id'
        this.oneClickOrdersDirection = 'ASC'
      }
      if (this.oneClickOrdersSortBy === 'dateAsc') {
        this.oneClickOrdersOrderBy = 'created_at'
        this.oneClickOrdersDirection = 'ASC'
      }
      if (this.oneClickOrdersSortBy === 'dateDesc') {
        this.oneClickOrdersOrderBy = 'created_at'
        this.oneClickOrdersDirection = 'DESC'
      }

      localStorage.setItem("oneClickOrdersOrderBy", JSON.stringify(this.oneClickOrdersOrderBy));
      localStorage.setItem("oneClickOrdersDirection", JSON.stringify(this.oneClickOrdersDirection));
      localStorage.setItem("oneClickOrdersSortBy", JSON.stringify(this.oneClickOrdersSortBy));
      this.loadOrders()

    },

    oneClickOrdersPerPage() {
      localStorage.setItem("oneClickOrdersPerPage", JSON.stringify(this.oneClickOrdersPerPage));
      this.loadOrders()
    },
  },

  created() {
    if (localStorage.getItem("oneClickOrdersStatus")) {
      this.oneClickOrdersStatus = JSON.parse(localStorage.getItem("oneClickOrdersStatus"))
    }

    if (localStorage.getItem("oneClickOrdersPayment")) {
      this.oneClickOrdersPayment = JSON.parse(localStorage.getItem("oneClickOrdersPayment"))
    }


    if (localStorage.getItem("oneClickOrdersSortBy")) {
      this.oneClickOrdersSortBy = JSON.parse(localStorage.getItem("oneClickOrdersSortBy"))
    }

    if (localStorage.getItem("oneClickOrdersOrderBy")) {
      this.oneClickOrdersOrderBy = JSON.parse(localStorage.getItem("oneClickOrdersOrderBy"))
    }

    if (localStorage.getItem("oneClickOrdersDirection")) {
      this.oneClickOrdersDirection = JSON.parse(localStorage.getItem("oneClickOrdersDirection"))
    }

    if (localStorage.getItem("oneClickOrdersPerPage")) {
      this.oneClickOrdersPerPage = JSON.parse(localStorage.getItem("oneClickOrdersPerPage"))
    }

  },
  mounted() {
    this.loadOrders()
  },
  components: {
    MoonLoader,
    AppPagination,
    EditOrderModal,
    AppButton,
    AppPageTitleAdmin,
    AppSelect,
    OneClickOrdersTable,
    DeletionConfirmModal,
    AlertModal,
    LaravelVuePagination
  },
  mixins: [
    ordersMapData,
  ]
}
</script>

<style scoped>

</style>