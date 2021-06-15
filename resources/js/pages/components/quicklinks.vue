<template>     
   <!-- Quicllinks accordion used in pages -->
   <v-card class="ml-3 hidden-sm-and-down" color="#002147">
      <v-card-title class="white--text"> Quick Links </v-card-title>
      <!-- <v-divider style="height: 100px; width: 500px"></v-divider> -->
      <!-- <div class="" style="width: 10px; height: 10px; color: black"></div> -->
      <v-expansion-panels accordion focusable>
         <v-expansion-panel
            v-for="item in expansionPanelitems"
            :key="item.title"
         >
            <v-expansion-panel-header color="#4270A9" class="white--text" v-ripple>
               {{item.title}}
               <template v-slot:actions>
                  <v-icon color="white">
                     mdi-chevron-down
                  </v-icon>
               </template>
            </v-expansion-panel-header>
            <v-expansion-panel-content class="pt-3">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </v-expansion-panel-content>
         </v-expansion-panel>
      </v-expansion-panels>
   </v-card>    
</template>

<script>
// import TopNav from './topnav'
export default {
    data: () => ({
        expansionPanelitems:[
           {title: 'Publications', content: 'Some Content'},
           {title: 'Archive', content: 'Some Content'},
           {title: 'Gallery', content: 'Some Content'},
           {title: 'Content', content: 'Some Content'},
        ],
    })
};
</script>

<style>

</style>