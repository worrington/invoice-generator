<script setup>
    import BaseInput from './BaseInput.vue'

    defineProps(['modelValue', 'errors'])
    defineEmits(['update:modelValue'])
</script>

<template>
  <div class="space-y-4 mt-8 w-full max-w-[320px]">
    <div class="flex items-center justify-between gap-4">
      <span class="text-gray-600 font-semibold whitespace-nowrap">
        Invoice No:
      </span>

      <div class="w-40">
        <BaseInput
          v-model="modelValue.invoiceNumber"
          placeholder="#####"
          id="invoiceNumber"
          label="Invoice number"
          classes=" font-semibold"
          :error="errors?.['meta.invoiceNumber'] ? errors['meta.invoiceNumber'][0] : null"
        />
      </div>
    </div>

    <div class="flex items-center justify-between gap-4">
      <span class="text-gray-600 font-semibold whitespace-nowrap">
        Invoice Date:
      </span>

      <div class="w-40">
        <BaseInput
          type="date"
          v-model="modelValue.invoiceDate"
          id="invoiceDate"
          label="Invoice date"
          classes="text-right font-medium"
          :error="errors?.['meta.invoiceDate'] ? errors['meta.invoiceDate'][0] : null"
        />
      </div>
    </div>

    <div class="flex items-center justify-between gap-4">
      <span class="text-gray-600 font-semibold whitespace-nowrap">
        Due Date:
      </span>

      <div class="w-40">
        <BaseInput
          type="date"
          v-model="modelValue.dueDate"
          id="dueDate"
          label="Due date"
          classes="text-right font-medium"
          :error="errors?.['meta.dueDate'] ? errors['meta.dueDate'][0] : null"
        />
      </div>
    </div>

  </div>
</template>