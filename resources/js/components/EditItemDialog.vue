<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> EditItem </div>
      <div slot="body">
        <select v-model="sel">
          <option disabled value="">Please Select</option>
          <option v-for="(p, pi) in Places" :value="p" :key="pi">{{p}}</option>
        </select>
        <input ref="inputItem" required :placeholder="itemname" @keyup.enter="EditItem" v-model="itemName" type="text"></input>
        <button @click="DeleteItem">DeleteItem</button>
      </div>
      <div slot="footer"><button class="btn-primary" @click="EditItem"> Ok </button> </div>
    </Modal>
</template>
<script>
import Modal from './Modal'
export default {
  props: ['mShow', 'itemname', 'Places', 'curIPN'],
  data () {
    return {
      itemName: this.itemname,
    }
  },
  computed: {
    sel() {
      return this.curIPN
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
