<script setup lang="ts">
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import ErrorAlert from "@/components/ErrorAlert.vue";
import {
  Mountain,
  AlertCircle,
  Eye,
  EyeOff,
} from "lucide-vue-next";
import type { ApiError } from "@/types/api";

const router = useRouter();
const authStore = useAuthStore();
const apiError = ref<ApiError | null>(null);

const form = reactive({
  email: "",
  password: "",
});

const showPw = ref(false);
const loginError = ref(false);

const inputCls =
  "w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-100 transition";


const login = async () => {
  try {
    apiError.value = null;
    await authStore.login(form);

    router.push("/dashboard");
  } catch (err:any) {
    loginError.value = true
    apiError.value = err.response.data;
  }
};
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
      <!-- Logo -->
      <div class="text-center mb-8">
        <div
          class="inline-flex w-14 h-14 rounded-2xl bg-green-600 items-center justify-center mb-4 shadow-lg shadow-green-200"
        >
          <Mountain class="w-7 h-7 text-white" />
        </div>

        <h1 class="font-['Fraunces',serif] text-2xl font-bold text-gray-900">
          Open<span class="text-green-600">Trip</span> Admin
        </h1>

        <p class="text-gray-500 text-sm mt-1">
          Masuk ke panel manajemen
        </p>
      </div>
      <ErrorAlert v-if="loginError" :error="apiError" />
      <form
        @submit.prevent="login"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col gap-4"
      >
        <!-- <div
          v-if="loginError"
          class="flex items-center gap-2 px-3.5 py-3 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm"
        >
          <AlertCircle class="w-4 h-4 flex-shrink-0" />
          Username atau password salah.
        </div> -->

        <Field label="Username">
          <input
            v-model="form.email"
            :class="inputCls"
            placeholder="admin"
            autocomplete="username"
            @input="loginError = false"
          />
        </Field>

        <Field label="Password">
          <div class="relative">
            <input
              v-model="form.password"
              :class="`${inputCls} pr-10`"
              :type="showPw ? 'text' : 'password'"
              placeholder="••••••••"
              autocomplete="current-password"
              @input="loginError = false"
            />

            <button
              type="button"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
              @click="showPw = !showPw"
            >
              <EyeOff
                v-if="showPw"
                class="w-4 h-4"
              />
              <Eye
                v-else
                class="w-4 h-4"
              />
            </button>
          </div>
        </Field>

        <button
          type="submit"
          class="w-full py-3 rounded-xl bg-green-600 text-white font-semibold text-sm hover:bg-green-700 transition-colors mt-1"
        >
          Masuk
        </button>

        <p class="text-center text-xs text-gray-400">
          Demo:
          <span
            class="font-mono bg-gray-50 px-1.5 py-0.5 rounded text-gray-600"
          >
            admin
          </span>
          /
          <span
            class="font-mono bg-gray-50 px-1.5 py-0.5 rounded text-gray-600"
          >
            admin123
          </span>
        </p>
      </form>
    </div>
  </div>
</template>