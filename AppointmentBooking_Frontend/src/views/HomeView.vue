<template>
    <div class="relative min-h-screen bg-[#1F2937] text-white flex items-center justify-center">
      
      <!-- Finom háttér fényhatás -->
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.1),_transparent)]"></div>
  
      <!-- Hero Content -->
      <div class="text-center z-10 px-6 sm:px-12">
        <h1 class="text-5xl sm:text-6xl font-extrabold text-white drop-shadow-lg">
          Schedule Your Appointment in Minutes
        </h1>
        <p class="text-lg sm:text-xl mt-6 max-w-2xl mx-auto text-[#F3F4F6]">
          Our easy-to-use system helps you schedule your appointments quickly and efficiently.
        </p>
  
        <!-- CTA Buttons -->
        <div class="mt-8 flex justify-center space-x-6">
          <button class="px-10 py-3 bg-[#10B981] text-white font-semibold rounded-full shadow-lg hover:bg-[#0b9a72] transition-all duration-300">
            Book Now
          </button>
          <button class="px-10 py-3 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-[#1F2937] transition-all duration-300">
            Learn More
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
    // Csak dizájn, nincs szükség semmilyen funkcióra
  </script>
  
  <style scoped>
    /* Finom animációk a szöveghez */
    .hero-content {
      animation: fadeIn 2s ease-in-out;
    }
  
    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
  </style>
  