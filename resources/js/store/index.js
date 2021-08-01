import Vue from "vue"
import Vuex from "vuex"

import authenticated from "./modules/authenticated"

Vue.use(Vuex)

export default new Vuex.Store({
   modules:{
      authenticated
   }
})
