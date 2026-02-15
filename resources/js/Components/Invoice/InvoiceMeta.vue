<script setup>
    import BaseInput from './BaseInput.vue'

    const props = defineProps({
    modelValue: {
        type: Object,
        default: () => ({
        invoiceNumber: '',
        invoiceDate: '',
        dueDate: ''
        })
    }
    })

    const emit = defineEmits(['update:modelValue'])

    function updateField(field, value) {
    emit('update:modelValue', {
        ...props.modelValue,
        [field]: value
    })
    }
</script>

<template>
  <div class="space-y-6 mt-8 w-full max-w-[320px]">
    <div class="flex items-center justify-between gap-4 m-0">
      <span class="text-gray-600 font-semibold whitespace-nowrap">
        Invoice No:
      </span>

      <div class="w-40">
        <BaseInput
          :modelValue="modelValue.invoiceNumber"
          @update:modelValue="updateField('invoiceNumber', $event)"
          placeholder="#####"
          id="invoiceNumber"
          label="Invoice number"
          classes="text-right font-semibold"
        />
      </div>
    </div>

    <div class="flex items-center justify-between gap-4 m-0">
      <span class="text-gray-600 font-semibold whitespace-nowrap">
        Invoice Date:
      </span>

      <div class="w-40">
        <BaseInput
          type="date"
          :modelValue="modelValue.invoiceDate"
          @update:modelValue="updateField('invoiceDate', $event)"
          id="invoiceDate"
          label="Invoice date"
          classes="text-right font-medium"
        />
      </div>
    </div>

    <div class="flex items-center justify-between gap-4 m-0">
      <span class="text-gray-600 font-semibold whitespace-nowrap">
        Due Date:
      </span>

      <div class="w-40">
        <BaseInput
          type="date"
          :modelValue="modelValue.dueDate"
          @update:modelValue="updateField('dueDate', $event)"
          id="dueDate"
          label="Due date"
          classes="text-right font-medium"
        />
      </div>
    </div>

  </div>
</template>