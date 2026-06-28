import type { TourPackage } from "@/types/tourpackage";

export const seedPackages: TourPackage[] = [
  { id: 1, destination_id: 1, title: "Raja Ampat Island Hopping", type: "Open Trip", is_discount: false, price: 4200000, price_original: 4200000, duration_days: 5, description: "Jelajahi 5 pulau terbaik Raja Ampat dengan snorkeling dan diving." },
  { id: 2, destination_id: 2, title: "Bromo Sunrise Jeep Tour", type: "Open Trip", is_discount: true, price: 1850000, price_original: 2200000, duration_days: 3, description: "Menyaksikan matahari terbit di Bromo dengan jeep 4WD." },
  { id: 3, destination_id: 3, title: "Ubud Cultural Walk", type: "Private Tour", is_discount: false, price: 750000, price_original: 750000, duration_days: 2, description: "Berjalan kaki melewati sawah dan desa adat Ubud." },
  { id: 4, destination_id: 4, title: "Flores Overland Kelimutu", type: "Open Trip", is_discount: true, price: 3500000, price_original: 4200000, duration_days: 4, description: "Perjalanan darat Flores menyaksikan danau tiga warna Kelimutu." },
];