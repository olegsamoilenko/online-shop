export default {
  data() {
    return {
      productsSortByData: [
        { value: 'No', label: 'No sorting' },
        { value: 'titleAsc', label: 'Title, A-Z' },
        { value: 'titleDesc', label: 'Title, Z-A' },
        { value: 'priceAsc', label: 'Price, 1-9' },
        { value: 'priceDesc', label: 'Price, 9-1' },
      ],

      productsAvailabilityData: [
        {value: 'all', label: 'All'},
        {value: 1, label: 'Yes'},
        {value: false, label: 'No'},
      ],

      productsPerPageData: [
        { value: '10', label: 10 },
        { value: '20', label: 20 },
        { value: '50', label: 50 },
      ],

      productsStatusData: [
        {value: 'all', label: 'All'},
        {value: 1, label: 'Active'},
        {value: false, label: 'Not active'},
      ],
    }
  }
}