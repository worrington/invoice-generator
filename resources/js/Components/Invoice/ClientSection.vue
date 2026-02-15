<script setup>
import BaseInput from './BaseInput.vue'

defineProps(['modelValue'])
defineEmits(['update:modelValue'])
</script>

<template>
  <section aria-labelledby="company-section" class="space-y-6">
    <BaseInput
      v-model="modelValue.clientName"
      label="CLIENT COMPANY"
      id="clientcompanyName"
      textColor="text-blue-00"
      placeholderColor="placeholder-blue-800"
      classes="font-bold text-lg uppercase tracking-wide"
      required
    />

    <BaseInput
      id="clientfullName"
      label="Full Name"
      v-model="modelValue.clientFullName"
      required
    />

    <BaseInput
      id="clientwebsite"
      label="Website"
      v-model="modelValue.clientWebsite"
    />

    <BaseInput
      id="clientaddress"
      label="Address"
      v-model="modelValue.clientAddress"
      required
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0">
      <BaseInput
        id="clientcity"
        label="City"
        v-model="modelValue.clientCity"
        required
      />

      <BaseInput
        id="clientstate"
        label="State"
        v-model="modelValue.clientState"
        required
      />

      <BaseInput
        id="clientzip"
        label="ZIP Code"
        v-model="modelValue.clientZip"
        required
      />

      <BaseInput
        id="clientcountry"
        label="Country"
        v-model="modelValue.clientCountry"
        required
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0">
      <BaseInput
        id="clientphone"
        type="tel"
        label="Phone"
        v-model="modelValue.clientPhone"
        required
      />

      <BaseInput
        id="clientemail"
        type="email"
        label="Email"
        v-model="modelValue.clientEmail"
        required
      />
    </div>

  </section>
</template>