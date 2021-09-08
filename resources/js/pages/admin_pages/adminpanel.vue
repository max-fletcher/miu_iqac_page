<template>
   <div>
      <!-- For Smaller screens -->
      <v-navigation-drawer v-model="admin_drawer" absolute temporary class="hidden-md-and-up">
         <v-sheet color="grey lighten-4" class="pa-4">
            <div v-if="loading_user">
               <div class="blue-grey--text text--lighten-1 ">
                  Loading...
               </div>
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243) none repeat scroll 0% 0%; display: block; shape-rendering: auto;" width="71px" height="71px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                  <g transform="rotate(0 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9285714285714286s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(25.714285714285715 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8571428571428571s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(51.42857142857143 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.7857142857142857s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(77.14285714285714 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.7142857142857143s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(102.85714285714286 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6428571428571429s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(128.57142857142858 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5714285714285714s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(154.28571428571428 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(180 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.42857142857142855s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(205.71428571428572 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.35714285714285715s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(231.42857142857142 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.2857142857142857s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(257.14285714285717 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.21428571428571427s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(282.85714285714283 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.14285714285714285s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(308.57142857142856 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.07142857142857142s" repeatCount="indefinite"></animate>
                  </rect>
                  </g><g transform="rotate(334.2857142857143 50 50)">
                  <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                     <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
                  </rect>
                  </g>
                  <!-- [ldio] generated by https://loading.io/ --></svg>
            </div>
            <div v-else>
               <div>Welcome {{ user.name }}</div>
               <div>Email: {{ user.email }}</div>
            </div>
         </v-sheet>

         <v-divider></v-divider>

         <v-list>

            <v-list-item to="/adminpanel/main" exact-path-active-class="lighten-1" link>
               <v-list-item-icon>
                  <v-icon>mdi-clipboard-list</v-icon>
               </v-list-item-icon>
               <v-list-item-content>
                  <v-list-item-title> Main Menu </v-list-item-title>
               </v-list-item-content>
            </v-list-item>

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

            <v-list-item to="/adminpanel/event_types" exact-path-active-class="lighten-1" link>
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
      <!-- End For Smaller screens -->

      <div class="d-flex">
         <div class="blue hidden-sm-and-down">
            <!-- For Larger Screens -->
            <v-navigation-drawer permanent class="hidden-sm-and-down">
               <v-sheet color="grey lighten-4 pa-3">
                  <div v-if="loading_user">
                     <div class="blue-grey--text text--lighten-1 ">
                        Loading...
                     </div>
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243) none repeat scroll 0% 0%; display: block; shape-rendering: auto;" width="71px" height="71px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <g transform="rotate(0 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9285714285714286s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(25.714285714285715 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8571428571428571s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(51.42857142857143 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.7857142857142857s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(77.14285714285714 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.7142857142857143s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(102.85714285714286 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6428571428571429s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(128.57142857142858 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5714285714285714s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(154.28571428571428 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(180 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.42857142857142855s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(205.71428571428572 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.35714285714285715s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(231.42857142857142 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.2857142857142857s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(257.14285714285717 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.21428571428571427s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(282.85714285714283 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.14285714285714285s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(308.57142857142856 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.07142857142857142s" repeatCount="indefinite"></animate>
                        </rect>
                        </g><g transform="rotate(334.2857142857143 50 50)">
                        <rect x="47.5" y="28.5" rx="2.5" ry="4.5" width="5" height="9" fill="#85a2b6">
                           <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
                        </rect>
                        </g>
                        <!-- [ldio] generated by https://loading.io/ --></svg>
                  </div>
                  <div v-else>
                     <div>Welcome {{ user.name }}</div>
                     <div>Email: {{ user.email }}</div>
                  </div>
               </v-sheet>

               <v-divider></v-divider>

               <v-list min-height="600" class="pt-0">

                  <v-list-item to="/adminpanel/main" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-clipboard-list</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Main Menu </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/carousel_content" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-image-move</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Carousel Options </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/about" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-information-outline</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> About Page </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/people" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-account</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> People </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/event_types" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-calendar-clock</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Events </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/news" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-newspaper-variant</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> News </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/resource_types" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-archive-outline</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Resources </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/publication_types" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-file</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Publications </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/all_galleries" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-camera</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Photo Galleries </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item to="/adminpanel/contact_us" exact-path-active-class="lighten-1" class="pl-2" link>
                     <v-list-item-icon>
                        <v-icon>mdi-phone</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title> Contact Us </v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

                  <v-list-item link @click.stop="logout" class="pl-2">
                     <v-list-item-icon>
                        <v-icon>mdi-power</v-icon>
                     </v-list-item-icon>
                     <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                     </v-list-item-content>
                  </v-list-item>

               </v-list>
            </v-navigation-drawer>
            <!-- End For Larger Screens -->
         </div>

         <v-card class="pa-5" width="100%">

            <v-btn @click.stop="admin_drawer = !admin_drawer" class="hidden-md-and-up mb-3">
               <v-icon>
                  mdi-format-list-bulleted-square
               </v-icon>
            </v-btn>

               <router-view></router-view>
            <!-- <v-row>
               <v-col v-for="card in cards" :key="card" cols="12">
                  <v-card>
                     <v-subheader>{{ card }}</v-subheader>

                     <v-list two-line>
                        <template v-for="n in 6">
                           <v-list-item :key="n">

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

                           <v-divider v-if="n !== 6" :key="`divider-${n}`"></v-divider>
                        </template>
                     </v-list>
                  </v-card>
               </v-col>
            </v-row> -->

         </v-card>
      </div>
   </div>
</template>

<script>
export default {
   data: () => ({
      user: '',
      // cards: ["Today", "Yesterday"],
      admin_drawer: false,
      loading_user: false,
   }),
   methods: {
      logout() {
         axios.post("/api/logout").then(() => {
            this.$router.push({ name: "Login" });
         });
      },
   },
   created() {
      this.loading_user = true
      axios
         .get("/api/user")
         .then((response) => {
            this.user = response.data
            this.loading_user = false
         })
         .catch((error) => {
            console.log(error)
            this.loading_user = false
         });
   },
};
</script>

<style></style>
