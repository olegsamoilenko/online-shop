<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <form @submit.prevent="$emit('action', id, title)">
        <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
          <label class="text-xs">Имя</label>

          <div class="mt-2 relative rounded-md shadow-sm">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                                </svg>
                            </span>

            <input type="text" v-model="title" name="title"
                   class="form-input w-full px-12 py-2 appearance-none rounded-md focus:border-indigo-600">
          </div>
        </div>

        <span class="text-red-500 text-[14px] mb-[20px] p-5" v-if="error">{{ error }}</span>

        <div class="flex justify-between items-center px-5 py-3">
          <button type="submit"
                  class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none">
            {{ id ? 'Изменить' : 'Добавить' }}
          </button>
        </div>
      </form>
    </template>
  </base-modal>
</template>

<script>
export default {
  name: "UpdateModal"
}
</script>

<style scoped>

</style>