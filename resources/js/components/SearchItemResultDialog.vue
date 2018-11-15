<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> SearchItem</div>
      <div slot="body">
        <a v-for="p in locItem" :href="p[0]">{{p[0]}}</a>
      </div>
      <div slot="footer"><button class="btn-primary" @click="onClose"> Ok </button> </div>
    </Modal>
</template>
<script>
import Modal from './Modal'
export default {
  props: ['mShow', 'arrItem'],
  data () {
    return {
      locItem: this.arrItem
    }
  },
  components: {
    Modal
  },
  methods: {
    onClose: function (wShow) {
      this.$emit('onCloseDialog')
    },
    DeleteItem () {
      this.$emit('onDeleteItem')
      this.onClose()
    }
  },
  updated: function () {
  }
}
</script>
<style>

</style>
