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
                          Create New Resource - ({{ resource_type }})</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="store_resource_data" :disabled="form_disabled" lazy-validation>

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

                        <v-file-input
                           truncate-length="15"
                           label="Select New File"
                           @change="select_file"
                           :rules="resource_file_rules"
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
      resource_file_rules: [ (v) => !!v || "File is required" ],
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
         if (this.$refs.store_resource_data.validate()) {
            this.form_disabled = true
            this.form_loading = true

            console.log("trigger 2")
            if (!this.resource_file) {
               this.error_message = "Please select a file!";
               this.form_disabled = false
               this.form_loading = false
               return;
            }

            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('resource_type_id', this.$route.params.resource_type_id)
            formData.append('resource_name', this.resource_name)
            formData.append('resource_file', this.resource_file)

            console.log("trigger 3")
            console.log(...formData)

            axios.post("/api/resource/store", formData)
            .then((res) => {
               console.log(res.data)
               this.success_message = res.data
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.store_resource_data.reset()
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
            this.$refs.store_resource_data.validate()
         }
      },
   },

   created(){
      this.loading_content = true
      axios.get("/api/resource_type/show_without_relations/" + this.$route.params.resource_type_id)
      .then((res) => {
         this.resource_type = res.data.resource_type_name
         this.loading_content = false
      });
   }
};
</script>

<style></style>
