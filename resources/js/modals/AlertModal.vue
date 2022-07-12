<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <h1 :class="{ 'text-red-500': alertDanger }">{{alertTitle}}</h1>
      <div class="flex justify-end center py-3">
        <app-button
          :title="buttonTitle"
          @action="$emit('close')"
        ></app-button>
        <!--        <a @click="$emit('close')" type="submit" class="btn-admin mr-[10px] cursor-pointer">{{buttonTitle}}</a>-->
      </div>


    </template>
  </base-modal>
</template>

<script>
import BaseModal from "./BaseModal";
import AppButton from "../components/app/AppButton";
export default {
  name: "AlertModal",
  props: {
    modalTitle: {
      type: String,
      required: false,
    },
    alertTitle: {
      type: String,
      required: true,
    },
    buttonTitle: {
      type: String,
      required: true,
    },
    alertDanger: {
      type: Boolean,
      default: false
    }
  },
  emits: ['close'],

  mounted() {
  },

  components: {
    BaseModal,
    AppButton
  }
}
</script>

<style scoped>

</style>