import type { Destination } from "./destination";

export type TourPackage = {
  id: number;
  destination_id: number;
  title: string;
  type: string;
  type_formatted:string;
  is_discount: boolean;
  price: number;
  price_original: number;
  rating: number;
  review_count: number;
  duration_days: number;
  description: string;
  destination: Destination
  package_images: PackageImage[]
};

export type PackageImage = {
  id: number;
  image_url: string;
  is_cover: number;
}

