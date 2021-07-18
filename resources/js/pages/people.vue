<template>
   <div class="pt-3">
        <v-card flat v-if="members.length === 0" height="480" min-height="300">
        <v-container fill-height fluid>
            <v-row align="center"
                justify="center">
                <div class="text-center">
                <h1> No Members Exist For This Section Yet !! </h1>
                <h2> Add Members From The Admin Panel. </h2>
                </div>
            </v-row>
        </v-container>
        </v-card>
      <v-row v-else class="mx-4 py-4">
          <v-col v-for="(member, index) in members" :key="index" cols="12" sm="6" md="4">
              <v-card min-height="450" to="/" elevation="10">
                  <v-img
                      height="400"
                      width="auto"
                      :src="'/storage/member_images/' + member.member_image"
                      alt=""
                      class="mx-auto"
                      position="center center"
                  ></v-img>

                  <v-card-title>
                      <div class="text-subtitle-1 font-weight-bold black-text">
                          Name: {{ member.name }}
                      </div>

                      <div class="text-subtitle-1 font-weight-bold">
                          Designation: Lorem ipsum dolor sit amet, consectetur adipisicing.
                      </div>

                      <div class="text-subtitle-1">
                          Contact No.: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, aliquam!
                      </div>

                      <div class="text-subtitle-1">
                          E-mail: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, aliquam!
                      </div>
                  </v-card-title>
              </v-card>
          </v-col>
      </v-row>
   </div>
</template>

<script>
export default {
    data: ()=> ({
        members: []
    }),
    created(){
        axios.get("/api/people/members/membersbypeopleid/" + this.$route.params.id)
         .then((res) => {            
            this.members = res.data
         })
         .catch((error) => {
            console.log(error)
            // this.errors = error.response.data.errors
         });
    }
};
</script>

<style></style>
