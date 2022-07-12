export default {
  methods: {
    userHasRole(role) {
      return this.user.roles.find(r => r.slug === role)
    }
  }
}