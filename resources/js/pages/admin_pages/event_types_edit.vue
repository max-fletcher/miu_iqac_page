<template>
   <div>
      <!-- event_type: {{event_type}} <br>
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
                           Edit Event Type</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="edit_about_content" :disabled="form_disabled" lazy-validation>

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

                      <!-- People Section Name Field -->
                      <v-text-field
                          v-model="event_type"
                          :rules="event_type_rules"
                          :error="errors && errors.event_type"
                          :error-messages="errors.event_type"
                          label="Title"
                          placeholder="Enter Title Here"
                          prepend-inner-icon="mdi-format-title"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>
                      <!-- End People Section Name Field -->

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
      event_type: "",
      event_type_rules: [
         (v) => !!v || "Event Name is required",
         (v) => (v && v.length <= 255) || 'Event Name must be less than 255 characters',
      ],
   }),

   components: {
      AdminLoading
   },

   methods: {
      submitForm() {
         console.log("trigger 1")
         if(this.$refs.edit_about_content.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('event_type', this.event_type)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")
            // console.log(formData);

            axios.post("/api/events/types/update/" + this.$route.params.id, formData)
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
            this.$refs.edit_about_content.validate()
         }
      },
      // reset() {
      //    this.$refs.edit_about_content.reset()
      // },
      // resetValidation() {
      //    this.$refs.edit_about_content.resetValidation()
      // },
   },
   created(){
      this.loading_content = true
      axios.get("/api/events/types/show/" + this.$route.params.id)
         .then((res) => {
            // console.log(res.data)
            this.event_type = res.data.event_type
            this.form_disabled = false
            this.form_loading = false
            this.loading_content = false
            // this.$refs.edit_about_content.reset()
         })
         .catch((error) => {
            this.$router.push('/adminpanel/event_types?nodata=nodatafound')
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
