<template>
  <table class=" min-w-full leading-normal border-t-[4px] border-gray-200  lg:border-t-0">
    <thead>
    <tr>
      <th
        class="px-[5px] py-[3px] border-b-2 border-gray-200 bg-sky-100 text-centr text-[14px] font-semibold text-gray-600 uppercase relative" v-for="t in thead">
        {{ t }}
      </th>
    </tr>
    </thead>
    <tbody class="">
    <tr v-for="(p, idx) in loadedProducts" :key="p.id"
        :class="[ idx % 2 === 1 ? 'lg:bg-sky-50' : 'lg:bg-white']">
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Title">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ p.title }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Price">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ getCurrency(p.price) }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Old Price">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ getCurrency(p.old_price) }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Category">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ p.category.title  }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Availability">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ isAvailable(p.is_available) }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Is Active">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ isActive(p.is_active) }}</p>
        </div>
      </td>
      <td v-if="editButtons"
        class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]"
        data-label="Edit">
        <div class="flex items-center lg:justify-start justify-end flex-nowrap">
          <button class="mr-[20px]" @click="edit(p)">
            <unicon name="edit-alt" fill="#7DC273" width="20" height="20"/>
          </button>
          <button class="" @click="del(p)">
            <unicon name="trash-alt" fill="red" width="17" height="17"/>
          </button>
        </div>


      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import getCurrency from "../../mixins/getCurrency";
export default {
  name: "ProductsTable",
  props: {
    thead: {
      type: Array,
      required: true
    },
    loadedProducts: {
      type: Array,
      required: true
    },
    categories: {
      type: Array,
      required: true
    },
    editButtons: {
      type: Boolean,
      default: true
    }
  },
  emits: ['editProduct', 'delProduct'],
  methods: {
    edit(product) {
      this.$emit('editProduct', product)
    },
    del(product) {
      this.$emit('delProduct', product)
    },
    isAvailable(bool) {
      if (bool) {
        return 'Yes';
      } else {
        return 'No'
      }
    },
    isActive(bool) {
      if (bool) {
        return 'Active';
      } else {
        return 'Not Active'
      }
    },
    // categoryById(id) {
    //   return this.categories.find(c => c.id === id)
    // },
  },
  mixins: [
    getCurrency
  ]
}
</script>

<style scoped>

</style>