<template>
<div>
   <v-sheet class="mx-4 mb-3 mt-5 mt-md-3 pb-7" min-height="350">

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
            >administrator registration</v-card-subtitle>
         </v-card>

            <v-form ref="form" :disabled="form_disabled" lazy-validation class="px-10 pt-5">

               <v-snackbar
                  v-model="success_snackbar"
                  color="green"                        
                  :timeout="timeout"
                  top
                  right
               >
               <v-icon left>
                  mdi-check-circle
               </v-icon>
                  Registration Successful !!
                  <template v-slot:action="{ attrs }">
                  <v-btn
                     color="white"
                     text
                     v-bind="attrs"
                     @click="success_snackbar = false"
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
                  v-model="name"
                  :rules="nameRules"
                  :error-messages="errors.name"
                  label="Name"
                  required
                  outlined
               ></v-text-field>

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

               <v-text-field
                  v-model="password_confirmation"
                  :rules="[confirmPasswordRules, passwordConfirmationRule]"
                  label="Confirm Password"
                  type="password"
                  required
                  outlined
               ></v-text-field>
               
               <v-btn
                  color="green"
                  class="mt-4 white--text"
                  @click.prevent="submitForm"
                  type="submit"
                  :loading="form_loading"
                  :disabled="form_loading"
                  >Register</v-btn
               >
            </v-form>

      </div>
   </v-sheet>
</div>
</template>

<script>
import Loading from "../components/loading";
export default {
   data: () => ({
      errors: [],
      error_message: '',
      form_loading: false,
      form_disabled: false,
      success_snackbar: false,
      error_snackbar: false,
      name: "",
      nameRules: [
         (v) => !!v || "Name is required",
         (v) => (v && v.length >= 3) || "Name must be more than 3 characters",
         (v) => (v && v.length <= 255) || "Name must not be more than 255 characters",
      ],
      email: "",
      emailRules: [
         (v) => !!v || "E-mail is required",
         (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
         (v) => (v && v.length <= 255) || "Email must not be more than 255 characters",
      ],
      password: "",
      passwordRules: [
         (v) => !!v || "Password is required",
         (v) =>
            (v && v.length >= 8) || "Password must be more than 8 characters",
            (v) => (v && v.length <= 255) || "Password must not be more than 255 characters",
      ],
      password_confirmation: "",
      confirmPasswordRules: [
         (v) => !!v || "Password Confirmation is required",
         (v) => (!!v && password === v) || "Passwords do not match",
         (v) => (v && v.length <= 255) || "Confirmation Password must not be more than 255 characters",
      ],
   }),

   components: {
      Loading
   },

   methods: {
      submitForm() {
         if (this.$refs.form.validate()) {
            this.form_loading = true
            this.form_disabled = true
            axios
               .post("/api/register", {
                  name: this.name,
                  email: this.email,
                  password: this.password,
                  password_confirmation: this.password_confirmation,
               })
               .then(() => {
                  this.success_snackbar = true
                  this.form_loading = false
                  this.form_disabled = false
                  this.$refs.form.reset()
                  console.log("Post Request Sent Successfully !!")
               })
               .catch((error) => {
                  this.form_loading = false
                  this.form_disabled = false
                  this.errors = error.response.data.errors
                  this.error_message = error.response.data.message
                  this.error_snackbar = true
                  console.log("Error Response !!")
               });

         } else {
            this.$refs.form.validate();
         }
      },
   },
   computed: {
      passwordConfirmationRule() {
         return () =>
            this.password == this.password_confirmation || "Confirmation Password must match Password";
      },
   },
};
</script>