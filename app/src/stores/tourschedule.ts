import api from "@/api/axios";
import type { ApiError, ApiResponse } from "@/types/api";
import type { TourSchedule } from "@/types/tourcschedule";

import axios from "axios";
import { defineStore } from "pinia";

interface TourPackageState {
  tourSchedules: TourSchedule[];
  loading: boolean;
  error: string | null;
}

export const usePublicTourScheduleStore = defineStore("publicTourSchedule", {
  state: (): TourPackageState => ({
    tourSchedules: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchTourSchedules() {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get<ApiResponse<TourSchedule[]>>(
          "public/tour-schedules"
        );

        this.tourSchedules = data.data;

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