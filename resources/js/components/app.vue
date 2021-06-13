<template>
   <div>
      <v-app id="inspire">
         <v-card class="blue darken-4 d-flex pl-4 pl-sm-6 pl-md-16 rounded-0" fluid>
            <v-img
               src="images/logo.png"
               width="auto"
               height="auto"
               min-width="50px"
               min-height="50px"
               max-width="100px"
               max-height="100px"
               contain
               class="my-3 ml-2 mr-0"
            ></v-img>
            <v-content class="my-auto">
               <div class="font-weight-light white--text text-body-2 text-sm-subtitle-1 text-md-h4-subtitle-1 pl-md-2">
                  DEPARTMENT OF</div>
               <div class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h5 pl-md-2">
                  INSTITUTIONAL QUALITY</div>
               <div class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h5 pl-md-2">
                  ASSURANCE CELL</div>
            </v-content>
         </v-card>
         <!-- height props available -->
         <v-card class="hidden-sm-and-down">
            <v-app-bar flat dense>
               <v-tabs centered color="white" class="text-white" background-color="blue lighten-3">
                     <!-- <v-icon
                        @click="toggleSidebar = !toggleSidebar"
                        class="hidden-md-and-up"
                        right
                        v-show="false"
                     >  
                     mdi
                     </v-icon>                   -->
                  <v-tab to="/" exact class="white--text">
                        <v-icon left color="white">mdi-home</v-icon>
                        <!-- v-for="link in links" :key="link" -->
                        Home
                  </v-tab>
                  <v-tab to="/about" exact  class="white--text">
                     <v-icon color="white" left>mdi-information</v-icon>
                     About
                  </v-tab>
                  <v-tab to="/members" exact class="white--text">
                     <v-icon color="white" left>mdi-information</v-icon>
                     Members
                  </v-tab>
                  <v-tab to="/events" exact class="white--text">
                     <v-icon color="white" left>mdi-information</v-icon>
                     Events
                  </v-tab>
                  <v-tab to="/news" exact class="white--text">
                     <v-icon color="white" left>mdi-information</v-icon>
                     News
                  </v-tab>
                  <v-tab to="/resources" exact class="white--text">
                     <v-icon color="white" left>mdi-information</v-icon>
                     Resources
                  </v-tab>
               </v-tabs>
            </v-app-bar>
         </v-card>
         <v-card class="hidden-md-and-up">
            <v-app-bar flat dense>
               Hamburger Menu goes here
            </v-app-bar>
         </v-card>
         <!-- v-main is the main content area e.g background -->
         <v-main class="grey lighten-3">
            <v-container>
               <v-sheet>
                  <router-view>  </router-view>
               </v-sheet>
            </v-container>
         </v-main>
      </v-app>
   </div>
</template>

<script>
// import TopNav from './topnav'
export default {
   data: () => ({
      toggleSidebar: false,
      //logo: require('./logo.png')
   }),
};
</script>

<style scoped></style>
