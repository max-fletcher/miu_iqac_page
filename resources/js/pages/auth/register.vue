<template>
   <div class="pt-3 pb-1">
      <!-- <div>
         <span>{{ this.dummy }}</span>
         <br />
         <span>{{ this.validation }}</span>
         <br />
         <span>{{ this.name }}</span>
         <br />
         <span>{{ this.email }}</span>
         <br />
         <span>{{ this.password }}</span>
         <br />
         <span>{{ this.password_confirmation }}</span>
         <br />
         <span>{{ this.errors }}</span>
      </div> -->

      <v-form ref="form" :disabled="form_disabled" lazy-validation class="px-10 pt-5">

         <!-- Snackbar For successful Form Submission -->
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
         <!-- End Snackbar For successful Form Submission -->

         <!-- Snackbar For backend validation failure -->
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
         <!-- End Snackbar For Failed Form Submission -->

         <v-text-field
            v-model="name"
            :rules="nameRules"
            :error-messages="errors.name"
            label="Name"
            required
            outlined
         ></v-text-field>
         <!-- <span v-if="errors.name">{{ errors.name[0] }}</span> -->

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

         <!-- <v-btn color="success" class="mt-4" @click="validate">Validate</v-btn>

         <v-btn color="warning" class="mt-4" @click="reset">Reset Form</v-btn>

         <v-btn color="info" class="mt-4" @click="resetValidation"
            >Reset Validation</v-btn
         > -->

      </v-form>
   </div>
</template>

<script>
export default {
   data: () => ({
      errors: [],
      error_message: '',
      //diasble form submission or sending request
      form_loading: false,
      form_disabled: false,
      success_snackbar: false,
      error_snackbar: false,
      // data and validation
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
      // dummy: "",
      // validation: "",
   }),
   methods: {

      // validate() {
      //    this.$refs.form.validate()
      // },
      // reset() {
      //    this.$refs.form.reset()
      //    // this.dummy = "";
      // },
      // resetValidation() {
      //    this.$refs.form.resetValidation()
      //    // this.dummy = "";
      // },
      
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
                  // this.dummy = "Post Request Sent Successfully !!"
                  console.log("Post Request Sent Successfully !!")
                  // this.$router.push({name: 'AdminPanel'})
                  // this.$router.push('/about')
                  // same as this.$router.push({ name: 'About'}) where the name is defined in router.js so its a named
                  // route
               })
               .catch((error) => {
                  this.form_loading = false
                  this.form_disabled = false
                  this.errors = error.response.data.errors
                  this.error_message = error.response.data.message
                  this.error_snackbar = true
                  // this.dummy = "Request Failed !!"
                  console.log("Error Response !!")
               });

            //this.$router.push()
         } else {
            //false
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