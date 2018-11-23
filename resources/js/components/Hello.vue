<template>
  <div class="hello">
  <!-- Dialogs -->
    <AddPlaceDialog @onAddPlace="onAddPlace" @onCloseDialog="onClose('mShowAddPlace')" :mShow="mShowAddPlace"></AddPlaceDialog>
    <AddItemDialog @onAddItem="onAddItem" @onCloseDialog="onClose('mShowAddItem')" :mShow="mShowAddItem"></AddItemDialog>
    <EditPlaceDialog @onDeletePlace="onDeletePlace" @onEditPlace="onEditPlace" @onCloseDialog="onClose('mShowEditPlace')" :mShow="mShowEditPlace" :placename="curPlaceName"></EditPlaceDialog>
    <EditItemDialog @onDeleteItem="onDeleteItem" @onEditItem="onEditItem" @onCloseDialog="onClose('mShowEditItem')" :curIPI="curPlaceIndex" :Places="places" :mShow="mShowEditItem" :itemname="curItemName"></EditItemDialog>
    <SearchItemResultDialog @onCloseDialog="onClose('mShowSearchItemResult')" :arrItem="searchResult" :mShow="mShowSearchItemResult"></SearchItemResultDialog>
  <!-- Buttons -->
    <button class="btn-primary" @click="onShowAddPlace">{{$t("lang.add")}}{{$t("lang.place")}}</button>
    <button class="btn-primary" @click="onSave">{{$t('lang.save')}}</button>
    <input type="text" v-model="searchItem" @keyup.enter="onSearchItem">search</input>
    <h3 v-show="connecting">Connecting to server...</h3>
    <div v-for="(pl, pi) in tdata" class="place" :id="pi" href="'#'+pi"> 
      <button class="btn-primary" @click="onShowEditPlace(pl, pi)" :style="{ backgroundColor: '#'+pClass[pi%4]+'0'+'0'}">{{$t('lang.place')}}:{{ pl.place }}</button>
        <div v-for="(item, ii)  in pl.items" > 
        <button class="btn-primary btn-item" @click="onShowEditItem(pi, item, ii)" :style="{ backgroundColor: '#'+pClass[pi%4]+'0'+pClass[ii%4], color: '#fff'}"> {{ item }} </button> {{pl.dates[ii]}} <code v-if="pl.unsaved[ii]">unsaved</code>
        <br>
        </div>
      <button class="btn-primary" @click="onShowAddItem(pi)"> {{$t("lang.add")}}{{$t("lang.item")}}</button>
      <hr>
    </div>
  </div>
</template>

<script>
import AddPlaceDialog from './AddPlaceDialog'
import AddItemDialog from './AddItemDialog'
import EditPlaceDialog from './EditPlaceDialog'
import EditItemDialog from './EditItemDialog'
import SearchItemResultDialog from './SearchItemResultDialog'
require('../bootstrap');

export default {
  name: 'hello',
  components: {
    AddPlaceDialog,
    AddItemDialog,
    EditPlaceDialog,
    EditItemDialog,
    SearchItemResultDialog
  },
  data () {
    return {
      tdata: '',
      searchItem: '',
      isShowLog: false,
      mShowAddPlace: false,
      mShowAddItem: false,
      curPlaceIndex: undefined,
      curPlaceName: '',
      curItemPlaceName: '',
      mShowEditPlace: false,
      mShowEditItem: false,
      mShowSearchItemResult: false,
      curItemIndex: undefined,
      curItemName: '',
      searchResult: [],
      pClass: ['3', '6', '9', 'c'],
      connecting: true
    }
  },
  computed: {
    places() {
      let p = []
      for(let i=0; i<this.tdata.length; i++) {
        p.push(this.tdata[i].place)
      }
      return p
    }
  },
  mounted: function () {
   this.getTdata()
  },
  methods: {
    onSearchItem () {
	  this.searchResult = []
      for (let i=0; i<this.tdata.length; i++){
        for (let j=0; j<this.tdata[i].items.length; j++){
          if (this.tdata[i].items[j].indexOf(this.searchItem) !== -1){
            this.searchResult.push([i, j])
          }
        }
      }
      if(this.searchResult.length !== 0){
      this.mShowSearchItemResult = true
      }
    },
    onEditItem (iname, ipi) {
      let mydate = new Date()
      //user changed item but leave  place unchanged
      if (ipi === this.curPlaceIndex) { 
        let mydate = new Date()
        this.tdata[this.curPlaceIndex].items[this.curItemIndex] = iname
        this.tdata[this.curPlaceIndex].unsaved[this.curItemIndex] = true
        this.tdata[this.curPlaceIndex].dates[this.curItemIndex] = mydate.toLocaleString()
      }
      //user changed place
      else if (ipi !== this.curPlaceIndex) {
        this.tdata[ipi].items.push(iname)
        this.tdata[ipi].unsaved.push(true)
        this.tdata[ipi].dates.push(mydate)
        this.tdata[this.curPlaceIndex].items.splice(this.curItemIndex, 1)
        this.tdata[this.curPlaceIndex].unsaved.splice(this.curItemIndex, 1)
        this.tdata[this.curPlaceIndex].dates.splice(this.curItemIndex, 1)
      }
    },
    onDeletePlace () {
	  this.tdata.splice(this.curPlaceIndex, 1)
    },
    onDeleteItem () {
      this.tdata[this.curPlaceIndex].items.splice(this.curItemIndex,1)
      this.tdata[this.curPlaceIndex].dates.splice(this.curItemIndex,1)
      this.tdata[this.curPlaceIndex].unsaved.splice(this.curItemIndex,1)
      this.curItemIndex = undefined
    },
    onShowEditItem (pi, item, ii) {
      this.curPlaceIndex = pi
      this.curItemIndex = ii
      this.curItemName = item
      this.curItemPlaceName = this.tdata[pi].place
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
      this.tdata.push({place: pname, items: [], dates: [], unsaved: [],  placeDate: mydate.toLocaleString(), PlaceUnsaved: true})
    },
    getTdata() {
      axios.get('http://localhost:8000/things')
        .then(res => {
         this.tdata = eval(res.data.jdata)
         this.connecting = false
        })
        .catch(err => {
          let mydate = new Date()
          this.tdata = [{place: '01', items: ['01'], dates: [mydate.toLocaleString()], unsaved: [true]}]
        })
    },
    onSave () {
    //  axios.post('http://localhost:8000/things', {tdata: JSON.stringify(this.tdata)}) 
        for(let i=0; i<this.tdata.length; i++){
          for(let j=0; j<this.tdata[i].unsaved.length; j++){
            this.tdata[i].unsaved[j] = false;
          }
        }
      axios.post('http://localhost:8000/things', {tdata: this.tdata})
      .then( res => {
         // history.go(0)    
         alert("saved")
		 this.$forceUpdate()
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
    font-size: 1.5em;
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
