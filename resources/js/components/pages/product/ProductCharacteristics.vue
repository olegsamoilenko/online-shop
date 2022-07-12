<template>
  <characteristics-table
  :product="product"
  ></characteristics-table>

</template>

<script>
import CharacteristicsTable from "../../tables/CharacteristicsTable";
export default {
  name: "ProductCharacteristics",
  props: {
    product: {
      type: Object
    }
  },
  components: {
    CharacteristicsTable
  }
}
</script>

<style scoped>

</style>