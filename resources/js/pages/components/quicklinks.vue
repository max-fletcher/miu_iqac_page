<template>    
    <v-card rounded="0" color="#002147" class="hidden-sm-and-down" width="200">
        <v-card-title class="white--text text-subtitle-1 font-weight-bold">
            Quick Links
        </v-card-title>
        <v-menu
            open-on-hover                
            offset-x                
            v-for="(item, index) in expansionPanelitems"
            :key="index"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    color="#4270A9"
                    dark
                    v-bind="attrs"
                    v-on="on"
                    tile
                    block
                    class="font-weight-regular"
                >
                    <div>
                        {{ item.title }}
                    </div>
                    <v-spacer></v-spacer>
                    <v-icon right class="">
                        mdi-chevron-right
                    </v-icon>
                </v-btn>
            </template>

            <v-list>
                <v-list-item
                    v-for="(item, index) in expansionPanelitems"
                    :key="index"
                >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-card>
</template>

<script>
// import TopNav from './topnav'
export default {
    data: () => ({
        expansionPanelitems: [
            { title: "Publications", content: "Some Content" },
            { title: "Archive", content: "Some Content" },
            { title: "Gallery", content: "Some Content" },
            { title: "Contact Us", content: "Some Content" }
        ]
    })
};
</script>

<style scoped></style>
