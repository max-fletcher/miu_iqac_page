<template>    
    <v-row class="pl-4 pt-3">
        <v-col cols="2" class="pt-md-6 pl-md-6 pt-sm-3 px-0 py-0">
            <QuickLinks />
        </v-col>
        <v-col cols="12" md="10">
            <v-card flat class="mx-0 my-0">
                <v-card-title
                    class="text-h5 font-weight-bold grey--text text--darken-2 pb-0 pl-md-2 pt-md-1 pl-sm-5 pt-sm-0 pr-sm-4 mb-md-0"
                >
                    <v-icon large left color="grey darken-1">mdi-information</v-icon
                    >About Us
                </v-card-title>
            </v-card>
            <v-card flat class="my-md-1 ml-md-0 mr-3 mt-1">
                <v-card-text
                    class="text-h5 font-weight-bold pb-0 grey--text text--darken-2 ml-2 ml-sm-3"
                >
                    <v-icon left large color="grey darken-2">
                        mdi-target
                    </v-icon>Mission
                </v-card-text>
                <v-card-text
                    class="text-h5 font-weight-regular ml-7 ml-md-10 pr-16"
                >
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint
                    facilis maiores fugiat eius culpa reiciendis. Molestias
                    obcaecati inventore dolorum dolor consequatur temporibus
                    voluptatem voluptates quisquam quam distinctio. Inventore,
                    laboriosam accusamus?
                </v-card-text>
            </v-card>
            <v-card flat class="my-md-1 ml-md-0 mr-3">
                <v-card-text
                    class="text-h5 font-weight-bold pb-0 grey--text text--darken-2 ml-2 ml-sm-3"
                >
                    <v-icon left large color="grey darken-2" class="ml-1">
                        mdi-eye-outline
                    </v-icon>
                    Vision
                </v-card-text>
                <v-card-text
                    class="text-h5 font-weight-regular ml-7 ml-md-10 pr-16"
                >
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint
                    facilis maiores fugiat eius culpa reiciendis. Molestias
                    obcaecati inventore dolorum dolor consequatur temporibus
                    voluptatem voluptates quisquam quam distinctio. Inventore,
                    laboriosam accusamus?
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import QuickLinks from "./components/quicklinks";
export default {
    data: () => ({}),
    components: {
        QuickLinks
    }
};
</script>

<style></style>
