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
            v-model="title"
            placeholder="Enter product title"
            :error="errors.title"
          ></app-input>
          <div v-if="errors.title">
            <span class="text-red-500">{{ errors.title[0] }}</span>
          </div>
        </div>

        <div class="mb-2">
          <label class="form-label">Description</label>
          <div class="mt-2 relative rounded-md shadow-sm"
               :class="{'border border-solid border-red-500': errors.description}">
            <editor type="text" v-model="description" name="description" rows="3"
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
            v-model="price"
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
            v-model="oldPrice"
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
              v-model="productCategory"
              :close-on-select="true"
              :options="categories"
              placeholder="Select a category"
              :class="{'multiselect-border-color': errors.category_id}"
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
              :options="tags"
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
            v-model="emotion"
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
            v-model="volume"
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
            v-model="diameter"
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
            v-model="height"
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
            v-model="color"
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
            v-model="material"
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
            v-model="made_by"
            placeholder="Enter country of manufacture"
            :error="errors.made_by"
          ></app-input>
          <div v-if="errors.made_by">
            <span class="text-red-500">{{ errors.made_by[0] }}</span>
          </div>
        </div>

        <div class="mb-4 mt-[40px]">
          <label class="form-label block">Availability</label>
          <div class="mt-2 relative rounded-md shadow-sm">
            <label class="mr-[20px] form-label"><input type="radio" v-model="isAvailable"
                                                       name="is_available"
                                                       :value="1"
                                                       class="form-input"> Yes</label>
            <label class="form-label"><input type="radio" v-model="isAvailable" name="is_available"
                                             :value="0"
                                             class="form-input"> No</label>
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label block">Is Active</label>
          <div class="mt-2 relative rounded-md shadow-sm">
            <label class="mr-[20px] form-label"><input type="radio" v-model="isActive"
                                                       name="is_active"
                                                       :value="1"
                                                       class="form-input"> Active</label>
            <label class="form-label"><input type="radio" v-model="isActive" name="is_active"
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
            title="Create"
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
  name: "CreateProductModal",
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
    }
  },
  emits: ['close', 'action'],
  data() {
    return {

      title: '',
      shortDescription: '',
      description: '',
      price: '',
      oldPrice: '',
      productCategory: '',
      productTags: [],
      emotion: '',
      volume: '',
      diameter: '',
      height: '',
      color: '',
      material: '',
      made_by: '',
      isAvailable: 1,
      isActive: 1,

      loadedImages: [],
      showPreview: false,

      messageError: {},

    }
  },
  methods: {
    removeImage(image) {
      this.loadedImages = this.loadedImages.filter(f => f.f !== image)
    },

    action() {
      console.log(this.color)
      console.log(this.material)
      const formData = new FormData()
      formData.append('title', this.title)
      formData.append('short_description', this.shortDescription)
      formData.append('description', this.description)
      formData.append('price', this.price)
      formData.append('old_price', this.oldPrice)
      formData.append('category_id', this.productCategory)
      formData.append('tags', this.productTags)
      formData.append('emotion', this.emotion)
      formData.append('volume', this.volume)
      formData.append('diameter', this.diameter)
      formData.append('height', this.height)
      formData.append('color', this.color)
      formData.append('material', this.material)
      formData.append('made_by', this.made_by)
      formData.append('is_available', this.isAvailable)
      formData.append('is_active', this.isActive)
      let img = []
      for (let image of this.loadedImages) {
        img.push(image.file)
      }

      if (!this.loadedImages.length) {
        formData.append('images', false);
      } else {
        for (let i = 0; i < this.loadedImages.length; i++) {
          let image = this.loadedImages[i];
          formData.append('images[' + i + ']', image.file);
        }
      }

      this.$emit('action', formData)
    }
  },

  mounted() {
    this.categories.shift()
    this.tags.shift()
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