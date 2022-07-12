<template>

  <app-page-title-admin
    title="Products"
  ></app-page-title-admin>

  <div v-if="loader" class="flex items-center justify-center mt-10">
    <moon-loader :loading="loader" color="blue" size="40px"></moon-loader>
  </div>

  <div v-else class="text-gray-700 mt-8">

    <app-button
      title="Create Product"
      @action="createProductModal"
    ></app-button>

    <div class="mt-5" v-if="products.length">

      <div class="2xl:flex items-end justify-between">
        <div class="mb-[10px] flex  flex-wrap ">
          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Sort by:"
              name="productsSortBy"
              :options="productsSortByData"
              v-model="productsSortBy"
            ></app-select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Category:"
              name="productsCategory"
              :options="optionsCategories"
              v-model="productsCategory"
            ></app-select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Tag:"
              name="productsTag"
              :options="optionsTags"
              v-model="productsTag"
            ></app-select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Availability:"
              name="availability"
              :options="productsAvailabilityData"
              v-model="productsAvailability"
            ></app-select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Is active:"
              name="status"
              :options="productsStatusData"
              v-model="productsStatus"
            ></app-select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Per page:"
              name="productsPerPage"
              :options="productsPerPageData"
              v-model="productsPerPage"
            ></app-select>
          </div>

        </div>

        <div class="inline-block mb-[10px]">
          <app-search-form
            v-model="searchInput"
            name="search"
            placeholder="Search Products..."
            @search="searchProducts"
          ></app-search-form>
        </div>
      </div>

      <div v-if="loadedProducts.length">


        <div class="mb-[20px]">
          <products-table
            :thead="thead"
            :loadedProducts="loadedProducts"
            :categories="categories"
            @editProduct="editProductModal"
            @delProduct="delProductConfirm"
          ></products-table>
        </div>

        <div>
          <!--          <app-pagination-->
          <!--            v-if="paginateData.total > productsPerPage"-->
          <!--            :paginateData="paginateData"-->
          <!--            :links="links"-->
          <!--          ></app-pagination>-->
          <!--          :linksPages="linksPages"-->
          <!--          :linksPageActive="linksPageActive"-->
          <laravel-vue-pagination :data="paginateData" :limit="2" @pagination-change-page="loadProducts"/>

        </div>
      </div>
      <div v-else class="mt-[10px]">
        <p>No products were found for these search parameters.</p>
      </div>
    </div>

    <div v-else class="mt-[10px]">
      <p>There are no products in the database. <span class="cursor-pointer text-cyan-600 hover:text-cyan-300"
                                                      @click="createProductModal">Add your first product</span></p>
    </div>
  </div>

  <teleport to="#modal">
    <create-product-modal
      v-if="showCreateProductModal"
      modalTitle="Create Product"
      :categories="optionsCategories"
      :tags="optionsTags"
      :errors="errors"
      @action="addProduct"
      @close="closeCreateProductModal"
    ></create-product-modal>

    <alert-modal
      v-if="showCreateProductAlertModal"
      alertTitle="You have successfully added a product"
      buttonTitle="Ок"
      @close="reloadProducts"
    ></alert-modal>

    <edit-product-modal
      v-if="showEditProductModal"
      modalTitle="Edit Product"
      :product="editableProduct"
      :categories="optionsCategories"
      :tags="optionsTags"
      :errors="errors"
      @action="updateProduct"
      @close="closeEditProductModal"
    ></edit-product-modal>

    <alert-modal
      v-if="showUpdateProductAlertModal"
      alertTitle="You have successfully updated the product"
      buttonTitle="Ок"
      @close="reloadProducts"
    ></alert-modal>

    <deletion-confirm-modal
      v-if="showDeleteProductConfirmModal"
      :title="titleDeletionConfirmModal"
      :objectToBeDeleted="deletedProduct"
      @del="deleteProduct"
      @close="closeDeleteProductConfirmModal"
    ></deletion-confirm-modal>

    <alert-modal
      v-if="showDeleteProductAlertModal"
      alertTitle="You have successfully deleted the product"
      buttonTitle="Ок"
      @close="reloadProducts"
    ></alert-modal>

    <search-products-modal
      v-if="showSearchProductsModal"
      :modalTitle="titleSearch"
      :categories="categories"
      @close="closeSearchProductsModal"
      :searchInput="searchInput"
      @editProduct="editProductModal"
      @delProduct="delProductConfirm"
    ></search-products-modal>

  </teleport>

</template>

<script>
import axios from "axios";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
import AppPagination from "../../components/app/AppPagination";
import AppSelect from "../../components/app/AppSelect";
import AppButton from "../../components/app/AppButton";
import AppPageTitleAdmin from "../../components/app/AppPageTitleAdmin";
import SearchProductsModal from "../../modals/SearchProductsModal";
import ProductsTable from "../../components/tables/ProductsTable";
import AlertModal from "../../modals/AlertModal";
import DeletionConfirmModal from "../../modals/DeletionConfirmModal";
import AppSearchForm from "../../components/app/AppSearchForm";
import productsAvailabilityData from "../../mixins/sortingProductsData";
import productsPerPageData from "../../mixins/sortingProductsData";
import productsStatusData from "../../mixins/sortingProductsData";
import productsSortByData from "../../mixins/sortingProductsData";
import CreateProductModal from "../../modals/CreateProductModal";
import EditProductModal from "../../modals/EditProductModal";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
  name: "ProductsAdmin",
  data() {
    return {
      loader: false,
      loadedProducts: [],

      deletedProduct: null,
      editableProduct: null,

      paginateData: {},
      links: [],

      productsSortBy: 'No',
      productsOrderBy: 'id',
      productsDirection: 'ASC',
      productsPerPage: 10,
      productsAvailability: 'all',
      productsStatus: 'all',
      productsCategory: 'all',
      productsTag: 'all',

      optionsCategories: [],
      optionsTags: [],
      errors: {},

      searchInput: '',
      showSearchProductsModal: false,

      thead: ['Title', 'Price', 'Old Price', 'Category', 'Availability', 'Is active', 'Edit'],

      showCreateProductModal: false,
      showCreateProductAlertModal: false,
      showEditProductModal: false,
      showUpdateProductAlertModal: false,
      showDeleteProductConfirmModal: false,
      showDeleteProductAlertModal: false
    }

  },
  props: {
    products: {
      type: Array,
      default: []
    },

    categories: {
      type: Array,
      default: []
    },

    tags: {
      type: Array,
      default: []
    },
  },

  methods: {
    loadProducts(page = 1) {
      this.loader = true
      let params = {
        productsPerPage: this.productsPerPage,
        productsCategory: this.productsCategory,
        productsTag: this.productsTag,
        isActive: this.productsStatus,
        productsAvailability: this.productsAvailability,
        productsOrderBy: this.productsOrderBy,
        productsDirection: this.productsDirection
      }
      axios.get('/admin/products/p?page=' + page, {params})
        .then(response => {
          this.paginateData = response.data.products;
          this.loadedProducts = response.data.products.data;
          this.loader = false
        })
        .catch(err => {
          console.log(err)
          this.loader = false
        })
    },
    // loadProducts(page) {
    //   this.loader = true
    //   // document.location.href = '/admin/products/p?page=1'
    //   // let page = location.search.split('page=')[1]
    //   let params = {
    //     productsPerPage: this.productsPerPage,
    //     productsCategory: this.productsCategory,
    //     productsTag: this.productsTag,
    //     isActive: this.productsStatus,
    //     productsAvailability: this.productsAvailability,
    //     productsOrderBy: this.productsOrderBy,
    //     productsDirection: this.productsDirection
    //   }
    //   return new Promise((res, rej) => {
    //     axios.get(`/admin/products/p?page=` + page, {params})
    //       .then(response => {
    //         this.loadedProducts = response.data.products.data
    //         this.paginateData = response.data.products
    //         if (response.data.products.links.length <= 6) {
    //           this.links = response.data.products.links.slice(1, -1)
    //         } else if (response.data.products.current_page < 3) {
    //           this.links = response.data.products.links.slice(1, -1).slice(0, 5)
    //         } else {
    //           this.links = response.data.products.links.slice(1, -1).slice(response.data.products.current_page - 2, response.data.products.current_page + 3)
    //         }
    //         this.loader = false
    //       })
    //       .catch(err => {
    //         console.log(rej(err))
    //       })
    //   })
    // },

    createProductModal() {
      this.showCreateProductModal = true
    },

    closeCreateProductModal() {
      this.showCreateProductModal = false
      this.errors = {}
    },

    async addProduct(formData) {
      return new Promise((res, rej) => {
        const config = {
          'content-type': 'multipart/form-data',
          // 'enctype': 'multipart/form-data',
        }
        axios.post('/admin/products', formData, config)
          .then(response => {
            this.showCreateProductModal = false
            this.errors = {}
            this.showCreateProductAlertModal = true
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

    editProductModal(product) {
      this.editableProduct = product
      this.showEditProductModal = true
      this.showSearchProductsModal = false
      this.searchInput = ''
    },

    closeEditProductModal() {
      this.showEditProductModal = false
      this.errors = {}
    },

    updateProduct(formData) {
      return new Promise((res, rej) => {
        const config = {'content-type': 'multipart/form-data'}
        axios.post(`/admin/products/${this.editableProduct.id}`, formData, config)
          .then(response => {
            this.showEditProductModal = false
            this.errors = {}
            this.showUpdateProductAlertModal = true
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

    delProductConfirm(product) {
      this.showDeleteProductConfirmModal = true
      this.deletedProduct = product
      this.showSearchProductsModal = false
      this.searchInput = ''
    },

    deleteProduct(id) {
      return new Promise((res, rej) => {
        axios.delete(`/admin/products/${id}`)
          .then(response => {
            this.showDeleteProductConfirmModal = false
            this.showDeleteProductAlertModal = true
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    closeDeleteProductConfirmModal() {
      this.showDeleteProductConfirmModal = false
    },

    getOptionsCategories() {
      this.categories.forEach(c => {
        let obj = {value: c.id, label: c.title}
        this.optionsCategories.push(obj)
      })
      this.optionsCategories.unshift({value: 'all', label: 'All'})
    },

    getOptionsTags() {
      this.tags.forEach(t => {
        let obj = {value: t.id, label: t.title}
        this.optionsTags.push(obj)
      })
      this.optionsTags.unshift({value: 'all', label: 'All'})
    },

    reloadProducts() {
      this.loadProducts()
      this.showCreateProductAlertModal = false
      this.showUpdateProductAlertModal = false
      this.showDeleteProductAlertModal = false
      // document.location.href = '/admin/products'
    },

    searchProducts() {
      if (this.searchInput) {
        this.showSearchProductsModal = true
      }
    },

    closeSearchProductsModal() {
      this.showSearchProductsModal = false
      this.searchInput = ''
    },
  },
  watch: {
    productsSortBy() {
      if (this.productsSortBy === 'No') {
        this.productsOrderBy = 'id'
        this.productsDirection = 'ASC'
      }
      if (this.productsSortBy === 'titleAsc') {
        this.productsOrderBy = 'title'
        this.productsDirection = 'ASC'
      }
      if (this.productsSortBy === 'titleDesc') {
        this.productsOrderBy = 'title'
        this.productsDirection = 'DESC'
      }
      if (this.productsSortBy === 'priceAsc') {
        this.productsOrderBy = 'price'
        this.productsDirection = 'ASC'
      }
      if (this.productsSortBy === 'priceDesc') {
        this.productsOrderBy = 'price'
        this.productsDirection = 'DESC'
      }
      localStorage.setItem("productsOrderBy", JSON.stringify(this.productsOrderBy));
      localStorage.setItem("productsDirection", JSON.stringify(this.productsDirection));
      localStorage.setItem("productsSortBy", JSON.stringify(this.productsSortBy));
      this.loadProducts()

    },
    productsPerPage() {
      localStorage.setItem("productsPerPage", JSON.stringify(this.productsPerPage));
      this.loadProducts()
    },

    productsStatus() {
      localStorage.setItem("productsStatus", JSON.stringify(this.productsStatus));
      this.loadProducts()
    },

    productsAvailability() {
      localStorage.setItem("productsAvailability", JSON.stringify(this.productsAvailability));
      this.loadProducts()
    },

    productsCategory() {
      localStorage.setItem("productsCategory", JSON.stringify(this.productsCategory));

      this.loadProducts()
    },

    productsTag() {
      localStorage.setItem("productsTag", JSON.stringify(this.productsTag));
      this.loadProducts()
    },
  },
  computed: {
    titleDeletionConfirmModal() {
      return "Do you want to delete" + ' ' + this.deletedProduct.title + ' ' + "product?"
    },
    titleSearch() {
      return "Result for search:" + ' ' + this.searchInput
    },
  },
  created() {
    if (localStorage.getItem("productsPerPage")) {
      this.productsPerPage = JSON.parse(localStorage.getItem("productsPerPage"))
    }

    if (localStorage.getItem("productsStatus")) {
      this.productsStatus = JSON.parse(localStorage.getItem("productsStatus"))
    }

    if (localStorage.getItem("productsAvailability")) {
      this.productsAvailability = JSON.parse(localStorage.getItem("productsAvailability"))
    }

    if (localStorage.getItem("productsSortBy")) {
      this.productsSortBy = JSON.parse(localStorage.getItem("productsSortBy"))
    }

    if (localStorage.getItem("productsOrderBy")) {
      this.productsOrderBy = JSON.parse(localStorage.getItem("productsOrderBy"))
    }

    if (localStorage.getItem("productsDirection")) {
      this.productsDirection = JSON.parse(localStorage.getItem("productsDirection"))
    }

    if (localStorage.getItem("productsCategory")) {
      this.productsCategory = JSON.parse(localStorage.getItem("productsCategory"))
    }

    if (localStorage.getItem("productsTag")) {
      this.productsTag = JSON.parse(localStorage.getItem("productsTag"))
    }

  },

  mounted() {
    this.loadProducts();
    this.getOptionsCategories()
    this.getOptionsTags()
  },

  components: {
    MoonLoader,
    AppPagination,
    AppPageTitleAdmin,
    AppSelect,
    ProductsTable,
    AppButton,
    DeletionConfirmModal,
    CreateProductModal,
    AlertModal,
    EditProductModal,
    AppSearchForm,
    SearchProductsModal,
    LaravelVuePagination
  },
  mixins: [
    productsAvailabilityData,
    productsPerPageData,
    productsStatusData,
    productsSortByData
  ]
}
</script>

<style scoped>

</style>