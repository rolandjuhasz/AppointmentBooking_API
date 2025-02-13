<script setup>
import { ref } from "vue";

const isOpen = ref(false);
</script>

<template>
  <nav class="bg-[#131213] text-[#FDFDFD] shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="#" class="text-2xl font-bold text-[#6ABC5C]">MyBrand</a>


      <div class="hidden md:flex space-x-6">
        <RouterLink :to="{ name: 'home' }" class="hover:text-[#6ABC5C] transition duration-300">Home</RouterLink>
        <RouterLink :to="{ name: 'services' }" class="hover:text-[#6ABC5C] transition duration-300">Services</RouterLink>
        <RouterLink :to="{ name: 'home' }" class="hover:text-[#6ABC5C] transition duration-300">Contact</RouterLink>
      </div>


      <button @click="isOpen = !isOpen" class="md:hidden focus:outline-none">
        <svg
          class="w-8 h-8 text-[#FDFDFD]"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <div v-if="isOpen" class="md:hidden bg-[#131213] py-4 space-y-2 text-center border-t border-[#6ABC5C]">
      <RouterLink :to="{ name: 'home' }" class="block py-2 hover:text-[#6ABC5C]">Home</RouterLink>
      <RouterLink :to="{ name: 'home' }" class="block py-2 hover:text-[#6ABC5C]">Services</RouterLink>
      <RouterLink :to="{ name: 'home' }" class="block py-2 hover:text-[#6ABC5C]">Contact</RouterLink>
    </div>
  </nav>
</template>
