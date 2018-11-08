<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> AddItem </div>
      <div slot="body">
        <input ref="inputItem" itemholder="item name" @keyup.enter="AddItem" v-model="itemName" type="text"></input>
      </div>
      <div slot="footer"><button @click="AddItem">Ok</button> </div>
    </Modal>
</template>
<script>
import Modal from './Modal'
export default {
  props: ['mShow'],
  data () {
    return {
      itemName: ''
    }
  },
  components: {
    Modal
  },
  methods: {
    onClose: function (wShow) {
      this.$emit('onCloseDialog')
    },
    AddItem: function () {
      this.$emit('onAddItem', this.itemName)
      this.itemName = ''
      this.onClose()
    }
  },
  updated: function () {
    this.$refs.inputItem.focus()
  }
}
</script>
<style>

</style>
