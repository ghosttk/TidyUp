<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> EditPlace </div>
      <div slot="body">
        <input ref="inputPlace" required :placeholder="placename" @keyup.enter="EditPlace" v-model.lazy="placeName" type="text"></input>
      </div>
      <div slot="footer"><button @click="EditPlace">Ok</button> </div>
    </Modal>
</template>
<script>
import Modal from './Modal'
export default {
  props: ['mShow', 'placename'],
  data () {
    return {
      placeName: this.placename
    }
  },
  components: {
    Modal
  },
  methods: {
    onClose: function (wShow) {
      this.$emit('onCloseDialog')
    },
    EditPlace: function () {
      this.$emit('onEditPlace', this.placeName)
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
