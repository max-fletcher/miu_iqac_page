<template>
   <div>
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
                          Edit Publication - ({{ publication_type_name }})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="edit_publication_data" :disabled="form_disabled" lazy-validation>

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

                        <!-- Photo Title Field -->
                        <v-text-field
                           v-model="publication_name"
                           :rules="publication_name_rules"
                           :error="errors && errors.publication_name"
                           :error-messages="errors.publication_name"
                           label="Publication Name"
                           placeholder="Enter Publication Name Here"
                           prepend-inner-icon="mdi-alpha-t-box"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>
                        <!-- End Photo Title Field -->


                        <div class="text-body-2 red--text font-weight-bold mb-2 text-center mt-4">
                           **If no file is provided, the previous file will be retained as default
                        </div>

                        <!-- File Upload -->
                        <v-file-input
                           truncate-length="15"
                           label="Select New File"
                           @change="select_file"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.publication_file"
                           :error-messages="errors.publication_file"
                           clearable
                           outlined
                           class="mb-2"
                        ></v-file-input>
                        <!-- End File Upload -->

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
      loading_content: false,
      publication_type_name: "",
      publication_name: "",
      publication_name_rules: [
         (v) => !!v || "Publication name is required",
         (v) => (v && v.length <= 255) || 'Publication name must be less than 255 characters',
      ],
      publication_file: null,
      // publication_file_rules: [ (v) => !!v || "File is required" ],
   }),

   components: {
      AdminLoading
   },

   methods: {
      select_file(file){
         this.errors.publication_file = null
         this.publication_file = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.edit_publication_data.validate()) {
            this.form_disabled = true
            this.form_loading = true

            // console.log("trigger 2")
            // if (!this.publication_file) {
            //    this.error_message = "Please select a file!";
            //    this.form_disabled = false
            //    this.form_loading = false
            //    return;
            // }

            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('publication_type_info_id', this.$route.params.publication_type_id)
            formData.append('publication_name', this.publication_name)
            formData.append('publication_file', this.publication_file)
            formData.append('_method', 'PATCH')
            // formData.append('resize_image', this.resize_image)

            console.log("trigger 3")
            // console.log(formData)
            console.log(...formData)

            axios.post("/api/publications/update/" + this.$route.params.id, formData)
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
            this.$refs.edit_publication_data.validate()
         }
      },
      // reset() {
      //    this.$refs.edit_publication_data.reset()
      // },
      // resetValidation() {
      //    this.$refs.edit_publication_data.resetValidation()
      // },
   },

   created(){
      this.loading_content = true
      axios.get("/api/publications/show/" + this.$route.params.id)
      .then((res) => {
         // console.log(res.data)
         if( this.$route.params.publication_type_id != res.data.publication_type_info.id )
            this.$router.push('/adminpanel/publication_types/'+ res.data.publication_type_info.id +'/all_publications?nodata=nodatafound')
         this.publication_type_name = res.data.publication_type_info.publication_type_name
         this.publication_name = res.data.publication_name
         this.loading_content = false
      })
      .catch((error) => {
            this.$router.push('/adminpanel/publication_types/'+ this.$route.params.publication_type_id +'/all_publications?nodata=nodatafound')
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
