<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1>{{ title }}</h1>
      <div class="flex justify-between items-center py-3">
        <app-button
          title="Cancel"
          @action="$emit('close')"
        ></app-button>
        <app-button
          title="Ok"
          @action="$emit('del', objectToBeDeleted.id)"
        ></app-button>
      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppButton from "../components/app/AppButton";

export default {
  name: "DeletionConfirmModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    title: {
      type: String,
      required: true,
    },
    objectToBeDeleted: {
      type: Object,
      required: true,
    }
  },
  emits: ['close', 'del'],
  mounted() {
    // console.log(this.objectToBeDeleted)
  },
  components: {
    BaseModal,
    AppButton
  }
}
</script>

<style scoped>

</style>