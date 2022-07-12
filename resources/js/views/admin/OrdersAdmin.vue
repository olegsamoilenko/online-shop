<template>
  <app-page-title-admin
    title="Orders"
  ></app-page-title-admin>

  <div v-if="loader" class="flex items-center justify-center mt-10">
    <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
  </div>

  <div v-else class="mt-8">
    <div class="mt-6" v-if="orders.length">

      <div class="mb-[20px] flex flex-wrap">

        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Sort by:"
            name="ordersSortBy"
            :options="ordersSortByData"
            v-model="ordersSortBy"
          ></app-select>
        </div>

        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Status:"
            name="ordersStatus"
            :options="statusOrderMap"
            v-model="ordersStatus"
          ></app-select>
        </div>


        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Payment:"
            name="ordersPayment"
            :options="statusPaymentMap"
            v-model="ordersPayment"
          ></app-select>
        </div>


        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Confirmation:"
            name="ordersConfirmation"
            :options="confirmationMap"
            v-model="ordersConfirmation"
          ></app-select>
        </div>

        <div class="mr-[20px] mb-[10px]">
          <app-select
            label="Per page:"
            name="ordersPerPage"
            :options="ordersPerPageData"
            v-model="ordersPerPage"
          ></app-select>
        </div>

      </div>

      <div v-if="loadedOrders.length" class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">

        <div class="mb-[20px]">
          <orders-table
            :thead="thead"
            :loadedOrders="loadedOrders"
            @editOrder="editOrderModal"
            @delOrder="delOrderConfirm"
          ></orders-table>
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
      :order="editableOrder"
      :orderProducts="editableOrderProducts"
      :errors="errors"
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
import OrdersTable from "../../components/tables/OrdersTable";
import DeletionConfirmModal from "../../modals/DeletionConfirmModal";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
  name: "OrdersAdmin",
  props: {
    orders: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      loader: false,

      ordersStatus: 'all',
      ordersPayment: 'all',
      ordersConfirmation: 'all',
      date: null,

      paginateData: {},
      links: [],

      loadedOrders: [],
      ordersSortBy: 'no',
      ordersOrderBy: 'id',
      ordersDirection: 'ASC',
      ordersPerPage: 10,

      products: [],
      showEditOrderModal: false,
      showDeleteOrderConfirmModal: false,
      showDeleteOrderAlertModal: false,

      thead: ['Name', 'Phone', 'Status', 'Payment', 'Confirmation', 'Data', 'Edit'],

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
        ordersStatus: this.ordersStatus,
        ordersPayment: this.ordersPayment,
        ordersConfirmation: this.ordersConfirmation,
        ordersOrderBy: this.ordersOrderBy,
        ordersDirection: this.ordersDirection,
        ordersPerPage: this.ordersPerPage,
      }
      return new Promise((res, rej) => {
        axios.get(`orders/p?page=${page}`, {params})
          .then(response => {
            this.paginateData = response.data.orders
            this.loadedOrders = response.data.orders.data

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
        axios.put(`/admin/orders/${id}`, data)
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
        axios.delete(`/admin/orders/${id}`)
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
    ordersStatus() {
      localStorage.setItem("ordersStatus", JSON.stringify(this.ordersStatus));
      this.loadOrders()
    },
    ordersPayment() {
      localStorage.setItem("ordersPayment", JSON.stringify(this.ordersPayment));
      this.loadOrders()
    },
    ordersConfirmation() {
      localStorage.setItem("ordersConfirmation", JSON.stringify(this.ordersConfirmation));
      this.loadOrders()
    },

    ordersSortBy() {
      if (this.ordersSortBy === 'No') {
        this.ordersOrderBy = 'id'
        this.ordersDirection = 'ASC'
      }
      if (this.ordersSortBy === 'dateAsc') {
        this.ordersOrderBy = 'created_at'
        this.ordersDirection = 'ASC'
      }
      if (this.ordersSortBy === 'dateDesc') {
        this.ordersOrderBy = 'created_at'
        this.ordersDirection = 'DESC'
      }

      localStorage.setItem("ordersOrderBy", JSON.stringify(this.ordersOrderBy));
      localStorage.setItem("ordersDirection", JSON.stringify(this.ordersDirection));
      localStorage.setItem("ordersSortBy", JSON.stringify(this.ordersSortBy));
      this.loadOrders()

    },

    ordersPerPage() {
      localStorage.setItem("ordersPerPage", JSON.stringify(this.ordersPerPage));
      this.loadOrders()
    },
  },

  created() {
    if (localStorage.getItem("ordersStatus")) {
      this.ordersStatus = JSON.parse(localStorage.getItem("ordersStatus"))
    }

    if (localStorage.getItem("ordersPayment")) {
      this.ordersPayment = JSON.parse(localStorage.getItem("ordersPayment"))
    }

    if (localStorage.getItem("ordersConfirmation")) {
      this.ordersConfirmation = JSON.parse(localStorage.getItem("ordersConfirmation"))
    }

    if (localStorage.getItem("ordersSortBy")) {
      this.ordersSortBy = JSON.parse(localStorage.getItem("ordersSortBy"))
    }

    if (localStorage.getItem("ordersOrderBy")) {
      this.ordersOrderBy = JSON.parse(localStorage.getItem("ordersOrderBy"))
    }

    if (localStorage.getItem("ordersDirection")) {
      this.ordersDirection = JSON.parse(localStorage.getItem("ordersDirection"))
    }

    if (localStorage.getItem("ordersPerPage")) {
      this.ordersPerPage = JSON.parse(localStorage.getItem("ordersPerPage"))
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
    OrdersTable,
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