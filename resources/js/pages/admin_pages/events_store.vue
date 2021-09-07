<template>
   <div>
      <!-- event_name: {{ event_name }} <br>
      event_description: {{ event_description }} <br>
      event_date: {{ event_date }} <br>
      Date Final {{ moment(this.event_date, "YYYY-MM-DD").format("YYYY-MM-DD h:mm:ss") }} <br>
      From Postman {{ moment().add(10, 'days').format(("YYYY-MM-DD h:mm:ss")) }}
      {{ error_message }} <br>
      {{ errors }} <br> <br>
      {{ event_type }} -->

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
                          Create New Event - ({{ event_type.event_type }})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="store_event_data" :disabled="form_disabled" lazy-validation>

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
                        <!-- Content Saved Successfully !! -->
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

                        <!-- Event Name Field -->
                        <v-text-field
                           v-model="event_name"
                           :rules="event_name_rules"
                           :error="errors && errors.event_name"
                           :error-messages="errors.event_name"
                           label="Event Name"
                           placeholder="Enter Event Name Here"
                           prepend-inner-icon="mdi-calendar-week"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>
                        <!-- End Event Name Field -->

                        <!-- Event Description Field -->
                        <v-text-field
                           v-model="event_description"
                           :rules="event_description_rules"
                           :error="errors && errors.event_description"
                           :error-messages="errors.event_description"
                           label="Event Description"
                           placeholder="Enter Event Description Here"
                           prepend-inner-icon="mdi-calendar-text"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>
                        <!-- End Event Description Field -->

                        <!-- Event Date Picker -->
                           <v-date-picker
                              v-model="event_date"
                              :show-current="moment().format('YYYY-MM-DD')"
                              show-adjacent-months
                              full-width
                              class="px-16"
                           ></v-date-picker>
                        <!-- End Event Date Picker -->

                        <!-- File Upload -->
                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.event_image"
                           :error-messages="errors.event_image"
                           outlined
                           class="mb-2"
                        ></v-file-input>
                        <!-- End File Upload -->

                        <div class="text-caption red--text">
                           **Selecting "Yes" below uses an auto-resizer to resize the image to have a dimension of 2000x1000.
                           It is applicable for most cell phone photos.
                           However, if you select "No" it is recommended that you resize your image to an aspect ratio of about
                           2 for it to display correctly on the page.
                           Otherwise, part of your image might be cropped out from the front-end.
                        </div>

                        <!-- Resize Image Radio Buttons -->
                        <v-container fluid class="pt-0">
                           <v-radio-group
                              v-model="resize_image"
                              mandatory
                              column
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
                              :disabled="!event_image"
                           >
                           
                              <template v-slot:label>
                                 <div> Do You Want to Resize Image ?? </div>
                              </template>
                              <v-radio value="1">
                                 <template v-slot:label>
                                    <div> Yes </div>
                                 </template>
                              </v-radio>
                              <v-radio value="0">
                                 <template v-slot:label>
                                    <div> No </div>
                                 </template>
                              </v-radio>
                           </v-radio-group>
                        </v-container>
                        <!-- End Resize Image Radio Buttons -->

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
import moment, { now } from 'moment'
import AdminLoading from "./admin_components/admin_loading"
export default {
   data: () => ({
      moment: moment,
      errors:[],
      error_message: '',
      error_snackbar: false,
      form_disabled: false,
      form_loading: false,
      success_message: "",
      success_snackbar: false,
      timeout: 3000,
      event_type: "",
      loading_content: false,
      event_name: "",
      event_name_rules: [
         (v) => !!v || "Event name is required",
         (v) => (v && v.length <= 255) || 'Event name must be less than 255 characters',
      ],
      event_description: "",
      event_description_rules: [
         (v) => !!v || "Event description is required",
         (v) => (v && v.length <= 255) || 'Event description must be less than 255 characters',
      ],
      event_image: null,
      event_date: "",
      resize_image: "",
      // resize_rules: [
      //    (v) => !!v || "Resize Parameter is required"
      // ],
   }),

   components: {
   AdminLoading
   },

   methods: {
      select_file(file){
         // console.log(file)
         this.event_image = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.store_event_data.validate()) {
            this.form_disabled = true
            this.form_loading = true

            // console.log("trigger 2")
            // if (!this.event_image) {
            //    this.error_message = "Please select a file!";
            //    this.form_disabled = false
            //    this.form_loading = false
            //    return;
            // }

            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('event_type_id', this.$route.params.event_type_id)
            formData.append('event_name', this.event_name)
            formData.append('event_description', this.event_description)
            formData.append('event_image', this.event_image)
            formData.append('resize_image', this.resize_image)
            formData.append('event_date',
               moment(this.event_date, "YYYY-MM-DD").format(("YYYY-MM-DD h:mm:ss"))
            )

            console.log("trigger 3")
            // console.log(formData)
            console.log(...formData)

            axios.post("/api/events/store", formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.store_event_data.reset()
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
            this.$refs.store_event_data.validate()
         }
      },
      // reset() {
      //    this.$refs.store_event_data.reset()
      // },
      // resetValidation() {
      //    this.$refs.store_event_data.resetValidation()
      // },
   },

   created(){
      this.event_date = moment().format("YYYY-MM-DD")
      this.loading_content = true
      axios.get("/api/events/types/show/" + this.$route.params.event_type_id)
      .then((res) => {
         // console.log(res.data)
         this.event_type = res.data
         this.loading_content = false
      });
   }
};
</script>

<style></style>
