<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <div v-if="!resultSearch.length">
        <span>Nothing found</span>
      </div>
      <div v-else>
        <products-table
          :thead="thead"
          :loadedProducts="resultSearch"
          :categories="categories"
          @editProduct="editProduct"
          @delProduct="delProduct"
        ></products-table>

        <div class="mt-[10px]">
          <app-button
            title="Show more"
            @action="searchProducts"
          ></app-button>
        </div>
      </div>

    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import axios from "axios";
import AppButton from "../components/app/AppButton";
import ProductsTable from "../components/tables/ProductsTable";
export default {
  name: "SearchProductsModal",
  props: {
    modalTitle: {
      type: String
    },
    searchInput: {
      type: String,
      required: true
    },
    categories: {
      type: Array,
      required: true
    }
  },
  emits: ['close', 'editProduct', 'delProduct'],
  data() {
    return {
      resultSearch: [],
      thead: ['Title', 'Short Description', 'Price', 'Old Price', 'Category', 'Availability', 'Is active', 'Edit'],
    }
  },
  methods: {
    searchProducts() {
      let params = {};
      if (!this.resultSearch.length) {
        params = {
          s: this.searchInput,
        }
      } else {
        params = {
          s: this.searchInput,
          length: this.resultSearch.length
        }
      }

      return new Promise((res, rej) => {
        axios.get(`/admin/products/search`, {params})
          .then(response => {
            response.data.products.forEach(p => {
              this.resultSearch.push(p)
            })
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    editProduct(product) {
      this.$emit('editProduct', product)
    },

    delProduct(product) {
      this.$emit('delProduct', product)
    }
  },
  mounted() {
    this.searchProducts()

  },
  components: {
    BaseModal,
    AppButton,
    ProductsTable
  },
}
</script>

<style scoped>

</style>