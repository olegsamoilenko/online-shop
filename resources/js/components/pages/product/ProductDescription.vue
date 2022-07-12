<template>
  <p dusk="product-description" class="whitespace-pre-line" v-html="product.description"></p>
</template>

<script>
export default {
  name: "ProductDescription",
  props: {
    product: {
      type: Object
    }
  }
}
</script>

<style scoped>

</style>