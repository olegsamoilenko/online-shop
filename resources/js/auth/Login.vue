<template>
  <div class="max-w-[425px] mx-auto px-[20px] my-[100px]">
    <div>
      <div class="border-b">
        <h3 class="font-inter font-bold text-22">Login</h3>
        <p class="font-inter font-light text-14 text-[#8692A6] mt-2 mb-3">Enter your credentials</p>
        <span></span>
      </div>
      <form class="mt-5">
        <span class="form-error" v-if="errors.error">{{ errors.error }}</span>
        <div class="block mt-3.5">
          <app-input
            title="Email"
            type="email"
            name="email"
            v-model="loginData.email"
            placeholder="Enter email address"
            :error="errors.email"
          ></app-input>
          <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
        </div>
        <div class="block mt-3.5 relative">
          <app-input
            v-if="!showPassword"
            title="Password"
            type="password"
            name="password"
            v-model="loginData.password"
            placeholder="Enter password"
            :error="errors.password"
          ></app-input>

          <app-input
            v-else
            title="Password"
            type="text"
            name="password"
            v-model="loginData.password"
            placeholder="Enter password"
            :error="errors.password"
          ></app-input>

          <a class="absolute top-[42px] right-[28px] font-inter font-normal text-12 cursor-pointer"
             @click="showPassword = !showPassword">{{ !showPassword ? 'Show' : 'Hide' }}</a>
          <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
        </div>

        <div class="mt-4 font-semibold font-inter text-14 text-[#1565D8]">
          <a href="#">Forgot your password?</a>
        </div>
        <div class="mt-6">
          <app-button
            title="Login"
            @action="loginUser"
            width="w-full"
            :disabled="loadingLogin"
          ></app-button>
        </div>

      </form>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import AppInput from "../components/app/AppInput";
import AppButton from "../components/app/AppButton";

export default {
  data() {
    return {
      loginData: {
        email: '',
        password: ''
      },
      showPassword: false,
      errors: {},
      loadingLogin: false
    }
  },
  methods: {
    loginUser() {
      this.loadingLogin = true
      return new Promise((res, rej) => {
        axios.post('/login', this.loginData)
          .then(response => {
            this.loadingLogin = false
            document.location.href = '/'
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.loadingLogin = false
              this.errors = err.response.data.errors
            } else if (err.response.status === 401) {
              this.loadingLogin = false
              this.errors = err.response.data
            } else {
              console.log(rej(err))
            }
          })
      })
    }
  },
  computed: {},
  components: {
    AppInput,
    AppButton
  }
}
</script>
<style scoped>

</style>
