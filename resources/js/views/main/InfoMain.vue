<template>
  <div class="container mx-auto pb-16 px-[15px]  xl:max-w-[1024px]">
    <h1>{{ info }}</h1>
  </div>
</template>

<script>
export default {
  name: "InfoMain",
  data() {
    return {
    }
  },
  props: {
    info: {
      type: String
    }
  },
  mounted() {
    console.log(this.info)
  }
}
</script>

<style scoped>

</style>