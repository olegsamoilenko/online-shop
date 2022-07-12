export default {
  data() {
    return {
      confirmationData: [
        {value: 1, label: 'Confirm'},
        {value: 0, label: 'Do not confirm'},
      ],
      statusPaymentData: [
        {value: 1, label: 'Paid'},
        {value: 0, label: 'Not paid'},
      ],
      shippingData: [
        {value: '', label: 'Chose delivery method'},
        {value: 'pickupFromTheStore', label: 'Pickup from the store'},
        {value: 'addressDelivery', label: 'Address delivery'},
        {value: 'toYourPostOffice', label: 'To the post office'},
      ],
      paymentData: [
        {value: '', label: 'Chose payment method'},
        {value: 'cash', label: 'Cash'},
        {value: 'card', label: 'Payment by Mastercard/Visa'},
        {value: 'paymentAccount', label: 'Payment to current account'},
      ],

      statusOrderData: [
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