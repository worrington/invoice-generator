<script setup>
defineProps([
  'subtotal',
  'total',
  'tax',
  'discount',
  'taxAmount',
  'discountAmount',
  'mode'
])

defineEmits(['update:tax','update:discount'])
</script>

<template>
  <div class="text-right space-y-2 border border-gray-300 rounded-lg p-4">

    <div class="flex justify-between">
      <span>Subtotal</span>
      <span>{{ subtotal.toFixed(2) }}</span>
    </div>

    <div class="flex justify-between items-center">
      <span>Tax %</span>
      <input
        type="number"
        :value="tax"
        @input="$emit('update:tax',+$event.target.value)"
        class="bg-transparent focus:outline-none w-20 text-right px-1"
      />
    </div>

    <div class="flex justify-between items-center">
      <span>Discount %</span>
      <input
        type="number"
        :value="discount"
        @input="$emit('update:discount',+$event.target.value)"
        class="bg-transparent focus:outline-none w-20 text-right px-1"
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
