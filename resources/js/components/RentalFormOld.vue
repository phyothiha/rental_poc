<template>
  <ValidationObserver v-slot="{ invalid }">
    <form class="mt-8 space-y-6" method="POST" @submit.prevent="onSubmit">
      <div class="space-y-3 md:space-y-4">
        <div :class="inputMinHeight">
          <form-label htmlFor="name" :isMandatory="true">Your Name</form-label>
          <ValidationProvider name="name" rules="required" v-slot="{ errors }">
            <input
              v-model="form.name"
              id="name"
              name="name"
              type="text"
              :class="[
                inputStyle,
                errors[0] &&
                  'border-red-500 focus:ring-red-500 focus:border-red-500',
              ]"
            />
            <form-validation-message>{{ errors[0] }}</form-validation-message>
          </ValidationProvider>
        </div>

        <div :class="inputMinHeight">
          <form-label htmlFor="email" :isMandatory="true"
            >Your Email</form-label
          >
          <ValidationProvider
            name="Email"
            rules="required|email"
            v-slot="{ errors }"
          >
            <input
              v-model="form.email"
              id="email"
              name="email"
              type="text"
              :class="[
                inputStyle,
                errors[0] &&
                  'border-red-500 focus:ring-red-500 focus:border-red-500',
              ]"
            />
            <form-validation-message>{{ errors[0] }}</form-validation-message>
          </ValidationProvider>
        </div>

        <div :class="inputMinHeight">
          <form-label htmlFor="phone" :isMandatory="true"
            >Your Phone No.</form-label
          >
          <ValidationProvider
            name="Phone No."
            rules="required"
            v-slot="{ errors }"
          >
            <input
              v-model="form.phone"
              id="phone"
              name="phone"
              type="text"
              :class="[
                inputStyle,
                errors[0] &&
                  'border-red-500 focus:ring-red-500 focus:border-red-500',
              ]"
            />
            <form-validation-message>{{ errors[0] }}</form-validation-message>
          </ValidationProvider>
        </div>

        <div>
          <div :class="inputMinHeight">
            <form-label htmlFor="nrc_front" :isMandatory="true"
              >NRC Front</form-label
            >
            <ValidationProvider
              name="NRC Front"
              rules="required|ext:jpg|size:10000"
              v-slot="{ errors, validate }"
            >
              <input
                id="nrc_front"
                name="nrc_front"
                type="file"
                :class="[
                  inputStyle,
                  fileInputStyle,
                  errors[0] &&
                    'border-red-500 focus:ring-red-500 focus:border-red-500',
                ]"
                @change="validate"
              />
              <form-validation-message>{{ errors[0] }}</form-validation-message>
            </ValidationProvider>
          </div>

          <div :class="inputMinHeight">
            <form-label htmlFor="nrc_back" :isMandatory="true"
              >NRC Back</form-label
            >
            <ValidationProvider
              name="NRC Back"
              rules="required|ext:jpg|size:10000"
              v-slot="{ errors, validate }"
            >
              <input
                id="nrc_back"
                name="nrc_back"
                type="file"
                :class="[
                  inputStyle,
                  fileInputStyle,
                  errors[0] &&
                    'border-red-500 focus:ring-red-500 focus:border-red-500',
                ]"
                @change="validate"
              />
              <form-validation-message>{{ errors[0] }}</form-validation-message>
            </ValidationProvider>
          </div>
        </div>
      </div>

      <div>
        <button
          type="submit"
          :disabled="invalid"
          class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 disabled:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-75"
        >
          Submit Request
        </button>
      </div>
    </form>
  </ValidationObserver>
</template>

<script>
import FormValidationMessage from "./Form/ValidationMessage.vue";
import FormLabel from "./Form/Label.vue";

import { ValidationObserver, ValidationProvider } from "vee-validate";
import "../utils/rental-form-validation";

export default {
  components: {
    FormValidationMessage,
    FormLabel,
    ValidationObserver,
    ValidationProvider,
  },

  data: () => ({
    form: {
      name: "",
      email: "",
      phone: "",
      nrc_front: "",
      nrc_back: "",
      destination: {
        from: "",
        to: "",
      },
    },
  }),

  computed: {
    inputMinHeight: () => "h-20",
    inputStyle: () =>
      "appearance-none rounded-md relative block w-full px-3 py-1.5 md:py-2 my-px md:my-0.5 border border-slate-300 placeholder-slate-500 text-slate-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 text-sm bg-white",
    fileInputStyle: () =>
      "block w-full text-sm text-slate-500 file:mr-4 file:px-2 file:py-0.5 file:rounded-full file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100",
  },

  methods: {
    onSubmit() {
      console.log("sending ajax request to server side");
    },
  },
};
</script>

<style></style>
