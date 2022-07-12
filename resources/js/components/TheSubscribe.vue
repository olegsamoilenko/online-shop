<template>
  <div class="bg-[#3A3C4A]">
    <div class="container mx-auto px-[15px]">
      <div class="lg:w-[900px] text-[#ffffff] pt-[44px] pb-[40px] mx-[20px] sm:mx-[10px] lg:mx-auto">
        <div v-if="!messageSuccess">
          <h1 class="font-gilroy-700 text-30 sm:text-36 mb-[10px]">Subscribe to our newsletter</h1>
          <p class="text-[#cccccc] font-gilroy-600 text-18 sm:text-20 mb-[37px]">Be the first to know about promotions and events</p>
        </div>
        <div v-else>
          <h1 class="font-gilroy-700 text-30 sm:text-36 mb-[70px]">{{ messageSuccess }}</h1>
        </div>

        <form class="mx-auto">
          <div class="sm:inline-block align-top">
            <label>
              <input
                type="text"
                name="name"
                class="w-full sm:w-[290px] h-[50px] mr-[15px] mb-[10px] bg-[#484A56] placeholder:text-[#ffffff] border-[#A3A4AA] rounded-lg"
                v-model="name"
                :class="{'border-red-500': errors.name}"
                placeholder="Name"
              />
            </label>
            <span class="form-error block" v-if="errors.name">{{ errors.name[0] }}</span>
          </div>
          <div class="sm:inline-block align-top">
            <label class="">
              <input
                type="email"
                name="email"
                class="w-full sm:w-[290px] h-[50px] mr-[15px] mb-[10px] bg-[#484A56] placeholder:text-[#ffffff] border-[#A3A4AA] rounded-lg"
                v-model="email"
                :class="{'border-red-500': errors.email}"
                placeholder="Email"
              />
            </label>
            <span class="form-error block" v-if="errors.email">{{ errors.email[0] }}</span>
          </div>
          <div class="sm:inline-block align-top">
            <app-button
              title="Subscribe"
              @action="subscribe"
            ></app-button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import AppButton from "./app/AppButton";
export default {
  name: "Subscription",
  data() {
    return {
      name: '',
      email: '',
      errors: {},
      messageSuccess: ''
    }
  },
  methods: {
    subscribe() {
      event.preventDefault()
      const formSubscribe = {
        name: this.name,
        email: this.email
      }

      return new Promise((res,rej)=>{
        axios.post('/subscribe', formSubscribe)
          .then(response => {
            this.errors = {}
            this.name = ''
            this.email = ''
            this.messageSuccess = response.data.message
          })
          .catch(err => {
            if  (err.response.status === 422) {
              this.errors = err.response.data.errors
            } else {
              console.log(rej(err))
            }
          })
      })
    },
  },
  components: {
    AppButton
  }

}
</script>

<style scoped>

</style>
