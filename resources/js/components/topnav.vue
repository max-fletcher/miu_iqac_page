<template>
    <div>
        <v-app-bar>
            <v-toolbar-title>BoilerPlate </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items class="hidden-xs-only">
                <v-btn to="/" text>
                    <v-icon small left>mdi-home</v-icon>
                    Home
                </v-btn>
                <v-btn to="/about" text>
                    <v-icon small left>mdi-information-variant</v-icon>
                    About
                </v-btn>
                <v-btn to="/link" text>
                    <v-icon small left>mdi-link</v-icon>
                    Link 1
                </v-btn>
                <v-btn to="/logout" text>
                    <v-icon small left>mdi-power-standby</v-icon>
                    Logout
                </v-btn>
            </v-toolbar-items>
        </v-app-bar>
    </div>
</template>

<script>
export default {
    data: () => ({
        drawer: false,
        items: [
            {title: 'Home', link: '/', icon: "mdi-home"},
            {title: 'About', link: '/about', icon: "mdi-information-variant"}
        ]
    }),
};
</script>

<style></style>
