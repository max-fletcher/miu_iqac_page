<template>
   <v-card class="hidden-sm-and-down" rounded="0" height="40">
      <v-tabs centered background-color="#4270A9" height="40">
         <v-tab
            v-for="item in linkItems"
            :key="item.title"
            :to="item.link"
            exact
            class="white--text"
         >
            <v-icon left color="white">{{ item.icon }}</v-icon>
            <!-- v-for="link in links" :key="link" -->
            {{ item.title }}
         </v-tab>
      </v-tabs>
   </v-card>
</template>

<script>
export default {
      data: () => ({                
        //logo: require('./logo.png')
        linkItems: [
            { title: "Home", icon: "mdi-home", link: "/" },
            { title: "About", icon: "mdi-information", link: "/about" },
            { title: "Members", icon: "mdi-account", link: "/members" },
            { title: "Events", icon: "mdi-home", link: "/events" },
            { title: "News", icon: "mdi-home", link: "/news" },
            { title: "Resources", icon: "mdi-home", link: "/resources" }
        ]
    }),
}
</script>

<style>

</style>