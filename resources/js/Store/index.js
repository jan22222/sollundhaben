import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const state = {
    zustand : 3,
    error: "",
    data : Object, 
    propertyValues2 : [],
    propertyValues : [],
    changer1 : Array,
    changer2 : Array,
    id : Number
}
const getters ={
    data_soll(state){
        return (state.propertyValues===[]) ? {} : Object.assign({}, state.propertyValues);
    },
    data_haben(state){
            return (state.propertyValues2===[]) ? {} : Object.assign({}, state.propertyValues2);
     },
}
const mutations ={
    updateData(state){
        state.zustand = 2
        let properValues = state.propertyValues.map(key => parseFloat(key))
        let properValues2 = state.propertyValues2.map(key => parseFloat(key))
        console.log(properValues, properValues2);
        let id = parseFloat(state.id); 
        axios.post("/user/update-table", {id : id, soll:  Object.assign({}, properValues), haben:  Object.assign({}, properValues2)})
        .then(function(res) {
            return state.zustand = 3
          })
          .catch(function(data) {
            return state.error = data   
          });
    },
    mutateZustand(state, payload){
        state.zustand = payload;
       },
    mutatePropertyValues(state, payload){
        state.propertyValues = payload;
       },
    mutatePropertyValues2(state, payload){
        state.propertyValues2 = payload;
       },
    changeEntrySoll(state, payload_wert, payload_index){
        state.changer1 = [payload_wert, payload_index]
        state.zustand = 1
    },
    changeEntryHaben(state, payload_wert, payload_index){
        state.changer2 = [payload_wert, payload_index]
        state.zustand = 1
    },
    storeData(state, payload){ 
        state.data = payload;
    }
}


const actions ={
    
    
}

const store = new Vuex.Store({
    state,
    mutations,
    actions,
    getters
})

export default store
