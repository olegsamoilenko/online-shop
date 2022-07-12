export default {
  methods: {
    onFileChange(e) {
      let files = Array.from(e.target.files);
      if (!files) {
        return;
      }
      let reader = new FileReader()

      files.forEach(f => {
        reader.onload = e => {
          this.showPreview = true;
          this.loadedImages.push({f: e.target.result, file: f})
        };

        reader.readAsDataURL(f)
      })
    },
  }
}