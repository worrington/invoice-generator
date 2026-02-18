<script setup>
  import BaseInput from './BaseInput.vue'
  defineProps(["item", "index", "errors", "mode"])
  defineEmits(["remove", "update"])
</script>

<template>
  <tr
    class="bg-white even:bg-slate-50 hover:bg-blue-50 transition rounded-lg relative group"
  >
    <td class="px-4 py-3">
      <BaseInput
        v-model="item.id"
        label="ID"
        :id="'id' + index"
        required
        :error="errors?.['items.' + index + '.id']?.[0] ?? null"
        placeholder="Item ID"
        />
    </td>

    <td class="px-4 py-3">
      <BaseInput
        v-model="item.description"
        label="Description"
        :id="'description' + index"
        required
        :error="errors?.['items.' + index + '.description']?.[0] ?? null"
        placeholder="Item description"
      />
    </td>

    <td class="px-4 py-3 text-center">
      <BaseInput
        v-model="item.quantity"
        :label="mode === 'service' ? 'Hrs' : 'Qty'"
        placeholder="0"
        :id="'qty' + index"
        required
        type="number"
        :error="errors?.['items.' + index + '.quantity']?.[0] ?? null"
        classes="text-center"
        :min="1"
      />
    </td>

    <td class="px-4 py-3 text-right">
        <BaseInput
          v-model="item.price"
          label="$"
          :id="'price' + index"
          required
          type="number"
          :error="errors?.['items.' + index + '.price']?.[0] ?? null"
          classes="text-end"
          placeholder="0"
          :min="1"
        />
    </td>

    <button
      @click="$emit('remove')"
      class="opacity-0 group-hover:opacity-100 border hover:border-blue-700 border-blue-500 rounded-full text-blue-500 hover:text-blue-700 w-5 h-5 flex justify-center items-center text-sm transition absolute right-0 top-0"
    >
      ✕
    </button>

  </tr>
</template>