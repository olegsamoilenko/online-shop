<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <form class="relative" @submit.prevent="updateUser">

        <div>
          <span class="inline-block w-[65px]">Name:</span>
          <span>{{ user.name }}</span>
        </div>

        <div>
          <span class="inline-block w-[65px]">Email:</span>
          <span>{{ user.email }}</span>
        </div>

        <div class="mt-[10px] mr-[20px]">
          <label class="block text-xs mb-3">Change user roles:</label>
          <Multiselect
            v-model="userRoles"
            mode="tags"
            :close-on-select="true"
            :options="options"
          />
        </div>


        <div class="flex justify-between items-center py-3">
          <app-button
            title="Update"
            @action="updateUser"
          ></app-button>
        </div>
      </form>

    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppButton from "../components/app/AppButton";
import AppSelect from "../components/app/AppSelect";
import Multiselect from '@vueform/multiselect'
import multiselectCss from '@vueform/multiselect/themes/default.css'
export default {
  name: "EditUserModal",
  props: {
    modalTitle: {
      type: String
    },
    user: {
      type: Object,
      required: true
    },
    roles: {
      type: Array,
      required: true
    }
  },
  emits: ['close', 'update'],
  data() {
    return {
      userRoles: [],
      options: [],
    }
  },
  methods: {
    getOptions() {
      this.roles.forEach(r => {
        let obj = {value: r.id, label: r.name}
        this.options.push(obj)
      })
    },

    getUserRoles() {
      if (this.user.roles.length) {
        this.user.roles.forEach(r => {
          this.userRoles.push(r.id)
        })
      } else {
        this.userRoles = [0]
      }
    },
    updateUser() {
      this.$emit('update', this.user.id, this.userRoles)
    }
  },
  mounted() {
    this.getUserRoles()
    this.getOptions()
  },
  watch: {
  },
  components: {
    BaseModal,
    AppButton,
    AppSelect,
    Multiselect,
    multiselectCss
  },
}
</script>

<style scoped>

</style>