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
            <v-card-title> Event Types </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  :to="'/adminpanel/event_types/store'"
                  :disabled="disable_buttons"
                  elevation="2"
                  class="ma-1 orange darken-3 rounded-1 white--text mt-4 mr-5"
               >
                  <v-icon left color="white">
                     mdi-plus
                  </v-icon>
                  CREATE NEW
               </v-btn>
         </v-card>

         <v-card flat v-if="event_types.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Event Types Has Been Added Yet</h1>
                     <h2>Add Event Types By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(event_type, index) in event_types" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Event Type: {{ event_type.event_type }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(event_type.created_at).format('MMMM Do YYYY, h:mm a') }}
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
                              :to="'/adminpanel/event_types/' + event_type.id + '/events'"
                              :disabled="disable_buttons"
                              elevation="2"
                              class="ma-1 green darken-1 rounded-1 white--text"
                           >
                              <v-icon left color="white">
                                 mdi-calendar-clock
                              </v-icon>
                              View Events
                           </v-btn>
                           
                           <v-btn
                                 :to="'/adminpanel/event_types/edit/' + event_type.id"
                                 :disabled="disable_buttons"
                                 elevation="2"
                                 class="ma-1 indigo darken-3 rounded-1 white--text"
                           >
                                 <v-icon left color="white">
                                 mdi-clipboard-edit
                                 </v-icon>
                                 EDIT
                           </v-btn>
                           <ContentDeleteDialog axios_path="/api/events/types/destroy/" :content_id="event_type.id" @content_deleted="event_types_update($event)" @content_delete_failed="event_type_delete_failed($event)" />
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
      event_types: [],
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
      event_types_update(deleted){

            this.event_types = this.event_types.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true

      },

      event_type_delete_failed($deleted_id)
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
      axios.get("/api/events/types/index")
         .then((response) => {
            console.log("response");
            this.event_types = response.data
            this.loading_content = false
         })
   },
}
</script>

<style>
</style>