<script setup>
import BaseInput from './BaseInput.vue'

defineProps(['modelValue'])
defineEmits(['update:modelValue'])
</script>

<template>
  <section aria-labelledby="company-section" class="space-y-6">
    <!-- Company Name -->
    <BaseInput
      v-model="modelValue.companyName"
      label="YOUR COMPANY"
      id="companyName"
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
        v-model="modelValue.companyFirstName"
        required
      />

      <BaseInput
        id="lastName"
        label="Last Name"
        v-model="modelValue.companyLastName"
        required
      />
    </div>

    <!-- Website -->
    <BaseInput
      id="website"
      label="Website"
      v-model="modelValue.companyWebsite"
    />

    <!-- Address -->
    <BaseInput
      id="address"
      label="Address"
      v-model="modelValue.companyAddress"
      required
    />

    <!-- City State Zip -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 m-0">
      <BaseInput
        id="city"
        label="City"
        v-model="modelValue.companyCity"
        required
      />

      <BaseInput
        id="state"
        label="State"
        v-model="modelValue.companyState"
        required
      />

      <BaseInput
        id="zip"
        label="ZIP Code"
        v-model="modelValue.companyZip"
        required
      />
    </div>

    <!-- Country -->
    <BaseInput
      id="country"
      label="Country"
      v-model="modelValue.companyCountry"
      required
    />

    <!-- Contact -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <BaseInput
        id="phone"
        type="tel"
        label="Phone"
        v-model="modelValue.companyPhone"
        required
      />

      <BaseInput
        id="email"
        type="email"
        label="Email"
        v-model="modelValue.companyEmail"
        required
      />
    </div>

  </section>
</template>