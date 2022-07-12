export default {
  data() {
    return {
      windowWidth: window.innerWidth
    }
  },
  methods: {
    updateWidth() {
      this.windowWidth = window.innerWidth;
    }
  },
  created() {
    window.addEventListener('resize', this.updateWidth);
  }

}