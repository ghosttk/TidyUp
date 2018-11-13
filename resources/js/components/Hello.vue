<template>
  <div class="hello">
  <!-- Dialogs -->
    <AddPlaceDialog @onAddPlace="onAddPlace" @onCloseDialog="onClose('mShowAddPlace')" :mShow="mShowAddPlace"></AddPlaceDialog>
    <AddItemDialog @onAddItem="onAddItem" @onCloseDialog="onClose('mShowAddItem')" :mShow="mShowAddItem"></AddItemDialog>
    <EditPlaceDialog @onEditPlace="onEditPlace" @onCloseDialog="onClose('mShowEditPlace')" :mShow="mShowEditPlace" :placename="curPlaceName"></EditPlaceDialog>
    <EditItemDialog @onEditItem="onEditItem" @onCloseDialog="onClose('mShowEditItem')" :mShow="mShowEditItem" :itemname="curItemName"></EditItemDialog>
  <!-- Buttons -->
    <button class="btn-primary" @click="onShowAddPlace">AddPlace</button>
    <button class="btn-primary" @click="onSave">Save</button>
    <div v-for="(pl, pi) in tdata" class="place"> 
      <button class="btn-primary" @click="onShowEditPlace(pl, pi)" :style="{ backgroundColor: '#'+pClass[pi%4]+'0'+'0'}">Place:{{ pl.place }}</button>
        <div v-for="(item, ii)  in pl.items" > 
        <button class="btn-primary btn-item" @click="onShowEditItem(pi, item, ii)" :style="{ backgroundColor: '#'+pClass[pi]+'0'+pClass[ii], color: '#fff'}"> {{ item }} </button> {{pl.dates[ii]}} <code v-if="pl.unsaved[ii]">unsaved</code>
        <br>
        </div>
      <button class="btn-primary" @click="onShowAddItem(pi)"> AddItem </button>
      <hr>
    </div>
  </div>
</template>

<script>
import AddPlaceDialog from './AddPlaceDialog'
import AddItemDialog from './AddItemDialog'
import EditPlaceDialog from './EditPlaceDialog'
import EditItemDialog from './EditItemDialog'
require('../bootstrap');

export default {
  name: 'hello',
  components: {
    AddPlaceDialog,
    AddItemDialog,
    EditPlaceDialog,
    EditItemDialog
  },
  data () {
    return {
      tdata: '',
      isShowLog: false,
      mShowAddPlace: false,
      mShowAddItem: false,
      curPlaceIndex: 0,
      curPlaceName: '',
      mShowEditPlace: false,
      mShowEditItem: false,
      curItemIndex: 0,
      curItemName: '',
      pClass: ['3', '6', '9', 'c']
    }
  },
  mounted: function () {
   let mydate = new Date()
   this.tdata = [{place: '01', items: ['01'], dates: [mydate.toLocaleString()], unsaved: [true]}]
   this.getToken()
  },
  methods: {
    onEditItem (iname) {
      if (iname === '') return
      let mydate = new Date()
      this.tdata[this.curPlaceIndex].items[this.curItemIndex] = iname
      this.tdata[this.curPlaceIndex].dates[this.curItemIndex] = mydate.toLocaleString()
    },
    onShowEditItem (pi, item, ii) {
      this.curPlaceIndex = pi
      this.curItemIndex = ii
      this.curItemName = item
      this.mShowEditItem = true
    },
    onEditPlace (pname) {
      if (pname === '') return
      this.tdata[this.curPlaceIndex].place = pname
    },
    onShowEditPlace (pl, pi) {
      this.curPlaceName = pl.place
      this.curPlaceIndex = pi
      this.mShowEditPlace = true
    },
    onAddItem: function (iname) {
      if (iname === '') return
      let mydate = new Date()
      this.tdata[this.curPlaceIndex].items.push(iname)
      this.tdata[this.curPlaceIndex].dates.push(mydate.toLocaleString())
      this.tdata[this.curPlaceIndex].unsaved.push(true)
    },
    onShowAddItem: function (pplace) {
      this.curPlaceIndex = pplace
      this.mShowAddItem = true
    },
    onShowAddPlace: function () {
      this.mShowAddPlace = true
    },
    onClose: function (wShow) {
      this[wShow] = false
    },
    onAddPlace: function (pname) {
      if (pname === '') return
      let mydate = new Date()
      this.tdata.push({place: pname, items: [], dates: [mydate.toLocaleString()], unsaved: [true]})
    },
    getToken () {
      axios.get('http://localhost:8000/things')
        .then(res => {
         let thatdata = eval(res.data.jdata)
         this.tdata = [this.tdata, ...thatdata]
         console.log(thatdata)
        })
        .catch(err => {
          console.log(err)
        })
    },
    onSave () {
    //  axios.post('http://localhost:8000/things', {tdata: JSON.stringify(this.tdata)}) 
      //console.log(JSON.stringify(this.tdata))
      axios.post('http://localhost:8000/things', {tdata: this.tdata})
      .then( res => {
        console.log(res)
      })
      .catch( err => {
        console.log(err)
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #35495E;
}
.btn-primary {
    background-color: #008CBA; /* Blue */
    color: white;
    padding: 0.2em 0.5em 0.2em 0.5em;
    display: inline-block;
    font-size: 2em;
    border-radius: 0.3em;
}
.btn-item{
   align: right;
   margin-left: 6em; 
   background-color: #ff8CBA; /* Blue */
}
.place{
    border: solid black;
}
</style>
