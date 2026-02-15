<script setup>
  import ItemRow from './ItemRow.vue'
  defineProps(['items'])
  defineEmits(['add-item','remove-item','update-item'])
</script>

<template>
  <table class="w-full mt-10">
    <thead class="bg-gray-800 text-white">
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Price</th>
        <th>-</th>
      </tr>
    </thead>

    <tbody>
      <ItemRow
        v-for="item in items"
        :key="item.id"
        :item="item"
        @remove="$emit('remove-item', item.id)"
        @update="$emit('update-item', $event)"
      />
    </tbody>
  </table>

  <button
    @click="$emit('add-item')"
    class="text-blue-600 mt-3"
    aria-label="Add item"
  >
    + Add Item
  </button>
</template>