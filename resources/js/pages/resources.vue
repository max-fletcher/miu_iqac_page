<template>
   <div class="pt-3">
      <div v-if="loading">
         <Loading />
      </div>
      <div v-else>
         <v-card
            v-if="resources.resources.length === 0"
            flat
            height="480"
            min-height="300"
         >
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>
                        No Resources For This Section Has Been Added Yet !!
                     </h1>
                     <h2>Add Resources From The Admin Panel.</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>
         <!-- <v-row v-else class="mx-2 py-4"> -->
         <div v-else class="mx-4">
            <v-row class="mx-2 mt-2" no-gutters>
               <v-col cols="12">
                  <v-card flat tile class="mx-auto px-0">
                     <v-card-subtitle
                        class="
                           text-center text-h3
                           blue--text
                           text--darken-4
                           py-0                           
                           mb-2
                           pl-lg-4
                           text-uppercase
                        "
                     >resources</v-card-subtitle>
                  </v-card>
               </v-col>
            </v-row>

            <v-row class="mx-2 mt-1">
               <v-col md="3" lg="2" class="hidden-sm-and-down">
                  <QuickLinks />
               </v-col>
               <v-col md="9" lg="10">
                  <v-card
                     v-for="(resource, index) in resources.resources"
                     :key="index"
                     :href="'/storage/resource_files/' + resource.resource_file"
                     rounded="0"
                     class="mb-4"
                  >
                     <v-alert
                        color="teal accent-4"
                        class="px-0 py-0 mx-0 my-0"
                        rounded="0"
                        text
                     >
                        <v-card-title class="py-2 text-h6 font-weight-medium">
                           <v-icon left color="teal accent-4" large>
                              mdi-file-pdf-box
                           </v-icon>
                           {{ resource.resource_name }}
                        </v-card-title>
                     </v-alert>
                  </v-card>
               </v-col>
            </v-row>
         </div>
      </div>
   </div>
</template>

<script>
import moment from "moment";
import QuickLinks from "./components/quicklinks";
import Loading from "./components/loading";
export default {
   data: () => ({
      resources: [],
      moment: moment,
      loading: true,
   }),
   components: {
      QuickLinks,
      Loading,
   },
   computed: {},
   created() {
      axios
         .get("/api/resource_type/show/" + this.$route.params.id)
         .then((res) => {
            this.resources = res.data;
            this.loading = false;
         })
         .catch((error) => {
            // console.log(error);
            // this.errors = error.response.data.errors
            // this.loading = false;
            this.$router.push({ name: "ResourceNotFound" });
         });
   },
};
</script>

<style>
</style>