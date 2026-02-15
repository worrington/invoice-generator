<script setup>
  const emit = defineEmits(['update'])

  function handleFile(e) {
    emit('update', e.target.files[0])
  }
</script>

<template>
  <label
    class="border-2 border-dashed p-6 text-center cursor-pointer block"
    aria-label="Upload company logo"
  >
    <input type="file" class="hidden" @change="handleFile" />
    Drag & drop logo or click
  </label>
</template>