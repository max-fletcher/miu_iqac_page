<template>
  <div>     
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
               <v-menu bottom offset-x transition="scale-transition" rounded="0">
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
                     <v-list-item v-for="(people_item, index) in people" :key="index" :to="{ name: 'People', params: { id: people_item.id }}" color="#4270A9">
                        <v-list-item-title class="font-weight-bold text-uppercase">{{ people_item.name }}</v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>
               <v-menu bottom offset-x transition="scale-transition" rounded="0">
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
                     <v-list-item v-for="(event_type, index) in event_types" :key="index" :to="{ name: 'Events', params: { id: event_type.id }}" color="#4270A9">
                        <v-list-item-title class="font-weight-bold text-uppercase"> {{ event_type.event_type }} </v-list-item-title>
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
               <v-menu bottom offset-x transition="scale-transition" rounded="0">
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
                           <v-icon left>mdi-archive</v-icon>Resources
                           <v-spacer></v-spacer>
                           <v-icon small right>mdi-chevron-right</v-icon>
                        </v-btn>
                     </v-card>
                  </template>
                  <v-list>
                     <v-list-item v-for="(resource_type, index) in resource_types" :key="index" :to="{ name: 'Resources', params: { id: resource_type.id }}" color="#4270A9">
                        <v-list-item-title class="font-weight-bold text-uppercase"> {{ resource_type.resource_type_name }} </v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>
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
               <v-card-text class="white--text pl-7 pb-2 pt-0">Click to Expand Links</v-card-text>
            </v-card>

            <v-divider></v-divider>
            <div class="text-center d-flex flex-column">

               <v-menu
                  offset-x
                  left
                  transition="scale-transition"                  
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
                        Publications
                     </v-btn>
                  </template>
                  <v-list>
                     <v-list-item v-for="(publication_type, index) in publication_types" :key="index" :to="'/publications_auth/' + publication_type.id">
                        <v-list-item-title class="font-weight-bold text-uppercase"> {{ publication_type.publication_type_name }} </v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>

               <v-menu
                  offset-x
                  left
                  transition="scale-transition"                  
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
                        Some Other Item
                     </v-btn>
                  </template>
                  <v-list>
                     <v-list-item v-for="(item, index) in expansionPanelitems" :key="index" to="/">
                        <v-list-item-title class="font-weight-bold text-uppercase">{{ item.title }}</v-list-item-title>
                     </v-list-item>
                  </v-list>
               </v-menu>

               <v-btn
                  color="#4270A9"
                  dark                  
                  block
                  tile
                  icon
                  class="font-weight-bold pr-5"
                  to="/photo-gallery"
               >                  
                  <v-spacer></v-spacer>
                  Photo Gallery
               </v-btn>

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
                  @click.stop="toggleQuickLinksSidebar = !toggleQuickLinksSidebar"
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
                              <v-list-item-title class="font-weight-bold text-uppercase">{{ people_item.name }}</v-list-item-title>
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
                     <div v-for="(event_type, index) in event_types" :key="index">
                        <v-list-item :to="{ name: 'Events', params: { id: event_type.id }}" color="#4270A9">
                           <v-list-item-title class="font-weight-bold text-uppercase">{{ event_type.event_type }}</v-list-item-title>
                        </v-list-item>
                     </div>
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
                        <v-icon left>mdi-archive-outline</v-icon>Resources
                        <v-icon small>mdi-chevron-down</v-icon>
                     </v-btn>
                  </template>
                  <v-list>
                     <div v-for="(resource_type, index) in resource_types" :key="index">
                        <v-list-item :to="{ name: 'Resources', params: { id: resource_type.id }}" color="#4270A9">
                           <v-list-item-title class="font-weight-bold text-uppercase">{{ resource_type.resource_type_name }}</v-list-item-title>
                        </v-list-item>
                     </div>
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
      event_types: [],
      resource_types: [],
      publication_types: []
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
      axios.get("/api/events/types/index")
         .then((res) => {
            this.event_types = res.data
         })
         .catch((error) => {
            console.log(error)
            // this.errors = error.response.data.errors
         });

      axios.get("/api/resource_type/index")
         .then((res) => {
            this.resource_types = res.data
         })
         .catch((error) => {
            console.log(error)
            // this.errors = error.response.data.errors
         });

      axios.get("/api/publication_type_info/frontend_index")
         .then((res) => {
               this.publication_types = res.data;
               // this.loading = false;
         })
         .catch((error) => {
               console.log(error);
               // this.errors = error.response.data.errors
               // this.loading = false;
         });
   }
};
</script>

<style>

</style>