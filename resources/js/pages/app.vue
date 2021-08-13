<template>
   <div>
      <v-app id="inspire">
        <div v-show="hideTopBar">
           <TopBar />
        </div>

         <!-- v-main is the main content area e.g background -->
         <v-main class="grey lighten-3">
            <v-sheet class="mx-4 mb-3 mt-3" min-height="500">
               <router-view :key="$route.fullPath"></router-view>
            </v-sheet>
         </v-main>

               <v-footer
                  max-height="400"
                  width="100%"
                  class="px-0 py-0"
               >
                  <v-card
                     flat
                     tile
                     width="100%"
                     class="text-center"
                     color="#4270A9"
                  >
                     <v-row class="mt-1 mb-0">
                        <v-col cols="12" sm="9" class="white--text pl-3 pb-1">
                           <div>
                              Copyright © {{ new Date().getFullYear() }} MIU Department of Institutional Quality Assurance Cell
                           </div>
                           <div class=" mt-1 mt-sm-0 mt-md-0 mb-md-0">
                              Designed & Developed by
                              <v-hover
                                 v-slot="{ hover }"
                              >
                                 <a
                                    href="https://www.facebook.com/machinekicker/"
                                    :class="{ 'on-hover': hover }"
                                    :elevation="hover ? 16 : 2"
                                    class="font-weight-medium"
                                 >
                                    Mahin Chowdhury
                                 </a>
                              </v-hover>
                           </div>
                        </v-col>
                        <v-col cols="12" sm="3" align-self="center" class="pr-3 pt-0">
                           <v-btn
                              v-for="(link, index) in links"
                              :key="index"
                              class="mx-2"
                              dark
                              icon
                           >
                              <v-icon class="white--text" size="24px">
                                 {{ link.icon }}
                              </v-icon>
                           </v-btn>
                        </v-col>
                     </v-row>
                  </v-card>
               </v-footer>  

      </v-app>
   </div>
</template>

<script>
import TopBar from './components/topbar'
export default {
   components: {
      TopBar
   },
   data: () => ({
       hideTopBar: true,
    // toggleNavSidebar: false,
      links: [
         { icon: "mdi-twitter", link: "www.twitter.com" },
         { icon: "mdi-facebook", link: "www.facebook.com" },
         { icon: "mdi-instagram", link: "www.instagram.com" },
         { icon: "mdi-instagram", link: "www.instagram.com" },
      ],
   }),
   mounted(){
   //  console.log(this.$route.name)
   },
   watch: {
      $route(to, from) {
         document.title = to.meta.title || "MIU IQAC";
      },      
   },
   created() {
   // Created method for disabling TopBar when name of component is AdminPanel
    const unwatch = this.$watch(
      () => this.$route,
      (route, prevRoute) => {
      //   console.log(this.$route)
        if(this.$route.name == 'AdminPanel'){
           this.hideTopBar = false
        }
        unwatch();
      });
   }
};
</script>

<style scoped>
   a, a:visited, a:active {
      color: inherit !important;
      text-decoration: none;
   }
   .on-hover{
      color: #FB8C00 !important;
   }
</style>
