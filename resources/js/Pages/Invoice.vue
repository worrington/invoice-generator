<script setup>
import { reactive, computed, ref } from 'vue'
import InvoiceLayout from '@/Components/Invoice/InvoiceLayout.vue'

const invoiceMode = ref('service')

const form = reactive({
  company: {},
  client: {},
  logo: null,

  items: [
    { id: 1, description: '', quantity: 1, price: 0 }
  ],

  tax: 0,
  discount: 0,
  notes: ''
})

const subtotal = computed(() =>
  form.items.reduce((sum, item) => sum + item.quantity * item.price, 0)
)

const discountAmount = computed(() =>
  subtotal.value * form.discount / 100
)

const taxAmount = computed(() => {
  if (invoiceMode.value === 'service') {
    const afterDiscount = subtotal.value - discountAmount.value
    return afterDiscount * form.tax / 100
  }

  return subtotal.value * form.tax / 100
})

const total = computed(() => {
  if (invoiceMode.value === 'service') {
    return subtotal.value - discountAmount.value + taxAmount.value
  }

  return subtotal.value + taxAmount.value - discountAmount.value
})

function addItem() {
  form.items.push({
    id: form.items.length + 1,
    description: '',
    quantity: 1,
    price: 0
  })
}

function removeItem(id) {
  form.items = form.items.filter(i => i.id !== id)
}

function updateItem(updatedItem) {
  const index = form.items.findIndex(i => i.id === updatedItem.id)
  form.items[index] = updatedItem
}

function changeMode(newMode) {
  if (form.items.length > 0) {
    if (!confirm('Changing invoice type affects totals. Continue?')) return
  }

  invoiceMode.value = newMode
}
</script>

<template>
  <div class="bg-gray-100 min-h-screen w-full py-10 overflow-auto p-4">
    <InvoiceLayout
      :form="form"
      :subtotal="subtotal"
      :total="total"
      :taxAmount="taxAmount"
      :discountAmount="discountAmount"
      :mode="invoiceMode"
      @change-mode="changeMode"
      @add-item="addItem"
      @remove-item="removeItem"
      @update-item="updateItem"
    />
  </div>
</template>
