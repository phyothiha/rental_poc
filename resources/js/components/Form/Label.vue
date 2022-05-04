<template>
  <label :for="htmlFor" class="text-sm font-medium text-slate-700 md:text-base">
    <slot></slot>
    <span v-if="isMandatory" class="ml-1 font-medium text-red-500">*</span>
  </label>
</template>

<script>
export default {
  props: ["htmlFor", "isMandatory"],
};
</script>

<style></style>
