<template>
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
        <v-col cols="3">
            <QuickLinks />
        </v-col>
    </v-row>
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
