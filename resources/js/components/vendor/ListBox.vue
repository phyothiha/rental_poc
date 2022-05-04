<template>
  <Listbox v-model="selectedOption" :disabled="listboxIsDisabled">
    <div class="relative mt-1">
      <ListboxButton
        class="relative w-full py-2 pl-3 pr-10 text-left rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 text-xs disabled:opacity-75"
        :class="[
          selectedOption.text == 'declined'
            ? 'bg-red-500 text-slate-100'
            : 'bg-white',
          selectedOption.text == 'accepted'
            ? 'bg-green-500 text-slate-100'
            : 'bg-white',
        ]"
      >
        <span class="block truncate capitalize">{{ selectedOption.text }}</span>
        <span
          class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
        >
          <SelectorIcon
            class="w-5 h-5"
            :class="[
              selectedOption.text == 'declined' ||
              selectedOption.text == 'accepted'
                ? 'text-slate-100'
                : 'text-slate-400',
            ]"
            aria-hidden="true"
          />
        </span>
      </ListboxButton>

      <transition
        leave-active-class="transition duration-100 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ListboxOptions
          class="absolute w-full py-1 mt-1 overflow-auto bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none text-xs"
        >
          <ListboxOption
            v-slot="{ active, selected, disabled }"
            v-for="option in options"
            :key="option.text"
            :value="option"
            as="template"
            class="z-50"
          >
            <li
              :class="[
                active ? 'bg-blue-500 text-white' : 'bg-white text-slate-900',
                disabled ? 'bg-slate-100 text-slate-500' : '',
                'cursor-default select-none relative py-2 pl-10 pr-4',
              ]"
              @click="handleStatus(option.value)"
            >
              <span
                :class="[
                  selected || disabled ? 'font-medium' : 'font-normal',
                  'block truncate capitalize',
                ]"
                >{{ option.text }}</span
              >
              <span
                v-if="selected || disabled"
                class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-100"
              >
                <CheckIcon class="w-5 h-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script>
import {
  Listbox,
  ListboxLabel,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";

export default {
  components: {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    CheckIcon,
    SelectorIcon,
  },

  props: ["currentStatus", "recordID"],

  data() {
    return {
      listboxIsDisabled: false,
      selectedOption: { text: "pending", value: 0 },
      options: [
        { text: "pending", value: 0 },
        { text: "declined", value: 1 },
        { text: "accepted", value: 2 },
      ],
    };
  },

  methods: {
    async handleStatus(value) {
      this.listboxIsDisabled = true;

      try {
        const { data } = await axios.post(
          `/dashboard/rentals/${this.recordID}/updateStatus/${value}`,
          {
            _method: "PATCH",
          }
        );

        this.listboxIsDisabled = false;
      } catch (error) {
        console.error(error);
      }
    },
  },

  mounted() {
    this.selectedOption = {
      ...this.options.find((option) => option.value == this.currentStatus),
      current: true,
    };
  },
};
</script>
