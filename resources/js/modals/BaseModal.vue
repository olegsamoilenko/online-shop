<template>
  <div class="modal-backdrop" @click="close"></div>
  <div class="modal relative w-[80vw] max-h-[80%] overflow-auto">
    <div class="mb-2">
      <h3 class="font-gilroy-600 text-20">{{ modalTitle }}</h3>
    </div>

    <slot></slot>


    <button v-if="buttonClose" dusk="modal-button-close" class="absolute top-[4px] right-[11px]" @click="$emit('close')">X</button>
  </div>
</template>

<script>
export default {
  name: "BaseModal",
  props: {
    modalTitle: {
      type: String
    },
    buttonClose: {
      type: Boolean,
      default: false
    }

  },
  emits: ['close'],
  methods: {
    close() {
      this.$emit('close')
    },
  },
}
</script>

<style scoped>

</style>