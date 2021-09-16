<template>
   <div>
      <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

      <div v-if="loading">
         <Loading />
      </div>
      <div v-else>
         <v-card flat v-if="members.members.length === 0" height="480" min-height="300">
            <v-container fill-height fluid>
               <v-row align="center" justify="center">
                  <div class="text-center">
                     <h1>No Members Exist For This Section Yet !!</h1>
                     <h2>Add Members From The Admin Panel.</h2>
                  </div>
               </v-row>
            </v-container>
         </v-card>
         <div v-else class="pb-3">
            <v-row class="mx-2 mt-2 pt-4" no-gutters>
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
                     >{{ members.name }}</v-card-subtitle>
                  </v-card>
               </v-col>
            </v-row>

            <v-row class="mx-4 pb-4 mt-0">
               <v-col
                  v-for="(member, index) in members.members"
                  :key="index"
                  cols="12"
                  sm="6"
                  md="4"
               >
                  <v-card min-height="450" elevation="10" color="grey lighten-4">
                     <v-img
                        width="auto"
                        class="mx-auto"
                        :src="'/storage/member_images/' + member.member_image"
                        :alt="member.member_image"
                        position="center center"
                        aspect-ratio="0.9"
                     ></v-img>
                     
                     <div class="py-2">
                        <v-card-subtitle class="text-subtitle-1 font-weight-medium blue--text text--darken-4 py-1">
                           <v-icon left color="blue darken-4">
                              mdi-account
                           </v-icon>
                           Name: {{ member.name }}
                        </v-card-subtitle>
                        <v-card-subtitle class="text-subtitle-1 font-weight-medium blue--text text--darken-4 py-1">
                           <v-icon left color="blue darken-4">
                              mdi-briefcase
                           </v-icon>
                           Designation: {{ member.designation }}
                        </v-card-subtitle>
                        <v-card-subtitle class="text-subtitle-1 font-weight-medium blue--text text--darken-4 py-1">
                           <v-icon left color="blue darken-4">
                              mdi-email
                           </v-icon>
                           E-mail: {{ member.email }}
                        </v-card-subtitle>
                        <v-card-subtitle class="text-subtitle-1 font-weight-medium blue--text text--darken-4 py-1">
                           <v-icon left color="blue darken-4">
                              mdi-phone
                           </v-icon>
                           Contact No: {{ member.cell_number }}
                        </v-card-subtitle>
                     </div>                  
                  </v-card>
               </v-col>
            </v-row>

         </div>
      </div>
      </v-sheet>
   </div>
</template>

<script>
import Loading from "./components/loading";
export default {
   data: () => ({
      members: [],      
      loading: true,
   }),
   components: {
      Loading
   },
   created() {

      axios
         .get("/api/people/show/" + this.$route.params.id)
         .then((res) => {
            this.members = res.data;
            this.loading = false;
         })
         .catch((error) => {
            // console.log(error);
            // this.errors = error.response.data.errors
            // this.loading = false;
            this.$router.push({ name: 'ResourceNotFound' })
         });
   },
};
</script>

<style></style>
