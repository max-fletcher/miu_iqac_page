<template>
   <div>
         <!-- {{ news }}
         {{ news }} -->
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
            <v-card-title> News Section </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  to="/adminpanel/news/store"
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

         <v-card flat v-if="news.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No News For This Event Type Has Been Added Yet</h1>
                     <h2>Add News For This Event Type By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(news, index) in news" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

               <!-- {{moment(news.news_date).format('YYYY-MM-DD')}} <br> -->
               <!-- {{moment().format('YYYY-MM-DD')}} -->
               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  News Title: {{ news.news_title }}
               </v-card-text>

               <v-card-text class="text-body-2 font-weight-medium py-0 black--text mt-1">
                  News Text: {{ news.news_text }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0 mt-2">
                  Created At: {{ moment(news.created_at).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                      <v-list-item-avatar color="grey darken-3" tile width="300" height="150">
                        <v-img
                          class="elevation-6"
                          :src="'/storage/news_images/' + news.news_image"
                          alt=""
                          position="center center"
                          aspect-ratio="2"
                        ></v-img>
                      </v-list-item-avatar>

                      <v-row
                          justify="end"
                          align="end"
                      >
                          <v-btn
                              :to="'/adminpanel/news/edit/' + news.id"
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
                          <ContentDeleteDialog axios_path="/api/news/destroy/" :content_id="news.id" @content_deleted="news_update($event)" @content_delete_failed="news_delete_failed($event)" />
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
      news: [],
      loading_content: true,
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
      news_update(deleted){
         console.log("delete from admin")
            this.news = this.news.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true

      },

      news_deleted_failed($deleted_id)
      {
        this.error_message = "Server Error !! Failed to Delete Content with ID: " + $deleted_id + "."
        this.error_snackbar = true
      }
   },

   created(){
    axios.get("/api/news/index")
    .then((response) => {
      // console.log(response.data)
      this.news = response.data
      this.loading_content = false
    })
   },
}
</script>

<style>
</style>