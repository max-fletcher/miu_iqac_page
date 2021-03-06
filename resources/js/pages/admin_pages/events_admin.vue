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
            <v-card-title> Events Section - {{ event_type }} </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  :to="'/adminpanel/event_types/'+ this.$route.params.event_type_id +'/events/store'"
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

         <v-card flat v-if="events.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Events For This Event Type Has Been Added Yet</h1>
                     <h2>Add Events For This Event Type By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(event, index) in events" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Event Name: {{ event.event_name }}
                     <v-chip
                        v-if="moment(event.event_date).format('YYYY-MM-DD') >= moment().format('YYYY-MM-DD')"
                        small
                        color="green"
                        outlined
                        pill
                        class="ml-1"
                     >
                        Upcoming
                     </v-chip>
                     <v-chip
                        v-else
                        small
                        color="red"
                        outlined
                        pill
                        class="ml-1"
                     >
                        Passed
                     </v-chip>
               </v-card-text>

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Event Type: {{ event_type }}
               </v-card-text>

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Event Description: <br> {{ event.event_description }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-bold py-0">
                  Event Date: {{ moment(event.event_date).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(event.created_at).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                      <v-list-item-avatar color="grey darken-3" tile width="300" height="150">
                        <v-img
                          class="elevation-6"
                          :src="'/storage/event_images/' + event.event_image"
                          :alt="'Image of - ' + event.event_image"
                          position="center center"
                          aspect-ratio="2"
                        ></v-img>
                      </v-list-item-avatar>

                      <v-row
                          justify="end"
                          align="end"
                      >
                              <v-btn
                                  :to="'/adminpanel/event_types/'+ $route.params.event_type_id +'/events/edit/' + event.id"
                                  :disabled="disable_buttons"
                                  elevation="2"
                                  class="ma-1 indigo darken-3 rounded-1 white--text"
                              >
                                  <v-icon left color="white">
                                    mdi-clipboard-edit
                                  </v-icon>
                                  EDIT
                              </v-btn>

                              <ContentDeleteDialog axios_path="/api/events/destroy/" :content_id="event.id" @content_deleted="event_update($event)" @content_delete_failed="event_delete_failed($event)" />
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
      event_type: "",
      events: [],
      loading_content: true,
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

      event_update(deleted){
         console.log("delete from admin")
            this.events = this.events.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true

      },

      event_deleted_failed($deleted_id)
      {
        this.error_message = "Server Error !! Failed to Delete Content with ID: " + $deleted_id + "."
        this.error_snackbar = true
      }
   },

   created(){
      if(this.$route.query.nodata == "nodatafound"){
         this.error_message = "The Requested Data Was Not Found !!"
         this.error_snackbar = true
      }

      this.loading_content = true
      axios.get("/api/events/types/show_with_events/"+ this.$route.params.event_type_id)
         .then((res) => {
            this.event_type = res.data.event_type
            this.events = res.data.events
            this.loading_content = false
         })
         .catch((error) => {
            this.$router.push('/adminpanel/event_types?nodata=nodatafound')
         })
   },
}
</script>

<style>
</style>