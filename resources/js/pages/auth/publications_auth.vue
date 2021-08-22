<template>
   <div>
      <TopBar />

      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <div v-if="loading">
         <Loading />
      </div>

      <div class="px-6 pb-2 pt-2 pt-md-2" v-else>
         <!-- <v-card flat v-if="publication_type.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h2> 404 Error !</h2>
                     <h1> Publication With This ID Does Not Exist. </h1>
                  </div>
               </v-row>
            </v-container>
         </v-card>
         <div v-else> -->
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
                     Access Denied ! Please Provide Password to Continue !!
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
                     <!-- Password Field -->
                     <!-- {{ errors.publication_password[0] }} -->

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
                        *Refreshing the page causes tokens to expire. If your token expires for any reason, just re-enter password.
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
                     <!-- End Password Field -->

                     <!-- Validate and Submit -->
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
                           <!-- Reset From -->
                           <!-- <v-btn color="error" class="mx-2" @click="reset">
                              Reset Form
                           </v-btn> -->
                           <!-- Reset validation -->
                           <!-- <v-btn color="warning" class="mx-2" @click="resetValidation">
                              Reset Validation
                           </v-btn> -->
                        </div>
                     </v-row>                                                                   
                     <!-- {{password}} <br>
                     {{this.$route.params.id}} <br>
                     {{ this.$store.state.authenticated.publication_tokens }} <br>
                     {{this.$route.params.authfail}} <br> -->

                  </v-form>
               </v-col>
            </v-row>
         <!-- </div> -->
      </div>
      </v-sheet>
   </div>
</template>

<script>
import moment from 'moment'
import TopBar from "../components/topbar";
import Loading from "../components/loading";
export default {
   data: () => ({
      moment: moment,
      loading: true,
      timeout: 3000,
      // loading2: true,
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
     Loading, TopBar
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
               // console.log(res.data)
               // use an action to commit data to a state in vuex store (authenticated.js)
               this.$store.dispatch('authenticated/create_token', res.data)
               // Redirect to publications page
               this.$router.push('/publications/' + this.$route.params.id)
               // this.$router.push({ name: 'Publications', params: { id: this.$route.params.id } })
               // Might not be needed
               this.form_disabled = false
               this.form_loading = false
               // this.$refs.contact_us_form.reset()
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
            //false
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
      // if "fail" query string existse i.e via redirect after failing to find token so message can be displayed\
      if(this.$route.query.fail)
         this.token_fail_type = this.$route.query.fail

      // Check if token exists in vuex store. If not, redirect to publication_auth
      if( this.$store.state.authenticated.publication_tokens.length > 0 ){
         // Find token by publication_type_info_id using looping
         for (var i = 0; i < this.$store.state.authenticated.publication_tokens.length; i++){
            // look for the entry with a matching `id` value
            if (this.$store.state.authenticated.publication_tokens[i].publication_type_info_id == this.$route.params.id){
               // check if token matches in DB
               axios
                  .post("/api/publication_token/token_exists", this.$store.state.authenticated.publication_tokens[i])
                  .then((res) => {
                     if (res.data === 'token_exists'){
                        this.$router.push('/publications/' + this.$route.params.id)
                     }
                  })
                  .catch((error) => {
                     // console.log(error)
                     this.$store.dispatch('authenticated/reset_state')
                     this.token_fail_type = 'notokenmatch'
                     // this.loading2 = false
                  });
            }
         }         
         // this.loading2 = false
      }

      axios
         .get("/api/publication_type_info/show/" + this.$route.params.id)
         .then((res) => {
            // console.log(res)
            this.publication_type = res.data
            this.loading = false
         })
         .catch((error) => {
            // console.log(error)
            // this.errors = error.response.data.errors
            // this.loading = false
            this.$router.push({ name: 'ResourceNotFound' })
         });
   },
};
</script>

<style>

</style>