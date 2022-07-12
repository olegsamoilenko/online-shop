<template>
  <div class=" mx-[12px] mb-[10px] inline-block w-[14px] h-[14px] rounded-[50%] border-[3px] border-[#405FD4] border-solid cursor-pointer" :class="{'bg-[#405FD4]': img.id === mainImage.id}" @click="active"></div>
</template>

<script>
export default {
  name: "ProductImagesPagination",
  props: {
    img: {
      type: Object,
    },
    mainImage: {
      type: Object,
    }
  },
  emits: ['activeImages'],
  methods: {
    active () {
      this.$emit('activeImages', this.img.id)
    }
  }
}
</script>

<style scoped>

</style>