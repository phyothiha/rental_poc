<template>
  <div>
    <h1>Backend Layout</h1>
    <navigation></navigation>
    <router-view></router-view>
  </div>
</template>

<script>
import Navigation from "../../components/Navigation.vue";

export default {
  components: {
    Navigation,
  },
};
</script>

<style></style>
