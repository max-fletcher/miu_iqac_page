<template>
   <div>
      <div v-if="loading_content">
         <AdminLoading />
      </div>

      <v-card v-else>
          <v-snackbar
              v-model="delete_success_snackbar"
              color="green"
              :timeout="timeout"
              top
              right
          >
            <v-icon left>
               mdi-check-circle
            </v-icon>
               {{ delete_success_message }}

            <template v-slot:action="{ attrs }">
               <v-btn
                  color="white"
                  text
                  v-bind="attrs"
                  @click="delete_success_snackbar = false"
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

         <v-card flat tile outlined width="100%" class="d-flex">
            <v-card-title> Contact Us</v-card-title>
         </v-card>

         <v-card flat v-if="all_contact_us.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No "Contact Us" Requests Has Been Sent Yet</h1>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(contact_us, index) in all_contact_us" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

              <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                Name: {{ contact_us.name }}
              </v-card-text>

              <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                Email: {{ contact_us.email }}
              </v-card-text>

              <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                Message: {{ contact_us.message }}
              </v-card-text>

              <v-card-text class="text-caption font-weight-medium py-0">
                Created At: {{ moment(contact_us.created_at).format('MMMM Do YYYY, h:mm a') }}
              </v-card-text>

              <v-card-actions class="py-0">
                <v-list-item class="grow">

                    <v-row
                      align="start"
                      align-sm="center"
                      justify="start"
                      justify-sm="end"
                      class="mt-0 mb-1 mt-sm-0 mb-sm-0"
                    >

                          <v-btn
                                :to="'/adminpanel/contact_us/edit/' + contact_us.id"
                                :disabled="disable_buttons"
                                elevation="2"
                                class="ma-1 indigo darken-3 rounded-1 white--text"
                          >
                                <v-icon left color="white">
                                mdi-clipboard-edit
                                </v-icon>
                                EDIT
                          </v-btn>

                          <ContentDeleteDialog axios_path="/api/contact_us/destroy/" :content_id="contact_us.id" @content_deleted="all_contact_us_update($event)" @content_delete_failed="contact_us_delete_failed($event)" />
                    </v-row>

                </v-list-item>
              </v-card-actions>
            </v-card>
         </div>
         
      </v-card>
   </div>
</template>

<script>
import moment from 'moment'
import AdminLoading from "./admin_components/admin_loading"
import ContentDeleteDialog from "./admin_components/content_delete_dialog.vue"
export default {
   data: () => ({
      moment: moment,
      all_contact_us: [],
      loading_content: false,
      disable_buttons: false,
      timeout: 3000,
      error_snackbar: false,
      error_message: "",
      delete_success_snackbar: false,
      delete_success_message: ""
   }),
   components: {
      AdminLoading, ContentDeleteDialog
   },
   methods: {
      all_contact_us_update(deleted){

            this.all_contact_us = this.all_contact_us.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true

      },

      contact_us_delete_failed($deleted_id)
      {
        this.error_message = "Server Error !! Failed to Delete Content with ID: " + $deleted_id + "."
        this.error_snackbar = true
      }
   },

   created() {
      if(this.$route.query.nodata == "nodatafound"){
         this.error_message = "The Requested Data Was Not Found !!"
         this.error_snackbar = true
      }
      
      this.loading_content = true,
      axios.get("/api/contact_us/index")
         .then((response) => {
            console.log("response");
            this.all_contact_us = response.data
            this.loading_content = false
         })
   },
}
</script>

<style>
</style>