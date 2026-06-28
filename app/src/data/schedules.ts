import type { TourSchedule } from "@/types/tourcschedule";

export const seedSchedules: TourSchedule[] = [
  { id: 1, tour_package_id: 1, start_date: "2025-07-15", end_date: "2025-07-19", quota: 12 },
  { id: 2, tour_package_id: 2, start_date: "2025-07-20", end_date: "2025-07-22", quota: 15 },
  { id: 3, tour_package_id: 2, start_date: "2025-08-05", end_date: "2025-08-07", quota: 15 },
  { id: 4, tour_package_id: 4, start_date: "2025-08-10", end_date: "2025-08-13", quota: 10 },
];