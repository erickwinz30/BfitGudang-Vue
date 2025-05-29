<script setup>
// export default {
//     props: {
//         status: String || "Not success",
//     },
// };

import { defineProps, ref } from "vue";
import Header from "@/Pages/Components/Header.vue";

const props = defineProps({
    status: {
        type: String,
        default: "Not success",
    },
});

const status = ref(props.status);
</script>

<template>
    <header>
        <Header />
    </header>
    <slot></slot>
    <!-- <h1 class="text-3xl font-bold text-blue-600">{{ status }}</h1> -->
</template>
