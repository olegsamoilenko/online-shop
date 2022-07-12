<template>
  <table class=" min-w-full leading-normal border-t-[4px] border-gray-200  lg:border-t-0">
    <thead>
    <tr>
      <th
        class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-gray-100 text-centr text-[14px] font-semibold text-gray-600 uppercase relative" v-for="t in thead">
        {{ t }}
      </th>
    </tr>
    </thead>
    <tbody class="">
    <tr v-for="(t, idx) in loadedTags" :key="t.id"
        :class="['lg:bg-gray-50', idx % 2 === 0 ? 'lg:bg-white' : '']">
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Title">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ t.title }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Slug">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ t.slug }}</p>
        </div>
      </td>
      <td
        class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]"
        data-label="Edit">
        <div class="flex items-center lg:justify-start justify-end flex-nowrap">
          <button class="mr-[20px]" @click="edit(t)">
            <unicon name="edit-alt" fill="#7DC273" width="20" height="20"/>
          </button>
          <button class="" @click="del(t)">
            <unicon name="trash-alt" fill="red" width="17" height="17"/>
          </button>
        </div>


      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "TagsTable",
  props: {
    thead: {
      type: Array,
      required: true
    },
    loadedTags: {
      type: Array,
      required: true
    }
  },
  emits: ['editTag', 'delTag'],
  methods: {
    edit(tag) {
      this.$emit('editTag', tag)
    },
    del(tag) {
      this.$emit('delTag', tag)
    }
  }
}
</script>

<style scoped>

</style>