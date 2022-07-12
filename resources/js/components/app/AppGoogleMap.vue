<template>
  <div class="modal-backdrop" @click="close"></div>
  <div dusk="google-map-modal" class="modal">
    <div>
      <h3>Мы находимся</h3>
      <p>Киев, Михаила Грушевского ул., 5</p>
    </div>
    <div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2978.059128314131!2d30.534933005847424!3d50.44736281858637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cfad233ecb25%3A0xbe4a6a87072f3a75!2z0JLQtdGA0YXQvtCy0L3QsNGPINCg0LDQtNCwINCj0LrRgNCw0LjQvdGL!5e0!3m2!1sru!2sua!4v1642249808458!5m2!1sru!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <button dusk="google-map-modal-close" @click="$emit('close')">Закрыть</button>
  </div>
</template>

<script>
export default {
  name: "AppGoogleMap",
  emits: ['close'],
  methods: {
    close() {
      this.$emit('close')
    }
  }
}
</script>

<style scoped>

</style>