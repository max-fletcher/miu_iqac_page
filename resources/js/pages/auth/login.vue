<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <v-form
         ref="form"
         :disabled="form_disabled"
         lazy-validation
         class="px-10 pt-8"
      >
         <!-- Snackbar For Unauthenticated -->
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
         <!-- End Snackbar For Unauthenticated -->
         
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
            v-model="email"
            :rules="emailRules"
            :error-messages="errors.email"
            label="E-mail"
            type="email"
            required
            outlined
         ></v-text-field>
         <!-- <span v-if="errors.email">{{ errors.email[0] }}</span> -->

         <v-text-field
            v-model="password"
            :rules="passwordRules"
            :error-messages="errors.password"
            label="Password"
            type="password"
            required
            outlined
         ></v-text-field>
         <!-- <span v-if="errors.password">{{ errors.password[0] }}</span> -->

         <div class="mt-2">
            <v-btn
               color="success"
               :loading="form_loading"
               :disabled="form_loading"
               @click.prevent="submitForm"
               type="submit"
               >Login</v-btn
            >

            <v-btn color="success" @click="validate">Validate</v-btn>

            <v-btn color="warning" @click="reset">Reset Form</v-btn>

            <v-btn color="info" @click="resetValidation"
               >Reset Validation</v-btn
            >
         </div>
         <br />
         <div>
            <span>{{ this.dummy }}</span>
            <br />
            <span>{{ this.validation }}</span>
            <br />
            <span>{{ this.email }}</span>
            <br />
            <span>{{ this.password }}</span>
            <br />
         </div>
      </v-form>

      </v-sheet>
   </div>
</template>

<script>
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
   }),
   methods: {
      validate() {
         this.$refs.form.validate();
      },
      reset() {
         this.$refs.form.reset();
         this.dummy = "";
      },
      resetValidation() {
         this.$refs.form.resetValidation();
         this.dummy = "";
      },
      submitForm() {
         if (this.$refs.form.validate()) {
            this.form_loading = true;
            this.form_disabled = true;
            axios.get("/sanctum/csrf-cookie").then((response) => {
               // Login...
               axios
                  .post("/api/login", {
                     email: this.email,
                     password: this.password,
                  })
                  .then((res) => {
                     this.form_loading = false
                     this.form_disabled = false
                     console.log("Login Post Request Sent Successfully !!")
                     // console.log(res);
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
            //false
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
      // console.log(this.$route.query.message)
      if (this.$route.query.message) {
         this.unauthenticated = true;
         this.message = this.$route.query.message;
      }
   },
};
</script>