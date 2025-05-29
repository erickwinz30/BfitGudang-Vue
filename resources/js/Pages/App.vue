<script setup>
// export default {
//     props: {
//         status: String || "Not success",
//     },
// };

import { defineProps, ref } from "vue";
import Header from "./Components/Header.vue";
import Sidebar from "./Layout/Sidebar.vue";

const props = defineProps({
  status: {
    type: String,
    default: "Not success",
  },
});

const status = ref(props.status);
</script>

<template>
  <Sidebar />
  <div class="flex flex-col min-h-screen pl-64">
    <header>
      <Header />
    </header>

    <main class="flex justify-center py-6">
      <slot></slot>
    </main>
  </div>

  <!-- <h1 class="text-3xl font-bold text-blue-600">{{ status }}</h1> -->
</template>
