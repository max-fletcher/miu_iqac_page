<template>
   <div>
      <TopBar />
      
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <div v-if="loading">
         <Loading />
      </div>
      <div v-else class="mb-5">
         <v-row class="mx-2 pt-4" no-gutters>
            <v-col cols="12">
               <v-card flat tile class="mx-auto px-0">
                  <v-card-subtitle
                     class="
                        text-center text-h3
                        blue--text
                        text--darken-4
                        py-0                           
                        mb-2
                        pl-lg-4
                        text-uppercase
                     "
                  >all events</v-card-subtitle>
               </v-card>
            </v-col>
         </v-row>

         <v-row class="mt-0 px-6">
            <v-col md="3" lg="2" class="hidden-sm-and-down">
               <QuickLinks />
            </v-col>

            <v-col cols="12" md="9" lg="10">

               <v-card rounded="0" class="mb-2">
                  <v-alert
                     color="green accent-4"
                     class="px-0 py-0 mx-0 my-0"
                     rounded="0"
                     outlined
                     text
                  >
                     <v-card-title>
                        <v-icon left color="green accent-4">
                           mdi-calendar-star
                        </v-icon>
                        Upcoming Events
                     </v-card-title>
                  </v-alert>
               </v-card>

               <v-card
                  v-if="events.upcoming_events.length === 0"
                  rounded="0"
                  class="mb-3 mx-3"
               >
                  <v-alert
                     color="green accent-4"
                     class="px-3 py-4 mx-0 my-0"
                     rounded="0"
                     outlined
                     text
                  >
                     <v-row>
                        <v-col cols="12" class="pt-0 pb-0">
                           <div
                              class="
                                 text-subtitle-1
                                 font-weight-medium
                                 text-center
                              "
                           >
                              <v-icon left color="green accent-4">
                                 mdi-close
                              </v-icon>
                              No Upcoming Events
                           </div>
                        </v-col>
                     </v-row>
                  </v-alert>
               </v-card>

               <v-card
                  v-else
                  v-for="(upcoming_event, index) in events.upcoming_events"
                  :key="index"
                  :to="'/events/single_event/' + upcoming_event.id"
                  rounded="0"
                  class="mb-3 mx-3"
               >
                  <v-alert
                     color="green accent-4"
                     class="px-3 py-4 mx-0 my-0"
                     rounded="0"
                     outlined
                     text
                  >
                     <v-row justify="space-between">
                        <v-col cols="12" sm="6" class="pt-0 pb-0">
                           <div
                              class="
                                 text-subtitle-1
                                 font-weight-medium
                              "
                           >
                              <v-icon
                                 left
                                 color="green accent-4"
                                 small
                              >
                                 mdi-calendar-arrow-right
                              </v-icon>
                              {{ upcoming_event.event_name }}
                           </div>
                        </v-col>
                        
                        <v-col cols="12" sm="6" class="pt-0 pb-0">
                           <div
                              class="
                                 text-subtitle-1
                                 font-weight-medium                                                
                                 text-sm-right
                              "
                           >
                              Date :
                              {{ moment( upcoming_event.event_date).format("MMMM Do YYYY, h:mm a") }}
                           </div>
                        </v-col>
                     </v-row>
                  </v-alert>
               </v-card>

               <v-card rounded="0" class="mb-2">
                  <v-alert
                     color="deep-orange darken-2"
                     class="px-0 py-0 mx-0 my-0"
                     rounded="0"
                     outlined
                     text
                  >
                     <v-card-title>
                        <v-icon left color="deep-orange darken-2">
                           mdi-calendar-remove
                        </v-icon>
                        Passed Events
                     </v-card-title>
                  </v-alert>
               </v-card>

               <v-card
                  v-if="events.passed_events.length === 0"
                  rounded="0"
                  class="mb-3 mx-3"
               >
                  <v-alert
                     color="deep-orange darken-2"
                     class="px-3 py-4 mx-0 my-0"
                     rounded="0"
                     outlined
                     text
                  >
                     <v-row>
                        <v-col cols="12" class="pt-0 pb-0">
                           <div
                              class="
                                 text-subtitle-1
                                 font-weight-medium
                                 text-center
                              "
                           >
                              <v-icon
                                 left
                                 color="deep-orange darken-2"
                              >
                                 mdi-close
                              </v-icon>
                              No Passed Events
                           </div>
                        </v-col>
                     </v-row>
                  </v-alert>
               </v-card>

               <v-card
                  v-else
                  v-for="(passed_event, index) in events.passed_events"
                  :key="index"
                  :to="'/events/single_event/' + passed_event.id"
                  rounded="0"
                  class="mb-3 mx-3"
               >
                  <v-alert
                     color="deep-orange darken-2"
                     class="px-3 py-4 mx-0 my-0"
                     rounded="0"
                     outlined
                     text
                  >
                     <v-row justify="space-between">
                        <v-col cols="12" sm="6" class="pt-0 pb-0">
                           <div
                              class="
                                 text-subtitle-1
                                 font-weight-medium
                              "
                           >
                              <v-icon
                                 left
                                 color="deep-orange darken-2"
                                 small
                              >
                                 mdi-calendar-arrow-left
                              </v-icon>
                              {{ passed_event.event_name }}
                           </div>
                        </v-col>
                        
                        <v-col cols="12" sm="6" class="pt-0 pb-0">
                           <div
                              class="
                                 text-subtitle-1
                                 font-weight-medium                                                
                                 text-sm-right
                              "
                           >
                              Date :
                              {{ moment( passed_event.event_date).format("MMMM Do YYYY, h:mm a") }}
                           </div>
                        </v-col>
                     </v-row>
                  </v-alert>
               </v-card>
            </v-col>
         </v-row>
      </div>
   </v-sheet>

   </div>
</template>

<script>
import moment from "moment";
import TopBar from './components/topbar';
import QuickLinks from "./components/quicklinks";
import Loading from "./components/loading";
export default {
   data: () => ({
      events: [],
      passed_events: [],
      moment: moment,
      loading: true,
      not_found: false,
   }),
   components: {
      QuickLinks, Loading, TopBar
   },
   created() {
      axios
         .get(
            "/api/events/types/show_sorted/" + this.$route.params.id
         )
         .then((res) => {
            // console.log(res);
            this.events = res.data;
            this.loading = false;
         })
         .catch((error) => {
            // console.log(error);
            // this.errors = error.response.data.errors
            this.$router.push({ name: 'ResourceNotFound' })
         });
   },
};
</script>

<style>
</style>