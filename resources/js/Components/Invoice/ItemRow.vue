<script setup>
  const props = defineProps(['item'])
  const emit = defineEmits(['remove','update'])

  function updateField(field, value) {
    emit('update', { ...props.item, [field]: value })
  }
</script>

<template>
  <tr>
    <td>{{ item.id }}</td>

    <td>
      <input
        :value="item.description"
        @input="updateField('description',$event.target.value)"
        class="w-full"
      />
    </td>

    <td>
      <input
        type="number"
        :value="item.quantity"
        @input="updateField('quantity',+$event.target.value)"
        class="w-20"
      />
    </td>

    <td>
      <input
        type="number"
        :value="item.price"
        @input="updateField('price',+$event.target.value)"
        class="w-24"
      />
    </td>

    <td>
      <button @click="$emit('remove')" aria-label="Remove item">❌</button>
    </td>
  </tr>
</template>