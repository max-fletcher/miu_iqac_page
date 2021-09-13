<template>
   <div>
      <!-- carousel_title: {{carousel_title}} <br>
      carousel_subtitle: {{carousel_subtitle}} <br>
      carousel_image: {{carousel_image}} <br>
      resize_image: {{resize_image}} <br> -->
      <!-- {{ errors }} -->

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
                        Edit Carousel Content</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="edit_carousel_content" :disabled="form_disabled" lazy-validation>

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

                     <!-- Carousel Title Field -->
                        <v-text-field
                           v-model="carousel_title"
                           :rules="carousel_title_rules"
                           :error="errors && errors.carousel_title"
                           :error-messages="errors.carousel_title"
                           label="Carousel Title"
                           placeholder="Enter Carousel Title Here"
                           prepend-inner-icon="mdi-format-title"
                           require
                           outlined
                           class="mb-2"
                        ></v-text-field>
                        <!-- End Carousel Title Field -->

                        <!-- Carousel Subtitle Field -->
                        <v-text-field
                           v-model="carousel_subtitle"
                           :rules="carousel_subtitle_rules"
                           :error="errors && errors.carousel_subtitle"
                           :error-messages="errors.carousel_subtitle"
                           label="Carousel Subtitle"
                           placeholder="Enter Carousel Subtitle Here"
                           prepend-inner-icon="mdi-subtitles"
                           required
                           outlined
                           class="mb-2"
                        ></v-text-field>
                        <!-- End Carousel Subtitle Field -->

                        <div class="text-body-2 red--text font-weight-bold mb-2 text-center">
                           **If no image is provided, the previous image will be retained as default
                        </div>

                        <!-- File Upload -->
                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.carousel_image"
                           :error-messages="errors.carousel_image"
                           outlined
                           class="mb-2"
                        ></v-file-input>
                        <!-- End File Upload -->

                        <div class="text-caption red--text">
                           **Selecting "Yes" below uses an auto-resizer to resize the image to have a dimension of 2000x1150.
                           It is applicable for most cell phone photos.
                           However, if you select "No" it is recommended that you resize your image to an aspect ratio of about
                           1.74 for it to display correctly on the page.
                           Otherwise, part of your image might be cropped out from the front-end.
                        </div>

                        <!-- Gender Radio Buttons -->
                        <v-container fluid class="pt-0">
                           <v-radio-group
                              v-model="resize_image"
                              column
                              mandatory
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
                              :disabled="!carousel_image"
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
                        <!-- End Gender Radio Buttons -->

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
      carousel_title: "",
      carousel_title_rules: [
         (v) => !!v || "Carousel Title is required",
         (v) => (v && v.length <= 133) || 'Name must be less than 133 characters',
      ],
      carousel_subtitle: "",
      carousel_subtitle_rules: [
         (v) => !!v || "Carousel Subtitle is required",
         (v) => (v && v.length <= 176) || 'Name must be less than 176 characters',
      ],
      carousel_image: null,
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
         this.carousel_image = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.edit_carousel_content.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")
            // if (!this.carousel_image) {
            //    this.error_message = "Please select a file!";
            //    this.form_disabled = false
            //    this.form_loading = false
            //    return;
            // }

            this.error_message = "";

            const formData  = new FormData()
            formData.append('carousel_title', this.carousel_title)
            formData.append('carousel_subtitle', this.carousel_subtitle)
            formData.append('carousel_image', this.carousel_image)
            formData.append('resize_image', this.resize_image)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")
            // console.log(formData);

            axios.post("/api/carouselcontent/update/" + this.$route.params.id, formData)
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
            this.$refs.edit_carousel_content.validate()
         }
      },
      // reset() {
      //    this.$refs.edit_carousel_content.reset()
      // },
      // resetValidation() {
      //    this.$refs.edit_carousel_content.resetValidation()
      // },
   },
   created(){
      this.loading_content = true
      axios.get("/api/carouselcontent/show/" + this.$route.params.id)
         .then((res) => {
            console.log(res.data)
            this.carousel_title = res.data.carousel_title
            this.carousel_subtitle = res.data.carousel_subtitle
            this.form_disabled = false
            this.form_loading = false
            this.loading_content = false
            // this.$refs.edit_carousel_content.reset()
         })
         .catch((error) => {
            this.$router.push('/adminpanel/carousel_content?nodata=nodatafound')
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
