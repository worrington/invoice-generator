<script setup>
import CompanySection from './CompanySection.vue'
import ClientSection from './ClientSection.vue'
import LogoUploader from './LogoUploader.vue'
import ItemsTable from './ItemsTable.vue'
import TotalsPanel from './TotalsPanel.vue'
import NotesField from './NotesField.vue'
import InvoiceMeta from './InvoiceMeta.vue'

defineProps([
  'form',
  'subtotal',
  'total',
  'taxAmount',
  'discountAmount',
  'mode',
  'errors'
])

defineEmits([
  'add-item',
  'remove-item',
  'update-item',
  'change-mode'
])

</script>

<template>
  <div class="max-w-5xl mx-auto bg-white shadow rounded overflow-auto">
    <div class="p-10">
      <h1 class="text-4xl font-bold mb-12 md:hidden">Invoice</h1>

      <div class="grid grid-cols-12 gap-6">
        <div class="md:col-span-8 col-span-12 order-2 md:order-1">
          <h1 class="text-4xl font-bold mb-12 hidden md:block">Invoice</h1>
          <CompanySection v-model="form.company" :errors="errors" />
          <ClientSection v-model="form.client" class="mt-10" :errors="errors"/>
        </div>

        <div class="md:col-span-4 col-span-12 order-1 md:order-2">
          <LogoUploader v-model="form.logo" :errors="errors"/>
          <InvoiceMeta v-model="form.meta" :errors="errors" />
        </div>
      </div>

      <ItemsTable
        :items="form.items"
        :mode="mode"
        :errors="errors"
        @add-item="$emit('add-item')"
        @remove-item="$emit('remove-item', $event)"
        @update-item="$emit('update-item', $event)"
        @change-mode="$emit('change-mode', $event)"
      />

      <div class="grid md:grid-cols-2 gap-6 mt-6">
        <NotesField v-model="form.notes" />

        <TotalsPanel
          :subtotal="subtotal"
          :total="total"
          :tax="form.tax"
          :discount="form.discount"
          :taxAmount="taxAmount"
          :discountAmount="discountAmount"
          :mode="mode"
          :errors="errors"
          @update:tax="form.tax = $event"
          @update:discount="form.discount = $event"
        />
      </div>

    </div>

    <div class="h-2 w-full bg-linear-to-r from-blue-300 to-blue-600 rounded-b-sm"></div>
  </div>
</template>
