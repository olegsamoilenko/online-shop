<template>
  <div class="max-w-[425px] px-[20px] mx-auto my-[100px]">
    <div>
      <div class="border-b">
        <h3 class="font-inter font-bold text-22">Registration</h3>
        <p class="font-inter font-light text-14 text-[#8692A6] mt-2 mb-3">Enter your credentials</p>
      </div>
      <form class="mt-5">
        <div class="block mt-3.5">
          <app-input
            title="Name"
            type="text"
            name="name"
            v-model="registerData.name"
            placeholder="Enter your name"
            :error="errors.name"
          ></app-input>
          <span class="form-error" v-if="errors.name">{{ errors.name[0] }}</span>
        </div>
        <div class="block mt-3.5">
          <app-input
            title="Email"
            type="email"
            name="email"
            v-model="registerData.email"
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
            v-model="registerData.password"
            placeholder="Enter password"
            :error="errors.password"
          ></app-input>

          <app-input
            v-else
            title="Password"
            type="text"
            name="password"
            v-model="registerData.password"
            placeholder="Enter password"
            :error="errors.password"
          ></app-input>
          <a class="absolute top-[42px] right-[28px] font-inter font-normal text-12 cursor-pointer"
             @click="showPassword = !showPassword">
            {{ !showPassword ? 'Show' : 'Hide' }}
          </a>
          <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
        </div>


        <div class="block mt-3.5 relative">
          <app-input
            v-if="!showPassword_confirmation"
            title="Confirm the password"
            type="password"
            name="password_confirmation"
            v-model="registerData.password_confirmation"
            placeholder="Confirm the password"
            :error="errors.password"
          ></app-input>

          <app-input
            v-else
            title="Confirm the password"
            type="text"
            name="password_confirmation"
            v-model="registerData.password_confirmation"
            placeholder="Confirm the password"
            :error="errors.password"
          ></app-input>
          <a class="absolute top-[42px] right-[28px] font-inter font-normal text-12 cursor-pointer"
             @click="showPassword_confirmation = !showPassword_confirmation">
            {{ !showPassword_confirmation ? 'Show' : 'Hide' }}
          </a>
        </div>

        <div class="form-label mt-3.5">
          <input
            type="checkbox"
            name="rules"
            v-model="registerData.rules"
            class="form-input"
            :class="{'border-red-500': errors.rules}"
          >
          <span class="ml-[10px]">I agree with the rules</span>
        </div>
        <span class="form-error mt-8" v-if="errors.rules && !registerData.rules">{{ errors.rules[0] }}</span>

        <div class="mt-6">
          <app-button
            title="Register"
            @action="registerUser"
            width="w-full"
            :disabled="loadingRegister"
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
  data: () => ({
    registerData: {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      rules: false,
    },
    showPassword: false,
    showPassword_confirmation: false,
    errors: {},
    loadingRegister: false

  }),
  methods: {
    registerUser() {
this.loadingRegister = true
      return new Promise((res, rej) => {
        axios.post('/register', this.registerData)
          .then(response => {
            this.loadingRegister = false
            document.location.href = '/'
          })
          .catch(err => {
            if (err.response.status === 422) {
              this.loadingRegister = false
              this.errors = err.response.data.errors
            } else {
              this.loadingRegister = false
              console.log(rej(err))
            }
          })
      })
    },
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
