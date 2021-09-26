<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">
         <div class="pt-3 pb-7 mx-md-16">
            <v-row>
               <v-col v-if="loading">
                  <Loading />
               </v-col>

               <v-col v-else cols="12" class="px-6 pt-3">

                  <v-carousel
                     height="auto"
                     cycle
                     interval="5500"
                     show-arrows-on-hover
                     hide-delimiters
                  >
                     <v-carousel-item
                        v-for="(item, index) in items"
                        :key="index"
                     >
                        <v-img
                           :alt="item.carousel_image"
                           :src="
                              '/storage/carousel_images/' + item.carousel_image
                           "
                           aspect-ratio="1.77"
                           width="auto"
                           max-height="700"
                        >
                           <v-container fill-height fluid class="px-0 py-0">
                              <v-layout fill-height align-end>
                                 <v-flex>
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
                                       <div
                                          class="
                                             font-weight-medium
                                             text-center text-subtitle-1
                                             orange--text
                                             text--darken-3
                                          "
                                       >
                                          {{ item.carousel_subtitle }}
                                       </div>
                                    </v-alert>

                                    <v-alert
                                       text
                                       color="black darken-2"
                                       class="
                                          text-h6
                                          mb-0
                                          py-1
                                          hidden-sm-and-up
                                       "
                                       tile
                                       max-height="100"
                                    >
                                       <div
                                          class="
                                             text-center text-subtitle-2
                                             orange--text
                                             text--darken-3
                                          "
                                       >
                                          {{ item.carousel_title }}
                                       </div>
                                       <div
                                          class="
                                             text-center text-caption
                                             orange--text
                                             text--darken-3
                                          "
                                       >
                                          {{ item.carousel_subtitle }}
                                       </div>
                                    </v-alert>
                                 </v-flex>
                              </v-layout>
                           </v-container>
                        </v-img>
                     </v-carousel-item>
                  </v-carousel>
               </v-col>
            </v-row>
            <v-row
               v-if="!loading"
               class="mx-1 ml-md-0 mt-n8 mt-md-1 mb-n5"
               justify="space-around"
            >
               <v-col cols="3">
                  <QuickLinks />
               </v-col>

               <v-col cols="12" md="9" class="">
                  <v-card class="pl-0 ml-0 mt-md-0">
                     <div class="d-flex flex-sm-row flex-column pa-3">
                        <v-img
                           max-width="500"
                           min-width="250"
                           class="rounded-md"
                           src="/images/head.jpg"
                           alt=""
                           position="center center"
                           aspect-ratio="1.18">
                        </v-img>
                        
                        <div class="ml-0 ml-sm-2 pa-2">
                           <div>
                              <div class="font-weight-bold blue--text text--darken-4 text-h6">
                                 Message From The Head Of The IQAC
                              </div>
                              <div class="font-weight-medium blue--text text--darken-4">
                                 Head and Professor
                              </div>
                              <div class="font-weight-medium blue--text text--darken-4">
                                 Institutional Quality Assurance Cell
                              </div>
                           </div>
                           <div class="mt-3 font-weight-medium blue-grey--text text--darken-3">
                              I take this opportunity to welcome all the students of the School of Business & Economics and their guardians for choosing Manarat International University (MIU) as the highest seat of learning. MIU has been established with the noble objective of building a knowledge-based society by imparting world class education. I realize that you have many choices and choosing where you will complete your BBA/MBA program can be an overwhelming experience. Our endeavor is to provide you with important information regarding BBA/MBA and the School of Business & Economics of MIU.
                           </div>
                        </div>
                     </div>
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
      items: [],
      loading: true,
   }),
   components: {
      QuickLinks,
      Loading,
   },
   created() {
      axios.get("/api/publication_token/clear_tokens");

      axios
         .get("/api/carouselcontent/frontend_index")
         .then((res) => {
            this.items = res.data;
            this.loading = false;
         })
         .catch((error) => {
            this.loading = false;
         });
   },
};
</script>

<style>

</style>
