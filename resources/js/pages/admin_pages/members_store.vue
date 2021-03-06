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
                          Create New Member - ({{ people_section.name }})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="store_member_data" :disabled="form_disabled" lazy-validation>

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
                          v-model="name"
                          :rules="name_rules"
                          :error="errors && errors.name"
                          :error-messages="errors.name"
                          label="Name"
                          placeholder="Enter Name Here"
                          prepend-inner-icon="mdi-account"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>

                      <v-text-field
                          v-model="designation"
                          :rules="designation_rules"
                          :error="errors && errors.designation"
                          :error-messages="errors.designation"
                          label="Designation"
                          placeholder="Enter Designation Here"
                          prepend-inner-icon="mdi-briefcase"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>

                      <v-text-field
                          v-model="email"
                          :rules="email_rules"
                          :error="errors && errors.email"
                          :error-messages="errors.email"
                          label="Email"
                          placeholder="Enter Email Address Here"
                          prepend-inner-icon="mdi-email"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>

                      <v-text-field
                          v-model="cell_number"
                          :rules="cell_number_rules"
                          :error="errors && errors.cell_number"
                          :error-messages="errors.cell_number"
                          label="Contact Number"
                          placeholder="Enter Contact Number Here"
                          prepend-inner-icon="mdi-phone"
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
                           :error="errors && errors.member_image"
                           :error-messages="errors.member_image"
                           outlined
                           class="mb-2"
                        ></v-file-input>

                        <div class="text-caption red--text">
                           **Selecting "Yes" below uses an auto-resizer to resize the image to have a dimension of 1500x3000
                           followed by a cropper that crops the top and bottom of the image so the final dimension is 1500x1700.
                           It is applicable for most cell phone photos. Keep the person's face centered when taking the photo.
                           However, if you select "No" it is recommended that you resize your image to an aspect ratio of about
                           0.9 for it to display correctly on the page.
                           Otherwise, part of your image might be cropped out from the front-end.
                        </div>

                        <v-container fluid class="pt-0">
                           <v-radio-group
                              v-model="resize_image"
                              mandatory
                              column
                              :error="errors && errors.resize_image"
                              :error-messages="errors.resize_image"
                              :disabled="!member_image"
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
        people_section: "",
        loading_content: false,
        name: "",
        name_rules: [
          (v) => !!v || "Name is required",
          (v) => (v && v.length <= 255) || 'Name must be less than 255 characters',
        ],
        designation: "",
        designation_rules: [
          (v) => !!v || "Designation is required",
          (v) => (v && v.length <= 255) || 'Designation must be less than 255 characters',
        ],
        cell_number: "",
        cell_number_rules: [
          (v) => !!v || "Cell Number is required",
          (v) => (v && v.length <= 255) || 'Contact Number must be less than 255 characters',
        ],
        email: "",
        email_rules: [
          (v) => !!v || "email is required",
          (v) => (v && v.length <= 255) || 'email must be less than 255 characters',
          (v) => /.+@.+/.test(v) || 'E-mail must be valid',
        ],
        member_image: null,
        resize_image: "",
   }),
    components: {
      AdminLoading
    },

   methods: {
      select_file(file){
         this.errors.member_image = null
         this.member_image = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.store_member_data.validate()) {
            this.form_disabled = true
            this.form_loading = true
            

            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('people_id', this.$route.params.people_id)
            formData.append('name', this.name)
            formData.append('designation', this.designation)
            formData.append('cell_number', this.cell_number)
            formData.append('email', this.email)
            formData.append('member_image', this.member_image)
            formData.append('resize_image', this.resize_image)

            console.log("trigger 3")

            axios.post("/api/people/members/store", formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.store_member_data.reset()
            })
            .catch((error) => {
               console.log(error)
               this.error_message = error.response.data.message
               this.error_snackbar = true
               this.errors = error.response.data.error
               this.form_disabled = false
               this.form_loading = false
            });
         } else {
            this.$refs.store_member_data.validate()
         }
      },
   },

    created(){
        this.loading_content = true
        axios.get("/api/people/show_without_relations/" + this.$route.params.people_id)
         .then((res) => {
            this.people_section = res.data
            this.loading_content = false
         })
         .catch((error) => {
            this.$router.push('/adminpanel/people?nodata=nodatafound')
         })
    }
};
</script>

<style></style>
