<template>
   <div>
      <!-- {{about_content}} -->
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
            <v-card-title style="word-break: break-word"> About Page Contents </v-card-title>

              <v-spacer></v-spacer>

              <v-btn
                to="/adminpanel/about_content/store"
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

         <v-card flat v-if="about_content.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No About Content Has Been Added Yet</h1>
                     <h2>Add About Content By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(about_content, index) in about_content" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">
              <v-card-title class="py-0">
                <span class="text-h6 font-weight-medium">
                  Title: {{ about_content.name }}
                </span>
              </v-card-title>

              <v-card-text class="text-body-1 font-weight-medium py-0 d-flex align-center">
                <div>
                  Icon Used:
                </div>
                <div class="ml-2">
                  <v-icon left large color="blue-grey darken-3">
                    {{ about_content.icon }}
                  </v-icon>
                </div>
                <div>
                  {{ about_content.icon }}
                </div>
              </v-card-text>

               <v-card-text class="text-body-1 font-weight-medium py-0">
                  Paragraph: {{ about_content.content }}
               </v-card-text>

                <v-card-text class="text-caption font-weight-medium mt-2 py-0">
                    Created At: {{ moment(about_content.created_at).format('MMMM Do YYYY, h:mm a') }}
                </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">


                     <v-row
                        align="center"
                        justify="start"
                        justify-sm="end"
                     >

                           <v-btn
                              :to="'/adminpanel/about_content/edit/' + about_content.id"
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
                           <AboutContentDialog :about_content_id="about_content.id" @about_content_deleted="about_content_update($event)" @about_content_delete_failed="about_content_delete_failed($event)"/>

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
import AboutContentDialog from "./admin_components/about_content_dialog"
export default {
   data: () => ({
      moment: moment,
      about_content: [],
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
      AdminLoading, AboutContentDialog
   },
   methods: {
      // logout() {
      //    axios.post("/api/carouselcontent/index")
      //    .then((response) => {
      //       this.about_content = response.data
      //    });
      // },

      // delete_about_content(id) {
      //    console.log(id)
      //    this.disable_buttons = true
      //    // axios
      //    //    .delete("/api/form/destroy/" + id)
      //    //    .then((res) => {
      //    //       console.log(res.data);
      //    //    }).catch(error => {
      //    //       alert('Internal Error ! Cannot Delete Contact !!');
      //    //    })

      //    //    this.about_content = this.about_content.filter(function(obj) {
      //    //       return obj.id !== id; // Or whatever value you want to use
      //    //    });
      //    this.disable_buttons = false
      //    this.dialog = false
      // }

      about_content_update(deleted){
        this.about_content = this.about_content.filter(function(obj) {
          return obj.id !== deleted.deleted_id; // Or whatever value you want to use
        })

         // console.log(deleted)
         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true
      },

      about_content_delete_failed($deleted_id)
      {
        this.error_message = "Server Error !! Failed to Delete Content with ID: " + $deleted_id + "."
        this.error_snackbar = true
      }
   },

   created() {
      this.loading_content = true,
      axios.get("/api/about/content/index")
         .then((response) => {
            console.log("response");
            this.about_content = response.data
            this.loading_content = false
         });
   },
}
</script>

<style>
</style>