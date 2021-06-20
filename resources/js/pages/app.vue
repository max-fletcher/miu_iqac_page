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

                <!-- Style One -->
                <!-- <v-list nav flat tile>
                    <v-list-item to="/">                        
                        <v-icon left>mdi-home</v-icon>                        
                        <v-list-item-title>
                            Home
                        </v-list-item-title>                        
                    </v-list-item>
                </v-list> -->

                <!-- Style Two -->
                <v-card rounded="0" flat>
                    <v-btn                                
                        color="#4270A9"
                        height="40"                        
                        text
                        block
                        to="/"
                        exact-active-class="darken-1"
                    >
                        <v-icon left>
                            mdi-home
                        </v-icon>
                        Home
                        <v-spacer></v-spacer>
                    </v-btn>
                    <v-btn                                
                        color="#4270A9"
                        height="40"
                        text                        
                        block
                        to="/about"
                        exact-active-class="darken-1"
                    >
                        <v-icon left>
                            mdi-information-outline
                        </v-icon>
                        About
                        <v-spacer></v-spacer>
                    </v-btn>
                    <v-menu open-on-hover bottom offset-y transition="scale-transition">
                        <template v-slot:activator="{ on, attrs }">
                            <!-- exact-path for later -->
                            <v-card rounded="0" flat>
                                <v-btn                                
                                    color="#4270A9"
                                    v-bind="attrs"
                                    v-on="on"                                                                  
                                    height="40"
                                    text
                                    block                                    
                                    exact-path-active-class="lighten-1"                                    
                                >
                                <!-- path class not working -->
                                    <v-icon left>
                                        mdi-account
                                    </v-icon>
                                    People
                                    <v-spacer></v-spacer>
                                    <v-icon small right>
                                        mdi-chevron-down
                                    </v-icon>
                                </v-btn>
                            </v-card>
                        </template>
                        <v-list>
                            <v-list-item to="/people/iqac" color="#4270A9">
                                <v-list-item-title class="font-weight-bold"> IQAC </v-list-item-title>
                            </v-list-item>
                            <v-list-item to="/people/sac" color="#4270A9">
                                <v-list-item-title class="font-weight-bold"> SAC </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                    <v-btn                                
                        color="#4270A9"
                        height="40"                        
                        text
                        block
                        to="/events"
                        exact-active-class="darken-1"
                    >
                        <v-icon left>
                            mdi-calendar-clock
                        </v-icon>
                        Events
                        <v-spacer></v-spacer>
                    </v-btn>
                    <v-btn                                
                        color="#4270A9"
                        height="40"                        
                        text
                        block
                        to="/news"
                        exact-active-class="darken-1"
                    >
                        <v-icon left>
                            mdi-newspaper-variant
                        </v-icon>
                        News
                        <v-spacer></v-spacer>
                    </v-btn>
                    <v-btn
                        color="#4270A9"
                        height="40"                        
                        text
                        block
                        to="/resources"
                        exact-active-class="darken-1"
                    >
                        <v-icon left>
                            mdi-archive
                        </v-icon>
                        Resources
                        <v-spacer></v-spacer>
                    </v-btn>                
                </v-card>                

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
                            Quick Links
                        </v-list-item-title>
                        <v-list-item-subtitle class="mt-1">
                            Click to Expand Links
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>

                <v-divider></v-divider>

                <v-expansion-panels accordion>
                    <v-expansion-panel>
                        <v-expansion-panel-header > Publications </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.                            
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel>
                        <v-expansion-panel-header > Archive </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel>
                        <v-expansion-panel-header > Gallery </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel>
                        <v-expansion-panel-header > Contact Us </v-expansion-panel-header>
                        <v-expansion-panel-content>
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    
                </v-expansion-panels>
            </v-navigation-drawer>
            <!-- End Quick Links Drawer -->

            <!-- Banner -->
            <v-card
                class="d-flex pl-4 pl-sm-6 pl-md-16 rounded-0"
                color="#002147"
                fluid
                width="auto"
                height="110"
                to="/"
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
                >
                </v-img>
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

            <v-card class="hidden-sm-and-down">
                <v-card
                    class="d-flex justify-center"
                    rounded="0"
                    height="40"
                    color="#4270A9"
                >
                    <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text
                        to="/"
                        exact-active-class="light"
                    >
                        <v-icon left>
                            mdi-home
                        </v-icon>
                        Home
                    </v-btn>
                    <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text
                        to="/about"
                        exact-active-class="light"
                    >
                        <v-icon left>
                            mdi-information-outline
                        </v-icon>
                        About
                    </v-btn>
                    <v-menu open-on-hover bottom offset-y transition="scale-transition">
                        <template v-slot:activator="{ on, attrs }">
                            <!-- exact-path for later -->
                            <v-btn
                                color="#4270A9"
                                v-bind="attrs"
                                v-on="on"
                                tile
                                class="white--text"
                                height="40"
                                text
                                exact-active-class=""
                            >
                                <v-icon left>
                                    mdi-account
                                </v-icon>
                                People
                                <v-icon small>
                                    mdi-chevron-down
                                </v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item to="/people/iqac" color="#4270A9">
                                <v-list-item-title class="font-weight-bold"> IQAC </v-list-item-title>
                            </v-list-item>
                            <v-list-item to="/people/sac" color="#4270A9">
                                <v-list-item-title class="font-weight-bold"> SAC </v-list-item-title>
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
                        to="/events"
                        exact-active-class="light"
                    >
                        <v-icon left>
                            mdi-calendar-clock-outline
                        </v-icon>
                        Events
                    </v-btn>
                    <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text
                        to="/news"
                        exact-active-class="light"
                    >
                        <v-icon left>
                            mdi-newspaper-variant-outline
                        </v-icon>
                        News
                    </v-btn>
                    <v-btn
                        color="#4270A9"
                        v-bind="attrs"
                        v-on="on"
                        tile
                        class="white--text"
                        height="40"
                        text
                        to="/resources"
                        exact-active-class="light"                        
                    >
                        <v-icon left>
                            mdi-archive-outline
                        </v-icon>
                        Resources
                    </v-btn>
                </v-card>
            </v-card>
            <!--End Navbar -->

            <!-- v-main is the main content area e.g background -->
            <v-main class="grey lighten-3">
                <v-sheet class="mx-4 mb-5 mt-7 mb-sm-5">
                    <router-view />
                </v-sheet>
            </v-main>
        </v-app>
    </div>
</template>

<script>
export default {
    data: () => ({
        toggleNavSidebar: false,
        toggleQuickLinksSidebar: false
    }),
    components: {
                
    }
};
</script>

<style scoped></style>
