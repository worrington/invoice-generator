<script setup>
  defineProps(['modelValue'])
  defineEmits(['update:modelValue'])
</script>

<template>
  <textarea
    class="space-y-2 border border-gray-300 rounded-lg p-4 w-full"
    rows="4"
    placeholder="Notes"
    :value="modelValue"
    @input="$emit('update:modelValue',$event.target.value)"
  ></textarea>
</template>