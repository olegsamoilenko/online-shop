<template>

<div class="lg:max-w-[640px]">
  <div v-for="(data, idx) in characteristicsData" :key="idx" class="flex py-2" :class="[ idx % 2 === 1 ? 'bg-[#E5E5E6]' : '']">
    <label class="min-w-[180px] "><b>{{ data.label }}</b></label>
    <div>
      <span v-if="data.label === 'Diameter'">Ø </span>
      <span>{{data.value}}</span>
      <span v-if="data.label === 'Diameter' || data.label === 'Height'"> sm.</span>
      <span v-if="data.label === 'Volume'"> ml.</span>
    </div>

  </div>
</div>


</template>

<script>
import productCharacteristicsData from "../../mixins/productCharacteristicsData";
export default {
  name: "CharacteristicsTable",
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      characteristicsData: []
    }
  },
  mounted() {
    console.log(this.productCharacteristicsData)
    this.characteristicsData = this.productCharacteristicsData.filter(d => d.value !== null)

  },
  mixins: [productCharacteristicsData]
}
</script>

<style scoped>

</style>