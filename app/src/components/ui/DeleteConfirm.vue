<template>
  <Modal
    title="Konfirmasi Hapus"
    @close="emit('close')"
  >
    <div
      class="flex flex-col items-center text-center gap-4"
    >
      <div
        class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center"
      >
        <AlertCircle class="w-6 h-6 text-red-500" />
      </div>

      <div>
        <p class="text-gray-800 font-medium">
          Hapus "{{ name }}"?
        </p>

        <p class="text-gray-500 text-sm mt-1">
          Data yang dihapus tidak dapat dipulihkan.
        </p>
      </div>

      <div class="flex gap-3 w-full">
        <button
          class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-colors"
          @click="emit('close')"
        >
          Batal
        </button>

        <button
          class="flex-1 px-4 py-2.5 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition-colors"
          @click="emit('confirm')"
        >
          Hapus
        </button>
      </div>
    </div>
  </Modal>
</template>

<script setup lang="ts">
import { AlertCircle } from "lucide-vue-next";
import Modal from "./Modal.vue";

defineProps<{
  name: string;
}>();

const emit = defineEmits<{
  (e: "confirm"): void;
  (e: "close"): void;
}>();
</script>