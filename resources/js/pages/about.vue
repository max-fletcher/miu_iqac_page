<template>
    <div class="pt-5">        
        <v-row class="pl-4">
            <v-col cols="2" class="pt-md-4 pl-md-4 pt-sm-3 px-0 py-0">
                <QuickLinks />
            </v-col>
            <v-col cols="12" md="10">
                <v-card flat class="mx-0 my-0">
                    <v-card-title
                        class="text-h5 font-weight-bold grey--text text--darken-2 pb-2 pl-md-2 pt-md-1 pl-sm-5 pt-sm-0 pr-sm-4 mb-md-0"
                    >
                        <v-icon large left color="grey darken-1">mdi-information</v-icon>
                        About Us
                    </v-card-title>
                </v-card>
                <v-card v-for="(about_item, index) in about_items" :key="index" flat class="my-md-1 ml-md-0 mr-3">
                    <v-card-text
                        class="text-h5 font-weight-bold pb-0 grey--text text--darken-2 ml-2 ml-sm-3"
                    >
                        <v-icon left large color="grey darken-2">
                            {{ about_item.icon }}
                        </v-icon>
                        {{ about_item.about_content_type.type }}
                    </v-card-text>
                    <v-card-text
                        class="text-h5 font-weight-regular ml-7 ml-md-10 pr-16"
                    >
                       {{ about_item.content }}
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>  
</template>

<script>
import QuickLinks from "./components/quicklinks";
export default {
    data: () => ({
        about_items: null,
    }),
    components: {
        QuickLinks
    },
    created(){
        axios.get("/api/about/content/index")
         .then((res) => {
            console.log(res)
            this.about_items = res.data
         })
         .catch((error) => {
            console.log(error)
            // this.errors = error.response.data.errors
         });
    }
};
</script>

<style></style>
