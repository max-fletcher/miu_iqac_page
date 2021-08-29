<template>
   <div>
      {{carousel_content}}
      <div v-if="loading_content">
         <AdminLoading />
      </div>

      <v-card v-else>
         <v-card flat tile outlined width="100%">
            <v-card-title> Carousel Content </v-card-title>
         </v-card>

         <div v-for="(carousel_content, index) in carousel_content" :key="index">
            <v-card tile outlined class="mx-auto px-1 py-1">
               <v-card-title class="py-1">
                  <span class="text-h6 font-weight-medium"> {{ carousel_content.carousel_title }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid placeat sed labore aliquam ut corrupti reprehenderit facilis esse eius quidem. </span>
               </v-card-title>

               <v-card-text class="text-body-1 font-weight-medium py-0">
                  {{ carousel_content.carousel_title }} Lorem ipsum dolor sit amet consectetur adipisicing elit. A totam optio vel eaque nulla omnis, placeat eveniet. Odio, delectus totam.
               </v-card-text>

               <v-card-actions class="py-0">
                  <v-list-item class="grow">

                     <v-list-item-avatar color="grey darken-3" tile width="150" height="100">
                        <v-img
                           class="elevation-6"
                           :src="'/storage/carousel_images/' + carousel_content.carousel_image"
                           alt=""
                           position="center center"
                           aspect-ratio="2"
                        ></v-img>
                     </v-list-item-avatar>

                     <v-row
                        align="center"
                        justify="end"
                     >
                        <v-dialog>
                           <template #activator="{ on: dialog, attrs }">
                              <v-tooltip>
                                 <template #activator="{ on: tooltip }">
                                    <v-btn :disabled="disable_buttons" elevation="2" fab rounded class="ma-1 red darken-4 rounded-1" v-on="{...tooltip, ...dialog }">
                                       <v-icon color="white">
                                          mdi-trash-can
                                       </v-icon>
                                    </v-btn>
                                 <!-- <v-btn v-on="{ ...tooltip, ...dialog }">Button</v-btn> -->
                                 </template>
                                 <span>Tooltip text</span>
                              </v-tooltip>
                           </template>
                           <!-- Dialog Card -->
                           <v-card>
                              <v-card-title class="text-h6">
                                 Are you sure you want to delete this entry ??
                              </v-card-title>
                              <v-card-text class="text-subtitle-1 red--text text--accent-4 py-0">
                                 (Click Outside To Exit)
                              </v-card-text>
                              <!-- <v-card-text class="text-subtitle-1">
                              </v-card-text> -->

                              <v-card-actions>
                                 <v-spacer></v-spacer>
                                 <v-btn
                                    color="red accent-4"
                                    text
                                    :disabled="disable_buttons"
                                    :loading="disable_buttons"
                                    @click.prevent = "delete_carousel_content(carousel_content.id)"
                                 >
                                    DELETE
                                 </v-btn>
                                 
                              </v-card-actions>
                           </v-card>
                           <!-- End Dialog Card -->
                        </v-dialog>

                        <v-tooltip top>
                           <template v-slot:activator="{ on, attrs }">
                              <v-btn :to="'/adminpanel/carousel_content/' + carousel_content.id" :disabled="disable_buttons" elevation="2" v-on="on" fab rounded class="ma-1 indigo darken-3 rounded-1">
                                 <v-icon color="white">
                                    mdi-clipboard-edit
                                 </v-icon>
                              </v-btn>
                           </template>
                           <span>EDIT</span>
                        </v-tooltip>

                     </v-row>

                  </v-list-item>
               </v-card-actions>
            </v-card>
         </div>
      </v-card>
   </div>
</template>

<script>
import AdminLoading from "./admin_components/admin_loading"
export default {
   data: () => ({
      cards: ["Today", "Yesterday"],
      carousel_content: [],
      loading_content: false,
      dialog: false,
      disable_buttons: false,
   }),
   components: {
      AdminLoading
   },
   methods: {
      // logout() {
      //    axios.post("/api/carouselcontent/index")
      //    .then((response) => {
      //       this.carousel_content = response.data
      //    });
      // },
      delete_carousel_content(id) {
         console.log(id)
         this.disable_buttons = true
         // axios
         //    .delete("/api/form/destroy/" + id)
         //    .then((res) => {
         //       console.log(res.data);
         //    }).catch(error => {
         //       alert('Internal Error ! Cannot Delete Contact !!');
         //    })

         //    this.carousel_content = this.carousel_content.filter(function(obj) {
         //       return obj.id !== id; // Or whatever value you want to use
         //    });
         this.disable_buttons = false
         this.dialog = false
      }
   },
   created() {
      this.loading_content = true,
      axios.get("/api/carouselcontent/index")
         .then((response) => {
            console.log("response");
            this.carousel_content = response.data
            this.loading_content = false
         });
   },
};
</script>

<style>
</style>