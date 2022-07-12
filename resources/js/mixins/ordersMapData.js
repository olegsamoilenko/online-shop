export default {
  data() {
    return {
      ordersSortByData: [
        { value: 'no', label: 'No sorting' },
        { value: 'dateAsc', label: 'Date, 1-9' },
        { value: 'dateDesc', label: 'Date, 9-1' },
      ],

      ordersPerPageData: [
        { value: '10', label: 10 },
        { value: '20', label: 20 },
        { value: '50', label: 50 },
      ],

      statusPaymentMap: [
        {value: 'all', label: 'All'},
        {value: 1, label: 'Paid'},
        {value: false, label: 'Not paid'},
      ],
      shippingMap: [
        {value: 'pickupFromTheStore', label: 'Pickup from the store'},
        {value: 'addressDelivery', label: 'Address delivery'},
        {value: 'toYourPostOffice', label: 'To the post office'},
      ],
      paymentMap: [
        {value: 'cash', label: 'Cash'},
        {value: 'card', label: 'Payment by Mastercard/Visa'},
        {value: 'paymentAccount', label: 'Payment to current account'},
      ],
      confirmationMap: [
        {value: 'all', label: 'All'},
        {value: 1, label: 'Confirm'},
        {value: false, label: 'Do not confirm'},
      ],
      statusOrderMap: [
        {value: 'all', label: 'All'},
        {value: 'new', label: 'New'},
        {value: 'confirmed', label: 'Confirmed'},
        {value: 'rejected', label: 'Rejected'},
        {value: 'WaitingPayment', label: 'Waiting for payment'},
        {value: 'transferredDeliveryService', label: 'Transferred to the delivery service'},
        {value: 'completed', label: 'Completed'},
      ],
    }
  },
}