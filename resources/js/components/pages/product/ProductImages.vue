<template>
  <div class="flex basis-2/3 flex-1 items-center justify-center sm:justify-between bg-white lg:mr-[20px] px-[17px] pt-[45px] pb-[40px] sm:px-[37px] sm:py-[70px]  relative">
    <div v-if="tags.length" class="absolute top-[11px] left-[19px]">
      <app-tag-label
        v-for="tag in tags"
        :key="tag.id"
        :tag="tag"
      ></app-tag-label>
    </div>
    <div class="hidden sm:block relative pl-[30px] md:pl-[50px]">
      <img v-if="startImages !== 0" class="rotate-180 absolute top-[-15px] left-[42px] md:left-[62px] cursor-pointer" src="../../../../images/vector.svg" alt="" @click="up">
      <div class="mr-[20px]">

        <img v-if="activeImages.length" class="max-w-[120px] h-[100px] mb-[20px] object-contain" :class="{' border-[#8BAFD4] border-solid shadow-img': img.id === mainImage.id}" v-for="img in activeImages" :key="img.id"
             :src="'/' + 'storage/images/products/' + img.thumbnail" alt="" @click="main(img.id)">
      </div>

      <img v-if="this.startImages < this.images.length - 3" class="absolute bottom-[-15px] left-[42px] md:left-[62px] cursor-pointer" src="../../../../images/vector.svg" alt="" @click="down">
    </div>

    <div class="sm:pr-[80px] md:pr-[110px]">
      <img v-if="mainImage" class="max-w-[410px] w-full h-[140px] sm:h-[340px] mb-[20px] mx-auto object-contain" :src="'/' + 'storage/images/products/' + mainImage.thumbnail"
           alt="">
      <div class="flex justify-center flex-wrap">
        <product-images-pagination
          v-for="img in images"
          :key="img.id"
          :img="img"
          :mainImage="mainImage"
          @activeImages="main"

        ></product-images-pagination>
      </div>
    </div>
  </div>
</template>

<script>
import AppTagLabel from "../../app/AppTagLabel";
import ProductImagesPagination from "./ProductImagesPagination";
export default {
  name: "ProductImages",
  props: {
    images: {
      type: Array,
    },
    tags: {
      type: Array,
    }
  },
  data() {
    return {
      mainImage: this.images[0],
      startImages: 0,
    }
  },
  mounted() {

  },
  methods: {
    main(id) {
      this.mainImage = this.images.find(image => image.id === id)
    },
    up() {
      if (this.startImages !== 0) {
        this.startImages--
      }
    },
    down() {
      if (this.startImages < this.images.length - 3) {
        this.startImages++
      }
    },
  },
  computed: {
    activeImages() {
      return this.images.slice(this.startImages, this.startImages + 3)
    }
  },
  components: {
    AppTagLabel,
    ProductImagesPagination

  },
}
</script>

<style scoped>

</style>