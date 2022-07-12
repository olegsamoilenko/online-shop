<template>
  <base-modal
    :modalTitle="modalTitle"
    @close="$emit('close')"
  >
    <template v-slot>
      <form class="px-5 py-2 bg-gray-200 text-gray-700 border-b">
        <div class="mb-3 mt-2">
          <app-input
            title="Product title"
            type="text"
            name="title"
            v-model="product.title"
            placeholder="Enter product title"
            :error="errors.title"
          ></app-input>
          <div v-if="errors.title">
            <span class="text-red-500">{{ errors.title[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <label class="form-label">Description</label>
          <div class="mt-2 relative rounded-md shadow-sm" :class="{'border border-solid border-red-500': errors.description}">
            <editor type="text" v-model="product.description" name="description" rows="3"
                    class="form-input mt-2 w-full px-12 py-2 appearance-none rounded-md focus:border-indigo-600"
                    placeholder="Description..."
                    apiKey="icfdpqgqlpc0igbm8v63wld9beqrmxa2z7iysslnkp52isyl"
                    :init="{
         height: 200,
         menubar: false,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
       }"
            />
          </div>
          <div v-if="errors.description">
            <span class="text-red-500">{{ errors.description[0] }}</span>
          </div>
        </div>


        <div class="mb-2">
          <app-input
            title="Price"
            type="number"
            name="price"
            v-model="product.price"
            placeholder="Enter product price"
            :error="errors.price"
          ></app-input>
          <div v-if="errors.price">
            <span class="text-red-500">{{ errors.price[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <app-input
            title="Old Price"
            type="number"
            name="oldPrice"
            v-model="product.old_price"
            placeholder="Enter product old price"
            :error="errors.old_price"
          ></app-input>
          <div v-if="errors.old_price">
            <span class="text-red-500">{{ errors.old_price[0] }}</span>
          </div>
        </div>


        <div class="mb-2">
          <label class="form-label block">Select a category</label>
          <Multiselect
            v-model="product.category_id"
            :close-on-select="true"
            :options="optionsCategories"
            placeholder="Select a category"
            :class="{'multiselect-border-color': errors.category_id}"
            :clear="false"
            :clearIcon="false"
            :multiselect-clear="false"
            :multiselect-clear-icon="false"
          />
          <div v-if="errors.category_id">
            <span class="text-red-500">{{ errors.category_id[0] }}</span>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label block">Select tags</label>
          <Multiselect
            v-model="productTags"
            mode="tags"
            :close-on-select="true"
            :options="optionsTags"
            placeholder="Select tags"
            :class="{'multiselect-border-color': errors.tags}"
          />
          <div v-if="errors.tags">
            <span class="text-red-500">{{ errors.tags[0] }}</span>
          </div>
        </div>

        <h3 class="mt-[40px]">Product Characteristics:</h3>

        <div class="mb-2 mt-2">
          <app-input
            title="Emotion"
            type="text"
            name="emotion"
            v-model="product.emotion"
            placeholder="Enter product emotion"
            :error="errors.emotion"
          ></app-input>
          <div v-if="errors.emotion">
            <span class="text-red-500">{{ errors.emotion[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <app-input
            title="Volume"
            type="number"
            name="volume"
            v-model="product.volume"
            placeholder="Enter product diameter"
            :error="errors.volume"
          ></app-input>
          <div v-if="errors.volume">
            <span class="text-red-500">{{ errors.volume[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <app-input
            title="Diameter"
            type="number"
            name="diameter"
            v-model="product.diameter"
            placeholder="Enter product diameter"
            :error="errors.diameter"
          ></app-input>
          <div v-if="errors.diameter">
            <span class="text-red-500">{{ errors.diameter[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <app-input
            title="Height"
            type="number"
            name="height"
            v-model="product.height"
            placeholder="Enter product height"
            :error="errors.height"
          ></app-input>
          <div v-if="errors.height">
            <span class="text-red-500">{{ errors.height[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <app-input
            title="Color"
            type="text"
            name="color"
            v-model="product.color"
            placeholder="Enter product color"
            :error="errors.color"
          ></app-input>
          <div v-if="errors.color">
            <span class="text-red-500">{{ errors.color[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <app-input
            title="Material"
            type="text"
            name="material"
            v-model="product.material"
            placeholder="Enter product material"
            :error="errors.material"
          ></app-input>
          <div v-if="errors.material">
            <span class="text-red-500">{{ errors.material[0] }}</span>
          </div>
        </div>

        <div class="mb-5">
          <app-input
            title="Made by"
            type="text"
            name="made_by"
            v-model="product.made_by"
            placeholder="Enter country of manufacture"
            :error="errors.made_by"
          ></app-input>
          <div v-if="errors.made_by">
            <span class="text-red-500">{{ errors.made_by[0] }}</span>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label block">Availability</label>
          <div class="mt-2 relative rounded-md shadow-sm">
            <label class="mr-[20px] form-label"><input type="radio" v-model="product.is_available"
                                                       name="is_available"
                                                       :value="1"
                                                       class="form-input"> Yes</label>
            <label class="form-label"><input type="radio" v-model="product.is_available" name="is_available"
                                             :value="0"
                                             class="form-input"> No</label>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label block">Is Active</label>
          <div class="mt-2 relative rounded-md shadow-sm">
            <label class="mr-[20px] form-label"><input type="radio" v-model="product.is_active"
                                                       name="is_active"
                                                       :value="1"
                                                       class="form-input"> Active</label>
            <label class="form-label"><input type="radio" v-model="product.is_active" name="is_active"
                                             :value="0"
                                             class="form-input"> Not Active</label>
          </div>
        </div>

        <div class="mb-2">
          <label class="form-label block">Add Images</label>
          <div class="mt-2 mb-4 relative rounded-md shadow-sm">
            <input type="file" ref="file" multiple name="thumbnail" id="thumbnail" @change="onFileChange"
                   class="form-input w-full px-12 py-2 appearance-none rounded-md focus:border-indigo-600">
          </div>
          <div class="inline-block mr-2 relative" v-for="image in productImages" :key="image.id">
            <div class="absolute right-[7px] top-0 cursor-pointer" @click="removeImage(image.id)">X</div>
            <img class="w-32 h-32" :src="'/'+ 'storage/' + '/images/products/' + image.thumbnail" alt="">
          </div>
          <div class="inline-block mr-2 relative" v-for="image in loadedImages">
            <div class="absolute right-[7px] top-0 cursor-pointer" @click="removeImage(image.f)">X</div>
            <img class="w-32 h-32" :src="image.f" v-show="showPreview" alt="">
          </div>

          <div v-if="errors.images">
            <span class="text-red-500">{{ errors.images[0] }}</span>
          </div>
        </div>

        <div class="flex justify-between items-center py-3">
          <app-button
            title="Update"
            @action="action"
          ></app-button>
        </div>
      </form>
    </template>
  </base-modal>
</template>

<script>
import AppButton from "../components/app/AppButton";
import BaseModal from "./BaseModal";
import AppInput from "../components/app/AppInput";
import Editor from '@tinymce/tinymce-vue';
import AppSelect from "../components/app/AppSelect";
import Multiselect from '@vueform/multiselect'
import multiselectCss from '@vueform/multiselect/themes/default.css'
import onFileChange from "../mixins/onFileChange";

export default {
  name: "EditProductModal",
  props: {
    modalTitle: {
      type: String,
      required: true,
    },
    errors: {
      type: Object,
      required: false,
    },
    categories: {
      type: Array,
      required: true,
      default: []
    },
    tags: {
      type: Array,
      required: true,
      default: []
    },
    product: {
      type: Object,
      required: true,
    }
  },
  emits: ['close', 'action'],
  data() {
    return {
      productTags: [],
      thumbnail: null,

      loadedImages: [],
      showPreview: false,

      removedImages: [],
      images: this.product.images,

    }
  },
  methods: {
    getProductTags() {
      this.productTags = []
      this.product.tags.forEach(t => {
        this.productTags.push(t.id)
      })
    },
    removeImage(id) {
      if (Number.isInteger(id)) {
        this.removedImages.push(id)
      }
      this.images = this.images.filter(i => i.id !== id)
      this.loadedImages = this.loadedImages.filter(f => f.f !== id)
    },
    action() {
      const formData = new FormData()
      formData.append('id', this.product.id)
      formData.append('title', this.product.title)
      formData.append('short_description', this.product.short_description)
      formData.append('description', this.product.description)
      formData.append('price', this.product.price)
      if (this.product.old_price !== null) {
        formData.append('old_price', this.product.old_price)
      }
      formData.append('category_id', this.product.category_id)
      if (this.product.tags !== null) {
        formData.append('tags', this.productTags)
      }
      if (this.product.emotion !== null) {
        formData.append('emotion', this.product.emotion)
      }
      if (this.product.volume !== null) {
        formData.append('volume', this.product.volume)
      }
      if (this.product.diameter !== null) {
        formData.append('diameter', this.product.diameter)
      }
      if (this.product.height !== null) {
        formData.append('height', this.product.height)
      }
      formData.append('color', this.product.color)
      formData.append('material', this.product.material)
      formData.append('made_by', this.product.made_by)
      formData.append('is_available', this.product.is_available)
      formData.append('is_active', this.product.is_active)

      let img = []
      for (let image of this.loadedImages) {
        img.push(image.file)
      }
      if (this.loadedImages.length === 0 && this.productImages.length === 0) {
        formData.append('images', false);
      } else {
        for (let i = 0; i < this.loadedImages.length; i++) {
          let image = this.loadedImages[i];
          formData.append('images[' + i + ']', image.file);
        }
      }

      formData.append('removedImages', this.removedImages)
      formData.append('_method', 'put')

      this.$emit('action', formData)
    },
  },
  computed: {
    productImages() {
      return Object.values(this.images)
    },
    optionsTags() {
      return this.tags.slice(1)
    },
    optionsCategories() {
      return this.categories.slice(1)
    },
  },
  mounted() {
    this.getProductTags()
  },
  components: {
    AppButton,
    BaseModal,
    AppInput,
    Editor,
    AppSelect,
    Multiselect,
    multiselectCss
  },
  mixins: [onFileChange]
}
</script>

<style scoped>

</style>