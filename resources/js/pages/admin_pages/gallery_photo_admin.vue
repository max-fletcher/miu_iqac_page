<template>
   <div>
      <!-- {{gallery_photos}} -->
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
            <v-card-title> List of Photos - {{ gallery_photos.gallery_name }} </v-card-title>

              <v-spacer></v-spacer>
              <v-btn
                :to="'/adminpanel/all_galleries/'+ this.$route.params.gallery_id +'/gallery/store'"
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

         <v-card flat v-if="gallery_photos.gallery_photos.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Photos For This Gallery Has Been Added Yet</h1>
                     <h2>Add Photos By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(gallery_photos, index) in gallery_photos.gallery_photos" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

               <v-card-title class="py-0">
                  <span class="text-h6 font-weight-medium">
                     Title: {{ gallery_photos.title }}
                  </span>
               </v-card-title>

               <v-card-text class="text-body-1 font-weight-medium py-0">
                  Subtitle: {{ gallery_photos.gallery_cover_photo }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(gallery_photos.created_at).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                     <v-list-item-avatar color="grey darken-3" tile width="150" height="100">
                        <v-img
                           class="elevation-6"
                           :src="gallery_photos.src"
                           :alt="'Image - ' + gallery_photos.src"
                           position="center center"
                           aspect-ratio="2"
                        ></v-img>
                     </v-list-item-avatar>

                     <v-row
                        align="center"
                        justify="end"
                     >
                           <v-btn
                              :to="'/adminpanel/all_galleries/' + gallery_photos.gallery_name_id + '/gallery/edit/' + gallery_photos.id"
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
                           <ContentDeleteDialog axios_path="/api/gallery/photos/destroy/" :content_id="gallery_photos.id" @content_deleted="gallery_photos_update($event)" @content_delete_failed="gallery_photos_delete_failed($event)" />
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
      gallery_photos: [],
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

      gallery_photos_update(deleted){
            this.gallery_photos.gallery_photos = this.gallery_photos.gallery_photos.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         // console.log(deleted)
         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true
      },

      gallery_photos_delete_failed($deleted_id)
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
      axios.get("/api/gallery/name/show/" + this.$route.params.gallery_id)
         .then((response) => {
            this.gallery_photos = response.data
            this.loading_content = false
         })
         .catch((error) => {
            this.$router.push('/adminpanel/all_galleries?nodata=nodatafound')
            // console.log(error)
            // this.error_message = error.response.data.message
            // this.error_snackbar = true
            // this.errors = error.response.data.errors
            // this.form_disabled = false
            // this.form_loading = false
            // this.loading_content = false
         })
   },
}
</script>

<style>
</style>