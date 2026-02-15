<script setup>
  defineProps(['subtotal','total','tax','discount'])
  defineEmits(['update:tax','update:discount'])
</script>

<template>
  <div class="text-right space-y-2">

    <div>Subtotal: {{ subtotal.toFixed(2) }}</div>

    <div>
      Tax %
      <input
        type="number"
        :value="tax"
        @input="$emit('update:tax',+$event.target.value)"
        class="border w-20 ml-2"
      />
    </div>

    <div>
      Discount %
      <input
        type="number"
        :value="discount"
        @input="$emit('update:discount',+$event.target.value)"
        class="border w-20 ml-2"
      />
    </div>

    <div class="font-bold text-xl">
      Total: {{ total.toFixed(2) }}
    </div>

  </div>
</template>