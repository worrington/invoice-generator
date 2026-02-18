<script setup>
  import { reactive, computed, ref, watch } from 'vue'
  import InvoiceLayout from '@/Components/Invoice/InvoiceLayout.vue'

  const invoiceMode = ref('service')
  const errors = ref({})
  const isValidated = ref(false)
  const pdf = ref(null)

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


  async function validateInvoice() {
    try {
      const formData = new FormData()

      formData.append('company', JSON.stringify(form.company))
      formData.append('client', JSON.stringify(form.client))
      formData.append('meta', JSON.stringify(form.meta))
      formData.append('items', JSON.stringify(form.items))
      formData.append('tax', form.tax)
      formData.append('discount', form.discount)
      formData.append('mode', invoiceMode.value)
      formData.append('notes', form.notes)

      if (form.logo) {
        formData.append('logo', form.logo)
      }

      const response = await fetch('/api/invoice/validate', {
        method: 'POST',
        headers: {
          'Accept': 'application/json'
        },
        body: formData
      })

      if (response.status === 422) {
        const data = await response.json()
        errors.value = data.errors

        isValidated.value = false
        return
      }

      errors.value = {}
      isValidated.value = true

      console.log('Invoice is valid!')

      const blob = await response.blob()
      pdf.value = blob

    } catch (error) {
      console.error('Error validating invoice:', error)
    }
  }


  async function downloadPdf() {
    if (!pdf.value) return
    const url = window.URL.createObjectURL(pdf.value)

    const a = document.createElement('a')
    a.href = url
    a.download = 'invoice.pdf'
    a.click()
  }

  watch(
    () => form,
    () => {
      isValidated.value = false
    },
    { deep: true }
  )

  watch(invoiceMode, () => {
    isValidated.value = false
  })

</script>

<template>
  <div class="bg-gray-100 py-10 p-4">
    <div class="max-w-5xl mx-auto flex justify-end gap-4 mb-4">
      <button
        @click="validateInvoice"
        class="mt-6 ml-4 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded flex items-center gap-2"
      >
        <svg
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="1"
          stroke-linecap="round"
          stroke-linejoin="round"
          xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
          <path d="M6 2h8l4 4v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"/>
          <path d="M14 2v4h4"/>
          <line x1="8" y1="10" x2="14" y2="10"/>
          <line x1="8" y1="13" x2="13" y2="13"/>
          <line x1="8" y1="16" x2="10" y2="16"/>
          <circle cx="17" cy="17" r="3.1" fill="#2ba63d" stroke="none"/>
          <circle cx="17" cy="17" r="3.6"/>
          <path d="M15.9 17l.9.9 1.8-1.8"/>
        </svg>
        Validate Invoice
      </button>

      <button @click="downloadPdf" :disabled="!isValidated"
        :class="[
          'mt-6 ml-4 px-6 py-3 rounded flex items-center gap-2 transition',
          isValidated
            ? 'bg-blue-600 hover:bg-blue-700 text-white'
            : 'bg-gray-400 text-gray-200 cursor-not-allowed'
        ]">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.8"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 3v12m0 0l4-4m-4 4l-4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2"
          />
        </svg>

        Download PDF
      </button>
    </div>

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
