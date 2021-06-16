<template>
    <div>
        <v-card flat class="mx-0 my-0">
            <v-card-title
                class="text-h5 font-weight-bold grey--text text--darken-2 pb-0 pl-md-8 pt-md-8 pl-sm-4 pt-sm-4 pr-sm-4 mb-md-3"
            >
                <v-icon large left color="grey darken-1">mdi-information</v-icon
                >About Us
            </v-card-title>
        </v-card>
        <v-card flat class="my-md-1 ml-md-2 mr-5 mt-2">
            <v-card-text
                class="text-h5 font-weight-bold pb-0 grey--text text--darken-2 ml-2 ml-sm-3"
            >
                <v-icon left large color="grey darken-2">mdi-target</v-icon
                >Mission
            </v-card-text>
            <v-card-text class="text-h5 font-weight-regular ml-7 ml-md-10 pr-16">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint
                facilis maiores fugiat eius culpa reiciendis. Molestias
                obcaecati inventore dolorum dolor consequatur temporibus
                voluptatem voluptates quisquam quam distinctio. Inventore,
                laboriosam accusamus?
            </v-card-text>
        </v-card>
        <v-card flat class="my-md-1 ml-md-2 mr-5">
            <v-card-text
                class="text-h5 font-weight-bold pb-0 grey--text text--darken-2 ml-2 ml-sm-3"
            >
                <v-icon left large color="grey darken-2">mdi-eye-outline</v-icon
                >Vision
            </v-card-text>
            <v-card-text class="text-h5 font-weight-regular ml-7 ml-md-10 pr-16">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint
                facilis maiores fugiat eius culpa reiciendis. Molestias
                obcaecati inventore dolorum dolor consequatur temporibus
                voluptatem voluptates quisquam quam distinctio. Inventore,
                laboriosam accusamus?
            </v-card-text>
        </v-card>
    </div>
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
