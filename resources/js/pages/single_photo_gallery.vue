<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <div v-if="loading">
         <Loading />
      </div>
      <div v-else>
         <v-card flat v-if="photos.gallery_photos.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Photos Have Been Added To The Gallery Yet !!</h1>
                     <h2>Add Photos To This Gallery From The Admin Panel.</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>
         <div v-else class="pb-2">
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
                     >{{ photos.gallery_name }}</v-card-subtitle>
                        <div class="text-body-2 red--text font-weight-bold mb-2 text-center mt-4">
                           Click On the Images For Full Size View
                        </div>
                  </v-card>
               </v-col>
            </v-row>
            <v-row class="mx-1 py-2 mt-n2">
               <v-col
                  v-for="(photo, index) in photos.gallery_photos"
                  :key="index"
                  cols="12"
                  sm="6"
                  md="4"
               >               
                  <v-card flat>
                     <v-img
                        :src="photo.src"
                        :alt="'Image - ' + photo.src"
                        @click="showSingle(photo.src, photo.title, index)"
                        aspect-ratio="1"
                     >
                     </v-img>
                     <v-card-text class="font-weight-medium text-subtitle-2 pt-1">
                        {{ photo.title }}
                     </v-card-text>
                  </v-card>
               </v-col>
            </v-row>

            <vue-easy-lightbox
               escDisabled
               :visible="visible"
               :imgs="photos.gallery_photos"
               :index="index"
               @hide="handleHide"
            >
            </vue-easy-lightbox>
         </div>
      </div>
      </v-sheet>
   </div>
</template>

<script>
import VueEasyLightbox from "vue-easy-lightbox";
import Loading from "./components/loading";
export default {
   components: {
      VueEasyLightbox, Loading
   },
   data() {
      return {
         photos: "",
         single_photo: "",
         title: "",
         visible: false,
         index: 0,
         loading: true,         
      };
   },
   methods: {
      showSingle(photo, title, index) {
         this.single_photo = photo;
         this.title = title;
         this.index = index;
         this.show();
      },

      show() {
         this.visible = true;
      },
      handleHide() {
         this.visible = false;
      },
   },
   created() {

      axios
         .get("/api/gallery/name/show/" + this.$route.params.id)
         .then((res) => {
            this.photos = res.data;
            this.loading = false;
         })
         .catch((error) => {
            this.$router.push({ name: 'ResourceNotFound' })
         });
   },
};
</script>