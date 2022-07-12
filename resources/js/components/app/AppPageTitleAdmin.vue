<template>
  <h1 class="mt-[20px] text-gray-700 text-16 text-bold font-semibold uppercase">{{title}}</h1>
</template>

<script>
export default {
  name: "AppPageTitleAdmin",
  props: {
    title: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>