<template>
   <div>
      <v-app id="inspire">
         <v-app-bar app color="white" flat elevation="3" dense>
            <v-app-bar-nav-icon @click="toggleSidebar = !toggleSidebar" class="hidden-md-and-up"></v-app-bar-nav-icon>
            <v-tabs centered color="grey darken-1">
               <v-tab to="/" exact class="deep-purple--text">
                  <v-icon left color="deep-purple">mdi-home</v-icon>
                  <!-- v-for="link in links" :key="link" -->
                  Home
               </v-tab>
               <v-tab to="/about">
                  <v-icon left>mdi-information</v-icon>About
               </v-tab>
               <v-tab>Link 1</v-tab>
               <v-tab>Logout</v-tab>
            </v-tabs>
         </v-app-bar>
         <!-- v-main is the main content area e.g background -->
         <v-main class="grey lighten-3">
            <v-navigation-drawer v-model="toggleSidebar" absolute temporary>
               <v-list nav dense>
                  <v-list-item-group
                     v-model="group"
                     active-class="deep-purple--text text--accent-4"
                  >
                     <v-list-item>
                        <v-list-item-title>Sidebar Item 1</v-list-item-title>
                     </v-list-item>

                     <v-list-item>
                        <v-list-item-title>Sidebar item 2</v-list-item-title>
                     </v-list-item>
                  </v-list-item-group>
               </v-list>
            </v-navigation-drawer>
            <v-container>
               <v-row>
                  <v-col cols="12" md="3" lg="2" class="hidden-sm-and-down">
                     <v-sheet rounded="lg" height="auto" elevation="5">
                        <div class="px-2 py-2">
                           <v-list nav dense>
                              <v-list-item-group active-class="deep-purple--text text--accent-4">
                                 <v-list-item>
                                    <v-list-item-title class="text-center">Sidebar Item 1</v-list-item-title>
                                 </v-list-item>

                                 <v-list-item>
                                    <v-list-item-title class="text-center">Sidebar item 2</v-list-item-title>
                                 </v-list-item>
                              </v-list-item-group>
                           </v-list>
                        </div>
                     </v-sheet>
                  </v-col>

                  <v-col cols="12" sm="12" md="9" lg="10">
                     <v-sheet rounded="lg" height="auto" class="purple lighten-4" elevation="5">
                        <router-view class="px-5 py-5"></router-view>
                     </v-sheet>
                  </v-col>
               </v-row>
            </v-container>
         </v-main>
         <!-- <v-footer app height="100px" color="white">
            <v-row justify="center">
               <v-col align="center" text="grey darken-1">
                  <h6 class="display-1">Footer</h6>
               </v-col>
            </v-row>
         </v-footer>-->
      </v-app>
   </div>
</template>

<script>
// import TopNav from './topnav'
export default {
   data: () => ({
      toggleSidebar: false,
   }),
};
</script>

<style scoped></style>
