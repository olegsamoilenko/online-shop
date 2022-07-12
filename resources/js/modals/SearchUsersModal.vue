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
        <users-table
          :thead="thead"
          :loadedUsers="resultSearch"
          @editUser="editUser"
          @delUser="delUser"
        ></users-table>

        <div class="mt-[10px]">
          <app-button
            title="Show more"
            @action="searchUsers"
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
import UsersTable from "../components/tables/UsersTable";
export default {
  name: "SearchUsersModal",
  props: {
    modalTitle: {
      type: String
    },
    searchInput: {
      type: String,
      required: true
    }
  },
  emits: ['close', 'editUser', 'delUser'],
  data() {
    return {
      resultSearch: [],
      thead: ['Name', 'Email', 'Roles', 'Edit'],
    }
  },
  methods: {
    searchUsers() {
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
        axios.get(`/admin/users/search`, {params})
          .then(response => {
            response.data.users.forEach(u => {
              this.resultSearch.push(u)
            })
          })
          .catch(err => {
            console.log(rej(err))
          })
      })
    },

    editUser(user) {
      this.$emit('editUser', user)
    },

    delUser(user) {
      this.$emit('delUser', user)
    }
  },
  mounted() {
    this.searchUsers()

  },
  components: {
    BaseModal,
    AppButton,
    UsersTable
  },
}
</script>

<style scoped>

</style>