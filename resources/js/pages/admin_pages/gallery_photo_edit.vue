<template>
   <div>
      <!-- photo_title: {{ photo_title }} <br>
      {{ error_message }} <br>
      {{ errors }} <br> <br>
      {{ gallery_name }} -->

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
                          Edit Photo Details in Gallery - ({{ gallery_name}})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="edit_photo_data" :disabled="form_disabled" lazy-validation>

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
                           v-model="photo_title"
                           :rules="photo_title_rules"
                           :error="errors && errors.photo_title"
                           :error-messages="errors.photo_title"
                           label="Photo Title"
                           placeholder="Enter Event Name Here"
                           prepend-inner-icon="mdi-alpha-t-box"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>
                        <!-- End Photo Title Field -->

                        <div class="text-body-2 red--text text-uppercase font-weight-bold mb-2 text-center">
                           No Image Resizer is used with this upload module. Please upload resized images only so that the web page view
                           looks how you want. It will show a centered view on the galleries page. Clicking on the images from inside
                           the gallery however will not break the page and will show the full image regardless of the resolution.
                        </div>

                        <div class="text-body-2 red--text font-weight-bold mb-2 text-center mt-4">
                           **If no image is provided, the previous image will be retained as default
                        </div>

                        <!-- File Upload -->
                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.photo_image"
                           :error-messages="errors.photo_image"
                           outlined
                           class="mb-2"
                        ></v-file-input>
                        <!-- End File Upload -->

                        <!-- Resize Image Radio Buttons -->
                        <!-- <v-container fluid class="pt-0">
                           <v-radio-group
                              v-model="resize_image"
                              mandatory
                              column
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
                              :disabled="!photo_image"
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
                        </v-container> -->
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
      loading_content: false,
      photo_title: "",
      photo_title_rules: [
         (v) => !!v || "Photo title is required",
         (v) => (v && v.length <= 255) || 'Photo title must be less than 255 characters',
      ],
      photo_image: null,
      // photo_image_rules: [ (v) => !!v || "Image is required" ],
      // resize_image: "",
      // resize_rules: [
      //    (v) => !!v || "Resize Parameter is required"
      // ],
   }),

   components: {
      AdminLoading
   },

   methods: {
      select_file(file){
         this.errors.photo_image = null
         this.photo_image = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.edit_photo_data.validate()) {
            this.form_disabled = true
            this.form_loading = true

            // console.log("trigger 2")
            // if (!this.photo_image) {
            //    this.error_message = "Please select a file!";
            //    this.form_disabled = false
            //    this.form_loading = false
            //    return;
            // }

            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('gallery_name_id', this.$route.params.gallery_id)
            formData.append('photo_title', this.photo_title)
            formData.append('photo_image', this.photo_image)
            formData.append('_method', 'PATCH')
            // formData.append('resize_image', this.resize_image)

            console.log("trigger 3")
            // console.log(formData)
            console.log(...formData)

            axios.post("/api/gallery/photos/update/" + this.$route.params.id, formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               // this.$refs.edit_photo_data.reset()
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
            this.$refs.edit_photo_data.validate()
         }
      },
      // reset() {
      //    this.$refs.edit_photo_data.reset()
      // },
      // resetValidation() {
      //    this.$refs.edit_photo_data.resetValidation()
      // },
   },

   created(){
      this.loading_content = true
      axios.get("/api/gallery/photos/show/" + this.$route.params.id)
      .then((res) => {
         // console.log(res.data)
         if( this.$route.params.gallery_id != res.data.gallery_name.id )
            this.$router.push('/adminpanel/all_galleries/'+ res.data.gallery_name.id +'/gallery?nodata=nodatafound')
         this.gallery_name = res.data.gallery_name.gallery_name
         this.photo_title = res.data.photo_title
         this.loading_content = false
      })
      .catch((error) => {
         this.$router.push('/adminpanel/all_galleries/'+ this.$route.params.gallery_id +'/gallery?nodata=nodatafound')
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
