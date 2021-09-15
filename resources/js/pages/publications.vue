<template>
<div>
   <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

   <div v-if="loading">
      <loading />
   </div>
   <div v-else>
      <v-card flat v-if="publications.publications.length === 0" height="480" min-height="300">
         <v-container fill-height fluid>
            <v-row align="center" justify="center">
               <div class="text-center">
                  <h1>No Publications For This Publication Type Has Been Added Yet</h1>
                  <h2>Add Publications For This Publication Type From The Admin Panel</h2>
               </div>
            </v-row>
         </v-container>
      </v-card>
      <div v-else class="mx-6 mx-md-8">
         <v-row class="mx-2 mt-2" no-gutters>
            <v-col cols="12">
               <v-card flat tile class="mx-auto px-0">
                  <v-card-subtitle
                     class="
                        text-center text-h3
                        blue--text
                        text--darken-4
                        py-0                           
                        mb-2
                        pl-lg-4
                        text-uppercase
                     "
                  >{{ publications.publication_type_name }}</v-card-subtitle>
               </v-card>
            </v-col>
         </v-row>
         <v-row class="mx-2">
            <v-col cols="12">
               <v-card v-for="(single_publication, index) in publications.publications" :key="index" :href="'/storage/publication_files/' + single_publication.publication_file" rounded="0" class="mb-4">
               <v-alert color="deep-purple accent-3" class="px-0 py-0 mx-0 my-0" rounded="0" text>
                  <v-card-title class="py-2 text-h6 font-weight-medium">
                     <v-icon left color="deep-purple accent-3" large>
                        mdi-file-pdf-box
                     </v-icon>
                     {{ single_publication.publication_name }}
                  </v-card-title>
               </v-alert>
               </v-card>
            </v-col>
         </v-row>
      </div>
   </div>
   </v-sheet>
</div>
</template>

<script>
import moment from 'moment'
import Loading from "./components/loading";
export default {
   data: () => ({
      publications:null,
      moment: moment,
      loading: true,
   }),
   components: {
     Loading
   },
   computed: {
      cardBorderColor: function(){
         return {border: '1px solid #4270a9'}
      }
   },
   created() {
      if( this.$store.state.authenticated.publication_tokens.length > 0 ){
         // Find token by publication_type_info_id using looping
         for (var i = 0; i < this.$store.state.authenticated.publication_tokens.length; i++){
            // look for the entry with a matching `code` value
            if (this.$store.state.authenticated.publication_tokens[i].publication_type_info_id == this.$route.params.id){
               axios
                  .post("/api/publication_token/token_exists", this.$store.state.authenticated.publication_tokens[i])
                  .then((res) => {
                     // console.log(res)
                     if (res.data !== 'token_exists'){
                        console.log('Das Boot !!')
                        this.$store.dispatch('authenticated/reset_state')
                        this.$router.push('/publications_auth/' + this.$route.params.id + '?fail=notokenmatch')
                     }                        
                  }).
                  catch((error) => {
                     this.$store.dispatch('authenticated/reset_state')
                     this.$router.push('/publications_auth/' + this.$route.params.id + '?fail=notokenmatch')
                  })
            }
         }
      }
      else{
         this.$router.push('/publications_auth/' + this.$route.params.id + '?fail=notokens')
      }

      axios
         .get("/api/publication_type_info/show_with_publications/" + this.$route.params.id)
         .then((res) => {
            // console.log(res)
            this.publications = res.data;
            this.loading = false;
         })
         .catch((error) => {
            // console.log(error);
            // this.errors = error.response.data.errors
            // this.loading = false;
            this.$router.push({ name: 'ResourceNotFound' })
         });
   },
};
</script>

<style>
</style>