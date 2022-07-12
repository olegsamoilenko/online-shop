// import confirmationData from "./editOrdersData";
export default {
  methods: {
    getConfirmationStatus(item) {
      if (item === false || item === 0) {
        return {value: 0, label: 'Do not confirm'}
      } else {
        return  {value: 1, label: 'Confirm'}
      }
      // return this.confirmationData.find(c => c.value === item)
    },
  },
  // mixins: [confirmationData]
}