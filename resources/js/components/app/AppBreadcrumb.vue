<template>
  <ul dusk="breadcrumb" class="flex flex-row font-gilroy-400 text-12 sm:text-16 text-[#B6B5B5]">
    <li><a href="/">Main</a></li>

    <li v-for="b in crumbData"><span class="mx-4"> > </span><a :href="b.url">{{b.title}}</a></li>
  </ul>
</template>

<script>
export default {
  name: "AppBreadcrumb",
  props: {
    crumbData: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      breadcrumb: [
        {url: '', title: 'Здесь будут Breadcrumb'},
      ]
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>