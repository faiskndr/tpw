<template>
  <div
    class="min-h-screen bg-gray-50 flex font-['Plus_Jakarta_Sans',sans-serif]"
  >
    <!-- Desktop Sidebar -->
    <aside
      class="hidden lg:flex flex-col w-56 bg-white border-r border-gray-100 fixed inset-y-0 left-0 z-40"
    >
      <Sidebar
        :page="page"
        @navigate="navigate"
        @logout="handleLogout"
      />
    </aside>

    <!-- Mobile Sidebar -->
    <div
      v-if="sidebarOpen"
      class="lg:hidden fixed inset-0 z-50 flex"
    >
      <div
        class="absolute inset-0 bg-black/30 backdrop-blur-sm"
        @click="sidebarOpen = false"
      >
      </div>

      <aside
        class="relative w-56 bg-white h-full shadow-2xl flex flex-col"
      >
        <Sidebar
          :page="page"
          @navigate="navigate"
          @logout="handleLogout"
        />
      </aside>
    </div>

    <!-- Main -->
    <div class="flex-1 lg:ml-56 flex flex-col min-h-screen">
      <!-- Mobile Header -->
      <header
        class="lg:hidden sticky top-0 z-30 bg-white border-b border-gray-100 px-4 py-3.5 flex items-center gap-3"
      >
        <button
          class="p-2 rounded-xl hover:bg-gray-100 transition-colors"
          @click="sidebarOpen = true"
        >
          <Menu class="w-5 h-5 text-gray-600" />
        </button>

        <span class="font-['Fraunces',serif] font-bold text-gray-900">
          Open<span class="text-green-600">Trip</span> Admin
        </span>
      </header>

      <!-- Page -->
      <main class="flex-1 p-5 lg:p-8 max-w-6xl w-full mx-auto">
        <Dashboard v-if="page === 'dashboard'" />

        <DestinationsPage
          v-else-if="page === 'destinations'"
        />

        <PackagesPage
          v-else-if="page === 'packages'"
          :destinations="seedDestinations"
        />

        <SchedulesPage
          v-else-if="page === 'schedules'"
          :packages="seedPackages"
          :destinations="seedDestinations"
        />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Menu } from "lucide-vue-next";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";

import Sidebar from "@/components/Sidebar.vue";
import Dashboard from "@/pages/Dashboard.vue";
import DestinationsPage from "@/pages/Destination.vue";
import PackagesPage from "@/pages/TourPackage.vue";
import SchedulesPage from "@/pages/Schedule.vue";

import type { Page } from "@/types/page";

import { seedDestinations } from "@/data/destinations";
import { seedPackages } from "@/data/packages";

const authStore = useAuthStore();
const router = useRouter();

const handleLogout = async () => {
  await authStore.logout();
  router.push("/login");
};


const page = ref<Page>("dashboard");
const sidebarOpen = ref(false);

function navigate(p: Page) {
  page.value = p;
  sidebarOpen.value = false;
}
</script>