export default {
  data() {
    return {
      usersSortByData: [
        { value: 'createdAt', label: 'Registration date' },
        { value: 'nameAsc', label: 'Name, A-Z' },
        { value: 'nameDesc', label: 'Name, Z-A' },
      ],

      usersPerPageData: [
        { value: 10, label: 10 },
        { value: 20, label: 20 },
        { value: 50, label: 50 },
      ],

      usersRoleData: [
        { value: 0, label: 'All' },
        { value: 'user', label: 'User' },
        { value: 'admin', label: 'Admin' },
        { value: 'manager', label: 'Manager' },

      ],
    }
  }
}