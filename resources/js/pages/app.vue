<template>
   <div>
      <v-app id="inspire">
        <div v-show="hideTopBar">
           <TopBar />
        </div>

         <!-- v-main is the main content area e.g background -->
         <v-main class="grey lighten-3">
            <v-sheet class="mx-4 mb-5 mt-3" min-height="500">
               <router-view />
            </v-sheet>
         </v-main>
      </v-app>
   </div>
</template>

<script>
import TopBar from './components/topbar'
export default {
   data: () => ({
       hideTopBar: true,
    // toggleNavSidebar: false,
   }),
   components: {TopBar},
   mounted(){
    console.log(this.$route.name)
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
        console.log(this.$route)
        if(this.$route.name == 'AdminPanel'){
           this.hideTopBar = false
        }
        unwatch();
      });
   }
};
</script>

<style scoped></style>
