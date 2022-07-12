<template>
  <form class="flex relative">
    <input
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="bg-[#F6F6F6] border border-solid border-[#EBEBEB] focus:border focus:border-solid focus:border-[#EBEBEB] rounded-l-[6px] placeholder:font-gilroy-400 placeholder:text-[#7F7F7F] placeholder:text-16 placeholder:pl-[25px] w-[300px] h-[40px]"
      type="search"
      :name="name"
      :placeholder="placeholder">

    <app-search-button
    @search="$emit('search')"
    ></app-search-button>

  </form>
</template>

<script>
import AppSearchButton from "./AppSearchButton";
export default {
  name: "AppSearchForm",
  props: {
    modelValue: {
      type: String
    },
    name: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      required: true
    }
  },

  emits: ['update:modelValue', 'search'],
  components: {
    AppSearchButton
  }
}
</script>

<style scoped>

</style>