<template>
   <div>
      Dashboard Component
      <br />
      <div v-if="loading">Loading...</div>
      <div v-else>
         <div v-if="!user">You Are Not Logged.</div>
         <div class="d-flex">
            <div>
               Name: {{ user.name }}
               <br />
               Email: {{ user.email }}
            </div>
            <v-spacer></v-spacer>
            <div class="mr-6">
               <v-btn @click.prevent="logout">
                  <v-icon left>mdi-power</v-icon>Logout
               </v-btn>
            </div>
         </div>

         <div>
            <v-icon @click="drawer = !drawer">
               mdi-hamburger
            </v-icon>
         </div>

         <v-navigation-drawer v-model="drawer" absolute temporary class="hidden-md-and-up">
            <v-sheet color="grey lighten-4" class="pa-4">
               <v-avatar class="mb-4" color="grey darken-1" size="64"></v-avatar>

               <div>Welcome {{ user.name }}</div>
               <div>Email: {{ user.email }}</div>
            </v-sheet>

            <v-divider></v-divider>

            <v-list>
               <v-list-item v-for="[icon, text] in links" :key="icon" link>
                  <v-list-item-icon>
                     <v-icon>{{ icon }}</v-icon>
                  </v-list-item-icon>

                  <v-list-item-content>
                     <v-list-item-title>{{ text }}</v-list-item-title>
                  </v-list-item-content>
               </v-list-item>
            </v-list>
         </v-navigation-drawer>

         <v-container class="py-8 px-6" fluid>
            <v-row>
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
      </div>
   </div>
</template>

<script>
export default {
   data: () => ({
      loading: true,
      user: null,      
      cards: ["Today", "Yesterday"],
      drawer: false,
      links: [
         ["mdi-inbox-arrow-down", "Inbox"],
         ["mdi-send", "Send"],
         ["mdi-delete", "Trash"],
         ["mdi-alert-octagon", "Spam"],
      ],
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
            this.loading = false;
         })
         .catch((error) => {
            this.loading = false;
         });
   },
};
</script>

<style></style>
