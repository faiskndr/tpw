export type TourPackage = {
  id: number;
  destination_id: number;
  title: string;
  type: string;
  is_discount: boolean;
  price: number;
  price_original: number;
  duration_days: number;
  description: string;
};
