<template>
    <Modal @close="onClose('mShow')" :show='mShow'>
      <div slot="header"> SearchItem</div>
      <div slot="body">
        <a v-for="(p, pi) in compItem" :href="'home#'+p[0]" @click="onClose">home#{{p[0]}}<br>{{p}}</a>
        <br>
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
  computed: {
	compItem: function () {
	  return this.arrItem 
    }
  },
  components: {
    Modal
  },
  methods: {
    onClose: function (wShow) {
      this.$emit('onCloseDialog')
    }
  },
  updated: function () {
	console.log(this.arrItem)
  }
}
</script>
<style>

</style>
