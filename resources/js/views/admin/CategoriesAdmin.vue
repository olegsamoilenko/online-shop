<template>

  <app-page-title-admin
    title="Categories"
  ></app-page-title-admin>

  <div v-if="loader" class="flex items-center justify-center mt-10">
    <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
  </div>

  <div v-else class="mt-8">

    <app-button
      title="Create Category"
      @action="createCategoryModal"
    ></app-button>


    <div v-if="categories.length" class="mt-7 inline-block min-w-full shadow rounded-lg overflow-hidden">
      <categories-table
        :thead="thead"
        :loadedCategories="categories"
        @editCategory="editCategoryModal"
        @delCategory="deleteCategoryConfirmModal"
      ></categories-table>
    </div>

    <div v-else class="mt-7">
      <p>No categories.
        <span class="cursor-pointer text-cyan-600 hover:text-cyan-300" @click="createCategoryModal">Add the first category</span>
      </p>
    </div>
  </div>

  <teleport to="#modal">

    <create-modal
      v-if="showCreateCategoryModal"
      modalTitle="Create Category"
      @close="closeCreateCategoryModal"
      @action="storeCategory"
      :error="messageError"
    ></create-modal>

    <alert-modal
      v-if="showCreateCategoryAlertModal"
      alertTitle="You have successfully created a category"
      buttonTitle="Ок"
      @close="redirectToCategories"
    ></alert-modal>

    <edit-modal
      v-if="showEditCategoryModal"
      modalTitle="Edit Category"
      @close="closeEditCategoryModal"
      @action="updateCategory"
      :error="messageError"
      :id="category.id"
      :title="category.title"
    ></edit-modal>

    <alert-modal
      v-if="showEditCategoryAlertModal"
      alertTitle="You have successfully edited the category"
      buttonTitle="Ок"
      @close="redirectToCategories"
    ></alert-modal>

    <deletion-confirm-modal
      v-if="showDeleteCategoryConfirmModal"
      :title="titleDeleteCategoryModal"
      :objectToBeDeleted="deletedCategory"
      @del="deleteCategory"
      @close="closeDeleteCategoryConfirmModal"
    ></deletion-confirm-modal>

    <alert-modal
      v-if="showDeleteCategoryAlertModal"
      alertTitle="You have successfully deleted the category"
      buttonTitle="Ок"
      @close="redirectToCategories"
    ></alert-modal>

  </teleport>
</template>

<script>
import axios from "axios";
import CreateModal from "../../modals/CreateModal";
import EditModal from "../../modals/EditModal";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
import CategoriesTable from "../../components/tables/CategoriesTable";
import AppPageTitleAdmin from "../../components/app/AppPageTitleAdmin";
import AppButton from "../../components/app/AppButton";
import AlertModal from "../../modals/AlertModal";
import DeletionConfirmModal from "../../modals/DeletionConfirmModal";
export default {
  name: "CategoriesAdmin",
  data() {
    return {
      loader: false,

      thead: ['Title', 'Slug', 'Edit'],
      messageSuccess: '',
      messageError: '',
      showCreateCategoryModal: false,
      showEditCategoryModal: false,
      showCreateCategoryAlertModal: false,
      showEditCategoryAlertModal: false,
      showDeleteCategoryConfirmModal: false,
      showDeleteCategoryAlertModal: false,

      category: {},

      deletedCategory: null,
      removedProducts: [],

      errors: '',
    }
  },
  props: {
    categories: {
      type: Array,
      default: []
    }
  },
  mounted() {
  },
  methods: {
    createCategoryModal() {
      this.showCreateCategoryModal = true
    },
    closeCreateCategoryModal() {
      this.showCreateCategoryModal = false
    },

    editCategoryModal(c) {
      this.category = c
      this.showEditCategoryModal = true
    },

    closeEditCategoryModal() {
      this.showEditCategoryModal = false
    },
    deleteCategoryConfirmModal(category) {
      this.deletedCategory = category
      this.showDeleteCategoryConfirmModal = true
    },
    closeDeleteCategoryConfirmModal() {
      this.showDeleteCategoryConfirmModal = false
    },
    redirectToCategories() {
      document.location.href = '/admin/categories'
    },


    storeCategory(title) {
      return new Promise((res, rej) => {
        axios.post('/admin/categories', {title: title})
          .then(response => {
            this.messageError = ''
            this.showCreateCategoryModal = false
            this.showCreateCategoryAlertModal = true
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.messageError = err.response.data.errors.title[0]
            } else {
              console.log(rej(err))
            }
          })
      })
    },

    updateCategory(id, title) {
      return new Promise((res, rej) => {
        axios.put(`/admin/categories/${id}`, {title: title})
          .then(response => {
            this.showEditCategoryAlertModal = true
            this.showEditCategoryModal = false
            this.messageError = ''
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.messageError = err.response.data.errors.title[0]
            } else {
              console.log(rej(err))
            }
          })
      })
    },

    deleteCategory(id) {
      return new Promise((res, rej) => {
        axios.delete(`/admin/categories/${id}`)
          .then(response => {
            this.showDeleteCategoryConfirmModal = false
            this.showDeleteCategoryAlertModal = true
            // location.reload()

          })
          .catch(err => {
            console.log(rej(err))
          })
      })

    },

  },
  computed: {
    titleDeleteCategoryModal() {
      return "Do you want to delete" + " " + this.deletedCategory.title + " category and all products belonging to this category?"
    },
  },
  watch: {},
  components: {
    MoonLoader,
    CategoriesTable,
    AppPageTitleAdmin,
    AppButton,
    CreateModal,
    EditModal,
    AlertModal,
    DeletionConfirmModal
  },
}
</script>

<style scoped>

</style>