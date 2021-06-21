<template>
    <v-card flat class="mx-3">
        <v-row>
            <v-col cols="12">
                <v-carousel>
                    <v-carousel-item
                        v-for="(item, i) in items"
                        :key="i"
                        :src="item.src"
                        reverse-transition="fade-transition"
                        transition="fade-transition"
                    ></v-carousel-item>
                </v-carousel>
            </v-col>
        </v-row>
        <v-row class="" justify="space-around mx-3">
            <v-col cols="3" class="">
                <QuickLinks />
            </v-col>
            <v-col cols="12" md="9" class="black mt-3">
                <v-card>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut eaque eius alias fugit cum obcaecati aliquam nihil facilis itaque dignissimos quis explicabo, voluptatem repudiandae et! Quod hic architecto fugit qui.
                </v-card>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
import QuickLinks from "./components/quicklinks";
// import TopNav from './topnav'
export default {
    data: () => ({
        items: [
            {
                src: "https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg"
            },
            {
                src: "https://cdn.vuetifyjs.com/images/carousel/sky.jpg"
            },
            {
                src: "https://cdn.vuetifyjs.com/images/carousel/bird.jpg"
            },
            {
                src: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg"
            }
        ]
    }),
    components: {
        QuickLinks
    }
};
</script>

<style></style>
