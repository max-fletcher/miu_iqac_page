<template>
    <v-card flat class="mx-3">
        <v-row>
            <v-col cols="12">
                <v-carousel height="auto" show-arrows-on-hover>
                    <v-carousel-item v-for="(item, i) in items" :key="i">
                        <v-img
                            :src="item.src"
                            aspect-ratio="1.77"
                            max-height="500"
                        >
                            <v-alert
                                text
                                color="info darken-2"
                                class="font-weight-medium text-h6"
                            >

                            <div class="text-center">                         
                                Proin magna. Vivamus in erat ut urna cursus vestibulum. Etiam imperdiet imperdiet orci.  
                            </div>
                                                                    
                            </v-alert>
                        </v-img>
                    </v-carousel-item>
                </v-carousel>
            </v-col>
        </v-row>
        <v-row class="" justify="space-around ml-1 ml-md-0 mr-1 mr-md-3">
            <v-col cols="3" class="">
                <QuickLinks />
            </v-col>
            <v-col cols="12" md="9" class="black mt-0 mt-md-3">
                <v-card class="pl-0 ml-0 mt-md-0">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Aut eaque eius alias fugit cum obcaecati aliquam nihil
                    facilis itaque dignissimos quis explicabo, voluptatem
                    repudiandae et! Quod hic architecto fugit qui.
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
