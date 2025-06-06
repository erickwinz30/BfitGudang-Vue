<script setup>
import { defineProps, ref } from "vue";
import App from "@/Pages/App.vue";
import ErrorAlert from "../../Components/ErrorAlert.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  stock: {
    type: Object,
  },
  status: {
    type: String,
  },
});

const stock = ref(props.stock || {});
console.log(stock);
const status = ref(props.status || null);

const form = useForm({
  id: "",
  amount: "",
  status: "",
  description: "",
});

const submit = () => {
  form.post(`/reduce/${stock.value.id}`);
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
              class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
              placeholder="Red Panda 508"
              :value="stock.name"
              disabled
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
              class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
              placeholder="RP508"
              :value="stock.code"
              disabled
              required
            />
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="mb-5">
              <label
                for="amount"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Jumlah Keluar</label
              >
              <input
                type="text"
                inputmode="numeric"
                id="amount"
                name="amount"
                v-model="form.amount"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="20"
                required
              />
            </div>
            <div class="mb-5">
              <label
                for="status"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Status</label
              >
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input
                    id="default-radio-1"
                    type="radio"
                    value="Terjual"
                    name="status"
                    v-model="form.status"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  />
                  <label
                    for="default-radio-1"
                    class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300"
                    >Terjual</label
                  >
                </div>
                <div class="flex items-center">
                  <input
                    id="default-radio-2"
                    type="radio"
                    value="Cabang"
                    name="status"
                    v-model="form.status"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  />
                  <label
                    for="default-radio-2"
                    class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300"
                    >Cabang</label
                  >
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="mb-5">
              <label
                for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Keterangan</label
              >
              <textarea
                id="description"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Keterangan..."
                v-model="form.description"
                required
              ></textarea>
            </div>
          </div>
          <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            Reduce
          </button>
        </form>
      </div>
    </div>
  </App>
</template>
