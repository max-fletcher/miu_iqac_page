<template>
  <div>

    <TopBar />

    <v-sheet class="mx-4 mb-3 mt-5 mt-md-3" min-height="450">

    <v-card height="480" min-height="300">
      <v-container fill-height fluid>
        <v-row align="center"
            justify="center">
            <div class="text-center">
              <h1>404 Error !</h1>
              <h2>Page Not Found !!</h2>
            </div>
        </v-row>
      </v-container>
    </v-card>

    </v-sheet>

  </div>
</template>

<script>
import TopBar from "./components/topbar";
export default {
  components: {
    TopBar
  },
}
</script>

<style>

</style>