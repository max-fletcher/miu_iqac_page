<template>
   <div>
      <div v-if="unauthenticated"> You Are Not Authenticated !! </div>
      <v-form ref="form" lazy-validation class="px-10 pt-5">
         <v-text-field v-model="email" :rules="emailRules" label="E-mail" type="email" required></v-text-field>
         <span v-if="errors.email">{{ errors.email[0] }}</span>

         <v-text-field
            v-model="password"
            :rules="passwordRules"
            label="Password"
            type="password"
            required
         ></v-text-field>
         <span v-if="errors.password">{{ errors.password[0] }}</span>

         <v-btn color="success" class="mt-4" @click.prevent="submitForm" type="submit">Login</v-btn>

         <v-btn color="success" class="mt-4" @click="validate">Validate</v-btn>

         <v-btn color="warning" class="mt-4" @click="reset">Reset Form</v-btn>

         <v-btn color="info" class="mt-4" @click="resetValidation">Reset Validation</v-btn>
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
      <!-- <div> {{unauthenticated}} </div>
      <div> {{message}} </div> -->
   </div>
</template>

<script>
export default {
   data: () => ({
      unauthenticated: false,
      message: '',
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
      errors: [],
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
         this.validation = this.$refs.form.validate();
         if (this.$refs.form.validate()) {
            axios.get("/sanctum/csrf-cookie").then((response) => {
               // Login...
               axios
                  .post("/api/login", {
                     email: this.email,
                     password: this.password,
                  })
                  .then((res) => {
                     this.dummy = "Login Post Request Sent Successfully !!";
                     // console.log(res);
                     this.$router.push({ name: "AdminPanel" });
                  })
                  .catch((error) => {
                     this.errors = error.response.data.errors;
                     this.dummy = "Request Not Sent !!";
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
      if(this.$route.query.message){
         this.unauthenticated = true
         this.message = this.$route.query.message
      }
   }
};
</script> 