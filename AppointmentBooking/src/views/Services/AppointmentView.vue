<script setup>
import { useAppointmentStore } from "@/stores/appointment";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

const route = useRoute();
const appointmentStore = useAppointmentStore();
const authStore = useAuthStore();
const appointments = ref([]);

onMounted(async () => {
  await appointmentStore.getAppointments(route.params.id);
  appointments.value = appointmentStore.appointments;
});
</script>

<template>
  <main class="p-8 bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">
    <div v-if="appointments.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="appointment in appointments"
        :key="appointment.id"
        class="bg-white/90 backdrop-blur-lg rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out p-6 border border-gray-100"
      >
        <div class="flex items-center justify-between mb-4">
          <span class="text-sm font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">
            {{ appointment.status || 'Scheduled' }}
          </span>
          <span class="text-xs text-gray-500">
            {{ new Date(appointment.appointment_time).toLocaleDateString() }}
          </span>
        </div>
        <h3 class="text-lg font-bold text-gray-800 mb-2">
          {{ appointment.title || 'Appointment' }}
        </h3>
        <p class="text-sm text-gray-600 mb-4">
          {{ appointment.description || 'No description provided.' }}
        </p>
        <div class="flex items-center justify-between text-sm text-gray-500">
          <span>
            {{ new Date(appointment.appointment_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }}
          </span>
          <RouterLink
            to="/"
            class="text-purple-600 hover:text-purple-800 transition-colors duration-200"
          >
          Make a reservation
          </RouterLink>
        </div>
      </div>
    </div>

    <div v-else class="text-center py-20">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">No appointments found for this course.</h2>
      <p class="text-gray-600">Please check back later or schedule a new appointment.</p>
    </div>
  </main>
</template>