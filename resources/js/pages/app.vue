<template>
   <div>
      <v-app id="inspire">
        <div v-show="hideTopBar">
           <TopBar />
        </div>

         <!-- v-main is the main content area e.g background -->
         <v-main class="grey lighten-3">
            <v-sheet class="mx-4 mb-3 mt-3" min-height="450">
               <router-view :key="$route.fullPath"></router-view>
            </v-sheet>
         </v-main>

         <Footer />

      </v-app>
   </div>
</template>

<script>
import TopBar from './components/topbar';
import Footer from './components/footer';
export default {
   components: {
      TopBar, Footer
   },
   data: () => ({
       hideTopBar: true,
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

</style>
