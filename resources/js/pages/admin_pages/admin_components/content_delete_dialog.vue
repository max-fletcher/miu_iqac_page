<template>
   <div>
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
                  @click.prevent = "delete_content(axios_path ,content_id)"
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
   props: ['axios_path' ,'content_id'],
   data: () => ({
      dialog: false,
      disable_buttons: false,
   }),
      methods: {
      delete_content(axios_path, id) {
         console.log( " Delete From Dialog "+ id )
         this.disable_buttons = true

         axios.delete( axios_path + id )
            .then((res) => {
               console.log(res.data)
               this.dialog = false
               this.disable_buttons = false
               this.$emit('content_deleted', { deleted_id: id, delete_message: res.data} )
            }).catch(error => {
               console.log('failed')
               this.dialog = false
               this.disable_buttons = false
               this.$emit('content_delete_failed', id)
            })

         
      }
   },
}
</script>

<style>

</style>