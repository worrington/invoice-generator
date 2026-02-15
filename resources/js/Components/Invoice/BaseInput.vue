<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: [String, Number],
  label: String,
  id: String,
  type: {
    type: String,
    default: 'text'
  },
  required: Boolean,
  error: String,
  textColor: {
    type: String,
    default: 'text-gray-900'
  },
  placeholderColor: {
    type: String,
    default: 'placeholder-gray-400'
  },
  classes: {
    type: String,
    default: ''
  }
})

defineEmits(['update:modelValue'])

const hasValue = computed(() =>
  props.modelValue !== '' &&
  props.modelValue !== null &&
  props.modelValue !== undefined
)

const inputBorder = computed(() => {
  if (props.error) return 'border-red-500 focus:border-red-500'

  return hasValue.value
    ? 'border-transparent focus:border-blue-500'
    : 'border-gray-300 focus:border-blue-500'
})
</script>

<template>
  <div class="mb-3">
    <!-- LABEL SOLO SCREEN READER -->
    <label :for="id" class="sr-only">
      {{ label }}
      <span v-if="required">*</span>
    </label>

    <input
      :id="id"
      :type="type"
      :value="modelValue"
      :placeholder="label + (required ? ' *' : '')"
      @input="$emit('update:modelValue', $event.target.value)"
      :required="required"
      :aria-required="required"
      :aria-invalid="error ? 'true' : 'false'"
      :aria-describedby="error ? `${id}-error` : null"
      :class="[
        'w-full border-b border-gray-300 focus:outline-none transition-colors',
        inputBorder,
        textColor,
        placeholderColor,
        classes
      ]"
    />

    <!-- ERROR -->
    <p
      v-if="error"
      :id="`${id}-error`"
      class="text-sm text-red-500 mt-1"
    >
      {{ error }}
    </p>
  </div>
</template>
