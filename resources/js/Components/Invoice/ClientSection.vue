<script setup>
import BaseInput from './BaseInput.vue'

  defineProps(['modelValue', 'errors'])
  defineEmits(['update:modelValue'])
</script>

<template>
  <section aria-labelledby="company-section" class="space-y-6">
    <BaseInput
      v-model="modelValue.name"
      label="CLIENT COMPANY"
      id="companyName"
      textColor="text-blue-00"
      placeholderColor="placeholder-blue-800"
      classes="font-bold text-lg uppercase tracking-wide"
      required
      :error="errors?.['client.name']?.[0] ?? null"
    />

    <BaseInput
      id="fullName"
      label="Full Name"
      v-model="modelValue.fullName"
      required
      :error="errors?.['client.fullName']?.[0] ?? null"
    />

    <BaseInput
      id="website"
      label="Website"
      v-model="modelValue.website"
      :error="errors?.['client.website']?.[0] ?? null"
    />

    <BaseInput
      id="address"
      label="Address"
      v-model="modelValue.address"
      required
      :error="errors?.['client.address']?.[0] ?? null"
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0 space-y-6">
      <BaseInput
        id="city"
        label="City"
        v-model="modelValue.city"
        required
        :error="errors?.['client.city']?.[0] ?? null"
      />

      <BaseInput
        id="state"
        label="State"
        v-model="modelValue.state"
        required
        :error="errors?.['client.state']?.[0] ?? null"
      />

      <BaseInput
        id="zip"
        label="ZIP Code"
        v-model="modelValue.zip"
        required
        :error="errors?.['client.zip']?.[0] ?? null"
      />

      <BaseInput
        id="country"
        label="Country"
        v-model="modelValue.country"
        required
        :error="errors?.['client.country']?.[0] ?? null"
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0 space-y-6">
      <BaseInput
        id="phone"
        type="tel"
        label="Phone"
        v-model="modelValue.phone"
        required
        :error="errors?.['client.phone']?.[0] ?? null"
      />

      <BaseInput
        id="email"
        type="email"
        label="Email"
        v-model="modelValue.email"
        required
        :error="errors?.['client.email']?.[0] ?? null"
      />
    </div>

  </section>
</template>