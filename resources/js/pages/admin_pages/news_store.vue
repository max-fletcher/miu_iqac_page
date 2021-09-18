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
                           Create New News</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="store_news_data" :disabled="form_disabled" lazy-validation>

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
                           v-model="news_title"
                           :rules="news_title_rules"
                           :error="errors && errors.news_title"
                           :error-messages="errors.news_title"
                           label="News Title"
                           placeholder="Enter News Title Here"
                           prepend-inner-icon="mdi-newspaper-variant"
                           require
                           outlined
                           class="mb-2"
                        ></v-text-field>

                        <v-text-field
                           v-model="news_text"
                           :rules="news_text_rules"
                           :error="errors && errors.news_text"
                           :error-messages="errors.news_text"
                           label="News Text"
                           placeholder="Enter News Text Here"
                           prepend-inner-icon="mdi-subtitles"
                           required
                           outlined
                           class="mb-2"
                        ></v-text-field>

                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           :rules="news_image_rules"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.news_image"
                           :error-messages="errors.news_image"
                           outlined
                           class="mb-2"
                        ></v-file-input>

                        <div class="text-caption red--text">
                           **Selecting "Yes" below uses an auto-resizer to resize the image to have a dimension of 2000x1000.
                           It is applicable for most cell phone photos.
                           However, if you select "No" it is recommended that you resize your image to an aspect ratio of about
                           2 for it to display correctly on the page.
                           Otherwise, part of your image might be cropped out from the front-end.
                        </div>

                        <v-container fluid class="pt-0">
                           <v-radio-group
                              v-model="resize_image"
                              mandatory
                              column
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
                              :disabled="!news_image"
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
      news_title: "",
      news_title_rules: [
         (v) => !!v || "News Title is required",
         (v) => (v && v.length <= 255) || 'News title must be less than 255 characters',
      ],
      news_text: "",
      news_text_rules: [
         (v) => !!v || "News Text is required",
         (v) => (v && v.length <= 65000) || 'Name must be less than 65000 characters',
      ],
      news_image: null,
      resize_image: "",
   }),

   methods: {
      select_file(file){
         this.errors.news_image = null
         this.news_image = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.store_news_data.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")
            if (!this.news_image) {
               this.error_message = "Please select a file!";
               this.form_disabled = false
               this.form_loading = false
               return;
            }

            console.log("trigger 3")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('news_title', this.news_title)
            formData.append('news_text', this.news_text)
            formData.append('news_image', this.news_image)
            formData.append('resize_image', this.resize_image)

            console.log("trigger 3")

            axios.post("/api/news/store", formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.store_news_data.reset()
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
            this.$refs.store_news_data.validate()
         }
      },
   },
};
</script>

<style></style>
