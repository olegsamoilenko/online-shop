<template>
  <div dusk="page-title" class="relative  inline-block">
    <h1 class="font-gilroy-600 text-page-title uppercase">{{ title }}</h1>
    <div class="h-[3px] bg-[#405FD4] absolute w-16 top-[12px] right-[-87px] sm:w-20 sm:top-[15px] sm:right-[-109px] lg:w-24 lg:top-[22px] lg:right-[-120px]"></div>
  </div>
</template>

<script>
export default {
  name: "AppPageTitle",
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