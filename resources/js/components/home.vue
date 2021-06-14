<template>
   <div>
      <v-carousel>
         <v-carousel-item
            v-for="(item,i) in items"
            :key="i"
            :src="item.src"
            reverse-transition="fade-transition"
            transition="fade-transition"
         ></v-carousel-item>
      </v-carousel>

      <v-card class="mx-auto my-3" color="purple darken-1" height="auto">
         <v-col align="center">
            <v-card-text
               class="text-h2 font-weight-bold teal--text text--accent-3"
            >This is a Home Page</v-card-text>
            <v-card-text
               class="text-h6 font-weight-regular cyan--text text--accent-3"
            >A Home Page For All Home Pages !!</v-card-text>
         </v-col>
      </v-card>
      <v-row class="my-2">
         <v-col cols="12" sm="4">
            <v-card class="blue lighten-3">
               <v-list-item three-line>
                  <v-list-item-content>
                     <div class="text-overline text-center mb-4">OVERLINE</div>
                     <v-list-item-title class="text-h5 mb-1 text-center">Headline 5</v-list-item-title>
                     <v-list-item-subtitle class="text-center">
                        Greyhound divisely
                        hello coldly
                        fonwderfully Lorem ipsum
                        dolor sit amet
                        consectetur adipisicing
                        elit. Aspernatur
                        temporibus omnis
                        quisquam, laborum
                        pariatur vero adipisci
                        culpa quae dicta quia
                        provident exercitationem
                        veritatis at delectus
                        modi consequuntur quis
                        unde
                        consectetur?
                     </v-list-item-subtitle>
                  </v-list-item-content>
               </v-list-item>

               <v-card-actions>
                  <v-btn outlined rounded text class="mx-auto">Button</v-btn>
               </v-card-actions>
            </v-card>
         </v-col>
         <v-col cols="12" sm="4">
            <v-card class="amber lighten-3">
               <v-list-item three-line>
                  <v-list-item-content>
                     <div class="text-overline text-center mb-4">OVERLINE</div>
                     <v-list-item-title class="text-h5 mb-1 text-center">Headline 5</v-list-item-title>
                     <v-list-item-subtitle class="text-center">
                        Greyhound divisely
                        hello coldly
                        fonwderfully Lorem ipsum
                        dolor sit amet
                        consectetur adipisicing
                        elit. Aspernatur
                        temporibus omnis
                        quisquam, laborum
                        pariatur vero adipisci
                        culpa quae dicta quia
                        provident exercitationem
                        veritatis at delectus
                        modi consequuntur quis
                        unde
                        consectetur?
                     </v-list-item-subtitle>
                  </v-list-item-content>
               </v-list-item>

               <v-card-actions>
                  <v-btn outlined rounded text class="mx-auto">Button</v-btn>
               </v-card-actions>
            </v-card>
         </v-col>
         <v-col cols="12" sm="4">
            <v-card class="pink lighten-3">
               <v-list-item three-line>
                  <v-list-item-content>
                     <div class="text-overline text-center mb-4">OVERLINE</div>
                     <v-list-item-title class="text-h5 mb-1 text-center">Headline 5</v-list-item-title>
                     <v-list-item-subtitle class="text-center">
                        Greyhound divisely
                        hello coldly
                        fonwderfully Lorem ipsum
                        dolor sit amet
                        consectetur adipisicing
                        elit. Aspernatur
                        temporibus omnis
                        quisquam, laborum
                        pariatur vero adipisci
                        culpa quae dicta quia
                        provident exercitationem
                        veritatis at delectus
                        modi consequuntur quis
                        unde
                        consectetur?
                     </v-list-item-subtitle>
                  </v-list-item-content>
               </v-list-item>

               <v-card-actions>
                  <v-btn outlined rounded class="mx-auto">Button</v-btn>
               </v-card-actions>
            </v-card>
         </v-col>
      </v-row>
   </div>
</template>

<script>
// import TopNav from './topnav'
export default {
    data: () => ({              
      items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
        ],
    })
};
</script>

<style></style>
