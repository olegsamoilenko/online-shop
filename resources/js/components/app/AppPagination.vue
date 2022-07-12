<template>
  <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
    <div class="flex-1 flex justify-between sm:hidden">
      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing from
          {{ ' ' }}
          <span class="font-medium">{{paginateData.from}}</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="font-medium">{{paginateData.to}}</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="font-medium">{{paginateData.total}}</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a :href="paginateData.first_page_url" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">&lt;&lt;
          </a>
          <a :href="paginateData.prev_page_url" class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">&lt;
            <!--            <span class="sr-only">Previous</span>-->
            <!--            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />-->
          </a>
          <a v-for="l in links" :href="l.url" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium cursor-pointer" :class="[l.active ? 'paginate-active' : '', 'paginate-base']">{{l.label}}</a>

          <a :href="paginateData.next_page_url" class="relative inline-flex items-center px-2 py-2  border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">>
            <!--            <span class="sr-only">Next</span>-->
            <!--            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />-->
          </a>
          <a :href="paginateData.last_page_url" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">>>
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
// import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
export default {
  name: "AppPagination",
  props: ['paginateData', 'links'],

  components: {
    // ChevronLeftIcon,
    // ChevronRightIcon,
  },
}
</script>

<style scoped>

</style>