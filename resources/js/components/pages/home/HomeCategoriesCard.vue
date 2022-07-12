<template>
  <app-block :title="title">
    <template v-slot>
      <swiper
        :slidesPerView="2"
        :spaceBetween="14"
        :slidesPerGroup="1"
        :loop="true"
        :loopFillGroupWithBlank="true"
        grabCursor
        :navigation="navigation"
        :modules="modules"
        :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }"
        class="swiper"
        :style="{
          '--swiper-navigation-size': '0px',
        '--swiper-navigation-color': '#3338E6',
      }"
        :breakpoints="{
          640: {
        slidesPerView: 3
      },
      1024: {
        slidesPerView: 4
      },
        }"
      >

        <swiper-slide v-for="(category, i) in categoryData" :key="i">
          <a :href="'/category/'+ category.slug" class="h-[330px] lg:basis-24 basis-48 mb-5 sm:mb-7  bg-white pb-6 rounded-lg shadow-card hover:shadow-card-active cursor-pointer text-black hover:text-[#405FD4] flex flex-col justify-between  flex-initial"
          >
            <div>
              <img class="mx-auto my-3 w-[150px]" :src="'/'+ 'storage/images/products/' + category.thumbnail" alt="">
            </div>
            <h3 class="text-center font-gilroy-600 text-18 md:text-20 uppercase">{{category.title}}</h3>
          </a>
        </swiper-slide>

        <div class="swiper-button-prev" slot="button-prev">
          <unicon name="angle-left-b" fill="#A5B4D4" width="30" height="30"/>
        </div>
        <div class="swiper-button-next" slot="button-next">
          <unicon name="angle-right-b" fill="#A5B4D4" width="30" height="30"/>
        </div>

      </swiper>

<!--      <a dusk="main-page-categories" :href="'/category/'+ category.slug" class="lg:basis-24 basis-48 mb-5 sm:mb-7  bg-white pb-6 rounded-lg shadow-card hover:shadow-card-active cursor-pointer text-black hover:text-[#405FD4] flex flex-col justify-between  flex-initial"-->
<!--         v-for="(category, i) in categories"-->
<!--         :key="i"-->
<!--      >-->
<!--        <div>-->
<!--          <img class="mx-auto my-3" :src="'/' + '../../../images/category-' + i + '.jpg'" alt="">-->
<!--        </div>-->
<!--        <h3 class="text-center font-gilroy-600 text-24">{{category.title}}</h3>-->
<!--      </a>-->
    </template>
  </app-block>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import "swiper/css/navigation";
import { Pagination, Navigation, Autoplay } from "swiper";
import AppBlock from "../../app/AppBlock";
export default {
  name: "HomeCategoriesCard",
  props: {
    categories: {
      type: Array,
      required: true
    },
    images: {
      type: Array,
      required: true
    },
    title: {
      type: String,
      required: true
    },
  },
  data() {
    return {
      modules: [Pagination, Navigation, Autoplay],
      categoryData: this.categories,
      navigation: {
        prevEl: '.swiper-button-prev',
        nextEl: '.swiper-button-next'
      }
    }
  },
  mounted() {
    for (let i = 0; i < this.categories.length; i++) {
      this.categoryData[i] = {thumbnail: this.images[i].thumbnail, ...this.categoryData[i]}
    }
  },
  components: {
    AppBlock,
    Swiper,
    SwiperSlide,
  },
}
</script>

<style scoped>
.swiper-button-next{
  right: 25px;
  top: 45%;
}
.swiper-button-prev{
  left: 25px;
  top: 45%;
}
</style>