<template>
  <label class="text-xs mb-2.5 block">{{ label }}</label>
  <Field class="form-select" :name="name" v-model="modelValue" @change="$emit('update:modelValue', $event.target.value)" as="select">
    <option class="py-5" v-for="(option, idx) in options" :key="option.idx" :value="option.value">{{ option.label }}</option>

  </Field>
</template>

<script>
import {Field} from 'vee-validate';
export default {
  name: "AppSelect",
  props: {
    label: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    options: {
      type: Array,
      default: []
    },
    modelValue: {},
  },
  mounted() {
  },
  emits: ['update:modelValue'],
  components: {
    Field,
  },
}
</script>

<style scoped>

</style>