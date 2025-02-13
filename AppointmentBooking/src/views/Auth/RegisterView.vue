<script setup>
import { useAuthStore } from "@/stores/auth";
import { storeToRefs } from "pinia";
import { onMounted, reactive } from "vue";

const { errors } = storeToRefs(useAuthStore());
const { authenticate } = useAuthStore();

const formData = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  role: "user"
});

onMounted(() => (errors.value = {}));
</script>

<template>
  <main class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
      <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">
        Register a new account
      </h1>

      <form @submit.prevent="authenticate('register', formData)" class="space-y-6">
        <div>
          <input
            type="text"
            placeholder="Name"
            v-model="formData.name"
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p class="text-red-500 text-sm mt-2" v-if="errors.name && errors.name[0]">
            {{ errors.name[0] }}
          </p>
        </div>

        <div>
          <input
            type="text"
            placeholder="Email"
            v-model="formData.email"
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p class="text-red-500 text-sm mt-2" v-if="errors.email && errors.email[0]">
            {{ errors.email[0] }}
          </p>
        </div>

        <div>
          <input
            type="password"
            placeholder="Password"
            v-model="formData.password"
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p class="text-red-500 text-sm mt-2" v-if="errors.password && errors.password[0]">
            {{ errors.password[0] }}
          </p>
        </div>

        <div>
          <input
            type="password"
            placeholder="Confirm Password"
            v-model="formData.password_confirmation"
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div>
  <label class="text-gray-800" for="role">Choose your role:</label>
  <select
    id="role"
    v-model="formData.role"
    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
  >
    <option value="user">User</option>
    <option value="expert">Expert</option>
  </select>
  <p class="text-red-500 text-sm mt-2" v-if="errors.role && errors.role[0]">
    {{ errors.role[0] }}
  </p>
</div>

        <button
          class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition"
        >
          Register
        </button>
      </form>
    </div>
  </main>
</template>
