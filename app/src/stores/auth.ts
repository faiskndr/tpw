import { defineStore } from "pinia";
import api from "@/api/axios";
import type { LoginRequest, LoginResponse, User } from "@/types/auth";
import type { ApiError } from "@/types/api";
import axios from "axios";

interface AuthState {
  user: User | null;
  token: string | null;
  loading: boolean;
  error: string | null;
  validationErrors: Record<string, string[]>;
}

export const useAuthStore = defineStore("auth", {
  state: (): AuthState => ({
    user: null,
    token: localStorage.getItem("token"),
    loading: false,
    error: null,
    validationErrors: {}
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    async login(payload: LoginRequest) {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.post<LoginResponse>(
          "/login",
          payload
        );

        this.user = data.user;
        this.token = data.token;

        localStorage.setItem("token", data.token);

        return data;
      } catch (error: any) {
        if (axios.isAxiosError<ApiError>(error)) {
          this.error = error.response?.data.message ?? "Unknown error";
          this.validationErrors = error.response?.data.validation_errors ?? {};
        }

        throw error;
      } finally {
        this.loading = false;
      }
    },

    logout() {
      this.user = null;
      this.token = null;

      localStorage.removeItem("token");
    },
  },
});