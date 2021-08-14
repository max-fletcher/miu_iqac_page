<template>
   <v-footer max-height="400" width="100%" class="px-0 py-0">
      <v-card flat tile width="100%" class="text-center" color="#4270A9">
         <v-row class="mt-1 mb-0">
            <v-col
               cols="12"
               sm="9"
               class="white--text pl-5 pr-5 pb-0 pb-sm-2 pt-2"
            >
               <div class="hidden-xs-only">
                  Copyright © {{ new Date().getFullYear() }} MIU Department of
                  Institutional Quality Assurance Cell
               </div>
               <div class="hidden-sm-and-up">
                  <div>
                     Copyright © {{ new Date().getFullYear() }} MIU Department
                     of
                  </div>
                  <div>Institutional Quality Assurance Cell</div>
               </div>
               <div class="mt-1 mt-sm-0 mb-md-0">
                  Designed & Developed by
                  <v-hover v-slot="{ hover }">
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
            <v-col cols="12" sm="3" align-self="center" class="pr-3 pt-2">
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
</template>

<script>
export default {
      data: () => ({
      links: [
         { icon: "mdi-facebook", link: "www.facebook.com" },
         { icon: "mdi-instagram", link: "www.instagram.com" },
         { icon: "mdi-twitter", link: "www.twitter.com" },
         { icon: "mdi-linkedin", link: "www.linkedin.com" },
      ],
   }),
};
</script>

<style>
   a, a:visited, a:active {
      color: inherit !important;
      text-decoration: none;
   }
   .on-hover{
      color: #FB8C00 !important;
   }
</style>