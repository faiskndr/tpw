import api from "@/api/axios";
import type { ApiError, ApiResponse } from "@/types/api";
import type { TourPackage } from "@/types/tourpackage";
import axios from "axios";
import { defineStore } from "pinia";

interface TourPackageState {
  tourPackages: TourPackage[];
  loading: boolean;
  error: string | null;
}

export const usePublicTourPackageStore = defineStore("publicTourPackage", {
  state: (): TourPackageState => ({
    tourPackages: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchTourPackages() {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get<ApiResponse<TourPackage[]>>(
          "public/tour-packages"
        );

        this.tourPackages = data.data;

        return data.data;
      } catch (error: any) {
        if (axios.isAxiosError<ApiError>(error)) {
          this.error = error.response?.data.message ?? "Unknown error";
        }

        throw error;
      } finally {
        this.loading = false;
      }
    },
  },
});