<script setup lang="ts">
import { computed } from "vue";
import { AlertCircle } from "lucide-vue-next";
import type { ApiError } from "@/types/api";

const props = defineProps<{
  error: ApiError | null;
}>();

const hasValidationErrors = computed(() => {
  return (
    props.error?.validation_errors &&
    Object.keys(props.error.validation_errors).length > 0
  );
});
</script>
<template>
  <div
    v-if="error"
    class="rounded-xl border border-red-200 bg-red-50 p-4"
  >
    <div class="flex items-start gap-3">
      <AlertCircle class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" />

      <div class="flex-1">
        <p class="font-medium text-red-700">
          {{ error.message }}
        </p>

        <ul
          v-if="hasValidationErrors"
          class="mt-2 list-disc pl-5 text-sm text-red-600 space-y-1"
        >
          <li
            v-for="(messages, field) in error.validation_errors"
            :key="field"
          >
            <strong>{{ field }}</strong>

            <ul class="list-disc pl-5">
              <li
                v-for="message in messages"
                :key="message"
              >
                {{ message }}
              </li>
            </ul>
          </li>
        </ul>

        <p
          v-else
          class="mt-2 text-sm text-red-600"
        >
          Error Code: {{ error.code }}
        </p>
      </div>
    </div>
  </div>
</template>