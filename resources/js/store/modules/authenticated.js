const state = {
   publication_tokens: [
            
   ],
};
const mutations = {
   PUSH_PUBLICATION_TOKEN( state, token_data ){
      state.publication_tokens.push({
         publication_type_info_id: token_data.publication_type_info_id,
         publication_token: token_data.publication_token
      })
   }
};
const actions = {
   create_token( {commit}, token_data ){
      commit('PUSH_PUBLICATION_TOKEN', token_data)
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
