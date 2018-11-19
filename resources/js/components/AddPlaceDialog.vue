<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> AddPlace </div>
      <div slot="body">
        <input ref="inputPlace" placeholder="place name" @keyup.enter="AddPlace" v-model="placeName" type="text"></input>
      </div>
      <div slot="footer"><button class="btn-primary" @click="AddPlace">Ok</button> </div>
    </Modal>
</template>
<script>
import Modal from './Modal'
export default {
  props: ['mShow'],
  data () {
    return {
      placeName: ''
    }
  },
  components: {
    Modal
  },
  methods: {
    onClose: function (wShow) {
      this.$emit('onCloseDialog')
    },
    AddPlace: function () {
      this.$emit('onAddPlace', this.placeName)
      this.placeName = ''
      this.onClose()
    }
  },
  updated: function () {
    this.$refs.inputPlace.focus()
  }
}
</script>
<style>

</style>
