<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  username: "",
  password: "",
});

console.log("Authentication Page Loaded");
</script>

<template>
  <div
    class="flex items-center justify-center h-screen bg-gray-100 dark:bg-gray-900"
  >
    <div class="flex flex-col">
      <div>
        <h1
          class="mb-6 text-2xl font-bold text-center text-gray-900 dark:text-white"
        >
          Welcome to the Authentication Page
        </h1>
        <p class="mb-6 text-center text-gray-600 dark:text-gray-400">
          Please enter your credentials to continue.
        </p>
      </div>
      <form
        class="w-full max-w-md p-6 bg-white rounded-lg shadow-md dark:bg-gray-800"
      >
        <div class="mb-5">
          <label
            for="username"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Your username</label
          >
          <input
            type="username"
            id="username"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="name@flowbite.com"
            v-model="form.username"
            required
          />
        </div>
        <div class="mb-5">
          <label
            for="password"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Your password</label
          >
          <input
            type="password"
            id="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            v-model="form.password"
            required
          />
        </div>
        <button
          type="submit"
          @click.prevent="form.post('/login')"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Login
        </button>
      </form>
    </div>
  </div>
</template>
