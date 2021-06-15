<template>
    <div>
        <v-app id="inspire">
            <!-- Nav Drawer -->
            <v-navigation-drawer v-model="toggleNavSidebar" absolute temporary>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title class="text-h6">
                            Navigation
                        </v-list-item-title>
                        <v-list-item-subtitle class="mt-1">
                            Click to navigate to a page
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

                <v-divider></v-divider>

                <v-list dense nav>
                    <v-list-item
                        v-for="item in linkItems"
                        :key="item.title"
                        :to="item.link"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{
                                item.title
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
                <v-expansion-panels accordion>
                    <v-expansion-panel
                        v-for="(item,i) in 5"
                        :key="i"
                    >
                        <v-expansion-panel-header>Item</v-expansion-panel-header>
                        <v-expansion-panel-content>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-navigation-drawer>
            <!-- End Nav Drawer -->

            <!-- Quick Links Drawer -->
            <v-navigation-drawer
                v-model="toggleQuickLinksSidebar"
                absolute
                temporary
                right
            >
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title class="text-h6">
                            Navigation
                        </v-list-item-title>
                        <v-list-item-subtitle class="mt-1">
                            Click to navigate to a page
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

                <v-divider></v-divider>

                <v-list dense nav>
                    <v-list-item
                        v-for="item in linkItems"
                        :key="item.title"
                        :to="item.link"
                        link
                    >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>
                                {{ item.title }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
            <!-- End Quick Links Drawer -->

            <!-- Banner -->
            <v-card
                class="d-flex pl-4 pl-sm-6 pl-md-16 rounded-0"
                color="#002147"
                fluid
                width="auto"
                height="110"
            >
                <v-img
                    src="images/logo.png"
                    width="auto"
                    height="auto"
                    min-width="50px"
                    min-height="50px"
                    max-width="100px"
                    max-height="100px"
                    contain
                    class="my-3 ml-2 mr-0"
                ></v-img>
                <v-content class="my-auto">
                    <div
                        class="font-weight-light white--text text-body-2 text-sm-subtitle-1 text-md-h4-subtitle-1 pl-md-2"
                    >
                        DEPARTMENT OF
                    </div>
                    <div
                        class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h5 pl-md-2"
                    >
                        INSTITUTIONAL QUALITY
                    </div>
                    <div
                        class="font-weight-bold white--text text-h6 text-sm-h5 text-md-h5 pl-md-2"
                    >
                        ASSURANCE CELL
                    </div>
                </v-content>
            </v-card>
            <!-- End Banner -->

            <!-- Navbar -->
            <!-- height props available -->
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
            <v-card class="hidden-md-and-up" rounded="0" height="40">
                <v-tabs background-color="#4270A9">
                    <v-tab
                        class="white--text"
                        @click.stop="toggleNavSidebar = !toggleNavSidebar"
                    >
                        <v-icon left color="white"> mdi-menu </v-icon>
                        Navbar Links
                    </v-tab>
                    <v-spacer></v-spacer>
                    <v-tab
                        class="white--text"
                        @click.stop="
                            toggleQuickLinksSidebar = !toggleQuickLinksSidebar
                        "
                    >
                        <v-icon left color="white"> mdi-menu </v-icon>
                        Quick Links
                    </v-tab>
                </v-tabs>
            </v-card>
            <!-- Testing New Navbar -->
            <v-card class="hidden-sm-and-down">
                <v-card class="d-flex justify-center" rounded="0" height="40" color="#4270A9">
                    <v-menu open-on-hover bottom offset-y>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="#4270A9"
                                v-bind="attrs"
                                v-on="on"
                                tile
                                class="white--text"
                                height="40"
                                text
                            >
                                Dropdown
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item
                                v-for="(item, index) in linkItems"
                                :key="index"
                            >
                                <v-list-item-title>{{
                                    item.title
                                }}</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>

                    <v-menu open-on-hover bottom offset-y>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="#4270A9"
                                v-bind="attrs"
                                v-on="on"
                                tile
                                class="white--text"
                                height="40"
                                text
                            >
                                Dropdown
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item
                                v-for="(item, index) in linkItems"
                                :key="index"
                            >
                                <v-list-item-title>{{
                                    item.title
                                }}</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                    <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text                    
                    >
                    <v-icon left>
                        mdi-pencil
                    </v-icon>
                        Button
                    </v-btn>
                </v-card>
            </v-card>                                            
            <!-- End Testing New Navbar -->
            <!--End Navbar -->

            <!-- v-main is the main content area e.g background -->
            <v-main class="grey lighten-3">
                <v-sheet class="mx-4 my-5">
                    <router-view />
                    <!-- <v-row>
                    <v-col cols="9">
                        <v-card flat>
                            <router-view></router-view>
                        </v-card>
                    </v-col> -->
                    <!-- Quick Links Accordion -->
                    <!-- <QuickLinks /> -->
                    <!-- End Quick Links Accordion -->
                    <!-- </v-row> -->
                </v-sheet>
            </v-main>
        </v-app>
    </div>
</template>

<script>
import QuickLinks from "./components/quicklinks";
export default {
    data: () => ({
        toggleNavSidebar: false,
        toggleQuickLinksSidebar: false,
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
    components: {
        QuickLinks
    }
};
</script>

<style scoped></style>
