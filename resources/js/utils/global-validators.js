import { defineRule, configure } from "vee-validate";
import { localize } from "@vee-validate/i18n";
import { required, email, ext, size } from "@vee-validate/rules";

// Customizing Validation Triggers
configure({
  validateOnBlur: true, // controls if `blur` events should trigger validation with `handleChange` handler
  validateOnChange: true, // controls if `change` events should trigger validation with `handleChange` handler
  validateOnInput: true, // controls if `input` events should trigger validation with `handleChange` handler
  validateOnModelUpdate: true, // controls if `update:modelValue` events should trigger validation with `handleChange` handler
});

// Defining Global Validators
defineRule("required", required);
defineRule("email", email);
defineRule("ext", ext);
defineRule("size", size);

// Global Message Generator
configure({
  generateMessage: localize("en", {
    messages: {
      required: "This field is required",
      email: "Invalid {field}",
      ext: "Accept only 0:{ext}, 1:{ext} file type",
      size: "Uploaded file must not exceed 10 MB.",
    },
  }),
});
