<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> EditItem </div>
      <div slot="body">
        <input ref="inputItem" required :placeholder="itemname" @keyup.enter="EditItem" v-model="itemName" type="text"></input>
        <button @click="DeleteItem">DeleteItem</button>
      </div>
      <div slot="footer"><button class="btn-primary" @click="EditItem"> Ok </button> </div>
    </Modal>
</template>
<script>
import Modal from './Modal'
export default {
  props: ['mShow', 'itemname'],
  data () {
    return {
      itemName: this.itemname
    }
  },
  components: {
    Modal
  },
  methods: {
    onClose: function (wShow) {
      this.$emit('onCloseDialog')
    },
    EditItem: function () {
      this.$emit('onEditItem', this.itemName)
      this.itemName = ''
      this.onClose()
    },
    DeleteItem () {
      this.$emit('onDeleteItem')
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
