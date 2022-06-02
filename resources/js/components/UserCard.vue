use auth;
<template>
  <li
    class="p-4 mb-3 flex justify-between items-start bg-white border border-white shadow rounded-lg cursor-move"
  >
    <div class="flex items-start">
       
    </div>
    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password" type="text" v-model="user" @input="resetZustand">
    </div>
    
  <button  @click="handleChange()" class = "cta-btn" >
      Save
  </button  >

  </li>
</template>
<script>


export default {
  components: {

  },
  data(){
    return{
      C_number: Number,
      C_index: Number,
      changer: Array
    }
  },
  props: {
    user: Number,
    index: Number,
    Seite: String
  },
    methods:{
      resetZustand(){
        this.$store.dispatch('mutateZustand', 1);
      },
    handleChange(){
      this.C_number = parseFloat(this.user)
      this.C_index = parseFloat(this.index)
      this.changer[0] = parseFloat(this.user)
      this.changer[1] = parseFloat(this.index)
      this.Seite==="soll" ? 
      this.$store.dispatch('changeEntrySoll', this.user, this.index) :
      this.$store.dispatch('changeEntryHaben', this.user, this.index) 
    }
    },
    mounted(){
    
    }
  }
;

</script>

