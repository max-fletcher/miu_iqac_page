<template>
   <div>
      <v-sheet class="mt-6 pt-6 pb-2 px-8">
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
                           <v-icon large left color="blue-grey darken-3"
                              >mdi-phone
                           </v-icon>
                           Contact Us
                        </v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="contact_us_form" :disabled="form_disabled" lazy-validation>

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
                        Message Sent Successfully !!

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

                     <!-- Name Field With Alert -->

                        <v-text-field
                           v-model="name"
                           @input = "name_alert = false"
                           :rules="nameRules"
                           label="Name"
                           placeholder="Enter Name Here"
                           prepend-inner-icon="mdi-account-details"
                           required
                           outlined
                        ></v-text-field>
                        
                        <v-alert
                           v-if="errors && errors.name"
                           :value="name_alert"
                           type="error"
                           dark
                           text
                           dense
                           transition="scale-transition"
                           class="mt-n5"
                        >                        
                           {{ errors.name[0] }}
                        </v-alert>
                        <!-- End Name Field With Alert -->

                        <!-- Email Field With Alert -->
                        <v-text-field
                           v-model="email"
                           @input = "email_alert= false"
                           :rules="emailRules"
                           label="E-mail"
                           type="email"
                           placeholder="Enter Email Here"
                           prepend-inner-icon="mdi-email"
                           required
                           outlined
                        ></v-text-field>

                        <v-alert
                           v-if="errors && errors.name"
                           :value="name_alert"
                           type="error"
                           dark
                           text
                           dense
                           transition="scale-transition"
                           class="mt-n5"
                        >                        
                           {{ errors.name[0] }}
                        </v-alert>
                        <!-- End Email Field With Alert -->

                        <!-- Message Field With Alert -->
                        <v-textarea
                           v-model="message"
                           input = "message_alert = false"
                           :rules="messageRules"
                           label="Message"
                           placeholder="Enter Message Here"
                           prepend-inner-icon="mdi-comment"
                           rows="1"
                           auto-grow
                           outlined                           
                        ></v-textarea>

                        <v-alert
                           v-if="errors && errors.name"
                           :value="name_alert"
                           type="error"
                           dark
                           text
                           dense
                           transition="scale-transition"
                           class="mt-n5"
                        >                        
                           {{ errors.name[0] }}
                        </v-alert>
                        <!-- End Message Field With Alert -->

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
               <v-row>                  
                  <v-col cols="12" sm="12" md="4" lg="4" class="mt-n2 mt-sm-n2 mt-md-0">
                     <v-card flat width="300" class="mx-auto mx-md-0">
                        <v-card-title
                           class="
                              text-body-h6
                              font-weight-bold
                              blue-grey--text
                              text--darken-3
                           "
                        >
                           Gulshan Campus
                        </v-card-title>
                        <v-card-text
                           class="
                              text-body-1
                              font-weight-bold
                              blue-grey--text
                              text--darken-3
                           "
                        >
                           Plot # CEN-16, Road # 106 <br />
                           Gulshan 2, Dhaka-1212 <br />
                           Bangladesh <br />
                           Phone: +88-02-55060025, <br />
                           9862251, 58817525 <br />
                           Mobile: 01780364414 <br />
                           Fax: +88-02-55059924 <br />
                        </v-card-text>
                     </v-card>
                  </v-col>                  

                  <!-- Map Component -->
                  <v-col cols="12" sm="12" md="8" lg="8" class="mt-md-4 mt-n4">
                     <div
                        class="
                           text-body-1
                           font-weight-bold
                           blue-grey--text
                           text--darken-3
                           text-center
                           text-md-left
                        "
                     >
                        Gulshan Campus Location
                     </div>
                     <div class="pt-3">
                        <iframe
                           src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14603.046330302512!2d90.4146433!3d23.7915029!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x121a03a4382f1df4!2sManarat+International+University!5e0!3m2!1sen!2sbd!4v1545627074631"
                           width="100%"
                           height="400"
                           style="border: 0"
                           allowfullscreen=""
                           loading="eager"
                        ></iframe>
                     </div>
                  </v-col>
               </v-row>
               <v-row>
                  <v-col cols="12" sm="12" md="4" lg="4" class="mt-n8 mt-md-0">
                     <v-card flat width="300" class="mx-auto mx-md-0">
                        <v-card-title
                           class="
                              text-body-h6
                              font-weight-bold
                              blue-grey--text
                              text--darken-3
                           "
                        >
                           Ashulia Permanent <br />
                           Campus
                        </v-card-title>
                        <v-card-text
                           class="
                              text-body-1
                              font-weight-bold
                              blue-grey--text
                              text--darken-3
                           "
                        >
                           Ashulia Model Town, <br />
                           Khagan, Ashulia <br />
                           Dhaka <br />
                           Phone: 09666911624, <br />
                           09666911625, 09666911626, <br />
                           09666911627 <br />
                           Mobile: 01819245895, <br />
                           01780364415
                        </v-card-text>
                     </v-card>
                  </v-col>

                  <!-- Map Component -->
                  <v-col cols="12" sm="12" md="8" lg="8" class="mt-md-4 mt-n4">
                     <div
                        class="
                           text-body-1
                           font-weight-bold
                           blue-grey--text
                           text--darken-3
                        "
                     >
                        Ashulia Permanent Campus Location
                     </div>
                     <div class="pt-3">
                        <iframe
                           src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29186.769300654392!2d90.30785646504465!3d23.87734075018992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c213b785c80f%3A0x160471c997db5233!2sManarat%20International%20University!5e0!3m2!1sen!2sbd!4v1626133954937!5m2!1sen!2sbd"
                           width="100%"
                           height="400"
                           style="border: 0"
                           allowfullscreen=""
                           loading="eager"
                        ></iframe>
                     </div>
                  </v-col>
               </v-row>
            </v-col>
         </v-row>
      </v-sheet>
   </div>
</template>

<script>
export default {
   data: () => ({      
      errors:[],
      error_message: '',
      form_disabled: false,
      form_loading: false,
      success_snackbar: false,
      timeout: 3000,
      name: "",
      name_alert: false,
      nameRules: [(v) => !!v || "Name is required"],
      email: "",
      email_alert: false,
      emailRules: [
         (v) => !!v || "E-mail is required",
         (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      message: "",
      message_alert: false,
      messageRules: [(v) => !!v || "A message is required"],
   }),

   methods: {
      submitForm() {
         // this.validation = this.$refs.contact_us_form.validate()
         if (this.$refs.contact_us_form.validate()) {
            this.form_disabled = true
            this.form_loading = true
            axios.post("/api/contact_us/store", {
               name: this.name,
               email: this.email,
               message: this.message
            })
            .then((res) => {
               // console.log(res)
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.contact_us_form.reset()
            })
            .catch((error) => {
               // console.log(error)
               this.errors = error.response.data.errors
               this.error_message = error.response.data.message               
               this.form_disabled = false
               this.form_loading = false
               this.name_alert = true
               this.email_alert = true
               this.message_alert = true
            });            
         } else {
            //false
            this.$refs.contact_us_form.validate()
         }         
      },
      // reset() {
      //    this.$refs.contact_us_form.reset()
      // },
      // resetValidation() {
      //    this.$refs.contact_us_form.resetValidation()
      // },
   },
};
</script>

<style></style>
