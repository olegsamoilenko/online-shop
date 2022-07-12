<template>
  <footer class="bg-[#252736]">
    <div class="container mx-auto text-[#ffffff] px-[15px] xl:max-w-[1024px]">
      <div class="sm:flex px-[20px] lg:px-0 flex-wrap pt-[40px] pb-[23px] font-gilroy-400 border-b-2 border-[#3A3B41]">
        <div class="sm:flex-50 lg:flex-25">
          <div>
            <h3 class="text-20 pb-[9px]">Information</h3>
            <div class="mb-[27px] border-b-2 border-[#405FD4] w-[100px]"></div>
          </div>
          <ul dusk="footer-menu">
            <li class="mb-[17px]" v-for="link in menu" :key="link.title">
              <a :href="link.url">{{link.title}}</a>
            </li>
          </ul>
        </div>

        <div class="sm:flex-50 lg:flex-34">
          <div>
            <h3 class="text-20 pb-[9px]">Contacts</h3>
            <div class="mb-[27px] border-b-2 border-[#ffffff] w-[100px]"></div>
          </div>
          <div dusk="footer-social" class="mb-[42px]">
            <unicon class="mr-[17px]" name="facebook-f" fill="#ffffff" width="30" height="30" />
            <unicon name="instagram-alt" fill="#ffffff" width="30" height="30" />
          </div>
          <ul>
            <li dusk="footer-contacts-address" class="relative pl-[35px] mb-[20px]">
              <a dusk="footer-contacts-address-link" href="#" @click="openMap">Киев, Михаила Грушевского ул., 5</a>
              <unicon class="absolute left-0 top-0" name="map-marker" fill="#ffffff" width="25" height="25" />
              <teleport to="#modal">
                <app-google-map
                  @close="closeMap"
                  v-if="showMap"
                ></app-google-map>
              </teleport>
            </li>
            <li dusk="footer-contacts-email" class="relative pl-[35px] mb-[20px]">
              <a href="mailto:support@verhovnarada.ua">Support@verhovnarada.ua</a>
              <unicon class="absolute left-0 top-0" name="envelope" fill="#ffffff" width="25" height="25" />
            </li>
            <li dusk="footer-contacts-phone" class="relative pl-[35px] mb-[20px]">
              <a href="tel:+380440000000">+380 (44) 000-00-00</a>
              <unicon class="absolute left-0 top-0" name="phone" fill="#ffffff" width="25" height="25" />
            </li>
            <li dusk="footer-contacts-working-hours" class="relative pl-[35px] mb-[20px]">
              <a>c 9:00 до 21:00</a>
              <unicon class="absolute left-0 top-0" name="clock" fill="#ffffff" width="25" height="25" />
            </li>
          </ul>
        </div>

        <div class="lg:flex-41">
          <div dusk="footer-logo">
            <a href="#" class="text-white font-gochi text-48">Logo</a>
          </div>
          <div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi odit provident adipisci earum quasi, distinctio at rem omnis eos assumenda, culpa nihil neque asperiores, nulla laudantium obcaecati libero ab. Sequi.</p>
          </div>
        </div>
      </div>
      <div class="sm:flex px-[20px] lg:px-0 justify-between font-gilroy-300 pt-[17px] pb-[100px] text-14">
        <div>
          © 2021 All rights reserved
        </div>
        <ul class="sm:flex hidden">
          <li class="mr-[50px]">
            Confidentiality
          </li>
          <li>
            Terms
          </li>
        </ul>
      </div>
    </div>
  </footer>

</template>

<script>
import AppGoogleMap from "./app/AppGoogleMap";
export default {
  name: "Footer",
  data () {
    return {
      menu: [
        {'title': 'About the store', 'url': '/info/about'},
        {'title': 'Shipping and payment', 'url': '/info/shipping'},
        {'title': 'Warranty and returns', 'url': '/info/warranty'},
        {'title': 'Terms of agreement', 'url': '/info/terms'},
        {'title': 'Contacts', 'url': '/info/contacts'},
        {'title': 'Map of site', 'url': '/info/map'},
      ],
      contact: [
        {'title': 'Киев, Михаила Грушевского ул., 5', 'href': ''},
      ],
      showMap: false,
    }
  },
  methods: {
    openMap() {
      this.showMap = true
    },
    closeMap() {
      this.showMap = false
    }
  },
  components: {
    AppGoogleMap
  }
}
</script>

<style scoped>

</style>
