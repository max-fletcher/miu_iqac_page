<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">
         <div class="pl-4">
            <div v-if="loading">
               <Loading />
            </div>

            <v-row v-else class="mt-3 mb-3 pt-sm-3 pt-md-2">
               <v-col cols="12" md="3" lg="2" class="hidden-sm-and-down">
                  <QuickLinks />
               </v-col>
               <v-col cols="12" md="9" lg="10">
                  <v-card flat class="mx-0 my-0">
                     <v-card-title
                        class="
                           text-h5
                           font-weight-bold
                           blue-grey--text
                           text--darken-3
                           pb-2
                           pl-md-2
                           pt-md-1
                           pl-sm-5
                           pt-sm-0
                           pr-sm-4
                           mb-md-0
                        "
                     >
                        <v-icon large left color="blue-grey darken-3"
                           >mdi-information</v-icon
                        >
                        About Us
                     </v-card-title>
                  </v-card>
                  <v-card
                     v-for="(about_item, index) in about_items"
                     :key="index"
                     flat
                     class="my-md-1 ml-md-0 mr-3"
                  >
                     <v-card-text
                        class="
                           text-h5
                           font-weight-bold
                           pb-0
                           blue-grey--text
                           text--darken-3
                           ml-2 ml-sm-3
                        "
                     >
                        <v-icon left large color="blue-grey darken-3">
                           {{ about_item.icon }}
                        </v-icon>
                        {{ about_item.name }}
                     </v-card-text>
                     <v-card-text
                        class="text-h5 font-weight-regular ml-7 ml-md-10 pr-16"
                     >
                        {{ about_item.content }}
                     </v-card-text>
                  </v-card>
               </v-col>
            </v-row>
         </div>
      </v-sheet>
   </div>
</template>

<script>
import QuickLinks from "./components/quicklinks";
import Loading from "./components/loading";
export default {
   data: () => ({
      about_items: null,
      loading: true,
   }),
   components: {
      QuickLinks,
      Loading,
   },
   created() {
      axios
         .get("/api/about/content/frontend_index")
         .then((res) => {
            this.about_items = res.data;
            this.loading = false;
         })
         .catch((error) => {
            this.loading = false;
         });
   },
};
</script>

<style></style>
