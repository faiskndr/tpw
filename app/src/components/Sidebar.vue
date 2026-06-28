<template>
  <div class="flex flex-col h-full">
    <!-- Logo -->
    <div class="px-5 py-5 border-b border-gray-100">
      <div class="flex items-center gap-2.5">
        <div
          class="w-8 h-8 rounded-xl bg-green-600 flex items-center justify-center"
        >
          <Mountain class="w-4 h-4 text-white" />
        </div>

        <span class="font-['Fraunces',serif] font-bold text-gray-900">
          Open<span class="text-green-600">Trip</span>
        </span>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 flex flex-col gap-0.5">
      <p
        class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-2 mb-2"
      >
        Menu
      </p>

      <button
        v-for="item in navItems"
        :key="item.id"
        @click="emit('navigate', item.id)"
        :class="[
          'w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all text-left',
          page === item.id
            ? 'bg-green-600 text-white shadow-sm shadow-green-200'
            : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
        ]"
      >
        <component
          :is="item.icon"
          class="w-4 h-4"
        />

        {{ item.label }}
      </button>
    </nav>

    <!-- User -->
    <div class="px-3 py-4 border-t border-gray-100">
      <div class="flex items-center gap-3 px-2 mb-3">
        <div
          class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center"
        >
          <span class="text-green-700 font-bold text-xs">
            A
          </span>
        </div>

        <div class="flex-1 min-w-0">
          <p class="text-sm font-semibold text-gray-900 truncate">
            Admin
          </p>

          <p class="text-xs text-gray-400 truncate">
            admin@opentrip.id
          </p>
        </div>
      </div>

      <button
        @click="emit('logout')"
        class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 transition-colors"
      >
        <LogOut class="w-4 h-4" />
        Keluar
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Mountain, LogOut } from "lucide-vue-next";
import { navItems } from "@/constants/nav";
import type { Page } from "@/types/page";

defineProps<{
  page: Page;
}>();

const emit = defineEmits<{
  (e: "navigate", page: Page): void;
  (e: "logout"): void;
}>();
</script>