<template>

        <app-page-title
          :title="title"
        ></app-page-title>


      <div class="mt-8 flex flex-wrap mr-[-6px] sm:mr-[-8px]">

        <slot></slot>

      </div>

</template>

<script>
import AppPageTitle from "./AppPageTitle";
export default {
  name: "AppBlock",
  props: {
    title: {
      type: String,
      required: true
    }
  },
  components: {
    AppPageTitle,
  }
}
</script>

<style scoped>

</style>