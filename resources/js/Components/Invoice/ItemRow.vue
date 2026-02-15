<script setup>
  defineProps(["item", "index"])
  defineEmits(["remove", "update"])
</script>

<template>
  <tr
    class="bg-white even:bg-slate-50 hover:bg-blue-50 transition rounded-lg group relative"
  >
    <td class="px-4 py-3">
      <input
        type="text"
        v-model="item.id"
        class="w-16 text-center bg-transparent focus:outline-none"
      />
    </td>

    <td class="px-4 py-3">
      <input
        v-model="item.description"
        class="w-full bg-transparent focus:outline-none"
      />
    </td>

    <td class="px-4 py-3 text-center">
      <input
        type="number"
        v-model="item.qty"
        class="w-32 text-center bg-transparent focus:outline-none"
      />
    </td>

    <td class="px-4 py-3 text-right">
        <input
          type="number"
          v-model="item.price"
          class="w-32 text-right bg-transparent focus:outline-none"
        />
    </td>

    <button
      @click="$emit('remove')"
      class="opacity-0 group-hover:opacity-100 text-red-500 hover:text-red-700 transition absolute right-0 top-0"
    >
      ✕
    </button>

  </tr>
</template>