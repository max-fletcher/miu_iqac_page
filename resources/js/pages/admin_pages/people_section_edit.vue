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
                           Edit People Section</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <v-form ref="store_about_content" :disabled="form_disabled" lazy-validation>

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
                          label="Title"
                          placeholder="Enter Title Here"
                          prepend-inner-icon="mdi-format-title"
                          require
                          outlined
                          class="mb-1"
                      ></v-text-field>

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
      loading_content: false,
      name: "",
      name_rules: [
         (v) => !!v || "People section name is required",
         (v) => (v && v.length <= 255) || 'People section name must be less than 255 characters',
      ],
   }),

   components: {
      AdminLoading
   },

   methods: {
      submitForm() {
         console.log("trigger 1")
         if(this.$refs.store_about_content.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('name', this.name)
            formData.append('_method', 'PATCH')

            console.log("trigger 3")

            axios.post("/api/people/update/" + this.$route.params.id, formData)
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
            this.$refs.store_about_content.validate()
         }
      },
   },
   created(){
      this.loading_content = true
      axios.get("/api/people/show/" + this.$route.params.id)
         .then((res) => {
            console.log(res.data)
            this.name = res.data.name
            this.form_disabled = false
            this.form_loading = false
            this.loading_content = false
         })
         .catch((error) => {
            this.$router.push('/adminpanel/people?nodata=nodatafound')
         })
  }
};
</script>

<style></style>
