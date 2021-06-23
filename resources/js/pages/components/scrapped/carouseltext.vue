<template>
    <div id="app">
        <v-app id="inspire">
            <v-container fluid>
                <v-layout row wrap justify-center>
                    <v-flex xs6>
                        <v-carousel>
                            <v-carousel-item
                                v-for="(item, i) in items"
                                :key="i"
                                :src="item.src"
                            >
                                <v-container fill-height fluid pa-0 ma-0 pb-3>
                                    <v-row fill-height align-end pb-4 mb-4>
                                        <v-col xs12>
                                            <v-card color="red" class="pa-2">
                                                <span
                                                    class="headline white--text"
                                                    v-text="item.src"
                                                > Some Text </span>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-carousel-item>
                        </v-carousel>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-app>
    </div>
</template>

<script>
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
};
</script>

<style></style>
