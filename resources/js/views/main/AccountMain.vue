<template>
  <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">
<h1>Name: {{ user.name }}</h1>
  </div>
</template>

<script>
export default {
  name: "AccountMain",
  props: {
    user: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>

</style>