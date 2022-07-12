<template>
  <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-[#405FD4]">
    <div class="flex items-center">
      <button class="flex flex-col items-start ml-7 lg:hidden" @click="sidebarState(true)">
        <span class="block h-[1.5px] w-[15px] mb-[4px] border-b-[1.5px] border-[#000000]"></span>
        <span class="block h-[1.5px] w-[9px] mb-[4px] border-b-[1.5px] border-[#000000]"></span>
        <span class="block h-[1.5px] w-[15px] mb-[4px] border-b-[1.5px] border-[#000000]"></span>
      </button>

    </div>

    <div>
<!--      {{ user.name }}-->
    </div>

    <div class="relative">
      <button @click="dropdownOpen = !dropdownOpen" class="block overflow-hidden focus:outline-none">
        <span v-if="!dropdownOpen" class="absolute top-[6px] left-[-18px] w-[8px] h-[8px] border-2 border-[#ffffff] border-opacity-50 border-r-black border-b-black origin-center rotate-45"></span>
        <span v-if="dropdownOpen" class="absolute top-[11px] left-[-18px] w-[8px] h-[8px] border-2 border-[#ffffff] border-opacity-50 border-r-black border-b-black origin-center rotate-225"></span>
        {{user.name}}</button>


      <div v-if="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
        <a @click.prevent="logout" href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
      </div>
    </div>
  </header>
</template>

<script>
// import axios from "axios";
export default {
  name: "TheHeaderAdmin",
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      notificationOpen: false,
      dropdownOpen: false
    }
  },
  methods: {
    sidebarState(state) {
      this.$store.commit('sidebarState', state)
    },
    logout() {
      document.location.href = '/login'
    },
  },
  mounted() {
  },
  computed: {

  }
}
</script>

<style scoped>

</style>