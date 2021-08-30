<template>
   <div>      
      <v-sheet class="mt-3 pt-6 pb-2 px-8">
         <!-- carousel_title: {{carousel_title}} <br>
         carousel_subtitle: {{carousel_subtitle}} <br>
         carousel_image: {{carousel_image}} <br>
         resize_image: {{resize_image}} <br> -->
         <!-- {{ errors }} -->
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
                              >mdi-user
                           </v-icon>
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
                        Content Edited Successfully !!

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
                        ></v-text-field>
                        <!-- End Carousel Title Field -->

                        <!-- Carousel Subtitle Field -->
                        <v-text-field
                           v-model="carousel_subtitle"
                           :rules="carousel_subtitle_rules"
                           :error="errors && errors.carousel_subtitle"
                           :error-messages="errors.carousel_subtitle"
                           label="E-mail"
                           type="email"
                           placeholder="Enter Carousel Subtitle Here"
                           prepend-inner-icon="mdi-subtitles"
                           required
                           outlined
                        ></v-text-field>
                        <!-- End Carousel Subtitle Field -->

                        <!-- File Upload -->
                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           :rules="carousel_image_rules"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.carousel_image"
                           :error-messages="errors.carousel_image"
                           outlined
                        ></v-file-input>
                        <!-- End File Upload -->

                        <!-- Gender Radio Buttons -->
                        <v-container fluid>
                           <v-radio-group
                              v-model="resize_image"
                              mandatory row
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
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
export default {
   data: () => ({
      errors:[],
      error_message: '',
      error_snackbar: false,
      form_disabled: false,
      form_loading: false,
      success_snackbar: false,
      timeout: 3000,
      carousel_title: "",
      carousel_title_rules: [(v) => !!v || "Carousel Title is required"],
      carousel_subtitle: "",
      carousel_subtitle_rules: [(v) => !!v || "Carousel Subtitle is required"],
      carousel_image: null,
      carousel_image_rules: [ (v) => !!v || "Image is required" ],
      resize_image: "",
      nameRules: [(v) => !!v || "Resize Parameter is required"],
   }),

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
            if (!this.carousel_image) {
               this.error_message = "Please select a file!";
               this.form_disabled = false
               this.form_loading = false
               return;
            }

            console.log("trigger 3")

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
      axios.get("/api/carouselcontent/show/" + this.$route.params.id)
         .then((res) => {
            console.log(res.data)
            this.carousel_title = res.data.carousel_title
            this.carousel_subtitle = res.data.carousel_subtitle
            
            this.form_disabled = false
            this.form_loading = false
            // this.$refs.edit_carousel_content.reset()
         })
         .catch((error) => {
            console.log(error)
            this.error_message = error.response.data.message
            this.error_snackbar = true
            this.errors = error.response.data.errors
            this.form_disabled = false
            this.form_loading = false
         })
  }
};
</script>

<style></style>
