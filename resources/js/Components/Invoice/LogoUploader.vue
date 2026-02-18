<script setup>
  import { ref, onBeforeUnmount, watch } from 'vue'

  const props = defineProps({
    modelValue: File | null,
    errors: Object
  })

  const MAX_SIZE = 2 * 1024 * 1024

  const emit = defineEmits(['update:modelValue'])

  const fileInput = ref(null)
  const preview = ref(null)
  const isDragging = ref(false)


  function openFileDialog() {
    fileInput.value.click()
  }

  function handleFile(file) {
    if (!file || !file.type.startsWith('image/')) return

    if (preview.value) URL.revokeObjectURL(preview.value)

    preview.value = URL.createObjectURL(file)
    emit('update:modelValue', file)
  }

  function onChange(e) {
    const file = e.target.files[0]
    if (!file) return

    const allowedTypes = [
      "image/png",
      "image/jpeg",
      "image/webp"
    ]

    if (!allowedTypes.includes(file.type)) {
      alert("Formant not supported. Please upload a PNG, JPG, JPEG, or WEBP image.")
      e.target.value = ""
      return
    }

    if (file.size > MAX_SIZE) {
      alert("The image exceeds the maximum size of 2MB")
      e.target.value = ""
      return
    }

    handleFile(e.target.files[0])
  }

  function onDrop(e) {
    e.preventDefault()
    isDragging.value = false
    handleFile(e.dataTransfer.files[0])
  }

  function onDragOver() {
    isDragging.value = true
  }

  function onDragLeave() {
    isDragging.value = false
  }

  watch(() => props.modelValue, (file) => {
    if (!file) {
      preview.value = null
      return
    }

    preview.value = URL.createObjectURL(file)
  })

  onBeforeUnmount(() => {
    if (preview.value) URL.revokeObjectURL(preview.value)
  })
</script>


<template>
  <div class="w-full aspect-square">
    <input
      ref="fileInput"
      type="file"
      class="hidden"
      accept=".png,.jpg,.jpeg,.webp"
      @change="onChange"
      aria-hidden="true"
    />

    <div
      role="button"
      tabindex="0"
      aria-label="Upload company logo"
      @click="openFileDialog"
      @keydown.enter.prevent="openFileDialog"
      @keydown.space.prevent="openFileDialog"
      @drop="onDrop"
      @dragover.prevent="onDragOver"
      @dragleave.prevent="onDragLeave"
      :class="[
        'relative flex items-center justify-center w-full h-full rounded-xl',
        'transition-all duration-300 cursor-pointer',
        'focus:outline-none focus:ring-2 focus:ring-blue-500',

        preview
          ? 'border-2 border-transparent'
          : isDragging
            ? 'border-2 border-dashed border-blue-500 bg-blue-50'
            : 'border-2 border-dashed border-gray-300 hover:border-blue-400 hover:bg-gray-50'
      ]"
    >
      <div v-if="preview" class="w-full h-full flex items-start justify-center">
        <img
          :src="preview"
          alt="Company logo preview"
          class="max-h-full max-w-full object-contain"
        />

        <button
          type="button"
          @click.stop="openFileDialog"
          class="absolute top-2 right-2 bg-white/80 backdrop-blur px-2 py-1 text-xs rounded shadow hover:bg-white"
        >
          Change
        </button>
      </div>


      <div v-else class="text-center space-y-2 p-6">
        <p class="text-sm font-medium text-gray-700">
          Drag & drop logo
        </p>
        <p class="text-xs text-gray-500">
          or click to upload
        </p>
        <p class="text-[11px] text-gray-400">
          PNG, JPG, JPEG, WEBP - Max 2MB
        </p>
      </div>
    </div>
  </div>
  <p class="text-sm text-red-500 mt-1 text-center w-full">{{errors?.['logo']?.[0] ?? null}}</p>
</template>
