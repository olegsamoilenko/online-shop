<template>

  <app-page-title-admin
    title="Users"
  ></app-page-title-admin>

  <div v-if="loader" class="flex items-center justify-center mt-10">
    <moon-loader :loading="loader" color="blue" size="40px"></moon-loader>
  </div>

  <div v-else class="text-gray-700 mt-8">

    <div class="xl:flex items-end justify-between">
      <div class="mb-[10px] flex flex-col sm:flex-row">
        <div class="mt-[10px] mr-[20px]">
          <app-select
            label="Sort by:"
            name="usersSortBy"
            :options="usersSortByData"
            v-model="usersSortBy"
          ></app-select>
        </div>

        <div class="flex">
          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Role:"
              name="usersRole"
              :options="usersRoleData"
              v-model="usersRole"
            ></app-select>
          </div>

          <div class="mt-[10px] mr-[20px]">
            <app-select
              label="Per page:"
              name="usersPerPage"
              :options="usersPerPageData"
              v-model="usersPerPage"
            ></app-select>
          </div>
        </div>

      </div>

      <div class="inline-block mb-[10px]">
        <app-search-form
          v-model="searchInput"
          name="search"
          placeholder="Search Users..."
          @search="searchUsers"
        ></app-search-form>
      </div>
    </div>

    <div v-if="loadedUsers.length">

      <div class="mb-[20px]">
        <users-table
          :thead="thead"
          :loadedUsers="loadedUsers"
          @editUser="editUser"
          @delUser="delConfirmUser"
        ></users-table>
      </div>

      <div>
        <laravel-vue-pagination :data="paginateData" :limit="2" @pagination-change-page="loadUsers"/>
      </div>
    </div>
    <div v-else class="mt-[10px]">
      <p>No users were found for these search parameters.</p>
    </div>
  </div>

  <teleport to="#modal">
    <search-users-modal
      v-if="showSearchUsersModal"
      :modalTitle="titleSearch"
      @close="closeSearchUsersModal"
      :searchInput="searchInput"
      @editUser="editUser"
      @delUser="delConfirmUser"
    ></search-users-modal>

    <edit-user-modal
      v-if="showEditUserModal"
      modalTitle="Edit User"
      :user="loadedEditableUser"
      :roles="loadedEditableUserRoles"
      @close="closeEditUserModal"
      @update="updateUser"
    ></edit-user-modal>

    <alert-modal
      v-if="showUpdateUserAlertModal"
      alertTitle="You have successfully edited the user"
      buttonTitle="Ок"
      @close="reloadUsers"
    ></alert-modal>

    <deletion-confirm-modal
      v-if="showDeleteUserConfirmModal"
      :title="titleDeletionConfirmModal"
      :objectToBeDeleted="deletedUser"
      @del="delUser"
      @close="closeDeleteUserConfirmModal"
    ></deletion-confirm-modal>

    <alert-modal
      v-if="showUnableDeleteUserModal"
      :alertDanger="true"
      alertTitle="You cannot delete yourself!"
      buttonTitle="Ок"
      @close="reloadUsers"
    ></alert-modal>

    <alert-modal
      v-if="showDeleteUserAlertModal"
      alertTitle="You have successfully delete the user"
      buttonTitle="Ок"
      @close="reloadUsers"
    ></alert-modal>
  </teleport>

</template>

<script>
import axios from "axios";
import {MoonLoader} from 'vue-spinner/dist/vue-spinner.min.js';
import AppPagination from "../../components/app/AppPagination";
import AppPageTitleAdmin from "../../components/app/AppPageTitleAdmin";
import SearchUsersModal from "../../modals/SearchUsersModal";
import UsersTable from "../../components/tables/UsersTable";
import EditUserModal from "../../modals/EditUserModal";
import AlertModal from "../../modals/AlertModal";
import DeletionConfirmModal from "../../modals/DeletionConfirmModal";
import AppSelect from "../../components/app/AppSelect";
import AppSearchForm from "../../components/app/AppSearchForm";
import usersPerPageData from "../../mixins/sortingUsersData";
import usersSortByData from "../../mixins/sortingUsersData";
import usersRoleData from "../../mixins/sortingUsersData";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
  name: "UsersAdmin",
  props: {
    user: {
      type: Object,
      required: false
    },
  },
  data() {
    return {
      loader: false,

      loadedUsers: [],
      paginateData: {},
      links: [],
      // linksPages: [],
      // linksPageActive: null,

      usersSortBy: 'createdAt',
      usersOrderBy: 'created_at',
      usersDirection: 'ASC',
      usersPerPage: 10,
      usersRole: 0,

      searchInput: '',
      showSearchUsersModal: false,
      showEditUserModal: false, //
      showUpdateUserAlertModal: false,
      showDeleteUserAlertModal: false,
      showDeleteUserConfirmModal: false,
      showUnableDeleteUserModal: false,

      deletedUser: null, //??????????????

      thead: ['Name', 'Email', 'Roles', 'Edit'],

      loadedEditableUser: null, // EditableUser
      loadedEditableUserRoles: null, // EditableUserRoles
    }
  },
  methods: {
    loadUsers(page = 1) {
      this.loader = true

      let params = {
        usersOrderBy: this.usersOrderBy,
        usersDirection: this.usersDirection,
        usersRole: this.usersRole,
        usersPerPage: this.usersPerPage,
      }

      return new Promise((res, rej) => {
        axios.get(`/admin/users/p?page=${page}`, {params})
          .then(response => {
            this.loadedUsers = response.data.users.data
            this.paginateData = response.data.users
            this.loader = false

          })
          .catch(err => {
            console.log(rej(err))
            this.loader = false
          })
      })
    },
    searchUsers() {
      if (this.searchInput) {
        this.showSearchUsersModal = true
      }
    },
    closeSearchUsersModal() {
      this.showSearchUsersModal = false
      this.searchInput = ''
    },
    editUser(user) {
      this.searchInput = ''
      this.showSearchUsersModal = false
      return new Promise((res, rej) => {
        axios.get(`/admin/users/${user.id}/edit`)
          .then(response => {
            this.loadedEditableUser = response.data.user
            this.loadedEditableUserRoles = response.data.roles
            this.showEditUserModal = true
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },
    closeEditUserModal() {
      this.showEditUserModal = false
    },
    updateUser(id, roles) {
      const formData = {
        '_method': 'put',
        'userRoles': roles
      }

      return new Promise((res, rej) => {
        axios.post(`/admin/users/${id}`, formData)
          .then(response => {
            this.showEditUserModal = false
            this.showUpdateUserAlertModal = true
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
    reloadUsers() {
      this.showUpdateUserAlertModal = false
      this.showUnableDeleteUserModal = false
      this.showDeleteUserAlertModal = false
      this.showDeleteUserConfirmModal = false
      this.loadUsers()
      // document.location.href = '/admin/users'
    },
    delConfirmUser(user) {
      if (this.user.id === user.id) {
        this.showUnableDeleteUserModal = true
      } else {
        this.deletedUser = user
        this.showSearchUsersModal = false
        this.searchInput = ''
        this.showDeleteUserConfirmModal = true
      }

    },
    delUser(id) {
      return new Promise((res, rej) => {
        axios.delete(`/admin/users/${id}`)
          .then(response => {
            this.showDeleteUserAlertModal = true

          })
          .catch(err => {
            if (err.response.status === 405) {
              this.showUnableDeleteUserModal = true
            } else {
              console.log(rej(err))
            }
          })
      })
    },
    closeDeleteUserConfirmModal() {
      this.showDeleteUserConfirmModal = false
    },

  },
  computed: {
    titleSearch() {
      return "Result for search:" + ' ' + this.searchInput
    },
    titleDeletionConfirmModal() {
      return "Do you want to delete" + ' ' + this.deletedUser.name + ' ' + "?"
    },

  },
  created() {

    if (JSON.parse(localStorage.getItem("usersSortBy"))) {
      this.usersSortBy = JSON.parse(localStorage.getItem("usersSortBy"))
    }

    if (JSON.parse(localStorage.getItem("usersOrderBy"))) {
      this.usersOrderBy = JSON.parse(localStorage.getItem("usersOrderBy"))
    }

    if (JSON.parse(localStorage.getItem("usersDirection"))) {
      this.usersDirection = JSON.parse(localStorage.getItem("usersDirection"))
    }

    if (JSON.parse(localStorage.getItem("usersPerPage"))) {
      this.usersPerPage = JSON.parse(localStorage.getItem("usersPerPage"))
    }

    if (JSON.parse(localStorage.getItem("usersRole"))) {
      this.usersRole = JSON.parse(localStorage.getItem("usersRole"))
    }

  },
  mounted() {
    this.loadUsers()
  },
  watch: {
    usersSortBy() {
      if (this.usersSortBy === 'createdAt') {
        this.usersOrderBy = 'created_at'
        this.usersDirection = 'DESC'
      }
      if (this.usersSortBy === 'nameAsc') {
        this.usersOrderBy = 'name'
        this.usersDirection = 'ASC'
      }
      if (this.usersSortBy === 'nameDesc') {
        this.usersOrderBy = 'name'
        this.usersDirection = 'DESC'
      }
      localStorage.setItem("usersOrderBy", JSON.stringify(this.usersOrderBy));
      localStorage.setItem("usersDirection", JSON.stringify(this.usersDirection));
      localStorage.setItem("usersSortBy", JSON.stringify(this.usersSortBy));
      this.loadUsers()

    },
    usersRole() {
      localStorage.setItem("usersRole", JSON.stringify(this.usersRole));
      this.loadUsers()
    },
    usersPerPage() {
      localStorage.setItem("usersPerPage", JSON.stringify(this.usersPerPage));
      this.loadUsers()
    },
  },
  components: {
    AppPagination,
    MoonLoader,
    AppPageTitleAdmin,
    SearchUsersModal,
    UsersTable,
    EditUserModal,
    AlertModal,
    DeletionConfirmModal,
    AppSelect,
    AppSearchForm,
    LaravelVuePagination
  },
  mixins: [usersPerPageData, usersRoleData, usersSortByData],


}
</script>

<style scoped>

</style>