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
  'mode'
])

defineEmits([
  'add-item',
  'remove-item',
  'update-item',
  'change-mode'
])
</script>

<template>
  <div class="max-w-5xl mx-auto bg-white shadow rounded min-w-[990px]">
    <div class="p-10">

      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-8">
          <h1 class="text-4xl font-bold mb-12">Invoice</h1>
          <CompanySection v-model="form.company" />
          <ClientSection v-model="form.client" class="mt-10"/>
        </div>

        <div class="col-span-4">
          <LogoUploader @update="form.logo = $event" />
          <InvoiceMeta v-model="form.meta" />
        </div>
      </div>

      <ItemsTable
        :items="form.items"
        :mode="mode"
        @add-item="$emit('add-item')"
        @remove-item="$emit('remove-item', $event)"
        @update-item="$emit('update-item', $event)"
        @change-mode="$emit('change-mode', $event)"
      />

      <div class="grid grid-cols-2 gap-6 mt-6">
        <NotesField v-model="form.notes" />

        <TotalsPanel
          :subtotal="subtotal"
          :total="total"
          :tax="form.tax"
          :discount="form.discount"
          :taxAmount="taxAmount"
          :discountAmount="discountAmount"
          :mode="mode"
          @update:tax="form.tax = $event"
          @update:discount="form.discount = $event"
        />
      </div>

    </div>

    <div class="h-2 w-full bg-linear-to-r from-blue-300 to-blue-600 rounded-b-sm"></div>
  </div>
</template>
