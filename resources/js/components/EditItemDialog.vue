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
  props: ['mShow', 'itemname', 'Places', 'curIPI'],
  data () {
    return {
      itemName: '',
      locIPN: this.sel,
    }
  },
  computed: {
    sel: {
      get: function () {
        return this.Places[this.curIPI]
      },
      set: function (newVal) {
        this.locIPN = newVal
        return newVal
      }
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
      for(let i=0; i<this.Places.length; i++){
        if(this.Places[i] === this.locIPN){
          this.locIPI = i
          break
        }
        else if(this.locIPN=== undefined){
          this.locIPI = this.curIPI
          break
        }
      }
      this.itemName = this.itemName?this.itemName:this.itemname
      this.$emit('onEditItem', this.itemName, this.locIPI)
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
