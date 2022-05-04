<template>
  <div>
    <h1>Frontend Layout</h1>
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
