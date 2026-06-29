import { defineStore } from "pinia";
import api from "@/api/axios";
import axios from "axios";
import type { ApiError } from "@/types/api";
import type { ApiResponse } from "@/types/api";
import type { Destination } from "@/types/destination";

interface DestinationState {
  destinations: Destination[];
  loading: boolean;
  error: string | null;
}

export const useDestinationStore = defineStore("destination", {
  state: (): DestinationState => ({
    destinations: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchDestinations() {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get<ApiResponse<Destination[]>>(
          "/destinations"
        );

        this.destinations = data.data;

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