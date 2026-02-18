<script setup>
import BaseInput from './BaseInput.vue'

defineProps(['modelValue', 'errors'])
defineEmits(['update:modelValue'])
</script>

<template>
  <section aria-labelledby="company-section" class="space-y-6">
    <BaseInput
      v-model="modelValue.name"
      label="YOUR COMPANY"
      id="companyname"
      textColor="text-blue-00"
      placeholderColor="placeholder-blue-800"
      classes="font-bold text-lg uppercase tracking-wide"
      required
      :error="errors?.['company.name']?.[0] ?? null"
    />

    <BaseInput
      id="companyfullName"
      label="Full Name"
      v-model="modelValue.fullName"
      required
      :error="errors?.['company.fullName']?.[0] ?? null"
    />

    <BaseInput
      id="companywebsite"
      label="Website"
      v-model="modelValue.website"
      :error="errors?.['company.website']?.[0] ?? null"
    />

    <BaseInput
      id="companyaddress"
      label="Address"
      v-model="modelValue.address"
      required
      :error="errors?.['company.address']?.[0] ?? null"
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0 space-y-6">
      <BaseInput
        id="companycity"
        label="City"
        v-model="modelValue.city"
        required
        :error="errors?.['company.city']?.[0] ?? null"
      />

      <BaseInput
        id="companystate"
        label="State"
        v-model="modelValue.state"
        required
        :error="errors?.['company.state']?.[0] ?? null"
      />

      <BaseInput
        id="companyzip"
        label="ZIP Code"
        v-model="modelValue.zip"
        required
        :error="errors?.['company.zip']?.[0] ?? null"
      />

      <BaseInput
        id="companycountry"
        label="Country"
        v-model="modelValue.country"
        required
        :error="errors?.['company.country']?.[0] ?? null"
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 m-0 space-y-6">
      <BaseInput
        id="companyphone"
        type="tel"
        label="Phone"
        v-model="modelValue.phone"
        required
        :error="errors?.['company.phone']?.[0] ?? null"
      />

      <BaseInput
        id="companyemail"
        type="email"
        label="Email"
        v-model="modelValue.email"
        required
        :error="errors?.['company.email']?.[0] ?? null"
      />
    </div>

  </section>
</template>