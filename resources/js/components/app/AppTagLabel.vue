<template>
    <span class="text-white font-gilroy-400 text-[13px] mr-[15px] px-2 py-[2px] mb-[5px]"
          :class="{'bg-[#EB702D]': tag.title === 'Promotion', 'bg-[#7AC14F]': tag.title === 'Novelties', 'bg-[#4A93E7]': tag.title === 'Popular'}">{{
        tag.title
      }}</span>
</template>

<script>
export default {
  name: "AppTagLabel",
  props: {
    tag: {
      type: Object,
    }
  }
}
</script>

<style scoped>

</style>