<template>
   <div>
      <!-- name: {{name}} <br>
      email: {{email}} <br>
      message: {{message}} <br>
      {{ errors }} <br> -->
      <div v-if="loading_content">
         <AdminLoading />
      </div>

      <v-sheet v-else class="mt-3 pb-2 px-8">
         <v-row class="mb-4 mx-sm-10">
            <v-col>
               <v-row>
                  <div class="mx-auto">
                     <v-card flat>
                        <v-card-title
                           class="
                              text-h5
                              font-weight-bold
                              blue-grey--text
                              text--darken-3
                           "
                        >
                           Edit Contact Us Info</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="edit_contact_us_info" :disabled="form_disabled" lazy-validation>

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
                        {{ success_message }}

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
                        mdi-cancel
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
                     <!-- End Snackbar For successful Form Submission -->

                      <!-- Name Field -->
                      <v-text-field
                          v-model="name"
                          :rules="name_rules"
                          :error="errors && errors.name"
                          :error-messages="errors.name"
                          label="Name"
                          placeholder="Enter Name Here"
                          prepend-inner-icon="mdi-alpha-n-box"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>
                      <!-- End Name Field -->

                     <!-- Email Field -->
                      <v-text-field
                          v-model="email"
                          :rules="email_rules"
                          :error="errors && errors.email"
                          :error-messages="errors.email"
                          label="Email"
                          placeholder="Enter Email Here"
                          prepend-inner-icon="mdi-at"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>
                      <!-- End Email Field -->

                     <!-- Message Field -->
                      <v-text-field
                          v-model="message"
                          :rules="message_rules"
                          :error="errors && errors.message"
                          :error-messages="errors.message"
                          label="Message"
                          placeholder="Enter Message Here"
                          prepend-inner-icon="mdi-email-newsletter"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>
                      <!-- End Message Field -->

                        <!-- Validate and Submit -->
                        <v-row class="">
                           <div class="d-flex flex-row mx-auto">
                              <v-btn
                                 color="green"
                                 x-large                                 
                                 @click.prevent="submitForm"
                                 :loading="form_loading"
                                 class="white--text mt-3 mt-md-1"
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
                     </v-form>
                  </v-col>
               </v-row>

            </v-col>
         </v-row>
      </v-sheet>
   </div>
</template>

<script>
import AdminLoading from "./admin_components/admin_loading"
export default {
   data: () => ({
      errors:[],
      error_message: '',
      error_snackbar: false,
      form_disabled: false,
      form_loading: false,
      success_message: "",
      success_snackbar: false,
      timeout: 3000,
      loading_content: false,
      name: "",
      name_rules: [
         (v) => !!v || "Name is required",
         (v) => (v && v.length <= 255) || 'Name must be less than 255 characters',
      ],
      email: "",
      email_rules: [
         (v) => !!v || "Email is required",
         (v) => (v && v.length <= 255) || 'Email must be less than 255 characters',
      ],
      message: "",
      message_rules: [
         (v) => !!v || "Message is required",
         (v) => (v && v.length <= 65000) || 'Message must be less than 65000 characters',
      ],
   }),

   components: {
      AdminLoading
   },

   methods: {
      submitForm() {
         console.log("trigger 1")
         if(this.$refs.edit_contact_us_info.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('name', this.name)
            formData.append('email', this.email)
            formData.append('message', this.message)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")
            // console.log(formData);

            axios.post("/api/contact_us/update/" + this.$route.params.id, formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
            })
            .catch((error) => {
               console.log(error)
               this.error_message = error.response.data.message
               this.error_snackbar = true
               this.errors = error.response.data.errors
               this.form_disabled = false
               this.form_loading = false
            });
         } else {
            //false
            this.$refs.edit_contact_us_info.validate()
         }
      },
      // reset() {
      //    this.$refs.edit_contact_us_info.reset()
      // },
      // resetValidation() {
      //    this.$refs.edit_contact_us_info.resetValidation()
      // },
   },
   created(){
      this.loading_content = true
      axios.get("/api/contact_us/show/" + this.$route.params.id)
         .then((res) => {
            // console.log(res.data)
            this.name = res.data.name
            this.email = res.data.email
            this.message = res.data.message

            this.form_disabled = false
            this.form_loading = false
            this.loading_content = false
            // this.$refs.edit_contact_us_info.reset()
         })
         .catch((error) => {
            this.$router.push('/adminpanel/contact_us?nodata=nodatafound')
            // console.log(error)
            // this.error_message = error.response.data.message
            // this.error_snackbar = true
            // this.errors = error.response.data.errors
            // this.form_disabled = false
            // this.form_loading = false
            // this.loading_content = false
         })
  }
};
</script>

<style></style>
