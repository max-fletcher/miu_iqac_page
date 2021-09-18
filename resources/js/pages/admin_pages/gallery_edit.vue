<template>
   <div>

      <v-sheet class="mt-3 pb-2 px-8">
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
                          Edit Gallery</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="edit_gallery" :disabled="form_disabled" lazy-validation>

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

                        <v-text-field
                           v-model="gallery_name"
                           :rules="gallery_name_rules"
                           :error="errors && errors.gallery_name"
                           :error-messages="errors.gallery_name"
                           label="Gallery Name"
                           placeholder="Enter Gallery Name Here"
                           prepend-inner-icon="mdi-image-text"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>

                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.gallery_cover_photo"
                           :error-messages="errors.gallery_cover_photo"
                           outlined
                           class="mb-2"
                        ></v-file-input>

                        <div class="text-caption red--text">
                           **Selecting "Yes" below uses an auto-resizer to resize the image to have a dimension of 2000x1150.
                           It is applicable for most cell phone photos.
                           However, if you select "No" it is recommended that you resize your image to an aspect ratio of about
                           1.74 for it to display correctly on the page.
                           Otherwise, part of your image might be cropped out from the front-end.
                        </div>

                        <v-container fluid class="pt-0">
                           <v-radio-group
                              v-model="resize_image"
                              mandatory
                              column
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
                              :disabled="!gallery_cover_photo"
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
      gallery_name: "",
      gallery_name_rules: [
         (v) => !!v || "Event name is required",
         (v) => (v && v.length <= 255) || 'Event name must be less than 255 characters',
      ],
      gallery_cover_photo: null,
      resize_image: "",
   }),

   methods: {
      select_file(file){
         this.errors.gallery_cover_photo = null
         this.gallery_cover_photo = file
      },

      submitForm() {
         if (this.$refs.edit_gallery.validate()) {
            this.form_disabled = true
            this.form_loading = true
            this.error_message = ""

            const formData  = new FormData()
            formData.append('gallery_name', this.gallery_name)
            formData.append('gallery_cover_photo', this.gallery_cover_photo)
            formData.append('resize_image', this.resize_image)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")
            console.log(...formData)

            axios.post("/api/gallery/name/update/" + this.$route.params.id, formData)
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
            this.$refs.edit_gallery.validate()
         }
      },
   },
    created(){
      this.loading_content = true
      axios.get("/api/gallery/name/show_without_relations/" + this.$route.params.id)
          .then((res) => {
            console.log(res.data)
            this.gallery_name = res.data.gallery_name
            this.form_disabled = false
            this.form_loading = false
            this.loading_content = false
          })
          .catch((error) => {
            this.$router.push('/adminpanel/all_galleries?nodata=nodatafound')
          })
    }
};
</script>

<style></style>
