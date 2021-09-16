<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">
         <div v-if="loading">
            <Loading />
         </div>
         <div v-else class="mb-3">
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
                        >events</v-card-subtitle
                     >
                  </v-card>
               </v-col>
            </v-row>
            <v-row class="mx-1 py-2 mt-n2 mb-2">
               <v-col cols="12">
                  <v-card min-height="450" class="mx-4 pb-4" elevation="10">
                     <v-card-text
                        class="
                           text-subtitle-1
                           mt-1
                           pb-0
                           orange--text
                           text--darken-3
                        "
                     >
                        EVENT NAME:
                     </v-card-text>
                     <v-card-title class="text-h6 mb-1 pt-0">
                        {{ single_event.event_name }}
                     </v-card-title>

                     <v-card-text
                        class="
                           text-subtitle-2
                           mt-n3
                           pb-0
                           orange--text
                           text--darken-3
                        "
                     >
                        EVENT TYPE:
                     </v-card-text>
                     <v-card-title class="text-subtitle-1 mb-1 pt-0">
                        {{ single_event.event_type.event_type }}
                     </v-card-title>

                     <v-img
                        width="auto"
                        :src="'/storage/event_images/' + single_event.event_image"
                        :alt="'Image - ' + single_event.event_image"
                        position="center center"
                        aspect-ratio="2"
                        max-height="700"
                     ></v-img>

                     <v-card-subtitle
                        class="text-subtitle-1 orange--text text--darken-3"
                     >
                        Event Date:
                        {{
                           moment(single_event.event_date).format(
                              "MMMM Do YYYY, h:mm a"
                           )
                        }}
                     </v-card-subtitle>

                     <v-card-text
                        class="text-subtitle-1 font-weight-medium black--text"
                     >
                        <div
                           class="text-subtitle-1 orange--text text--darken-3"
                        >
                           DETAILS:
                        </div>
                        {{ single_event.event_description }}
                     </v-card-text>
                  </v-card>
               </v-col>
            </v-row>
         </div>
      </v-sheet>
   </div>
</template>

<script>
import moment from "moment";
import Loading from "./components/loading";
export default {
   data: () => ({
      single_event: null,
      moment: moment,
      loading: true,
   }),
   components: {
      Loading
   },
   created() {
      axios
         .get("/api/events/show/" + this.$route.params.id)
         .then((res) => {
            this.single_event = res.data;
            this.loading = false;
         })
         .catch((error) => {
            console.log(error);
            // this.errors = error.response.data.errors
            // this.loading = false;
            this.$router.push({ name: "ResourceNotFound" });
         });
   },
};
</script>

<style>
</style>