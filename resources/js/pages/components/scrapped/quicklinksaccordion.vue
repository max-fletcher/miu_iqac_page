<template>
   <div>
   <!-- Quicklinks accordion used in pages -->
      <v-card class="hidden-sm-and-down" color="#002147">
         <v-card-title class="white--text"> Quick Links </v-card-title>
         <!-- <v-divider style="height: 100px; width: 500px"></v-divider> -->
         <!-- <div class="" style="width: 10px; height: 10px; color: black"></div> -->
         <v-expansion-panels accordion focusable flat>
               <v-expansion-panel
                  v-for="item in expansionPanelitems"
                  :key="item.title"
               >
                  <v-expansion-panel-header
                     color="#4270A9"
                     class="white--text"
                     v-ripple
                  >
                     {{ item.title }}
                     <template v-slot:actions>
                           <v-icon color="white">
                              mdi-chevron-down
                           </v-icon>
                     </template>
                  </v-expansion-panel-header>
                  <v-expansion-panel-content class="pt-3 px-0 py-0 mx-0 my-0">
                     <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. -->
                     <v-btn class="px-0 py-0 mx-0 my-0" block tile text>
                           Hello Boi
                     </v-btn>
                     <v-btn class="px-0 py-0 mx-0 my-0" block tile text>
                           Hello Boi
                     </v-btn>
                     <!-- <v-card class="" color="black">
                  <v-btn class="mx-auto my-auto blue mx-auto" block>
                     Hello Boi
                  </v-btn>
               </v-card>
               <v-card class="" color="black">
                  <v-btn class="mx-auto my-auto blue mx-auto" block>
                     Hello Boi
                  </v-btn>
               </v-card> -->
                  </v-expansion-panel-content>
               </v-expansion-panel>
         </v-expansion-panels>
      </v-card>
   </div>
</template>

<script>
// import TopNav from './topnav'
export default {
    data: () => ({
        expansionPanelitems: [
            { title: "Publications", content: "Some Content" },
            { title: "Archive", content: "Some Content" },
            { title: "Gallery", content: "Some Content" },
            { title: "Contact Us", content: "Some Content" }
        ]
    })
};
</script>

<style>

</style>