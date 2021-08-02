const getDefaultState = () => {
   return{
      publication_tokens: []
   }
}

const state = getDefaultState()

const mutations = {
   PUSH_PUBLICATION_TOKEN( state, token_data ){
      state.publication_tokens.push({
         publication_type_info_id: token_data.publication_type_info_id,
         publication_token: token_data.publication_token
      })
   },
   RESET_STATE(state){
      Object.assign(state, getDefaultState())
   }
};
const actions = {
   create_token( {commit}, token_data ){
      commit('PUSH_PUBLICATION_TOKEN', token_data)
   },
   reset_state( {commit} ){
      commit('RESET_STATE')
   }
};
const getters = {

};

export default{
   namespaced: true,
   state,
   getters,
   actions,
   mutations
}
