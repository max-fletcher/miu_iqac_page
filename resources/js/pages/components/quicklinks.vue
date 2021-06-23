<template>
  <div class="hidden-sm-and-down">
        <v-card
            color="#002147" 
            block            
            class="text-center white--text"
            tile
            min-width="143"
            >
            <v-card-title class="px-3 py-2 text-center">
                Quick Links
            </v-card-title>
        </v-card>
        <v-menu
            open-on-hover
            right
            offset-x
            transition="scale-transition"
            v-for="(item, index) in expansionPanelitems"
            :key="index"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                color="#4270A9"
                dark
                v-bind="attrs"
                v-on="on"
                block
                tile
                icon
                class="pl-3 font-weight-bold text-subtitle-2"
                >
                    {{ item.title }}
                    <v-spacer></v-spacer>
                    <v-icon>
                        mdi-chevron-right
                    </v-icon>
                </v-btn>                
            </template>

            <v-list>
                <v-list-item
                v-for="(item, index) in expansionPanelitems"
                :key="index"
                to="/"
                >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
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
