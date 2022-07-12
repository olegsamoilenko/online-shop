<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <form>
        <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
          <app-input
            title="Title"
            type="text"
            name="title"
            v-model="title"
            placeholder="Enter title"
            :error="error"
          ></app-input>
        </div>

        <span class="text-red-500 text-[14px] mb-[20px] p-5" v-if="error">{{ error }}</span>

        <div class="flex justify-between items-center py-3">
          <app-button
            title="Create"
            @action="$emit('action', title)"
          ></app-button>
        </div>
      </form>
    </template>
  </base-modal>
</template>

<script>
import AppButton from "../components/app/AppButton";
import BaseModal from "./BaseModal";
import AppInput from "../components/app/AppInput";
export default {
  name: "CreateModal",
  props: {
    modalTitle: {
      type: String,
      required: true,
    },
    error: {
      type: String,
      required: false,
    },
  },
  data() {
    return {
      title: ''
    }
  },
  emits: ['close', 'action'],
  components: {
    AppButton,
    BaseModal,
    AppInput
  }
}
</script>

<style scoped>

</style>