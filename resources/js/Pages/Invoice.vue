<script setup>
import { reactive, computed, ref } from 'vue'
import InvoiceLayout from '@/Components/Invoice/InvoiceLayout.vue'

const invoiceMode = ref('service')
const errors = ref({})

const form = reactive({
  company: {
    name: '',
    fullName: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    zip: '',
    country: ''
  },
  client: {
    name: '',
    fullName: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    zip: '',
    country: ''
  },
  logo: null,

  items: [
    { id: 1, description: '', quantity: 1, price: 0 }
  ],

  meta: {
    invoiceNumber: '',
    invoiceDate: new Date().toISOString().substr(0, 10),
    dueDate: new Date().toISOString().substr(0, 10)
  },

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


async function saveInvoice() {
  try {
    const formData = new FormData()

    formData.append('company', JSON.stringify(form.company))
    formData.append('client', JSON.stringify(form.client))
    formData.append('meta', JSON.stringify(form.meta))
    formData.append('items', JSON.stringify(form.items))
    formData.append('tax', form.tax)
    formData.append('discount', form.discount)
    formData.append('mode', invoiceMode.value)

    if (form.logo) {
      formData.append('logo', form.logo)
    }

    const response = await fetch('/api/invoice/calculate', {
      method: 'POST',
      headers: {
        'Accept': 'application/json'
      },
      body: formData
    })

    if (response.status === 422) {
      const data = await response.json()
      errors.value = data.errors

      console.log('Validation errors:', data.errors, errors.value)
      return
    }

    errors.value = {};

    const data = await response.json()

    console.log('Backend totals:', data)

  } catch (error) {
    console.error('Error saving invoice:', error)
  }
}


async function downloadPdf() {
  const response = await fetch('/api/invoice/pdf', {
    method: 'POST',
    headers: {
      'Accept': 'application/pdf'
    },
    body: JSON.stringify({
      ...form,
      mode: invoiceMode.value
    })
  })

  const blob = await response.blob()
  const url = window.URL.createObjectURL(blob)

  const a = document.createElement('a')
  a.href = url
  a.download = 'invoice.pdf'
  a.click()
}

</script>

<template>
  <button
    @click="saveInvoice"
    class="mt-6 bg-blue-600 text-white px-6 py-3 rounded"
  >
    Save Invoice
  </button>

  <button @click="downloadPdf">
  Download PDF
</button>
  <div class="bg-gray-100 py-10 p-4">
      <InvoiceLayout
        :form="form"
        :subtotal="subtotal"
        :total="total"
        :taxAmount="taxAmount"
        :discountAmount="discountAmount"
        :mode="invoiceMode"
        :errors="errors"
        @change-mode="changeMode"
        @add-item="addItem"
        @remove-item="removeItem"
        @update-item="updateItem"
      />
  </div>
</template>
