<template>
  <div>
    <h1 class="text-xl font-bold text-gray-900 mb-6">
      Dashboard
    </h1>

    <!-- Stat cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <div
        v-for="stat in stats"
        :key="stat.label"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5"
      >
        <div
          :class="[
            'w-10 h-10 rounded-xl flex items-center justify-center mb-3',
            stat.color,
          ]"
        >
          <component
            :is="stat.icon"
            class="w-5 h-5"
          />
        </div>

        <div
          class="text-2xl font-bold text-gray-900 font-['Fraunces',serif]"
        >
          {{ stat.value }}
        </div>

        <div class="text-xs text-gray-500 mt-0.5">
          {{ stat.label }}
        </div>
      </div>
    </div>

    <!-- Upcoming schedules -->
    <div
      class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
    >
      <h2 class="font-semibold text-gray-800 mb-4">
        Jadwal Mendatang
      </h2>

      <div class="divide-y divide-gray-50">
        <div
          v-for="schedule in seedSchedules"
          :key="schedule.id"
          class="flex items-center justify-between py-3"
        >
          <div>
            <p class="text-sm font-medium text-gray-900">
              {{ getPackage(schedule.tour_package_id)?.title ?? "—" }}
            </p>

            <p class="text-xs text-gray-400 mt-0.5">
              {{ getDestination(schedule.tour_package_id)?.name }}
              ·
              {{ schedule.start_date }}
              →
              {{ schedule.end_date }}
            </p>
          </div>

          <span
            class="text-xs font-medium bg-green-50 text-green-700 px-2.5 py-1 rounded-full"
          >
            {{ schedule.quota }} pax
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Component } from "vue";
import { Map, Package, Calendar } from "lucide-vue-next";

import { seedDestinations } from "@/data/destinations";
import { seedPackages } from "@/data/packages";
import { seedSchedules } from "@/data/schedules";

const stats: {
  label: string;
  value: number;
  icon: Component;
  color: string;
}[] = [
  {
    label: "Total Destinasi",
    value: seedDestinations.length,
    icon: Map,
    color: "text-blue-600 bg-blue-50",
  },
  {
    label: "Total Paket",
    value: seedPackages.length,
    icon: Package,
    color: "text-purple-600 bg-purple-50",
  },
  {
    label: "Total Jadwal",
    value: seedSchedules.length,
    icon: Calendar,
    color: "text-green-600 bg-green-50",
  },
  {
    label: "Paket Diskon",
    value: seedPackages.filter((p) => p.is_discount).length,
    icon: Package,
    color: "text-orange-600 bg-orange-50",
  },
];

function getPackage(id: number) {
  return seedPackages.find((p) => p.id === id);
}

function getDestination(packageId: number) {
  const pkg = getPackage(packageId);

  if (!pkg) return null;

  return seedDestinations.find(
    (d) => d.id === pkg.destination_id
  );
}
</script>