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
                          Edit Resource - ({{ resource_type }})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="edit_resource_data" :disabled="form_disabled" lazy-validation>

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
                           v-model="resource_name"
                           :rules="resource_name_rules"
                           :error="errors && errors.resource_name"
                           :error-messages="errors.resource_name"
                           label="Resource Name"
                           placeholder="Enter Resource Name Here"
                           prepend-inner-icon="mdi-form-textbox"
                           require
                           outlined
                           class="mb-1"
                        ></v-text-field>

                        <div class="text-body-2 red--text font-weight-bold mb-2 text-center">
                           **If no file is provided, the previous file will be maintained as default
                        </div>

                        <v-file-input
                           truncate-length="15"
                           label="Select New File"
                           @change="select_file"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.resource_file"
                           :error-messages="errors.resource_file"
                           outlined
                           class="mb-2"
                        ></v-file-input>

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
      resource_type: "",
      resource_name: "",
      resource_name_rules: [
         (v) => !!v || "Resource name is required",
         (v) => (v && v.length <= 255) || 'Resource name must be less than 255 characters',
      ],
      resource_file: null,
   }),

   components: {
      AdminLoading
   },

   methods: {
      select_file(file){
         this.errors.resource_file = null
         this.resource_file = file
      },

      submitForm() {
         console.log("trigger 1")
         if (this.$refs.edit_resource_data.validate()) {
            this.form_disabled = true
            this.form_loading = true

            console.log("trigger 2")

            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('resource_type_id', this.$route.params.resource_type_id)
            formData.append('resource_name', this.resource_name)
            formData.append('resource_file', this.resource_file)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")
            console.log(...formData)

            axios.post("/api/resource/update/" + this.$route.params.id, formData)
            .then((res) => {
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
            })
            .catch((error) => {
               this.error_message = error.response.data.message
               this.error_snackbar = true
               this.errors = error.response.data.errors
               this.form_disabled = false
               this.form_loading = false
            });

         } else {
            this.$refs.edit_resource_data.validate()
         }
      },
   },

   created(){
      this.loading_content = true
      axios.get("/api/resource/show/" + this.$route.params.id)
      .then((res) => {
         if( this.$route.params.resource_type_id != res.data.resource_type_id )
            this.$router.push('/adminpanel/resource_types/' + res.data.resource_type_id + '/resources/?nodata=nodatafound')
         this.resource_type = res.data.resource_type.resource_type_name
         this.resource_name = res.data.resource_name
         this.loading_content = false
      })
      .catch((error) => {
         this.$router.push('/adminpanel/resource_types/' + this.$route.params.resource_type_id + '/resources/?nodata=nodatafound')
      })
   }
};
</script>

<style></style>
