<template>
  <div class="pt-3">     
      <div v-if="loading">
         <Loading />
      </div>
      <div v-else>
         <v-row>
            <v-card flat tile class="mx-auto mt-2">
               <v-card-title class="text-center text-h3 blue--text text--darken-4">
                  NEWS
               </v-card-title>
            </v-card>
         </v-row>
         <v-row class="mx-1 py-2 mt-n3">
            <v-col cols="12">
               <v-card min-height="450" class="mx-4 pb-4" elevation="10">
                  <v-card-text class="text-subtitle-1 mt-1 pb-0 orange--text text--darken-3"> HEADLINE: </v-card-text>
                  <v-card-title class="text-h6 mb-1 pt-0">
                     {{ single_news.news_title }}
                  </v-card-title>

                  <v-img                     
                     width="auto"
                     max-height="700"
                     :src="'/storage/news_images/' + single_news.news_image"
                     alt=""
                     position="center center"
                     aspect-ratio="2"
                  ></v-img>

                  <v-card-subtitle class="text-subtitle-1 orange--text text--darken-3">
                     Date Published: {{ moment(single_news.created_at).format('MMMM Do YYYY, h:mm a') }}
                  </v-card-subtitle>

                  <v-card-text class="text-subtitle-1 font-weight-medium black--text">
                     <div class="text-subtitle-1 orange--text text--darken-3"> DETAILS: </div>
                     {{ single_news.news_text }}
                  </v-card-text>
                  
               </v-card>
            </v-col>
         </v-row>
      </div>
   </div>
</template>

<script>
import moment from 'moment'
import Loading from "./components/loading";
export default {
   data: () => ({
      single_news: null,
      moment: moment,
      loading: true,
   }),
   components: {
      Loading
   },
   created() {
      axios
         .get("/api/news/show/" + this.$route.params.id)
         .then((res) => {
            this.single_news = res.data;
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