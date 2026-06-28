<template>
  <div>
    <label
      class="block text-xs font-medium text-gray-600 mb-1.5"
    >
      {{ label }}
    </label>

    <slot></slot>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  label: string;
}>();
</script>