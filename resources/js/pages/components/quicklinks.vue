<template>
    <v-card class="hidden-sm-and-down">
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
        <!-- Publications -->
        <v-menu
            open-on-hover
            right
            offset-x
            transition="scale-transition"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                color="blue darken-4"
                v-bind="attrs"
                v-on="on"
                block
                tile
                icon
                class="pl-3 font-weight-bold text-subtitle-2"
                >
                    Publications
                    <v-spacer></v-spacer>
                    <v-icon>
                        mdi-chevron-right
                    </v-icon>
                </v-btn>                
            </template>

            <v-list>
                <v-list-item
                    v-for="(publication_type, index) in publication_types"
                    :key="index"
                    :to="'/publications_auth/' + publication_type.id"
                    exact-active-class="blue lighten-5"
                >
                <v-list-item-title
                 class="font-weight-bold text-uppercase blue--text text--darken-4">
                 {{ publication_type.publication_type_name }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>

        <v-btn
            color="blue darken-4"
            dark 
            block
            tile
            icon
            class="pl-3 font-weight-bold text-subtitle-2"
            to="/photo-gallery"
        >
            Photo Gallery
            <v-spacer></v-spacer>
        </v-btn>
    </v-card>
</template>

<script>
// import TopNav from './topnav'
export default {
    data: () => ({
        publication_types: []
    }),
    created(){
        axios
            .get("/api/publication_type_info/frontend_index")
            .then((res) => {
                this.publication_types = res.data;
                // this.loading = false;
            })
            .catch((error) => {
                console.log(error);
                // this.errors = error.response.data.errors
                // this.loading = false;
            });
    }
};
</script>

<style scoped></style>
