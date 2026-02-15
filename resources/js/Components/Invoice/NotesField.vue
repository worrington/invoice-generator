<script setup>
  defineProps(['modelValue'])
  defineEmits(['update:modelValue'])
</script>

<template>
  <textarea
    class="w-full border p-3"
    rows="4"
    placeholder="Notes"
    :value="modelValue"
    @input="$emit('update:modelValue',$event.target.value)"
  ></textarea>
</template>