<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="350">

      <div v-if="loading">
         <Loading />
      </div>

      <div v-else>

         <v-card flat tile class="mx-auto px-0 pt-6">
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
            >administrator login</v-card-subtitle>
         </v-card>

         <v-form
            ref="form"
            :disabled="form_disabled"
            lazy-validation
            class="px-10 pt-8 pb-10"
         >
            <v-snackbar
               v-model="unauthenticated"
               color="red"
               :timeout="timeout"                             
               top
               right
            >
            <v-icon left>
               mdi-alert-octagon-outline
            </v-icon>
               You Are Not Authenticated !!

               <template v-slot:action="{ attrs }">
               <v-btn
                  color="white"
                  text
                  v-bind="attrs"
                  @click="unauthenticated = ''"
               >
                  Close
               </v-btn>
               </template>
            </v-snackbar>
            
            <v-snackbar
               v-model="error_snackbar"
               color="red"
               :timeout="timeout"
               top
               right
            >
            <v-icon left>
               mdi-alert-octagon-outline
            </v-icon>
               {{error_message}}

               <template v-slot:action="{ attrs }">
               <v-btn
                  color="white"
                  text
                  v-bind="attrs"
                  @click="error_snackbar = false"
               >
                  Close
               </v-btn>
               </template>
            </v-snackbar>

            <v-text-field
               v-model="email"
               :rules="emailRules"
               :error-messages="errors.email"
               label="E-mail"
               type="email"
               required
               outlined
            ></v-text-field>

            <v-text-field
               v-model="password"
               :rules="passwordRules"
               :error-messages="errors.password"
               label="Password"
               type="password"
               required
               outlined
            ></v-text-field>

            <div class="mt-2">
               <v-btn
                  color="success"
                  :loading="form_loading"
                  :disabled="form_loading"
                  @click.prevent="submitForm"
                  type="submit"
                  class="mx-auto"
               >
               Login</v-btn>

            </div>
         </v-form>

      </div>

      </v-sheet>

   </div>
</template>

<script>
import Loading from "../components/loading";
export default {
   data: () => ({
      unauthenticated: false,
      errors: [],
      error_message: "",
      error_snackbar: false,
      form_disabled: false,
      form_loading: false,
      timeout: 3000,
      email: "",
      emailRules: [
         (v) => !!v || "E-mail is required",
         (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      password: "",
      passwordRules: [
         (v) => !!v || "Password is required",
         (v) =>
            (v && v.length >= 8) || "Password must be more than 8 characters",
      ],
      dummy: "",
      validation: "",
      loading: true,
   }),

   components: {
      Loading
   },

   methods: {
      submitForm() {
         if (this.$refs.form.validate()) {
            this.form_loading = true;
            this.form_disabled = true;
            axios.get("/sanctum/csrf-cookie").then((response) => {
               axios
                  .post("/api/login", {
                     email: this.email,
                     password: this.password,
                  })
                  .then((res) => {
                     this.form_loading = false
                     this.form_disabled = false
                     console.log("Login Post Request Sent Successfully !!")
                     this.$router.push({ path: "/adminpanel/main" })
                  })
                  .catch((error) => {
                     this.form_loading = false
                     this.form_disabled = false
                     this.errors = error.response.data.errors
                     this.error_message = error.response.data.message
                     this.error_snackbar = true
                     console.log("Error Response !!")
                  });
            });
         } else {
            this.$refs.form.validate();
         }
      },
   },
   computed: {
      passwordConfirmationRule() {
         return () =>
            this.password === this.confirmPassword || "Password must match";
      },
   },
   created() {
      axios.get('/api/authenticated')
         .then(()=>{
            this.$router.push('/adminpanel/main')
         })
         .catch(()=>{
            this.loading = false
         })

      if (this.$route.query.message) {
         this.unauthenticated = true;
         this.message = this.$route.query.message;
      }
   },
};
</script>