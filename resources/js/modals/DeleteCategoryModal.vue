<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1>{{ title }}</h1>

      <products-table
        :thead="thead"
        :loadedProducts="deletedProducts"
        :categories="categories"
        :editButtons="false"
      ></products-table>

      <div class="flex justify-between items-center py-3">
        <app-button
          title="Cancel"
          @action="$emit('close')"
        ></app-button>
        <app-button
          title="Ok"
          @action="$emit('del', category.id)"
        ></app-button>
      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppButton from "../components/app/AppButton";
import ProductsTable from "../components/tables/ProductsTable";
export default {
  name: "DeleteCategoryModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    title: {
      type: String,
      required: true,
    },
    category: {
      type: Object,
      required: true,
    },
    categories: {
      type: Object,
      required: true,
    },
    deletedProducts: {
      type: Array,
      required: false,
    }
  },
  emits: ['close', 'del'],
  data() {
    return {
      thead: ['Title', 'Short Description', 'Price', 'Old Price', 'Category', 'Availability', 'Is active'],
    }
  },
  mounted() {
    // console.log(this.objectToBeDeleted)
  },
  components: {
    BaseModal,
    AppButton,
    ProductsTable
  }
}
</script>

<style scoped>

</style>