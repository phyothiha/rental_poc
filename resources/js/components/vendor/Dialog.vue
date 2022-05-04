<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog @close="closeDialog">
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay class="fixed inset-0 bg-slate-900 opacity-75" />
          </TransitionChild>

          <span class="inline-block h-screen align-middle" aria-hidden="true">
            &#8203;
          </span>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div
              class="inline-block w-full max-w-2xl my-8 overflow-hidden text-center align-middle transition-all transform bg-white shadow-xl rounded-2xl"
            >
              <div class="p-6">
                <DialogTitle
                  as="h3"
                  class="text-xl font-medium leading-6 text-slate-900 text-left"
                >
                  User Information
                </DialogTitle>

                <DialogDescription
                  class="mt-6 text-sm leading-relaxed text-slate-500 text-left"
                >
                  <table class="w-full border-collapse table-auto">
                    <tbody
                      class="bg-white divide-y dark:divide-slate-700 dark:bg-slate-800"
                    >
                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          name
                        </td>
                        <td class="px-4 py-3 border dark:border-slate-700">
                          {{ item.name }}
                        </td>
                      </tr>

                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          email
                        </td>
                        <td class="px-4 py-3 border dark:border-slate-700">
                          {{ item.email }}
                        </td>
                      </tr>

                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          phone
                        </td>
                        <td class="px-4 py-3 border dark:border-slate-700">
                          {{ item.phone }}
                        </td>
                      </tr>

                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          destination from
                        </td>
                        <td class="px-4 py-3 border dark:border-slate-700">
                          {{ item.destination_from }}
                        </td>
                      </tr>

                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          destination to
                        </td>
                        <td class="px-4 py-3 border dark:border-slate-700">
                          {{ item.destination_to }}
                        </td>
                      </tr>

                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          status
                        </td>
                        <td class="px-4 py-3 border dark:border-slate-700">
                          {{ item.status_text }}
                        </td>
                      </tr>

                      <tr class="text-slate-700 dark:text-slate-400 text-sm">
                        <td
                          class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border dark:border-slate-700 bg-slate-50 dark:text-slate-400 dark:bg-slate-800 px-4 py-3"
                        >
                          Attachments
                        </td>
                        <td
                          class="px-4 py-3 space-x-4 border dark:border-slate-700"
                        >
                          <template
                            v-for="(attachment, index) in item.attachments"
                            :key="index"
                          >
                            <a
                              v-if="attachment"
                              :href="attachment"
                              target="_blank"
                              class="inline-block"
                            >
                              <img
                                class="object-cover object-center h-20 w-20 rounded"
                                :src="attachment"
                                alt="attachment"
                              />
                            </a>
                          </template>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </DialogDescription>

                <div class="mt-6 text-right">
                  <button
                    type="button"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                    @click="closeDialog"
                  >
                    Close
                  </button>
                </div>
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
  DialogDescription,
} from "@headlessui/vue";

export default {
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
    DialogDescription,
  },

  props: ["item", "isOpen"],

  methods: {
    closeDialog() {
      this.$emit("closeDialog", false);
      // this.isOpen = false;
    },
  },
};
</script>

<style></style>
