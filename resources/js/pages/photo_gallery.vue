<template>
   <div>

      <TopBar />

      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <div v-if="loading">
         <Loading />
      </div>
      <div v-else>
         <v-card flat v-if="photo_galleries.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Galleries Has Been Added Yet</h1>
                     <h2>Add Galleries From The Admin Panel</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>
         <div v-else class="pb-3">
  
            <v-row class="mx-2 mt-2 pt-4" no-gutters>
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
                     >all photo galleries</v-card-subtitle>
                  </v-card>
               </v-col>
            </v-row>

            <v-row class="px-2" no-gutters>
               <v-col v-for="(photo_gallery, index) in photo_galleries" :key="index" cols="12" sm="6" class="px-2 my-3">
                  <v-card
                     class="mx-auto"
                     :to="'/single-gallery/' + photo_gallery.id"
                  >
                     <v-img
                        :src="'/storage/gallery_cover_photos/' + photo_gallery.gallery_cover_photo"                           
                        width="auto"
                        aspect-ratio="1.77"
                     ></v-img>
                     <v-card-title class="text-h6">
                        {{ photo_gallery.gallery_name }}
                     </v-card-title>
                     <v-card-subtitle class="text-subtitle-1 font-weight-medium orange--text text--darken-4">
                        Created: {{  moment(photo_gallery.created_at).format('MMMM Do YYYY, h:mm a') }}
                     </v-card-subtitle>
                  </v-card>
               </v-col>
            </v-row>

         </div>
      </div>
      </v-sheet>
   </div>
</template>

<script>
import moment from 'moment'
import TopBar from "./components/topbar";
import Loading from "./components/loading";
export default {
   data: () => ({
      photo_galleries:[],
      moment: moment,
      loading: true,
      show: false,
   }),
   components: {
      Loading, TopBar
   },
   created() {
      axios
         .get("/api/gallery/name/index")
         .then((res) => {            
            this.photo_galleries = res.data;
            this.loading = false;
         })
         .catch((error) => {
            console.log(error);
            // this.errors = error.response.data.errors
            this.loading = false;
         });
   },
};
</script>

<style>

</style>