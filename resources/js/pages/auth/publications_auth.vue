<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <div v-if="loading">
         <Loading />
      </div>

      <div class="px-6 pb-2 pt-2 pt-md-2" v-else>
            <v-row>
               <v-card flat tile class="mx-auto mb-2 mt-2">
                  <v-card-title class="text-center text-sm-h3 text-h4 blue--text text--darken-4 text-uppercase">
                     {{ publication_type.publication_type_name }}
                  </v-card-title>
               </v-card>
            </v-row>

            <v-row>
               <div class="mx-auto">
                  <v-card flat>
                     <v-card-title
                        class="text-center text-sm-h5 text-h6 font-weight-medium blue-grey--text text--darken-3"
                     >
                        This Section is Password Protected
                     </v-card-title>
                     <v-card-subtitle
                        class="
                           text-center
                           text-sibtitle-1
                           font-weight-bold
                           blue-grey--text
                           text--darken-3
                           pb-0
                        "
                     >
                        Enter Password to Proceed
                     </v-card-subtitle>

                  </v-card>
               </div>
            </v-row>

            <v-row class="pb-0 mx-1">
               <v-col class="mx-7">
                  <v-snackbar
                     v-model="error_message_snackbar"
                     color="red darken-4"
                     :timeout="timeout"
                     top
                     right
                  >
                  <v-icon left>
                     mdi-alert-octagon
                  </v-icon>
                     {{ error_message }}

                     <template v-slot:action="{ attrs }">
                        <v-btn
                           color="white"
                           text
                           v-bind="attrs"
                           @click="error_message_snackbar = false"
                        >
                           Close
                        </v-btn>
                     </template>
                  </v-snackbar>

                  <v-alert
                     v-if="errors && errors.publication_password"               
                     type="error"
                     dark
                     text
                     dense
                     transition="scale-transition"
                     class="mt-2"
                  >                        
                     {{ errors.publication_password[0] }}
                  </v-alert>

                  <v-alert
                     v-if="token_fail_type === 'notokens'"
                     type="error"
                     dark
                     text
                     dense
                     transition="scale-transition"
                     class="mt-2"
                  >                        
                     Access Denied !! Please Provide Password to Continue !!
                  </v-alert>

                  <v-alert
                     v-if="token_fail_type === 'notokenmatch'"
                     type="error"
                     dark
                     text
                     dense
                     transition="scale-transition"
                     class="mt-2"
                  >                        
                     Access Denied ! Please Refresh Page and Enter Password to Continue !!
                  </v-alert>
               </v-col>
            </v-row>

            <v-row class="pt-0" no-gutters>
               <v-col class="mb-3 px-4 px-sm-10">
                  <v-form ref="contact_us_form" :disabled="form_disabled" lazy-validation>

                     <v-card-subtitle
                        class="
                           text-center
                           text-sm-left
                           text-caption
                           font-weight-bold
                           red--text
                           text--darken-3
                           mb-n2
                           ml-n3
                        "
                     >
                        *Refreshing the page causes login tokens to expire. If your login token expires for any reason, just re-enter password.
                     </v-card-subtitle>
                     <v-text-field
                        v-model="password"
                        @input = "password_alert = false"
                        @keydown.enter.prevent="submitForm"
                        type="password"
                        :rules="passwordRules"
                        label="Password"
                        placeholder="Enter Password"
                        prepend-inner-icon="mdi-lock"
                        required
                        outlined                        
                     ></v-text-field>

                     <v-row class="mt-4 mt-sm-3 mt-md-1 mb-1">
                        <div class="d-flex flex-row mx-auto">
                           <v-btn
                              color="green"
                              x-large                                 
                              @click.prevent="submitForm"                              
                              :loading="form_loading"
                              class="white--text"
                           >
                              Submit
                           </v-btn>
                        </div>
                     </v-row>                                                                   

                  </v-form>
               </v-col>
            </v-row>
      </div>
      </v-sheet>
   </div>
</template>

<script>
import moment from 'moment'
import Loading from "../components/loading";
export default {
   data: () => ({
      moment: moment,
      loading: true,
      timeout: 3000,
      token_fail_type: null,
      publication_type: [],
      errors:[],
      error_message: '',
      error_message_snackbar: false,
      form_disabled: false,
      form_loading: false,
      password: "",
      password_alert: false,
      passwordRules: [
         (v) => !!v || "Password is required",
         (v) => (v && v.length >= 8) || "Password must be more than 8 characters",
      ],
   }),
   components: {
     Loading
   },
   methods: {
         submitForm() {
         if (this.$refs.contact_us_form.validate()) {
            this.form_disabled = true
            this.form_loading = true
            axios.post("/api/publication_token/create_token", {
               publication_type_info_id: this.$route.params.id,
               publication_password: this.password
            })
            .then((res) => {
               this.$store.dispatch('authenticated/create_token', res.data)
               this.$router.push('/publications/' + this.$route.params.id)
               this.form_disabled = false
               this.form_loading = false
            })
            .catch((error) => {
               this.error_message_snackbar = true
               this.errors = error.response.data.errors
               this.error_message = error.response.data.message
               this.form_disabled = false
               this.form_loading = false
               this.password_alert = true
            });
         } else {
            this.$refs.contact_us_form.validate()
         }
      },
      
      reset() {
         this.$refs.contact_us_form.reset()
      },
      
      resetValidation() {
         this.$refs.contact_us_form.resetValidation()
      },
   },
   computed:{

   },
   created(){
      if(this.$route.query.fail)
         this.token_fail_type = this.$route.query.fail

      if( this.$store.state.authenticated.publication_tokens.length > 0 ){
         for (var i = 0; i < this.$store.state.authenticated.publication_tokens.length; i++){
            if (this.$store.state.authenticated.publication_tokens[i].publication_type_info_id == this.$route.params.id){
               axios
                  .post("/api/publication_token/token_exists", this.$store.state.authenticated.publication_tokens[i])
                  .then((res) => {
                     if (res.data === 'token_exists'){
                        this.$router.push('/publications/' + this.$route.params.id)
                     }
                  })
                  .catch((error) => {
                     this.$store.dispatch('authenticated/reset_state')
                     this.token_fail_type = 'notokenmatch'
                  });
            }
         }
      }

      axios
         .get("/api/publication_type_info/show/" + this.$route.params.id)
         .then((res) => {
            this.publication_type = res.data
            this.loading = false
         })
         .catch((error) => {
            this.$router.push({ name: 'ResourceNotFound' })
         });
   },
};
</script>

<style>

</style>