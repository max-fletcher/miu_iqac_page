<template>
   <div class="pt-3 pb-7 mx-md-16">
      <v-row>
         <v-col v-if="loading">
            <Loading />
         </v-col>

         <v-col v-else cols="12" class="px-6 pt-3">

            <!-- <v-row class="mx-1">
               <v-col md="3" lg="2" class="hidden-sm-and-down">
                  <QuickLinks />
               </v-col>
               <v-col cols="12" md="9" lg="10"> -->
                           
                  <v-carousel height="auto" cycle interval="5500" show-arrows-on-hover hide-delimiters>
                     <v-carousel-item v-for="(item, index) in items" :key="index">
                        <v-img
                           :src="'/storage/carousel_images/' + item.carousel_image"
                           aspect-ratio="1.77"
                           width="auto"
                           max-height="700"
                        >
                           <v-container fill-height fluid class="px-0 py-0">
                              <v-layout fill-height align-end>
                                 <v-flex>
                                    <!-- For sm and up devices -->
                                    <v-alert
                                       text
                                       color="black darken-2"
                                       class="
                                          font-weight-bold
                                          text-h6
                                          mb-0
                                          hidden-xs-only
                                       "
                                       tile
                                       max-height="100"
                                    >
                                       <div
                                          class="
                                             font-weight-medium
                                             text-center text-h6
                                             orange--text
                                             text--darken-3
                                          "
                                       >
                                          {{ item.carousel_title }}
                                       </div>
                                       <div class="font-weight-medium
                                             text-center
                                             text-subtitle-1
                                             orange--text
                                             text--darken-3">
                                          {{ item.carousel_subtitle }}
                                       </div>
                                    </v-alert>

                                    <!-- For xs devices -->
                                    <v-alert
                                       text
                                       color="black darken-2"
                                       class="text-h6 mb-0 py-1 hidden-sm-and-up"
                                       tile
                                       max-height="100"
                                    >
                                       <div class="text-center text-subtitle-2
                                             orange--text
                                             text--darken-3">
                                          {{ item.carousel_title }}
                                       </div>
                                       <div class="text-center text-caption
                                             orange--text
                                             text--darken-3">
                                          {{ item.carousel_subtitle }}
                                       </div>
                                    </v-alert>
                                 </v-flex>
                              </v-layout>
                           </v-container>
                        </v-img>
                     </v-carousel-item>
                  </v-carousel>
               <!-- </v-col>
            </v-row> -->

         </v-col>
      </v-row>
      <v-row v-if="!loading" class justify="space-around ml-1 ml-md-0 mr-1 mr-md-3">
         <v-col cols="3">
            <QuickLinks />
         </v-col>
         <v-col cols="12" md="9" class="black mt-0 mt-md-3">
            <v-card class="pl-0 ml-0 mt-md-0">
               Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut
               eaque eius alias fugit cum obcaecati aliquam nihil facilis itaque
               dignissimos quis explicabo, voluptatem repudiandae et! Quod hic
               architecto fugit qui.
            </v-card>
         </v-col>
      </v-row>
   </div>
</template>

<script>
import QuickLinks from "./components/quicklinks";
import Loading from "./components/loading";
// import TopNav from './topnav'
export default {
   data: () => ({
      items: [],
      loading: true
   }),
   components: {
      QuickLinks, Loading
   },
   created() {

      axios
         .get("/api/publication_token/clear_tokens")

      axios
         .get("/api/carouselcontent/frontend_index")
         .then((res) => {
            // console.log(res);
            this.items = res.data;
            this.loading = false
         })
         .catch((error) => {
            // console.log(error);
            // this.errors = error.response.data.errors
            this.loading = false
         });
   },
};
</script>

<style></style>
