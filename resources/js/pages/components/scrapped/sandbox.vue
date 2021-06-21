<template>
  <div class="hidden-sm-and-down">
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
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>