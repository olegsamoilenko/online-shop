export default {
  data() {
    return {
      dateOptions: {
        year: "numeric",
        month: "numeric",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
        timezone: "UTC",
      },
    }
  },
  methods: {
    getDate(date) {
      return new Intl.DateTimeFormat("us-US", this.dateOptions).format(
        new Date(date)
      );
    },
  }
}