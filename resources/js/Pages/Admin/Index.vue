<script setup>
import { defineProps, ref } from "vue";
import App from "../App.vue";
import SuccessAlert from "../Components/SuccessAlert.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  status: {
    type: String,
    required: true,
  },
  stocks: {
    type: Object,
  },
});

const status = ref(props.status || null);
const stocks = ref(props.stocks);

const submitDelete = (id) => {
  Swal.fire({
    title: "Anda yakin ingin menghapus data ini?",
    text: "Setelah dihapus, data tidak bisa dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`stocks/${id}`);
    }
  });
};
</script>

<template>
  <App>
    <div class="flex flex-col justify-center">
      <div class="flex justify-center w-full px-[80px]">
        <div class="relative w-full overflow-x-auto shadow-md">
          <SuccessAlert v-if="status" :message="status" />
          <div
            class="flex flex-wrap items-center justify-end space-y-4 flex-column sm:flex-row sm:space-y-0"
          >
            <div class="flex space-x-4">
              <label for="table-search" class="sr-only">Search</label>
              <div class="relative">
                <div
                  class="absolute inset-y-0 left-0 flex items-center pointer-events-none rtl:inset-r-0 rtl:right-0 ps-3"
                >
                  <svg
                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  type="text"
                  id="table-search"
                  class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Search for items"
                />
              </div>
              <a
                href="/create"
                type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              >
                Add
              </a>
            </div>
          </div>
          <div
            class="flex flex-wrap items-center justify-between space-y-4 flex-column sm:flex-row sm:space-y-0"
          >
            <table
              class="w-full overflow-hidden text-sm text-left text-gray-500 rounded-lg rtl:text-right dark:text-gray-400"
            >
              <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
              >
                <tr>
                  <th scope="col" class="px-6 py-3">No.</th>
                  <th scope="col" class="px-6 py-3">Nama</th>
                  <th scope="col" class="px-6 py-3">Kode</th>
                  <th scope="col" class="px-6 py-3">Berat</th>
                  <th scope="col" class="px-6 py-3">Lead Time</th>
                  <th scope="col" class="px-6 py-3">Demand</th>
                  <th scope="col" class="px-6 py-3">Penjualan Tertinggi</th>
                  <th scope="col" class="px-6 py-3">Lead Time Terlama</th>
                  <th scope="col" class="px-6 py-3">Jumlah Stock</th>
                  <th scope="col" class="px-6 py-3">Safety Stock</th>
                  <th scope="col" class="px-6 py-3">Reorder Point</th>
                  <th scope="col" class="px-6 py-3">Action</th>
                </tr>
              </thead>
              <tbody v-for="(stock, index) in stocks" :key="stock.id">
                <tr
                  class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                >
                  <td class="px-6 py-4">{{ index + 1 }}</td>
                  <td class="px-6 py-4">{{ stock.name }}</td>
                  <td class="px-6 py-4">{{ stock.code }}</td>
                  <td class="px-6 py-4">{{ stock.weight }}</td>
                  <td class="px-6 py-4">{{ stock.lead_time }}</td>
                  <td class="px-6 py-4">{{ stock.demand }}</td>
                  <td class="px-6 py-4">{{ stock.highest_sales }}</td>
                  <td class="px-6 py-4">{{ stock.longest_lead_time }}</td>
                  <td class="px-6 py-4">{{ stock.stock }}</td>
                  <td class="px-6 py-4">{{ stock.safety_stock }}</td>
                  <td class="px-6 py-4">{{ stock.reorder_point }}</td>
                  <td class="px-6 py-4">
                    <a
                      :href="`/stocks/${stock.id}/edit`"
                      class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                      >Edit</a
                    >
                    <form @submit.prevent="submitDelete(stock.id)">
                      <button
                        type="submit"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                      >
                        Delete
                      </button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </App>
</template>
