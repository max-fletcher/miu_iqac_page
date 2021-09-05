<template>
   <div>
      <v-sheet class="mt-3 pb-2 px-8">
         <!-- people section event_type: {{event_type}} <br>
         {{ errors }} <br> -->
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
                           Create New Event Type</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="store_event_types" :disabled="form_disabled" lazy-validation>

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

                     <!-- Event Type Name Field -->
                        <v-text-field
                           v-model="event_type"
                           :rules="event_type_rules"
                           :error="errors && errors.event_type"
                           :error-messages="errors.event_type"
                           label="Event Type"
                           placeholder="Enter Event Type Here"
                           prepend-inner-icon="mdi-format-title"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>
                        <!-- End Event Type Name Field -->

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
      event_type: "",
      event_type_rules: [
         (v) => !!v || "Event type is required",
         (v) => (v && v.length <= 255) || 'Event type must be less than 255 characters',
      ],
   }),

   methods: {
      submitForm() {
         console.log("trigger 1")
         if(this.$refs.store_event_types.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('event_type', this.event_type)

            console.log("trigger 3")
            // console.log(formData);

            axios.post("/api/events/types/store", formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.store_event_types.reset()
            })
            .catch((error) => {
               // console.log(error)
               this.error_message = error.response.data.message
               this.error_snackbar = true
               this.errors = error.response.data.errors
               this.form_disabled = false
               this.form_loading = false
            });
         } else {
            //false
            this.$refs.store_event_types.validate()
         }
      },
      // reset() {
      //    this.$refs.store_event_types.reset()
      // },
      // resetValidation() {
      //    this.$refs.store_event_types.resetValidation()
      // },
   },
};
</script>

<style></style>
