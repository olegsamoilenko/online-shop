<template>
  <div>
    <swiper
      grabCursor
      class="swiper"
      :loop="true"
      :modules="modules"
      :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }"
      v-if="windowWidth < 640"
    >

      <swiper-slide>
        <img class="home-image" src="../../../../images/slider-image-01.jpg" alt="">
      </swiper-slide>
      <swiper-slide>
        <img class="home-image" src="../../../../images/slider-image-02.jpg" alt="">
      </swiper-slide>
      <swiper-slide>
        <img class="home-image" src="../../../../images/slider-image-03.jpg" alt="">
      </swiper-slide>
      <!--      <swiper-slide>-->
      <!--        <img class="home-image" src="../../../../images/slider-image-4.jpg" alt="">-->
      <!--      </swiper-slide>-->
    </swiper>

    <swiper
      grabCursor
      class="swiper"
      :loop="true"
      :modules="modules"
      :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }"
      v-else
    >

      <swiper-slide>
        <img class="home-image" src="../../../../images/slider-image-1.jpg" alt="">
      </swiper-slide>
      <swiper-slide>
        <img class="home-image" src="../../../../images/slider-image-2.jpg" alt="">
      </swiper-slide>
      <swiper-slide>
        <img class="home-image" src="../../../../images/slider-image-3.jpg" alt="">
      </swiper-slide>
      <!--      <swiper-slide>-->
      <!--        <img class="home-image" src="../../../../images/slider-image-4.jpg" alt="">-->
      <!--      </swiper-slide>-->
    </swiper>

  </div>

</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';
import 'swiper/css';
import "swiper/css/navigation";
import {Autoplay} from "swiper";
import getWindowWidth from "../../../mixins/getWindowWidth";

export default {
  name: "HomeImage",
  data() {
    return {
      modules: [Autoplay],

    }
  },
  methods: {},
  components: {
    Swiper,
    SwiperSlide,
  },
  mixins: [getWindowWidth]
}
</script>

<style scoped>

</style>