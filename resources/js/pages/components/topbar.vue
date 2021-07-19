<template>
  <div>
     {{event_types}}
     <!-- Nav Drawer -->
        <v-navigation-drawer v-model="toggleNavSidebar" absolute temporary width="190">
            <v-card tile color="#4270A9">
               <v-card-text class="text-h6 white--text pl-4 pt-2 pb-0">Navigation</v-card-text>
               <v-card-text class="white--text pl-4 pb-2 pt-0">Click to navigate</v-card-text>
            </v-card>

            <v-divider></v-divider>

            <!-- Style Two -->
            <v-card rounded="0" flat>
               <v-btn color="#4270A9" height="40" text block to="/" exact-active-class="darken-1">
                  <v-icon left>mdi-home</v-icon>
                  Home
                  <v-spacer></v-spacer>
               </v-btn>
               <v-btn
                  color="#4270A9"
                  height="40"
                  text
                  block
                  to="/about"
                  exact-active-class="darken-1"
               >
                  <v-icon left>mdi-information-outline</v-icon>About
                  <v-spacer></v-spacer>
               </v-btn>
               <v-menu open-on-hover bottom offset-x transition="scale-transition" rounded="0">
                  <template v-slot:activator="{ on, attrs }">
                     <!-- exact-path for later -->
                     <v-card rounded="0" flat>
                        <v-btn
                           color="#4270A9"
                           v-bind="attrs"
                           v-on="on"
                           height="40"
                           text
                           block
                           exact-path-active-class="lighten-1"
                        >
                           <!-- path class not working -->
                           <v-icon left>mdi-account</v-icon>People
                           <v-spacer></v-spacer>
                           <v-icon small right>mdi-chevron-right</v-icon>
                        </v-btn>
                     </v-card>
                  </template>
                  <v-list>
                     <v-list-item to="/people/iqac" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">IQAC</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/people/sac" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">SAC</v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>
               <v-menu open-on-hover bottom offset-x transition="scale-transition" rounded="0">
                  <template v-slot:activator="{ on, attrs }">
                     <!-- exact-path for later -->
                     <v-card rounded="0" flat>
                        <v-btn
                           color="#4270A9"
                           v-bind="attrs"
                           v-on="on"
                           height="40"
                           text
                           block
                           exact-path-active-class="lighten-1"
                        >
                           <!-- path class not working -->
                           <v-icon left>mdi-calendar-clock</v-icon>Events
                           <v-spacer></v-spacer>
                           <v-icon small right>mdi-chevron-right</v-icon>
                        </v-btn>
                     </v-card>
                  </template>
                  <v-list>
                     <v-list-item to="/people/iqac" color="#4270A9">
                        <v-list-item-title>WORKSHOP</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/people/sac" color="#4270A9">
                        <v-list-item-title>SEMINAR</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/people/sac" color="#4270A9">
                        <v-list-item-title>CONFERANCE</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/people/sac" color="#4270A9">
                        <v-list-item-title>TRAINING</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/people/sac" color="#4270A9">
                        <v-list-item-title>PEER REVIEW</v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>
               <v-btn
                  color="#4270A9"
                  height="40"
                  text
                  block
                  to="/news"
                  exact-active-class="darken-1"
               >
                  <v-icon left>mdi-newspaper-variant</v-icon>News
                  <v-spacer></v-spacer>
               </v-btn>
               <v-btn
                  color="#4270A9"
                  height="40"
                  text
                  block
                  to="/resources"
                  exact-active-class="darken-1"
               >
                  <v-icon left>mdi-archive</v-icon>Resources
                  <v-spacer></v-spacer>
               </v-btn>
                              <v-btn
                  color="#4270A9"
                  height="40"
                  text
                  block
                  to="/contact-us"
                  exact-active-class="darken-1"
               >
                  <v-icon left>mdi-phone</v-icon>Contact Us
                  <v-spacer></v-spacer>
               </v-btn>
            </v-card>
         </v-navigation-drawer>
         <!-- End Nav Drawer -->

         <!-- Quick Links Drawer -->
         <v-navigation-drawer
            v-model="toggleQuickLinksSidebar"
            absolute
            temporary
            right
            width="190"
         >
            <v-card tile color="#4270A9">
               <v-card-text class="text-h6 white--text pl-16 pt-2 pb-0">Quick Links</v-card-text>
               <v-card-text class="white--text pl-7 pb-2 pt-0">Hover to Expand Links</v-card-text>
            </v-card>

            <v-divider></v-divider>
            <div class="text-center d-flex flex-column">
               <v-menu
                  open-on-hover
                  offset-x
                  left
                  transition="scale-transition"
                  v-for="(item, index) in expansionPanelitems"
                  :key="index"
               >
                  <template v-slot:activator="{ on, attrs }">
                     <v-btn
                        color="#4270A9"
                        dark
                        v-bind="attrs"
                        v-on="on"
                        block
                        tile
                        icon
                        class="font-weight-bold pr-5"
                     >
                        <v-icon left class="pl-5">mdi-chevron-left</v-icon>
                        <v-spacer></v-spacer>
                        {{ item.title }}
                     </v-btn>
                  </template>
                  <v-list>
                     <v-list-item v-for="(item, index) in expansionPanelitems" :key="index">
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>
            </div>
         </v-navigation-drawer>
         <!-- End Quick Links Drawer -->

         <!-- Banner -->
         <v-card
            class="d-flex pl-4 pl-sm-6 pl-md-16 rounded-0"
            color="#002147"
            fluid
            width="auto"
            height="110"
            to="/"
         >
            <v-img
               src="/images/logo.png"
               width="auto"
               height="auto"
               min-width="50px"
               min-height="50px"
               max-width="100px"
               max-height="100px"
               contain
               class="my-3 ml-2 mr-0"
            ></v-img>
            <v-main class="my-auto">
               <div
                  class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h4 pl-md-2 hidden-sm-and-down"
               >INSTITUTIONAL QUALITY ASSURANCE CELL</div>
               <div
                  class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h5 pl-md-2 hidden-md-and-up"
               >INSTITUTIONAL QUALITY</div>
               <div
                  class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h5 pl-md-2 hidden-md-and-up"
               >ASSURANCE CELL</div>
            </v-main>
         </v-card>
         <!-- End Banner -->

         <!-- Navbar -->
         <!-- For xs screens -->
         <v-card class="hidden-md-and-up" rounded="0" height="40">
            <v-tabs background-color="#4270A9">
               <v-tab class="white--text" @click.stop="toggleNavSidebar = !toggleNavSidebar">
                  <v-icon left color="white">mdi-menu</v-icon>Navigation Links
               </v-tab>
               <v-spacer></v-spacer>
               <v-tab
                  class="white--text"
                  @click.stop="
                            toggleQuickLinksSidebar = !toggleQuickLinksSidebar
                        "
               >
                  <v-icon left color="white">mdi-menu</v-icon>Quick Links
               </v-tab>
            </v-tabs>
         </v-card>

         <!-- For sm and up screens -->
         <v-card class="hidden-sm-and-down">
            <v-card class="d-flex justify-center" rounded="0" height="40" color="#4270A9">
               <v-btn
                  color="#4270A9"
                  v-bind="attrs"
                  v-on="on"
                  tile
                  class="white--text"
                  height="40"
                  text
                  to="/"
                  exact-active-class="light"
               >
                  <v-icon left>mdi-home</v-icon>Home
               </v-btn>
               <v-btn
                  color="#4270A9"
                  v-bind="attrs"
                  v-on="on"
                  tile
                  class="white--text"
                  height="40"
                  text
                  to="/about"
                  exact-active-class="light"
               >
                  <v-icon left>mdi-information-outline</v-icon>About
               </v-btn>
               <v-menu open-on-hover bottom offset-y transition="scale-transition">
                  <template v-slot:activator="{ on, attrs }">
                     <!-- exact-path for later -->
                     <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text
                        exact-active-class
                     >
                        <v-icon left>mdi-account</v-icon>People
                        <v-icon small>mdi-chevron-down</v-icon>
                     </v-btn>
                  </template>                     
                     <v-list>
                        <div v-for="(people_item, index) in people" :key="index">
                           <v-list-item :to="{ name: 'People', params: { id: people_item.id }}" color="#4270A9">
                              <v-list-item-title class="font-weight-bold">{{ people_item.name }}</v-list-item-title>
                           </v-list-item>
                        </div>
                     </v-list>                     
               </v-menu>
               <v-menu open-on-hover bottom offset-y transition="scale-transition">
                  <template v-slot:activator="{ on, attrs }">
                     <!-- exact-path for later -->
                     <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text
                        exact-active-class
                     >
                        <v-icon left>mdi-calendar-clock-outline</v-icon>Events
                        <v-icon small>mdi-chevron-down</v-icon>
                     </v-btn>
                  </template>
                  <v-list>
                     <v-list-item to="/events" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">WORKSHOP</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/events" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">SEMINAR</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/events" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">CONFERANCE</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/events" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">TRAINING</v-list-item-title>
                     </v-list-item>
                     <v-list-item to="/events" color="#4270A9">
                        <v-list-item-title class="font-weight-bold">PEER REVIEW</v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>
               <v-btn
                  color="#4270A9"
                  v-bind="attrs"
                  v-on="on"
                  tile
                  class="white--text"
                  height="40"
                  text
                  to="/news"
                  exact-active-class="light"
               >
                  <v-icon left>mdi-newspaper-variant-outline</v-icon>News
               </v-btn>
               <v-btn
                  color="#4270A9"
                  v-bind="attrs"
                  v-on="on"
                  tile
                  class="white--text"
                  height="40"
                  text
                  to="/resources"
                  exact-active-class="light"
               >
                  <v-icon left>mdi-archive-outline</v-icon>Resources
               </v-btn>

               <v-btn
                  color="#4270A9"
                  v-bind="attrs"
                  v-on="on"
                  tile
                  class="white--text"
                  height="40"
                  text
                  to="/contact-us"
                  exact-active-class="light"
               >
                  <v-icon left>mdi-phone</v-icon>Contact Us
               </v-btn>
            </v-card>
         </v-card>
         <!--End Navbar -->
  </div>
</template>

<script>
export default {
   data: () => ({
      toggleNavSidebar: false,
      toggleQuickLinksSidebar: false,
      expansionPanelitems: [
         { title: "Publications", content: "Some Content" },
         { title: "Archive", content: "Some Content" },
         { title: "Gallery", content: "Some Content" },
         { title: "Contact Us", content: "Some Content" },
      ],
      people: [],      
   }),
   components: {},
   watch: {
      $route(to, from) {
         document.title = to.meta.title || "MIU IQAC";
      },
   },
   created(){
      axios.get("/api/people/frontend_index")
         .then((res) => {            
            this.people = res.data
         })
         .catch((error) => {
            console.log(error)
            // this.errors = error.response.data.errors
         });
   }
};
</script>

<style>

</style>