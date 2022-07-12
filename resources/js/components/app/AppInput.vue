<template>
  <label class="form-label block">{{ title }}</label>
  <input
    :type="type"
    :name="name"
    class="form-input"
    :class="[{'border-red-500': error}, width]"
    :placeholder="placeholder"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>

<script>
export default {
  name: "AppInput",
  props: {
    title: {
      type: String,
      required: false
    },
    type: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    width: {
      type: String,
      default: 'w-full'
    },
    error: {
      type: [Object, String],
      required: false
    },
    placeholder: {
      type: String,
      required: false
    },
    modelValue: {}
  },
  emits: ['update:modelValue'],

}
</script>

<style scoped>

</style>