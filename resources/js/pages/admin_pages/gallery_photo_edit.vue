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
                          Edit Photo Details in Gallery - ({{ gallery_name}})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="edit_photo_data" :disabled="form_disabled" lazy-validation>

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

                        <div class="text-body-2 red--text text-uppercase font-weight-bold mb-2 text-center">
                           No Image Resizer is used with this upload module. Please upload resized images only so that the web page view
                           looks how you want. It will show a centered view on the galleries page. Clicking on the images from inside
                           the gallery however will not break the page and will show the full image regardless of the resolution.
                        </div>

                        <div class="text-body-2 red--text font-weight-bold mb-2 text-center mt-4">
                           **If no image is provided, the previous image will be retained as default
                        </div>

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

                           >
                           

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


            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('gallery_name_id', this.$route.params.gallery_id)
            formData.append('photo_title', this.photo_title)
            formData.append('photo_image', this.photo_image)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")
            console.log(...formData)

            axios.post("/api/gallery/photos/update/" + this.$route.params.id, formData)
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
            this.$refs.edit_photo_data.validate()
         }
      },
   },

   created(){
      this.loading_content = true
      axios.get("/api/gallery/photos/show/" + this.$route.params.id)
      .then((res) => {
         if( this.$route.params.gallery_id != res.data.gallery_name.id )
            this.$router.push('/adminpanel/all_galleries/'+ res.data.gallery_name.id +'/gallery?nodata=nodatafound')
         this.gallery_name = res.data.gallery_name.gallery_name
         this.photo_title = res.data.photo_title
         this.loading_content = false
      })
      .catch((error) => {
         this.$router.push('/adminpanel/all_galleries/'+ this.$route.params.gallery_id +'/gallery?nodata=nodatafound')
      })
   }
};
</script>

<style></style>
