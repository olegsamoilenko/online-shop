<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <form>
        <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
          <label class="text-xs">Title</label>

          <div class="mt-2 relative rounded-md shadow-sm">

            <input type="text" v-model="title" name="title"
                   class="form-input w-full px-12 py-2 appearance-none rounded-md focus:border-indigo-600">
          </div>
        </div>

        <span class="text-red-500 text-[14px] mb-[20px] p-5" v-if="error">{{ error }}</span>

        <div class="flex justify-between items-center py-3">
          <app-button
            title="Update"
            @action="$emit('action', id, title)"
          ></app-button>
        </div>
      </form>
    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppButton from "../components/app/AppButton";
export default {
  name: "EditModal",
  props: {
    modalTitle: {
      type: String,
      required: true,
    },
    id: {
      type: Number,
      required: false,
    },
    title: {
      type: String,
      required: false,
    },
    error: {
      type: String,
      required: false,
    },
  },
  emits: ['close', 'action'],

  components: {
    BaseModal,
    AppButton
  }
}
</script>

<style scoped>

</style>