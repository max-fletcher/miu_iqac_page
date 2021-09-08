<template>
   <div>
      <!-- {{ members }} -->
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
            <v-card-title> Members Section - {{ members.name }} </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  :to="'/adminpanel/people/'+ this.$route.params.people_id +'/members/store'"
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

         <v-card flat v-if="members.members.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Members For This Section Has Been Added Yet</h1>
                     <h2>Add Memebers By Clicking the "Create New" Button Above</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>

         <div v-else v-for="(member, index) in members.members" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Name: {{ member.name }}
               </v-card-text>

               <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Designation: {{ member.designation }}
               </v-card-text>

                <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Contact No: {{ member.cell_number }}
               </v-card-text>

                <v-card-text class="text-body-1 font-weight-medium py-0 black--text">
                  Email Address: {{ member.email }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(member.created_at).format('MMMM Do YYYY, h:mm a') }}
               </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                      <v-list-item-avatar color="grey darken-3" tile width="120" height="150">
                        <v-img
                          class="elevation-6"
                          :src="'/storage/member_images/' + member.member_image"
                          alt=""
                          position="center center"
                          aspect-ratio="0.9"
                        ></v-img>
                      </v-list-item-avatar>

                      <v-row
                          justify="end"
                          align="end"
                      >
                              <v-btn
                                  :to="'/adminpanel/people/'+ $route.params.people_id +'/members/edit/' + member.id"
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
                              <ContentDeleteDialog axios_path="/api/people/members/destroy/" :content_id="member.id" @content_deleted="members_update($event)" @content_delete_failed="member_delete_failed($event)" />
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
      members: [],
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

      members_update(deleted){
            this.members.members = this.members.members.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true

      },

      member_delete_failed($deleted_id)
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
      axios.get("/api/people/show/"+ this.$route.params.people_id)
         .then((response) => {
            console.log("response");
            this.members = response.data
            this.loading_content = false
         })
         .catch((error) => {
            this.$router.push('/adminpanel/people?nodata=nodatafound')
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