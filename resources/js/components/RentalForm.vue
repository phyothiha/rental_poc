<template>
  <div>
    <Form
      @submit="onSubmit"
      class="mt-8 space-y-6"
      v-slot="{ meta }"
      ref="form"
    >
      <div class="space-y-3 md:space-y-4">
        <div class="h-20">
          <form-label htmlFor="name" :isMandatory="true">Your Name</form-label>
          <Field
            name="name"
            label="Name"
            type="text"
            rules="required"
            :class="[inputClass]"
          >
          </Field>
          <ErrorMessage name="name" class="text-xs font-medium text-red-500" />
        </div>

        <div class="h-20">
          <form-label htmlFor="email" :isMandatory="true"
            >Your Email</form-label
          >
          <Field
            name="email"
            label="Email"
            type="email"
            rules="required|email"
            :class="[inputClass]"
          >
          </Field>
          <ErrorMessage name="email" class="text-xs font-medium text-red-500" />
        </div>

        <div class="h-20">
          <form-label htmlFor="phone" :isMandatory="true"
            >Your Phone</form-label
          >
          <Field
            name="phone"
            label="Phone"
            type="text"
            rules="required"
            :class="[inputClass]"
          >
          </Field>
          <ErrorMessage name="phone" class="text-xs font-medium text-red-500" />
        </div>

        <div>
          <SwitchGroup class="mb-4">
            <div class="flex">
              <Switch
                v-model="toggleAttachment"
                :class="toggleAttachment ? 'bg-blue-700' : 'bg-blue-500'"
                class="relative inline-flex flex-shrink-0 h-[20px] w-[40px] border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
              >
                <span
                  aria-hidden="true"
                  :class="toggleAttachment ? 'translate-x-5' : 'translate-x-0'"
                  class="pointer-events-none inline-block h-[16px] w-[16px] rounded-full bg-white shadow-lg transform ring-0 transition ease-in-out duration-200"
                />
              </Switch>
              <SwitchLabel
                class="text-sm ml-3 font-medium text-slate-500"
                :class="{ 'text-blue-700': toggleAttachment }"
              >
                Show Passport Photo Upload
              </SwitchLabel>
            </div>
          </SwitchGroup>

          <div v-show="toggleAttachment" class="mb-3 md:mb-4">
            <div class="h-20">
              <form-label htmlFor="passport_front" :isMandatory="true"
                >Passport Front</form-label
              >
              <Field
                name="attachment[passport_front]"
                label="Passport Front"
                type="file"
                :rules="passportRules"
                :class="[inputClass, fileInputClass]"
                ref="passport_front"
              />
              <ErrorMessage
                name="passport_front"
                class="text-xs font-medium text-red-500"
              />
            </div>
          </div>

          <div v-show="!toggleAttachment" class="space-y-3 md:space-y-4">
            <div class="h-20">
              <form-label htmlFor="nrc_front" :isMandatory="true"
                >NRC Front</form-label
              >
              <Field
                name="attachment[nrc_front]"
                label="NRC Front"
                type="file"
                :rules="nrcRules"
                :class="[inputClass, fileInputClass]"
                ref="nrc_front"
              />
              <ErrorMessage
                name="nrc_front"
                class="text-xs font-medium text-red-500"
              />
            </div>
            <div class="h-20">
              <form-label htmlFor="nrc_back" :isMandatory="true"
                >NRC Back</form-label
              >
              <Field
                name="attachment[nrc_back]"
                label="NRC Back"
                type="file"
                :rules="nrcRules"
                :class="[inputClass, fileInputClass]"
                ref="nrc_back"
              />
              <ErrorMessage
                name="nrc_back"
                class="text-xs font-medium text-red-500"
              />
            </div>
          </div>
        </div>

        <div class="h-20">
          <form-label htmlFor="destination_from" :isMandatory="true"
            >Destination From</form-label
          >
          <Field
            name="destination_from"
            label="Destination From"
            type="text"
            rules="required"
            :class="[inputClass]"
          >
          </Field>
          <ErrorMessage
            name="destination_from"
            class="text-xs font-medium text-red-500"
          />
        </div>

        <div class="h-20">
          <form-label htmlFor="destination_to" :isMandatory="true"
            >Destination To</form-label
          >
          <Field
            name="destination_to"
            label="Destination To"
            type="text"
            rules="required"
            :class="[inputClass]"
          >
          </Field>
          <ErrorMessage
            name="destination_to"
            class="text-xs font-medium text-red-500"
          />
        </div>
      </div>

      <div>
        <button
          type="submit"
          :disabled="!meta.valid"
          class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 disabled:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-75"
        >
          Submit Request
        </button>
      </div>
    </Form>

    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog @close="closeModal">
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
                class="inline-block w-full max-w-md my-8 overflow-hidden text-center align-middle transition-all transform bg-white shadow-xl rounded-2xl"
              >
                <div class="bg-blue-700 p-6">
                  <CheckCircleIcon
                    class="h-24 w-24 mx-auto text-slate-100 stroke-1"
                  />
                </div>

                <div class="p-6">
                  <DialogTitle
                    as="h3"
                    class="text-xl font-medium leading-6 text-slate-900"
                  >
                    Request successful
                  </DialogTitle>

                  <DialogDescription
                    class="mt-2 text-sm leading-relaxed text-slate-500"
                  >
                    Your request has been successfully submitted. We will
                    contact you shortly. 😊
                  </DialogDescription>

                  <div class="mt-6">
                    <button
                      type="button"
                      class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                      @click="closeModal"
                    >
                      Got it, thanks!
                    </button>
                  </div>
                </div>
              </div>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script>
import FormLabel from "./Form/Label.vue";
import { CheckCircleIcon } from "@heroicons/vue/outline";
import { Form, Field, ErrorMessage } from "vee-validate";
import {
  Switch,
  SwitchGroup,
  SwitchLabel,
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
  DialogDescription,
} from "@headlessui/vue";

export default {
  components: {
    Switch,
    SwitchGroup,
    SwitchLabel,
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
    DialogDescription,
    FormLabel,
    Field,
    Form,
    ErrorMessage,
    CheckCircleIcon,
  },

  data: () => {
    return {
      isOpen: false,
      dialogTimeoutID: null,
      toggleAttachment: false,
      attachmentRules: "required|ext:jpg,png|size:10000",
      inputClass:
        "appearance-none rounded-md relative block w-full px-3 py-1.5 md:py-2 my-px md:my-0.5 border border-slate-200 placeholder-slate-500 text-slate-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 text-sm bg-white invalid:border-red-500 focus:invalid:border-red-500 focus:invalid:ring-red-500",
      fileInputClass:
        "block w-full text-sm text-slate-500 file:mr-4 file:px-2 file:py-0.5 file:rounded-full file:border-0 file:text-xs file:bg-blue-400 file:text-white hover:file:bg-blue-600",
    };
  },

  computed: {
    passportRules() {
      return this.toggleAttachment ? this.attachmentRules : "";
    },
    nrcRules() {
      return this.toggleAttachment ? "" : this.attachmentRules;
    },
  },

  methods: {
    closeModal() {
      this.isOpen = false;

      if (this.dialogTimeoutID) {
        clearTimeout(this.dialogTimeoutID);
        this.dialogTimeoutID = null;
      }
    },
    delayCloseModal() {
      var self = this;
      this.dialogTimeoutID = setTimeout(function () {
        self.closeModal();
      }, 3000);
    },

    async onSubmit(values) {
      try {
        var formData = new FormData(this.$refs.form.$el);

        if (this.toggleAttachment) {
          formData.delete("attachment[nrc_front]");
          formData.delete("attachment[nrc_back]");
        } else {
          formData.delete("attachment[passport_front]");
        }

        const { data } = await axios.post("/rental", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });

        this.$refs.form.resetForm();
        this.isOpen = true;
        this.delayCloseModal();

        // File Input
        this.$refs.passport_front.$el.value = null;
        this.$refs.nrc_front.$el.value = null;
        this.$refs.nrc_back.$el.value = null;

        console.log(data);
      } catch (error) {
        console.error(error);
      }
    },

    // onSubmit() {
    //   this.$refs.form.resetForm();
    //   this.isOpen = true;
    //   this.delayCloseModal();
    //   // // Show Modal
    //   // this.isOpen = true;
    //   // var self = this;
    //   // // and Hide Modal
    //   // setTimeout(function () {
    //   //   console.log("testing");
    //   //   self.isOpen = false;
    //   // }, 2000);
    // },
  },
};
</script>

<style></style>
