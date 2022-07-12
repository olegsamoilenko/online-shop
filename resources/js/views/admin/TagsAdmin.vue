<template>

  <app-page-title-admin
    title="Tags"
  ></app-page-title-admin>

  <div v-if="loader" class="flex items-center justify-center mt-10">
    <moon-loader :loading="loader" color="green" size="40px"></moon-loader>
  </div>

  <div v-else class="mt-8">

      <app-button
        title="Create Tag"
        @action="createTagModal"
      ></app-button>


        <div v-if="tags.length" class="mt-7 inline-block min-w-full shadow rounded-lg overflow-hidden">
          <tags-table
            :thead="thead"
            :loadedTags="tags"
            @editTag="editTagModal"
            @delTag="deleteTagConfirmModal"
          ></tags-table>
        </div>

        <div v-else class="mt-7">
          <p>No tags.
            <span class="cursor-pointer text-cyan-600 hover:text-cyan-300" @click="createTagModal">Add the first tag</span>
          </p>
        </div>

      </div>

  <teleport to="#modal">

    <create-modal
      v-if="showCreateTagModal"
      modalTitle="Create Tag"
      @close="closeCreateTagModal"
      @action="storeTag"
      :error="messageError"
    ></create-modal>

    <alert-modal
      v-if="showCreateTagAlertModal"
      alertTitle="You have successfully created a tag"
      buttonTitle="Ок"
      @close="redirectToTags"
    ></alert-modal>

    <edit-modal
      v-if="showEditTagModal"
      modalTitle="Edit Tag"
      @close="closeEditTagModal"
      @action="updateTag"
      :error="messageError"
      :id="tag.id"
      :title="tag.title"
    ></edit-modal>

    <alert-modal
      v-if="showUpdateTagAlertModal"
      alertTitle="You have successfully edited the tag"
      buttonTitle="Ок"
      @close="redirectToTags"
    ></alert-modal>

    <deletion-confirm-modal
      v-if="showDeleteTagConfirmModal"
      :title="titleDeleteTagConfirmModal"
      :objectToBeDeleted="deletedTag"
      @del="deleteTag"
      @close="closeDeleteTagConfirmModal"
    ></deletion-confirm-modal>

    <alert-modal
      v-if="showDeleteTagAlertModal"
      alertTitle="You have successfully deleted the tag"
      buttonTitle="Ок"
      @close="redirectToTags"
    ></alert-modal>
  </teleport>
</template>

<script>
import axios from "axios";
import CreateModal from "../../modals/CreateModal";
import EditModal from "../../modals/EditModal";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
import TagsTable from "../../components/tables/TagsTable";
import AppPageTitleAdmin from "../../components/app/AppPageTitleAdmin";
import AppButton from "../../components/app/AppButton";
import DeletionConfirmModal from "../../modals/DeletionConfirmModal";
import AlertModal from "../../modals/AlertModal";
export default {
  name: "TagsAdmin",
  data() {
    return {
      loader: false,

      thead: ['Title', 'Slug', 'Edit'],
      messageSuccess: '',
      messageError: '',
      showCreateTagModal: false,
      showEditTagModal: false,
      showDeleteTagConfirmModal: false,
      showUpdateTagAlertModal: false,
      showCreateTagAlertModal: false,
      showDeleteTagAlertModal: false,


      tag: {},
      deletedTag: null, // ???????????
      errors: '',
    }
  },
  props: {
    tags: {
      type: Array,
      default: []
    }
  },
  mounted() {
  },
  methods: {
    createTagModal() {
      this.showCreateTagModal = true
    },
    closeCreateTagModal() {
      this.showCreateTagModal = false
    },

    editTagModal(t) {
      this.tag = t
      this.showEditTagModal = true
    },

    closeEditTagModal() {
      this.showEditTagModal = false
    },
    deleteTagConfirmModal(tag) {
      this.deletedTag = tag
      this.showDeleteTagConfirmModal = true
    },

    closeDeleteTagConfirmModal() {
      this.showDeleteTagConfirmModal = false
    },
    redirectToTags() {
      document.location.href = '/admin/tags'
    },

    storeTag(title) {
      return new Promise((res, rej) => {
        axios.post('/admin/tags', {title: title})
          .then(response => {
            this.messageError = ''
            this.showCreateTagModal = false
            this.showCreateTagAlertModal = true
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


    updateTag(id, title) {
      return new Promise((res, rej) => {
        axios.put(`/admin/tags/${id}`, {title: title})
          .then(response => {
            this.showEditTagModal = false
            this.showUpdateTagAlertModal = true
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

    deleteTag(id) {
      return new Promise((res, rej) => {
        axios.delete(`/admin/tags/${id}`)
          .then(response => {
            this.showDeleteTagAlertModal = true
          })
          .catch(err => {
            console.log(rej(err))
          })
      })

    },
  },
  computed: {
    titleDeleteTagConfirmModal() {  // titleDeleteTagConfirmModal()
      return "Do you want to delete" + " " + this.deletedTag.title + " tag ?"
    },
  },
  watch: {},
  components: {
    MoonLoader,
    TagsTable,
    AppPageTitleAdmin,
    AppButton,
    CreateModal,
    EditModal,
    DeletionConfirmModal,
    AlertModal
  },

}
</script>

<style scoped>

</style>