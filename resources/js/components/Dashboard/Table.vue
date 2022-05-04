<template>
  <div class="w-full mb-8 rounded-lg shadow-xs">
    <div class="w-full">
      <table class="w-full border-collapse table-auto">
        <thead>
          <tr
            class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border-b dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800"
          >
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Phone</th>
            <th class="px-4 py-3">From</th>
            <th class="px-4 py-3">To</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>

        <tbody
          class="bg-white divide-y dark:divide-slate-700 dark:bg-slate-800"
        >
          <tr
            class="text-slate-700 dark:text-slate-400 text-sm"
            v-for="item in data"
            :key="item.id"
          >
            <td class="px-4 py-3">
              {{ item.name }}
            </td>
            <td class="px-4 py-3">
              {{ item.phone }}
            </td>
            <td class="px-4 py-3">
              {{ item.destination_from }}
            </td>
            <td class="px-4 py-3">
              {{ item.destination_to }}
            </td>
            <td class="px-4 py-3">
              <VendorListBox :currentStatus="item.status" :recordID="item.id" />
            </td>
            <td class="px-4 py-3 space-x-3">
              <button @click="openDialog(item)">
                <EyeIcon class="w-5 h-5" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <VendorDialog
    :item="dialog.item"
    :isOpen="dialog.isOpen"
    @closeDialog="closeDialog"
  />
</template>

<script>
import VendorListBox from "../vendor/ListBox.vue";
import VendorDialog from "../vendor/Dialog.vue";
import { EyeIcon, PhotographIcon } from "@heroicons/vue/outline";

export default {
  components: {
    VendorListBox,
    VendorDialog,
    EyeIcon,
    PhotographIcon,
  },

  data() {
    return {
      dialog: {
        isOpen: false,
        item: {},
      },
      data: [],
    };
  },

  mounted() {
    this.getData();
  },

  methods: {
    async getData() {
      const {
        data: { data },
      } = await axios.get("/dashboard/json/rentals");
      this.data = data.data;
    },

    openDialog(item) {
      this.dialog.isOpen = true;
      this.dialog.item = item;
    },

    closeDialog() {
      this.dialog = { isOpen: false, item: {} };
    },
  },
};
</script>

<style></style>
