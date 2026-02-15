<script setup>
import BaseInput from './BaseInput.vue'

defineProps(['modelValue'])
defineEmits(['update:modelValue'])
</script>

<template>
  <section aria-labelledby="client-section" class="space-y-6">
    <!-- Client Name -->
    <BaseInput
      v-model="modelValue.clientName"
      label="CLIENT NAME"
      id="clientName"
      textColor="text-blue-700"
      placeholderColor="placeholder-blue-700"
      classes="font-bold text-lg uppercase tracking-wide"
      required
    />

    <!-- Name -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-0">
      <BaseInput
        id="firstName"
        label="First Name"
        v-model="modelValue.clientFirstName"
        required
      />

      <BaseInput
        id="lastName"
        label="Last Name"
        v-model="modelValue.clientLastName"
        required
      />
    </div>

    <!-- Website -->
    <BaseInput
      id="website"
      label="Website"
      v-model="modelValue.clientWebsite"
    />

    <!-- Address -->
    <BaseInput
      id="address"
      label="Address"
      v-model="modelValue.clientAddress"
      required
    />

    <!-- City State Zip -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 m-0">
      <BaseInput
        id="city"
        label="City"
        v-model="modelValue.clientCity"
        required
      />

      <BaseInput
        id="state"
        label="State"
        v-model="modelValue.clientState"
        required
      />

      <BaseInput
        id="zip"
        label="ZIP Code"
        v-model="modelValue.clientZip"
        required
      />
    </div>

    <!-- Country -->
    <BaseInput
      id="country"
      label="Country"
      v-model="modelValue.clientCountry"
      required
    />

    <!-- Contact -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <BaseInput
        id="phone"
        type="tel"
        label="Phone"
        v-model="modelValue.clientPhone"
        required
      />

      <BaseInput
        id="email"
        type="email"
        label="Email"
        v-model="modelValue.clientEmail"
        required
      />
    </div>

  </section>
</template>