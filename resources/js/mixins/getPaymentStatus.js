// import statusPaymentData from "./editOrdersData";
export default {
  methods: {
    getPaymentStatus(item) {
      if (item === false || item === 0) {
        return {value: false, label: 'Not paid'}
     } else {
        return {value: 1, label: 'Paid'}
      }
        // return this.statusPaymentData.find(s => s.value === item)
    },
  },
  // mixins: [statusPaymentData]
}