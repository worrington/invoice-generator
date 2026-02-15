<script setup>
import { ref } from 'vue'
import ItemRow from "./ItemRow.vue"

defineProps(["items", "mode"])
const emit = defineEmits([
  "add-item",
  "remove-item",
  "update-item",
  "change-mode"
])

const showPopover = ref(false)

function setMode(type) {
  emit("change-mode", type)
  showPopover.value = false
}
</script>

<template>
  <div class="mt-10 group relative">

    <table class="w-full border-separate border-spacing-y-1">
      <thead class="bg-blue-800 text-white">
        <tr class="text-xs uppercase tracking-wider">
          <th class="text-left px-4 py-2 min-w-16">ID</th>
          <th class="text-left px-4 py-2">Description</th>

          <th class="text-center px-4 py-2 w-24 relative">

            <div class="flex items-center justify-center gap-2">
              {{ mode === 'service' ? 'Hours' : 'Qty' }}

              <button
                @click="showPopover = !showPopover"
                class="text-white/80 hover:text-white"
              >
                ⓘ
              </button>
            </div>

            <div
              v-if="showPopover"
              class="absolute z-50 top-full mt-2 left-1/2 -translate-x-1/2
                     w-64 bg-white text-black rounded-lg shadow-lg p-4 text-sm"
            >
              <p class="font-medium mb-1">Are you a service based company?</p>
              <p class="mb-3 text-gray-600">Switch to hours/rates:</p>

              <div class="flex gap-2 justify-center">
                <button
                  @click="setMode('service')"
                  class="px-3 py-1 rounded bg-blue-100 hover:bg-blue-200"
                >
                  Yes
                </button>

                <button
                  @click="setMode('product')"
                  class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200"
                >
                  No
                </button>
              </div>
            </div>

          </th>

          <th class="text-right px-4 py-2 w-32">Price</th>
        </tr>
      </thead>

      <tbody>
        <ItemRow
          v-for="(item, index) in items"
          :key="item.id"
          :item="item"
          :mode="mode"
          :index="index"
          @remove="$emit('remove-item', item.id)"
          @update="$emit('update-item', $event)"
        />
      </tbody>
    </table>

    <button
      @click="$emit('add-item')"
      class="w-full mt-3 py-3 border-2 border-dashed border-transparent
             text-slate-400 rounded-lg transition-all
             opacity-0 group-hover:opacity-100
             hover:border-blue-500 hover:text-blue-600 hover:bg-blue-50"
    >
      + Add Item
    </button>

  </div>
</template>
