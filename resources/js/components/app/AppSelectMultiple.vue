<template>
  <label class="form-label block">{{ label }}</label>
  <select class="form-input" name="userRoles" v-model="userRoles" multiple>
    <!--            <option value="0">Немає ролі</option>-->
    <option v-for="r in roles" :key="r.id" :value="r.id">{{ r.name }}</option>
  </select>
</template>

<script>
export default {
  name: "AppSelectMultiple",
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
}
</script>

<style scoped>

</style>