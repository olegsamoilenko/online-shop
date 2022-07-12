export default {
  data() {
    return {
      productCharacteristicsData: [
        {label: 'Emotion', value: this.product.emotion},
        {label: 'Volume', value: this.product.volume},
        {label: 'Diameter', value: this.product.diameter},
        {label: 'Height', value: this.product.height},
        {label: 'Color', value: this.product.color},
        {label: 'Material', value: this.product.material},
        {label: 'Made by', value: this.product.made_by},
      ]
    }
  },
}