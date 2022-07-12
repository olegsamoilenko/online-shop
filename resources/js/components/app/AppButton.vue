<template>
  <button v-if="actionButton" type="submit" class="inline-block px-[20px] h-[50px] bg-[#405FD4] rounded-lg text-[#ffffff]" :disabled="disabled" :class="[width]" @click.prevent="action">{{title}}</button>
  <button v-else type="submit" class="inline-block px-[20px] h-[50px] bg-[#405FD4] rounded-lg text-[#ffffff]" :disabled="disabled" :class="[width]">{{title}}</button>
</template>

<script>
export default {
  name: "AppButton",
  props: {
    title: {
      type: String,
      required: true
    },
    disabled: {
      type: Boolean,
      default: false
    },
    width: {
      type: String,
      default: 'w-auto'
    },
    actionButton: {
      type: Boolean,
      default: true
    },
  },
  emits: ['action'],
  data() {
    return {

    }
  },
  methods: {
    action() {
      this.$emit('action')
    }
  }
}
</script>

<style scoped>

</style>