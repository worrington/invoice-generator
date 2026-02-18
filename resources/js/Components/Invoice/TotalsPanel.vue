<script setup>
import BaseInput from './BaseInput.vue'

  defineProps([
    'subtotal',
    'total',
    'tax',
    'discount',
    'taxAmount',
    'discountAmount',
    'mode',
    "errors"
  ])

  defineEmits(['update:tax','update:discount'])

</script>

<template>
  <div class="text-right border border-gray-300 rounded-lg p-4">

    <div class="flex justify-between">
      <span>Subtotal</span>
      <span>{{ subtotal.toFixed(2) }}</span>
    </div>

    <div class="flex justify-between items-center">
      <span>Tax %</span>
      <label for="tax" class="sr-only">
        Tax percentage
      </label>
      <BaseInput
        :modelValue="tax"
        @update:modelValue="$emit('update:tax', $event)"
        type="number"
        name="tax"
        id="tax"
        label="Tax %"
        :min="0"
        :max="100"
        placeholder="0"
        classes="w-20 text-right px-1 bg-transparent"
        :error="errors?.tax ? errors.tax[0] : null"
      />
    </div>

    <div class="flex justify-between items-center">
      <span>Discount %</span>
      <label for="discount" class="sr-only">
        Discount percentage
      </label>
      <BaseInput
        :modelValue="discount"
        @update:modelValue="$emit('update:discount', $event)"
        type="number"
        name="discount"
        id="discount"
        label="Discount %"
        :min="0"
        :max="100"
        placeholder="0"
        classes="w-20 text-right px-1 bg-transparent"
        :error="errors?.discount ? errors.discount[0] : null"
      />
    </div>

    <div class="flex justify-between">
      <span>Tax amount</span>
      <span>{{ taxAmount.toFixed(2) }}</span>
    </div>

    <div class="flex justify-between text-red-600">
      <span>Discount</span>
      <span>- {{ discountAmount.toFixed(2) }}</span>
    </div>

    <div class="border-t pt-2 flex justify-between font-bold text-xl">
      <span>Total</span>
      <span>{{ total.toFixed(2) }}</span>
    </div>

    <p class="text-xs text-gray-500 italic">
      Calculation mode: {{ mode }}
    </p>

  </div>
</template>
