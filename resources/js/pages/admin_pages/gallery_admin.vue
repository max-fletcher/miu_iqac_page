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
            <v-card-title> List of Galleries </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  to="/adminpanel/gallery/store"
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

         <v-card flat v-if="galleries.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Galleries Has Been Added Yet</h1>
                     <h2>Add Galleries By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(gallery, index) in galleries" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Gallery Name: {{ gallery.gallery_name}}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(gallery.created_at).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-text class="text-body-2 font-weight-normal py-0 mt-2 mb-n1 ml-2 teal--text text--darken-2">
                  Cover Photo
               </v-card-text>
               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                     <div class="hidden-sm-and-up">
                        <div>
                              <v-list-item-avatar color="grey darken-3" tile width="300" height="150">
                                 <v-img
                                 class="elevation-6"
                                 :src="'/storage/gallery_cover_photos/' + gallery.gallery_cover_photo"
                                 :alt="'Image - ' + gallery.gallery_cover_photo"
                                 position="center center"
                                 aspect-ratio="2"
                                 ></v-img>
                              </v-list-item-avatar>
                        </div>

                        <v-row class="my-1 mx-auto">
                              <v-btn
                                 :to="'/adminpanel/all_galleries/' + gallery.id + '/gallery'"
                                 :disabled="disable_buttons"
                                 elevation="2"
                                 class="ma-1 green darken-1 rounded-1 white--text"
                              >
                                 <v-icon left color="white">
                                    mdi-image-multiple
                                 </v-icon>
                                 View Photos
                              </v-btn>

                              <v-btn
                                 :to="'/adminpanel/gallery/edit/' + gallery.id"
                                 :disabled="disable_buttons"
                                 elevation="2"
                                 class="ma-1 indigo darken-3 rounded-1 white--text"
                              >
                                 <v-icon left color="white">
                                    mdi-clipboard-edit
                                 </v-icon>
                                 EDIT
                              </v-btn>

                              <ContentDeleteDialog axios_path="/api/gallery/name/destroy/" :content_id="gallery.id" @content_deleted="gallery_update($event)" @content_delete_failed="gallery_deleted_failed($event)" />
                        </v-row>
                     </div>

                     <v-list-item-avatar color="grey darken-3" tile width="300" height="150" class="hidden-xs-only">
                        <v-img
                        class="elevation-6"
                        :src="'/storage/gallery_cover_photos/' + gallery.gallery_cover_photo"
                        :alt="'Image of - ' + gallery.gallery_cover_photo"
                        position="center center"
                        aspect-ratio="2"
                        ></v-img>
                     </v-list-item-avatar>

                     <v-row
                        align="start"
                        align-sm="center"
                        justify="start"
                        justify-sm="end"
                        class="mt-0 mb-1 mt-sm-0 mb-sm-0 hidden-xs-only"
                     >
                           <v-btn
                              :to="'/adminpanel/all_galleries/' + gallery.id + '/gallery'"
                              :disabled="disable_buttons"
                              elevation="2"
                              class="ma-1 green darken-1 rounded-1 white--text"
                           >
                              <v-icon left color="white">
                                 mdi-image-multiple
                              </v-icon>
                              View Photos
                           </v-btn>

                           <v-btn
                              :to="'/adminpanel/gallery/edit/' + gallery.id"
                              :disabled="disable_buttons"
                              elevation="2"
                              class="ma-1 indigo darken-3 rounded-1 white--text"
                           >
                              <v-icon left color="white">
                                 mdi-clipboard-edit
                              </v-icon>
                              EDIT
                           </v-btn>

                           <ContentDeleteDialog axios_path="/api/gallery/name/destroy/" :content_id="gallery.id" @content_deleted="gallery_update($event)" @content_delete_failed="gallery_deleted_failed($event)" />
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
      galleries: [],
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

      gallery_update(deleted){
         console.log("delete from admin")
            this.galleries = this.galleries.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true
      },

      gallery_deleted_failed($deleted_id)
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
      axios.get("/api/gallery/name/index")
         .then((res) => {
            console.log(res.data)
            this.galleries = res.data
            this.loading_content = false
         })
   },
}
</script>

<style>
</style>