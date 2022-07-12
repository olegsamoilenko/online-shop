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
    <tr v-for="(o, idx) in loadedOrders" :key="o.id"
        :class="[ idx % 2 === 1 ? 'lg:bg-sky-50' : 'lg:bg-white']">
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Name">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ o.name }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Phone">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ o.phone }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Status">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ getStatus(o.status) }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Payment">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ getPaymentStatus(o.paid).label }}</p>
        </div>
      </td>
      <td class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]" data-label="Data">
        <div class="mr-[10px]">
          <p class="text-gray-900 whitespace-no-wrap">{{ getDate(o.created_at) }}</p>
        </div>
      </td>
      <td
        class="px-[5px] py-[3px] border-b border-gray-200 text-[14px]"
        data-label="Edit">
        <div class="flex items-center lg:justify-start justify-end flex-nowrap">
          <button class="mr-[20px]" @click="edit(o)">
            <unicon name="edit-alt" fill="#7DC273" width="20" height="20"/>
          </button>
          <button class="" @click="del(o)">
            <unicon name="trash-alt" fill="red" width="17" height="17"/>
          </button>
        </div>


      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import getStatus from "../../mixins/getStatus";
import getPaymentStatus from "../../mixins/getPaymentStatus";
import getConfirmationStatus from "../../mixins/getConfirmationStatus";
import getDate from "../../mixins/getDate";
import ordersMapData from "../../mixins/ordersMapData";

export default {
  name: "OneClickOrdersTable",
  props: {
    thead: {
      type: Array,
      required: true
    },
    loadedOrders: {
      type: Array,
      required: true
    },
  },
  emits: ['editOrder', 'delOrder'],
  methods: {
    edit(order) {
      this.$emit('editOrder', order)
    },
    del(order) {
      this.$emit('delOrder', order)
    },
  },
  mixins: [
    getStatus,
    getPaymentStatus,
    getConfirmationStatus,
    getDate,
    ordersMapData
  ]
}
</script>

<style scoped>

</style>