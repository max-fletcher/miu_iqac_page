<template>
   <div>
      <!-- {{people}} -->
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
            <v-card-title> People Section </v-card-title>

               <v-spacer></v-spacer>

               <v-btn
                  to="/adminpanel/people/store"
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

         <div v-for="(people, index) in people" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-2">
               <v-card-title class="py-0">
                  <span class="text-h6 font-weight-medium">
                     Title: {{ people.name }}
                  </span>
               </v-card-title>

               <v-card-text class="text-body-1 font-weight-medium py-0">
                  ID: {{ people.id }}
               </v-card-text>

               <v-card-text class="text-caption font-weight-medium py-0">
                  Created At: {{ moment(people.created_at).format('MMMM Do YYYY, h:mm a') }}
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
                              :to="'/adminpanel/members/' + people.id"
                              :disabled="disable_buttons"
                              elevation="2"
                              class="ma-1 green darken-1 rounded-1 white--text"
                           >
                              <v-icon left color="white">
                                 mdi-account
                              </v-icon>
                              View Members
                           </v-btn>

                           <v-btn
                              :to="'/adminpanel/people/edit/' + people.id"
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
                           <PeopleSectionDialog :people_section_id="people.id" @people_section_deleted="people_update($event)" @people_section_delete_failed="people_section_delete_failed($event)" />

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
import PeopleSectionDialog from "./admin_components/people_section_dialog"
export default {
   data: () => ({
      moment: moment,
      people: [],
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
      AdminLoading, PeopleSectionDialog
   },
   methods: {
      // logout() {
      //    axios.post("/api/carouselcontent/index")
      //    .then((response) => {
      //       this.people = response.data
      //    });
      // },

      // delete_people(id) {
      //    console.log(id)
      //    this.disable_buttons = true
      //    // axios
      //    //    .delete("/api/form/destroy/" + id)
      //    //    .then((res) => {
      //    //       console.log(res.data);
      //    //    }).catch(error => {
      //    //       alert('Internal Error ! Cannot Delete Contact !!');
      //    //    })

      //    //    this.people = this.people.filter(function(obj) {
      //    //       return obj.id !== id; // Or whatever value you want to use
      //    //    });
      //    this.disable_buttons = false
      //    this.dialog = false
      // }

      people_update(deleted){
            this.people = this.people.filter(function(obj) {
            return obj.id !== deleted.deleted_id; // Or whatever value you want to use
         })

         this.delete_success_message = deleted.delete_message
         this.delete_success_snackbar = true

      },

      people_section_delete_failed($deleted_id)
      {
        this.error_message = "Server Error !! Failed to Delete Content with ID: " + $deleted_id + "."
        this.error_snackbar = true
      }
   },

   created() {
      this.loading_content = true,
      axios.get("/api/people/index")
         .then((response) => {
            console.log("response");
            this.people = response.data
            this.loading_content = false
         });
   },
}
</script>

<style>
</style>