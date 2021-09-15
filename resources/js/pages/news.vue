<template>
<div>
   <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

   <div v-if="loading">
      <Loading />
   </div>
   
   <div v-else class="pb-4">
      <v-card flat v-if="news.length === 0" height="480" min-height="300">
         <v-container fill-height fluid>
            <v-row align="center" justify="center">
               <div class="text-center">
                  <h1>No News Has Been Added Yet</h1>
                  <h2>Add News From The Admin Panel</h2>
               </div>
            </v-row>
         </v-container>
      </v-card>
      <div v-else>
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
                  >all news</v-card-subtitle>
               </v-card>
            </v-col>
         </v-row>

         <v-row class="mx-2 mt-0">
            <v-col cols="12">
               <v-row class="mx-1">
                  <v-col md="3" lg="2" class="hidden-sm-and-down">
                     <QuickLinks />
                  </v-col>
                  <v-col cols="12" md="9" lg="10">
                     <div v-for="(single_news, index) in news" :key="index" class="mb-3">
                        <v-card width="auto" height="120" outlined class="d-flex align-center pa-auto" :to="'/news/single_news/' + single_news.id" :style="cardBorderColor">
                           <v-avatar
                              size="100"
                              tile
                              rounded
                              class="ml-2"
                           >
                              <v-img                  
                                 :src="'/storage/news_images/' + single_news.news_image"
                                 :alt="single_news.news_title"
                                 position="center center"                        
                              ></v-img>
                           </v-avatar>

                           <div>
                           <!-- Title For Xs -->
                              <v-card-title class="text-subtitle-1 font-weight-bold d-flex d-sm-none text-wrap">
                                 {{ single_news.news_title | truncate_title_xs }}
                              </v-card-title>
                           <!-- Title For Sm -->
                              <v-card-title class="text-subtitle-1 font-weight-bold d-none d-sm-flex d-md-none text-wrap">
                                 {{ single_news.news_title | truncate_title_sm }}
                              </v-card-title>
                           <!-- Title For Md -->
                              <v-card-title class="text-subtitle-1 font-weight-bold d-none d-md-flex d-lg-none text-wrap">
                                 {{ single_news.news_title | truncate_title_md }}
                              </v-card-title>
                           <!-- Title For XL and up -->
                              <v-card-title class="text-subtitle-1 font-weight-bold d-none d-lg-flex d-xl-none text-wrap">
                                 {{ single_news.news_title }}
                              </v-card-title>
                              <v-card-subtitle
                                 class="font-weight-bold text-no-wrap"
                              > {{ moment(single_news.created_at).format('MMMM Do YYYY, h:mm a') }}
                              </v-card-subtitle>
                           </div>
                        </v-card>
                     </div>
                  </v-col>
               </v-row>
            </v-col>
         </v-row>
      </div>
   </div>
   </v-sheet>
</div>
</template>

<script>
import moment from 'moment'
import QuickLinks from "./components/quicklinks";
import Loading from "./components/loading";
export default {
   data: () => ({
      news:[],
      moment: moment,
      loading: true,
   }),
   components: {
      QuickLinks, Loading
   },
   computed: {
      cardBorderColor: function(){
         return {border: '1px solid #4270a9'}
      }
   },
   created() {
      axios
         .get("/api/news/frontend_index")
         .then((res) => {
            this.news = res.data;
            this.loading = false;
         })
         .catch((error) => {
            // console.log(error);
            // this.errors = error.response.data.errors
            this.loading = false;
         });
   },
};
</script>

<style>
</style>