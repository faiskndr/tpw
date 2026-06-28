import type { Component } from "vue";
import type { Page } from "@/types/page";
import {
  LayoutDashboard,
  MapPinned,
  Package,
  Calendar,
} from "lucide-vue-next";

export interface NavItem {
  id: Page;
  label: string;
  icon: Component;
}

export const navItems: NavItem[] = [
  {
    id: "dashboard",
    label: "Dashboard",
    icon: LayoutDashboard,
  },
  {
    id: "destinations",
    label: "Destinations",
    icon: MapPinned,
  },
  {
    id: "packages",
    label: "Tour Package",
    icon: Package,
  },
  {
    id: "schedules",
    label: "Tour Schedule",
    icon: Calendar,
  },
];