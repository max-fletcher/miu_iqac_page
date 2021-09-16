<template>
   <div>
      <!-- {{carousel_content}} -->
      <div v-if="loading_content">
         <AdminLoading />
      </div>

      <v-card v-else>

         <!-- Snackbar For successful Deletion -->
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
          <!-- End Snackbar For successful Deletion -->

         <!-- Snackbar For Internal Server Error -->
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
         <!-- End Snackbar For Internal Server Error -->

         <v-card flat tile outlined width="100%" class="d-flex">
            <v-card-title> Carousel Content </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  to="/adminpanel/carousel_content/store"
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

         <v-card flat v-if="carousel_content.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Carousel Content Has Been Added Yet</h1>
                     <h2>Add Carousel Content By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(carousel_content, index) in carousel_content" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">
               <v-card-title class="py-0">
                  <span class="text-h6 font-weight-medium">
                     Title: {{ carousel_content.carousel_title }}
                  </span>
               </v-card-title>

               <v-card-text class="text-body-1 font-weight-medium py-0">
                  Subtitle: {{ carousel_content.carousel_subtitle }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(carousel_content.created_at).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                     <v-list-item-avatar color="grey darken-3" tile width="150" height="100">
                        <v-img
                           class="elevation-6"
                           :src="'/storage/carousel_images/' + carousel_content.carousel_image"
                           :alt="'Image - ' + carousel_content.carousel_image"
                           position="center center"
                           aspect-ratio="2"
                        ></v-img>
                     </v-list-item-avatar>

                     <v-row
                        align="center"
                        justify="end"
                     >
                           <v-btn
                              :to="'/adminpanel/carousel_content/edit/' + carousel_content.id"
                              :disabled="disable_buttons"
                              elevation="2"
                              class="ma-1 indigo darken-3 rounded-1 white--text"
                           >
                              <v-icon left color="white">
                                 mdi-clipboard-edit
                              </v-icon>
                              EDIT
                           </v-btn>

                           <!-- Delete Button With v-menu -->
                           <ContentDeleteDialog axios_path="/api/carouselcontent/destroy/" :content_id="carousel_content.id" @content_deleted="carousel_content_update($event)" @content_delete_failed="carousel_content_delete_failed($event)" />
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
      carousel_content: [],
      loading_content: false,
      disable_buttons: false,
      timeout: 3000,
      error_snackbar: false,
      error_message: "",
      delete_success_snackbar: false,
      delete_success_message: ""
      // dialog: false,
   }),
   components: {
      AdminLoading, ContentDeleteDialog
   },
   methods: {

      carousel_content_update(deleted){
            this.carousel_content = this.carousel_content.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         // console.log(deleted)
         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true
      },

      carousel_content_delete_failed($deleted_id)
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
      axios.get("/api/carouselcontent/index")
         .then((response) => {
            console.log("response");
            this.carousel_content = response.data
            this.loading_content = false
         })
   },
}
</script>

<style>
</style>