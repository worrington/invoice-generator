<script setup>
  import CompanySection from './CompanySection.vue'
  import ClientSection from './ClientSection.vue'
  import LogoUploader from './LogoUploader.vue'
  import ItemsTable from './ItemsTable.vue'
  import TotalsPanel from './TotalsPanel.vue'
  import NotesField from './NotesField.vue'

  defineProps(['form','subtotal','total'])
  defineEmits(['add-item','remove-item','update-item'])
</script>

<template>
  <div class="max-w-5xl mx-auto bg-white p-10 shadow rounded">

    <h1 class="text-3xl font-bold mb-6">Invoice</h1>

    <div class="grid grid-cols-2 gap-6">
      <CompanySection v-model="form.company" />
      <LogoUploader @update="form.logo = $event" />
    </div>

    <ClientSection v-model="form.client" class="mt-10"/>

    <ItemsTable
      :items="form.items"
      @add-item="$emit('add-item')"
      @remove-item="$emit('remove-item', $event)"
      @update-item="$emit('update-item', $event)"
    />

    <div class="grid grid-cols-2 gap-6 mt-6">
      <NotesField v-model="form.notes" />
      <TotalsPanel
        :subtotal="subtotal"
        :total="total"
        v-model:tax="form.tax"
        v-model:discount="form.discount"
      />
    </div>

  </div>
</template>