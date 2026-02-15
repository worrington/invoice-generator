<script setup>
import BaseInput from './BaseInput.vue'

defineProps(['modelValue'])
defineEmits(['update:modelValue'])
</script>

<template>
  <section aria-labelledby="company-section" class="space-y-6">
    <BaseInput
      v-model="modelValue.companyName"
      label="YOUR COMPANY"
      id="companyName"
      textColor="text-blue-00"
      placeholderColor="placeholder-blue-800"
      classes="font-bold text-lg uppercase tracking-wide"
      required
    />

    <BaseInput
      id="fullName"
      label="Full Name"
      v-model="modelValue.companyFullName"
      required
    />

    <BaseInput
      id="website"
      label="Website"
      v-model="modelValue.companyWebsite"
    />

    <BaseInput
      id="address"
      label="Address"
      v-model="modelValue.companyAddress"
      required
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0">
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

      <BaseInput
        id="country"
        label="Country"
        v-model="modelValue.companyCountry"
        required
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0">
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