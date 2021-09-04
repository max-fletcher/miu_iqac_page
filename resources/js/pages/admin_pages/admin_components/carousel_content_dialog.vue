<template>
   <div>
      <!-- {{ carousel_content_id }}
      {{ dialog }}
      {{ disable_buttons }} -->

      <v-btn
         @click.prevent="dialog = true"
         :disabled="disable_buttons"
         elevation="2"
         class="ma-1 red darken-4 rounded-1 white--text"
      >
         <v-icon left color="white">
            mdi-trash-can
         </v-icon>
         DELETE
      </v-btn>

      <v-dialog v-model="dialog">
         <v-card>
            <v-card-title class="text-h6">
               Are you sure you want to delete this entry ??
            </v-card-title>
            <!-- <v-card-text class="text-subtitle-1">
            </v-card-text> -->

            <v-card-actions>
               <v-spacer></v-spacer>

               <v-btn
                  color="blue-grey darken-3"
                  text
                  :disabled="disable_buttons"
                  :loading="disable_buttons"
                  @click.prevent = "dialog = false"
               >
                  CANCEL
               </v-btn>

               <v-btn
                  color="red accent-4"
                  text
                  :disabled="disable_buttons"
                  :loading="disable_buttons"
                  @click.prevent = "delete_carousel_content(carousel_content_id)"
               >
                  DELETE
               </v-btn>
               
            </v-card-actions>
         </v-card>
      </v-dialog>
   </div>
</template>

<script>
export default {
   props: ['carousel_content_id'],
   data: () => ({
      dialog: false,
      disable_buttons: false
   }),
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

         // this.$emit('carousel_content_deleted', id)

         axios.delete( "/api/carouselcontent/destroy/" + id )
            .then((res) => {
               console.log(res.data);
               this.dialog = false
               this.disable_buttons = false
               this.$emit('carousel_content_deleted', { deleted_id: id, delete_message: res.data} )
            }).catch(error => {
               this.dialog = false
               this.disable_buttons = false
               this.$emit('carousel_content_delete_failed', id)
            })

            // this.carousel_content = this.carousel_content.filter(function(obj) {
            //    return obj.id !== id; // Or whatever value you want to use
            // });
         
      }
   },
}
</script>

<style>

</style>