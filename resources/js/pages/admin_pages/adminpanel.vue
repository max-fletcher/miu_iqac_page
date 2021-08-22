<template>
   <div>
      <v-row>
         <v-col md="3">
            <!-- For Smaller Screens -->
            <v-navigation-drawer permanent class="hidden-sm-and-down">
               <v-sheet color="grey lighten-4" class="pa-4">

                  <div>Welcome {{ user.name }}</div>
                  <div>Email: {{ user.email }}</div>
               </v-sheet>

               <v-divider></v-divider>

               <v-list>
                  <v-list-item to="/adminpanel/carousel_content" exact-path-active-class="lighten-1" link>
                     <v-list-item-icon>
                        <v-icon>mdi-image-move</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Carousel Options </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/about" exact-path-active-class="lighten-1" link>
                     <v-list-item-icon>
                        <v-icon>mdi-information-outline</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> About Page </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/people" exact-path-active-class="lighten-1" link>
                     <v-list-item-icon>
                        <v-icon>mdi-account</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> People </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/events" exact-path-active-class="lighten-1" link>
                     <v-list-item-icon>
                        <v-icon>mdi-calendar-clock</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Events </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/news" exact-path-active-class="lighten-1" link>
                     <v-list-item-icon>
                        <v-icon>mdi-newspaper-variant</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> News </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/resources" exact-path-active-class="lighten-1" link>
                     <v-list-item-icon>
                        <v-icon>mdi-phone</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Contact Us </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item link @click.stop="logout">
                     <v-list-item-icon>
                        <v-icon>mdi-power</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>
               </v-list>
            </v-navigation-drawer>
            <!-- End For Smaller Screens -->

            <!-- For Larger screens -->
            <v-navigation-drawer v-model="drawer" absolute temporary class="hidden-md-and-up">
               <v-sheet color="grey lighten-4" class="pa-4">
                  <div>Welcome {{ user.name }}</div>
                  <div>Email: {{ user.email }}</div>
               </v-sheet>

               <v-divider></v-divider>

               <v-list>                     
                  <v-list-item link @click.stop="logout">
                     <v-list-item-icon>
                        <v-icon>mdi-power</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>
               </v-list>
            </v-navigation-drawer>
            <!-- End For Larger screens -->
         </v-col>


         <v-col xs="12" sm="12" md="9">

            <router-view></router-view>

            <v-container class="" fluid>
               <v-row>
                  <v-btn @click.stop="drawer = !drawer" class="hidden-md-and-up mt-n7 ml-3">
                     <v-icon>
                        mdi-format-list-bulleted-square
                     </v-icon>
                  </v-btn>
                  <v-col v-for="card in cards" :key="card" cols="12">
                     <v-card>
                        <v-subheader>{{ card }}</v-subheader>

                        <v-list two-line>
                           <template v-for="n in 6">
                              <v-list-item :key="n">
                                 <v-list-item-avatar color="grey darken-1"></v-list-item-avatar>

                                 <v-list-item-content>
                                    <v-list-item-title>
                                       Message
                                       {{ n }}
                                    </v-list-item-title>

                                    <v-list-item-subtitle>
                                       Lorem ipsum dolor sit amet,
                                       consectetur adipisicing elit.
                                       Nihil repellendus distinctio
                                       similique
                                    </v-list-item-subtitle>
                                 </v-list-item-content>
                              </v-list-item>

                              <v-divider v-if="n !== 6" :key="`divider-${n}`" inset></v-divider>
                           </template>
                        </v-list>
                     </v-card>
                  </v-col>
               </v-row>
            </v-container>

         </v-col>            
      </v-row>
   </div>
</template>

<script>
export default {
   data: () => ({
      user: '',
      cards: ["Today", "Yesterday"],
      drawer: false,
   }),
   methods: {
      logout() {
         axios.post("/api/logout").then(() => {
            this.$router.push({ name: "Login" });
         });
      },
   },
   created() {
      axios
         .get("/api/user")
         .then((res) => {
            this.user = res.data;            
         })
         .catch((error) => {
            console.log(error)
         });
   },
};
</script>

<style></style>
