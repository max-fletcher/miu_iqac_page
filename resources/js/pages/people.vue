<template>
   <div class="pt-3 pb-3">      
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
         <div v-else>
            <v-row>
               <v-card flat tile class="mx-auto mt-1">
                  <v-card-title class="text-center text-h3 blue--text text--darken-4">{{ members.name }}</v-card-title>
               </v-card>            
            </v-row>

            <v-row class="mx-4 pb-4">
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
                        :src="'/storage/member_images/' + member.member_image"
                        alt=""
                        class="mx-auto"
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
