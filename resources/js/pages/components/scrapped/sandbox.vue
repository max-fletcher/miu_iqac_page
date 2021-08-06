<template>
  <div class="">
        <v-btn
            color="#4270A9"
            dark
            v-bind="attrs"
            v-on="on"
            block
            tile
            >
            Publications
        </v-btn>
        <v-menu
            open-on-hover
            bottom
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
                block
                tile
                >
                Publications
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

        <br><br>
                    
        <!-- The to="/" needs to be bound e.g :to="'/someroute/' + publication.id" later -->
        <v-card v-for="(single_publication, index) in publications.publications" :key="index" width="auto" outlined class="mt-n3 d-flex align-center pa-2 mx-6" to="/">
        <!-- Title For Xs -->
            <v-card-title class="text-subtitle-1 font-weight-bold text-wrap py-0">
                Publication Name: {{ single_publication.publication_name }}
            </v-card-title>

            <v-card-title class="text-subtitle-1 font-weight-bold text-wrap py-0">
                Created At: {{ moment(single_publication.created_at).format('MMMM Do YYYY, h:mm a') }}
            </v-card-title>                
        </v-card>

        <br>

        <v-card v-for="(single_publication, index) in publications.publications" :key="index" :href="'/storage/publication_files/' + single_publication.publication_file" rounded="0" class="mb-4 mx-6">
            <v-alert color="deep-purple accent-3" class="px-0 py-0 mx-0 my-0" rounded="0" text>
            <v-card-title class="py-2 text-h6 font-weight-medium">
                <v-icon left color="deep-purple accent-3" large>
                mdi-pdf-box
                </v-icon>
                {{ single_publication.publication_name }}
            </v-card-title>
            </v-alert>
        </v-card>

    </div>
</template>

<script>
import moment from 'moment'
export default {
    data: () => ({
        expansionPanelitems: [
            { title: "Publications", content: "Some Content" },
            { title: "Archive", content: "Some Content" },
            { title: "Gallery", content: "Some Content" },
            { title: "Contact Us", content: "Some Content" }
        ],
        moment: moment,
        publications: [],
    }),
    created() {
      axios
         .get("/api/publication_type_info/show/1")
         .then((res) => {
            // console.log(res)
            this.publications = res.data;
            this.loading = false;
         })
         .catch((error) => {
            // console.log(error);
            this.errors = error.response.data.errors
            this.loading = false;
         });
    },
}
</script>

<style>

</style>