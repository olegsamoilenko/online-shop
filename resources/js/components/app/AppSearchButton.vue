<template>
  <button dusk="search-button"
          class="border border-solid border-[#EBEBEB] border-l-0 rounded-r-[6px] w-[58px]" type="submit"
          @click.prevent="$emit('search')">
    <unicon class="absolute right-[16px] top-[9px] cursor-pointer" name="search" fill="#242424" width="22"
            height="22"/>
  </button>
</template>

<script>
export default {
  name: "AppSearchButton",
  emits: ['search'],
}
</script>

<style scoped>

</style>