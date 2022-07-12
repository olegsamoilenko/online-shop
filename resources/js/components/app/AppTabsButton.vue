<template>
  <button class="inline-block mr-[20px] font-gilroy-600 text-14 sm:text-14 text-[#333333] uppercase px-[15px] sm:px-[25px] py-[11px] border-solid rounded-[6px]" :class="border" @click="$emit('action')">{{title}}</button>
</template>

<script>
export default {
  name: "AppTabsButton",
  props: {
    title: {
      type: String,
      required: true
    },
    border: {
      type: String,
    }
  },
  emits: ['action']
}
</script>

<style scoped>

</style>