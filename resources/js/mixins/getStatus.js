import statusOrderMap from "./ordersMapData";
export default {
  methods: {
    getStatus(item) {
      return this.statusOrderMap.find(s => s.value === item).label
    },
  },
  mixins: [statusOrderMap]
}