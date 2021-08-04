<template>
  <div>
     <v-card rounded="0" class="my-1">
      <v-alert color="teal accent-4" class="px-0 py-0 mx-0 my-0" rounded="0" text>
         <v-card-title class="py-1 text-subtitle-1 font-weight-medium">
         <v-icon left color="teal accent-4">
            mdi-file-pdf-box
         </v-icon>
            Resource Name
         </v-card-title>
      </v-alert>
     </v-card>

      <v-card rounded="0" class="mb-1">
         <v-alert
            color="green accent-4"
            class="px-0 py-0 mx-0 my-0"
            rounded="0"
            text
         >
            <v-card-title>
               <v-icon left color="green accent-4">
                  mdi-calendar-star
               </v-icon>
               Upcoming Events
            </v-card-title>
         </v-alert>
      </v-card>

      <v-card rounded="0" class="mb-3 mx-3">
         <v-alert
            color="green accent-4"
            class="px-3 py-4 mx-0 my-0"
            rounded="0"            
            text
         >
         <v-row>                  
            <v-col cols="12" class="pt-0 pb-0">
               <div class="text-subtitle-1 font-weight-medium text-center">
               <v-icon left color="green accent-4">
                  mdi-close
               </v-icon>
                  No Upcoming Events
               </div>
            </v-col>                    
         </v-row>
         </v-alert>
      </v-card>

      <v-card rounded="0" class="mb-4">
         <v-alert
            color="deep-orange darken-2"
            class="px-0 py-0 mx-0 my-0"
            rounded="0"            
            text
         >
            <v-card-title>
               <v-icon left color="deep-orange darken-2">
                  mdi-calendar-remove
               </v-icon>
               Passed Events
            </v-card-title>
         </v-alert>
      </v-card>

      <v-card rounded="0" class="mb-3 mx-3">
         <v-alert
               color="deep-orange darken-2"
               class="px-3 py-4 mx-0 my-0"
               rounded="0"
               text
         >
         <v-row>
            <v-col cols="12" class="pt-0 pb-0">
               <div class="text-subtitle-1 font-weight-medium text-center">
               <v-icon left color="deep-orange darken-2">
                     mdi-close
               </v-icon>
                  No Passed Events
               </div>
            </v-col>                    
         </v-row>
         </v-alert>
      </v-card>

      Something....

      <v-card rounded="0" class="mb-4">
         <v-alert
            color="teal accent-4"
            class="px-0 py-0 mx-0 my-0"
            rounded="0"
            text
         >
            <v-card-title>
               <v-icon left color="teal accent-4">
                  mdi-calendar-star
               </v-icon>
               Something Events
            </v-card-title>
         </v-alert>
      </v-card>
      <v-card rounded="0" class="mb-2" color="teal lighten-5">
         <v-alert
            color="teal accent-4"
            class="px-0 py-0 mx-0 my-0"
            rounded="0"
            outlined
         >
            <v-card-title>
               <v-icon left color="teal accent-4">
                  mdi-calendar-star
               </v-icon>
               Something Events
            </v-card-title>
         </v-alert>
      </v-card>

      <br><br><br>

      Scrapped/Reference Cards

      <v-card rounded="0" class="mb-4">
         <v-alert color="teal accent-4" class="px-0 py-0 mx-0 my-0" rounded="0" text>
         <v-card-title class="py-1 text-subtitle-1 font-weight-medium">
            <v-icon left color="teal accent-4" small>
               mdi-file-outline
            </v-icon>
               Something Events
         </v-card-title>
         </v-alert>
      </v-card>

      <v-card rounded="0" class="mb-2" color="teal lighten-5">
         <v-alert
            color="teal accent-4"
            class="px-0 py-0 mx-0 my-0"
            rounded="0"
            outlined
         >
            <v-card-title
               class="py-1 text-subtitle-1 font-weight-medium"
            >
               <v-icon left color="teal accent-4" small>
                  mdi-file-outline
               </v-icon>
               Something Events
            </v-card-title>
         </v-alert>
      </v-card>

         <v-card rounded="0" class="mb-2" color="deep-orange lighten-5">
         <v-alert
            color="deep-orange darken-2"
            class="px-0 py-0 mx-0 my-0"
            rounded="0"
            outlined
         >
            <v-card-title>
               <v-icon left color="deep-orange darken-2">
                  mdi-calendar-remove
               </v-icon>
               Passed Events
            </v-card-title>
         </v-alert>
      </v-card>

      <v-card rounded="0" class="mb-3 mx-3">
         <v-alert
            color="deep-orange darken-2"
            class="px-3 py-4 mx-0 my-0"
            rounded="0"
            outlined
            text
         >
         <v-row>                  
            <v-col cols="12" md="9" class="pt-0 pb-0">
            <div class="text-subtitle-1 font-weight-medium">
               <v-icon left color="deep-orange darken-2" small>
                  mdi-calendar-arrow-left
               </v-icon>
                  Event Name
            </div>
            </v-col>
            <v-col cols="12" md="3" class="pt-0 pb-0">
            <div class="text-subtitle-1 font-weight-medium">
               Date : {{ moment().format('MMMM Do YYYY, h:mm a') }}
            </div>
            </v-col>
         </v-row>
         </v-alert>
      </v-card>

      <v-card rounded="0" class="mb-3 mx-3">
         <v-alert
            color="green accent-4"
            class="px-3 py-4 mx-0 my-0"
            rounded="0"
            outlined
            text
         >
         <v-row>                  
            <v-col cols="12" md="9" class="pt-0 pb-0">
               <div class="text-subtitle-1 font-weight-medium">
               <v-icon left color="green accent-4" small>
                  mdi-calendar-arrow-right
               </v-icon>
                  Event Name
               </div>
            </v-col>
            <v-col cols="12" md="3" class="pt-0 pb-0">
               <div class="text-subtitle-1 font-weight-medium">
               Date : {{ moment().format('MMMM Do YYYY, h:mm a') }}
               </div>
            </v-col>
         </v-row>
         </v-alert>
      </v-card>  

   </div>
</template>

<script>
import moment from "moment";
export default {
   data: () => ({      
      moment: moment,      
   }),
}
</script>

<style>

</style>