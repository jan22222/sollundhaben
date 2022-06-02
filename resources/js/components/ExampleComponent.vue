<template>
<div class="flex flex-column content-center w-full">
<div class="flex flex-row content-center items-center w-full h-36">
<div>
  <h1 v-if = "getData.title" style="height:140px;">
    Title of the table:  {{getData.title}}
  </h1>
  <h1 v-else class="text-xl" style="height:140px;">
    No title 
  </h1>
</div>
  <div v-if="getError" class="error" style="height:140px;">
   <p>{{ getError }}</p>
  </div>
  <div v-if="getLoading==1" style="height:140px;" >   
  <div class="saver" >Not saved</div>
</div>
  <div v-if="getLoading==2" style="height:140px;" class="flex flex-column content-center ">
      <div class="loader" ></div>
</div>
<div v-if="getLoading==3" >   
  <div class="saver" >Data save</div>
</div>

00
  </div>
    <div
    id="app"
    class="min-h-screen w-screen bg-gray-200 flex flex-row pt-20 justify-center items-start md:items-start md:flex-row"
  >
    <div class="w-full max-w-md text-center px-3">
      <p class="mb-2 text-gray-700 font-semibold font-sans tracking-wide">Soll</p>
     <draggable v-model="propertyValues">
        <UserCard v-for="(element, index) in propertyValues" :user ="element" :index = "index" :key="index" :Seite="'soll'" @click="resetZustand">
            
        </userCard>
      </draggable>
    </div>

    <div class="w-full max-w-md md:ml-6 text-center px-3">
      <p class="mb-2 text-gray-700 font-semibold font-sans tracking-wide">Haben</p>

    <draggable v-model="propertyValues2">
        <UserCard v-for="(element, index) in propertyValues2" :user ="element" :index = "index" :key="index" :Seite="'haben'"  >
            
        </userCard>
    </draggable>

    </div>

  </div>
</div>
</template>

<script>
import Draggable from "vuedraggable";
import UserCard from "./UserCard";

export default {
  name: "App",
  components: {
    Draggable,
    UserCard,
  },
  mounted(){

    this.onMounted()
  },
  props:{
    myData: []
  },
  data() {
    return {
      myDataCopy: Object,
      propertyValues: Array,
      propertyValues2: Array,
      dummyPropertyValues: Array,
      dummyPropertyValues2: Array
    }   
  },
  watch: {
    propertyValues: function(){this.sendPropertyValues()},
    propertyValues2: function(){this.sendPropertyValues()},
    '$store.state.changer1': function(){
      this.resetZustand()
      let value = this.$store.state.changer1[0]
      let index = this.$store.state.changer1[1]
      this.$store.state.propertyValues[index] = value  
      this.$store.dispatch('updateData')
      },
    '$store.state.changer2': function(){
      this.resetZustand()
      let value = this.$store.state.changer1[0]
      let index = this.$store.state.changer1[1]
      this.$store.state.propertyValues2[index] = value  
      this.$store.dispatch('updateData')
      },
  },
  methods: {
    derivePropertyValues(){
      return Object.values( JSON.parse(JSON.parse(this.myDataCopy)["soll"]));
    },
    derivePropertyValues2(){
            return Object.values( JSON.parse(JSON.parse(this.myDataCopy)["haben"]));
    },
    
    onMounted(){
      this.myDataCopy = this.myData
      this.propertyValues =  this.derivePropertyValues()
      this.propertyValues2 =this.derivePropertyValues2()
      this.sendPropertyValues()
      this.$store.state.id = JSON.parse(this.myDataCopy)["id"]
    },
    updateData(){
      this.$store.dispatch('updateData');
    },
    sendPropertyValues(){
        this.$store.dispatch('mutatePropertyValues', this.propertyValues) 
        this.$store.dispatch('mutatePropertyValues2', this.propertyValues2) 
        this.resetZustand()
    },
    resetZustand(){
        this.$store.dispatch('mutateZustand', 1) 
    }
},
  computed: {
    getError(){
      return this.$store.state.error 
    },
    getLoading(){
      return this.$store.state.zustand
    },
    async getData(){
      return await this.$store.state.data
    },
    propertyValuesState(){
      return this.$store.state.propertyValues;
    },
    propertyValues2State(){
      return this.$store.state.propertyValues2;
    }
  }
    
}
</script>


<style>

.draggable-list {
  min-height: 100px;
}
/* Unfortunately @apply cannot be setup in codesandbox, 
but you'd use "@apply border opacity-50 border-blue-500 bg-gray-200" here */
.moving-card {
  opacity: 0.5;
  background: #F7FAFC;
  border: 1px solid #4299e1;
}
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.saver {
  color: rgb(33, 143, 33);
  font-size: 10px;
  width: 120px;
  height: 120px;
  animation: fadeIn linear 2s;
  -webkit-animation: fadeIn linear 2s;
  -moz-animation: fadeIn linear 2s;
  -o-animation: fadeIn linear 2s;
  -ms-animation: fadeIn linear 2s;
}

@keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-moz-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-webkit-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-o-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-ms-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}
</style>
