<script setup>
import Navbar from "./components/Navbar.vue";
import { RouterView } from "vue-router";
</script>

<template>
  <Navbar />
  <div class="bg-[#38BDF8]">
    <RouterView />
  </div>
</template>
