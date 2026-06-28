<template>
  <div
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
  >
    <div
      class="absolute inset-0 bg-black/40 backdrop-blur-sm"
      @click="emit('close')"
    />

    <div
      class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto"
    >
      <div
        class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl z-10"
      >
        <h2 class="font-semibold text-gray-900 text-base">
          {{ title }}
        </h2>

        <button
          class="p-1.5 rounded-lg hover:bg-gray-100 transition-colors"
          @click="emit('close')"
        >
          <X class="w-4 h-4 text-gray-500" />
        </button>
      </div>

      <div class="p-6">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { X } from "lucide-vue-next";

defineProps<{
  title: string;
}>();

const emit = defineEmits<{
  (e: "close"): void;
}>();
</script>