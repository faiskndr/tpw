
export type TourSchedule = {
  id: number;
  tour_package_id: number;
  start_date: string;
  end_date: string;
  quota: number;
  available_quota: number;
  is_full: number;
  joined: number;
  tour_package: TourPackage;
};

export type TourPackage = {
  title: string;
  type: string;
  price: number;
  location:string;
  price_original: number;
  duration_day: number;
  description: string;
  rating: number;
  review_count: number;
  image_url: string;
}