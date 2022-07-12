export default {
  methods: {
    getCurrency(currency) {
      return new Intl.NumberFormat('ua-UA', {
        style: 'currency',
        currency: 'uah',
        currencyDisplay: 'symbol'
      }).format(currency)
    },
  }
}

