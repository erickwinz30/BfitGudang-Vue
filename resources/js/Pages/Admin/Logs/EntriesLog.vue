<script setup>
import { defineProps, ref, computed, watch } from "vue";
import App from "@/Pages/App.vue";

const props = defineProps({
  logs: {
    type: Object,
    required: true,
  },
});

const logs = ref(props.logs);
const selectedRange = ref("thirty-days"); // default
const selectedRangeText = ref("Last 30 days");

const lastDay = () => {
  const today = new Date();
  const yesterday = new Date(today);
  yesterday.setDate(today.getDate() - 1);
  console.log(logs.value);
  console.log("Last Day Selected");
  // selectedRangeText.value = "Last Day";
  return logs.value.filter((log) => new Date(log.created_at) >= yesterday);
};

const last7Days = () => {
  const today = new Date();
  const sevenDaysAgo = new Date(today);
  sevenDaysAgo.setDate(today.getDate() - 7);
  // selectedRangeText.value = "Last 7 Days";
  return logs.value.filter((log) => new Date(log.created_at) >= sevenDaysAgo);
};

const last30Days = () => {
  const today = new Date();
  const thirtyDaysAgo = new Date(today);
  thirtyDaysAgo.setDate(today.getDate() - 30);
  // selectedRangeText.value = "Last 30 Days";
  return logs.value.filter((log) => new Date(log.created_at) >= thirtyDaysAgo);
};

const lastMonth = () => {
  const today = new Date();
  const firstDayOfLastMonth = new Date(
    today.getFullYear(),
    today.getMonth() - 1,
    1
  );
  const lastDayOfLastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
  // selectedRangeText.value = "Last Month";
  return logs.value.filter(
    (log) =>
      new Date(log.created_at) >= firstDayOfLastMonth &&
      new Date(log.created_at) <= lastDayOfLastMonth
  );
};

const lastYear = () => {
  const today = new Date();
  const lastYearDate = new Date(
    today.getFullYear() - 1,
    today.getMonth(),
    today.getDate()
  );
  console.log("Last Year Selected");
  // selectedRangeText.value = "Last Year";
  return logs.value.filter((log) => new Date(log.created_at) >= lastYearDate);
};

// Computed untuk hasil filter
const filteredLogs = computed(() => {
  switch (selectedRange.value) {
    case "last-day":
      return lastDay();
    case "seven-days":
      return last7Days();
    case "thirty-days":
      return last30Days();
    case "last-month":
      return lastMonth();
    case "last-year":
      return lastYear();
    default:
      return logs.value;
  }
});

watch(selectedRange, (val) => {
  switch (val) {
    case "last-day":
      selectedRangeText.value = "Last Day";
      break;
    case "seven-days":
      selectedRangeText.value = "Last 7 Days";
      break;
    case "thirty-days":
      selectedRangeText.value = "Last 30 Days";
      break;
    case "last-month":
      selectedRangeText.value = "Last Month";
      break;
    case "last-year":
      selectedRangeText.value = "Last Year";
      break;
    default:
      selectedRangeText.value = "All";
  }
});
</script>

<template>
  <App>
    <div class="flex flex-col justify-center">
      <div class="flex justify-center w-full px-[40px]">
        <div class="relative w-full overflow-x-auto shadow-md">
          <SuccessAlert v-if="status" :message="status" />
          <div
            class="flex flex-wrap items-center justify-between py-3 space-y-4 flex-column sm:flex-row sm:space-y-0"
          >
            <div>
              <button
                id="dropdownRadioButton"
                data-dropdown-toggle="dropdownRadio"
                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button"
              >
                <svg
                  class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"
                  />
                </svg>
                {{ selectedRangeText }}
                <svg
                  class="w-2.5 h-2.5 ms-2.5"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 10 6"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 4 4 4-4"
                  />
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div
                id="dropdownRadio"
                class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                data-popper-reference-hidden=""
                data-popper-escaped=""
                data-popper-placement="top"
                style="
                  position: absolute;
                  inset: auto auto 0px 0px;
                  margin: 0px;
                  transform: translate3d(522.5px, 3847.5px, 0px);
                "
              >
                <ul
                  class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="dropdownRadioButton"
                >
                  <li>
                    <div
                      class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="range-date-example-1"
                        type="radio"
                        value="last-day"
                        name="range-date"
                        v-model="selectedRange"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      />
                      <label
                        for="range-date-example-1"
                        class="w-full text-sm font-medium text-gray-900 rounded-sm ms-2 dark:text-gray-300"
                        >Last day</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        checked="true"
                        id="range-date-example-2"
                        type="radio"
                        value="seven-days"
                        name="range-date"
                        v-model="selectedRange"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      />
                      <label
                        for="range-date-example-2"
                        class="w-full text-sm font-medium text-gray-900 rounded-sm ms-2 dark:text-gray-300"
                        >Last 7 days</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="range-date-example-3"
                        type="radio"
                        value="thirty-days"
                        name="range-date"
                        v-model="selectedRange"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      />
                      <label
                        for="range-date-example-3"
                        class="w-full text-sm font-medium text-gray-900 rounded-sm ms-2 dark:text-gray-300"
                        >Last 30 days</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="range-date-example-4"
                        type="radio"
                        value="last-month"
                        name="range-date"
                        v-model="selectedRange"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      />
                      <label
                        for="range-date-example-4"
                        class="w-full text-sm font-medium text-gray-900 rounded-sm ms-2 dark:text-gray-300"
                        >Last month</label
                      >
                    </div>
                  </li>
                  <li>
                    <div
                      class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                      <input
                        id="range-date-example-5"
                        type="radio"
                        value="last-year"
                        name="range-date"
                        v-model="selectedRange"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      />
                      <label
                        for="range-date-example-5"
                        class="w-full text-sm font-medium text-gray-900 rounded-sm ms-2 dark:text-gray-300"
                        >Last year</label
                      >
                    </div>
                  </li>
                </ul>
              </div>
            </div>
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
                  <th scope="col" class="px-6 py-3">Jumlah</th>
                  <th scope="col" class="px-6 py-3">Status</th>
                  <th scope="col" class="px-6 py-3">Deskripsi</th>
                  <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                </tr>
              </thead>
              <tbody v-for="(log, index) in filteredLogs" :key="log.id">
                <tr
                  class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                >
                  <td class="px-6 py-4">{{ index + 1 }}</td>
                  <td class="px-6 py-4">{{ log.name }}</td>
                  <td class="px-6 py-4">{{ log.code }}</td>
                  <td class="px-6 py-4">{{ log.amount }}</td>
                  <td class="px-6 py-4">{{ log.status }}</td>
                  <td class="px-6 py-4">{{ log.description }}</td>
                  <td class="px-6 py-4">{{ log.created_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </App>
</template>
