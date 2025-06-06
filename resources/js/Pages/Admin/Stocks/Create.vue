<script setup>
import { defineProps, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import App from "@/Pages/App.vue";
import ErrorAlert from "../../Components/ErrorAlert.vue";

const props = defineProps({
  status: {
    type: String,
  },
});

const status = ref(props.status || null);
console.log(status.value);

const form = useForm({
  name: "",
  code: "",
  weight: "",
  lead_time: "",
  demand: "",
  highest_sales: "",
  longest_lead_time: "",
  stock: "",
});

const submit = () => {
  form.post("/stocks");
};
</script>

<template>
  <App>
    <div class="flex flex-col justify-center">
      <ErrorAlert v-if="status" :message="status" />
      <div class="p-4 border-2 rounded-lg shadow-md border-slate-500">
        <form class="mx-auto max-w" @submit.prevent="submit">
          <div class="mb-5">
            <label
              for="name"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Nama</label
            >
            <input
              type="text"
              id="name"
              name="name"
              v-model="form.name"
              class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
              placeholder="Red Panda 508"
              required
            />
          </div>
          <div class="mb-5">
            <label
              for="code"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Code</label
            >
            <input
              type="text"
              id="code"
              name="code"
              v-model="form.code"
              class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
              placeholder="RP508"
              required
            />
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="mb-5">
              <label
                for="weight"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Weight</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="weight"
                name="weight"
                v-model="form.weight"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
            <div class="mb-5">
              <label
                for="lead_time"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Lead Time</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="lead_time"
                name="lead_time"
                v-model="form.lead_time"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="mb-5">
              <label
                for="demand"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Demand</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="demand"
                name="demand"
                v-model="form.demand"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
            <div class="mb-5">
              <label
                for="highest_sales"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Penjualan Tertinggi</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="highest_sales"
                name="highest_sales"
                v-model="form.highest_sales"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="mb-5">
              <label
                for="longest_lead_time"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Lead Time Terlama</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="longest_lead_time"
                name="longest_lead_time"
                v-model="form.longest_lead_time"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
            <div class="mb-5">
              <label
                for="stock"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Jumlah Stock</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="stock"
                name="stock"
                v-model="form.stock"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
          </div>
          <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Add
          </button>
        </form>
      </div>
    </div>
  </App>
</template>
