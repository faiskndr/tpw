<script setup lang="ts">
import { computed, ref, type Component } from 'vue';
const isScroll = ref(false)
const isFeatured = ref(false)
const activeNav = ref("explore")
const targetElement = ref<HTMLElement | null>(null)
const activeFilterId = ref(0)
const currentFilterId = ref(0)
const isTripFull = ref(false)
import {
  Waves,
  Mountain,
  TreePine,
} from "lucide-vue-next";

interface ButtonMenu {
  id:string,
  text:string
}

const headerClass = computed(() => {
    return {
        'fixed top-0 inset-x-0 z-50 transition-all duration-300':true,
        'bg-white shadow-sm border-b border-gray-100':isScroll,
        'bg-transparent':!isScroll,
    }
})

const navButtonClass = computed(() => {
    return (navId:string) => {
      return {
        'px-4 py-2 rounded-full text-sm font-medium transition-all':true,
        'bg-green-50 text-green-700': activeNav.value === navId,
        'text-gray-600 hover:text-gray-900 hover:bg-gray-50': activeNav.value !== navId
      }
    }
})

const cardClass = computed(() => {
    return {
        'flex-shrink-0 snap-center cursor-pointer group relative rounded-2xl overflow-hidden bg-gray-100 shadow-md hover:shadow-xl transition-all duration-300':true,
        'w-72 lg:w-80 h-96 lg:h-[420px] -mt-4 ring-2 ring-green-500 ring-offset-2':isFeatured,
        'w-60 lg:w-68 h-80 lg:h-96 mt-2': !isFeatured
                  
    }
})

const filterButtonClass = computed(() => {
    return {
        'px-4 py-1.5 rounded-full text-sm font-medium transition-all border':true,
        'bg-green-600 text-white border-green-600':activeFilterId===currentFilterId,
        'border-gray-200 text-gray-600 hover:border-gray-400 hover:text-gray-800':activeFilterId!==currentFilterId,
    }
})

const tripButtonClass = computed(() => {
    return {
        'px-4 py-2 rounded-full text-sm font-semibold transition-colors':true,
        'bg-gray-100 text-gray-400 cursor-not-allowed':isTripFull,
        'bg-green-600 text-white hover:bg-green-700':!isTripFull
    }
})

function scrollTo(id:string) {
  activeNav.value=id
  const element = document.getElementById(id)
  if(element) {
    element.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
}

const navButtonMenus: ButtonMenu[] = [
  {
    id:"explore",
    text:"Explore"
  },
  {
    id:"schedule",
    text:"Tour Schedule"
  },
  {
    id:"about",
    text:"About Us"
  }
]

interface ActivityCard {
  id:number,
  badge:string,
  badgeColor:string,
  name:string,
  location:string,
  rating:number,
  reviews:number,
  price:string,
  originalPrice:string,
  image:string
}

const ACTIVITY_CARDS:ActivityCard[] = [
  {
    id: 1,
    badge: "Open Trip",
    badgeColor: "bg-orange-500",
    name: "Tur Ora Beach Saleman",
    location: "Maluku",
    rating: 4.4,
    reviews: 170,
    price: "Rp 4.500.000",
    originalPrice: "Rp 5.200.000",
    image: "https://images.unsplash.com/photo-1654159148138-bf64a2278cf7?w=480&h=560&fit=crop&auto=format",
  },
  {
    id: 2,
    badge: "Open Trip",
    badgeColor: "bg-orange-500",
    name: "Tur Pulau Pahawang start Jakarta",
    location: "Lampung",
    rating: 5.0,
    reviews: 229,
    price: "Rp 850.000",
    originalPrice: "Rp 1.100.000",
    image: "https://images.unsplash.com/photo-1583364512105-951b6f7080ae?w=480&h=560&fit=crop&auto=format",
  },
  {
    id: 3,
    badge: "Open Trip",
    badgeColor: "bg-orange-500",
    name: "Ciwilley Bandung",
    location: "Jawa Barat",
    rating: 5.0,
    reviews: 290,
    price: "Rp 180.000",
    originalPrice: "Rp 220.000",
    image: "https://images.unsplash.com/photo-1591958192151-5e56166d7aee?w=480&h=560&fit=crop&auto=format",
  },
  {
    id: 4,
    badge: "Open Trip",
    badgeColor: "bg-orange-500",
    name: "Raja Ampat Island Hopping",
    location: "West Papua",
    rating: 4.9,
    reviews: 312,
    price: "Rp 4.200.000",
    originalPrice: "Rp 5.000.000",
    image: "https://images.unsplash.com/photo-1724258391590-6cfdc2d783b4?w=480&h=560&fit=crop&auto=format",
  },
  {
    id: 5,
    badge: "Open Trip",
    badgeColor: "bg-orange-500",
    name: "Bromo Sunrise Jeep",
    location: "East Java",
    rating: 4.8,
    reviews: 445,
    price: "Rp 1.850.000",
    originalPrice: "Rp 2.200.000",
    image: "https://images.unsplash.com/photo-1505487985217-c1f95816212d?w=480&h=560&fit=crop&auto=format",
  },
];

interface Destination {
  id:number,
  name:string,
  location:string,
  category:string,
  rating:number,
  duration:string,
  image:string,
  tag:string
}
const DESTINATIONS:Destination[] = [
  {
    id: 1,
    name: "Raja Ampat",
    location: "West Papua",
    category: "Island",
    rating: 4.9,
    duration: "5D/4N",
    image: "https://images.unsplash.com/photo-1724258391590-6cfdc2d783b4?w=600&h=420&fit=crop&auto=format",
    tag: "Bestseller",
  },
  {
    id: 2,
    name: "Bromo Tengger",
    location: "East Java",
    category: "Volcano",
    rating: 4.8,
    duration: "3D/2N",
    image: "https://images.unsplash.com/photo-1505487985217-c1f95816212d?w=600&h=420&fit=crop&auto=format",
    tag: "Popular",
  },
  {
    id: 3,
    name: "Sekumpul Falls",
    location: "North Bali",
    category: "Waterfall",
    rating: 4.7,
    duration: "2D/1N",
    image: "https://images.unsplash.com/photo-1564460549828-f0219a31bf90?w=600&h=420&fit=crop&auto=format",
    tag: "",
  },
  {
    id: 4,
    name: "Kelimutu Lake",
    location: "Flores, NTT",
    category: "Volcano",
    rating: 4.8,
    duration: "4D/3N",
    image: "https://images.unsplash.com/photo-1591958192151-5e56166d7aee?w=600&h=420&fit=crop&auto=format",
    tag: "New Route",
  },
  {
    id: 5,
    name: "Ubud Rice Terraces",
    location: "Bali",
    category: "Forest",
    rating: 4.6,
    duration: "3D/2N",
    image: "https://images.unsplash.com/photo-1513415756790-2ac1db1297d0?w=600&h=420&fit=crop&auto=format",
    tag: "",
  },
  {
    id: 6,
    name: "Rinjani Summit",
    location: "Lombok",
    category: "Volcano",
    rating: 4.9,
    duration: "4D/3N",
    image: "https://images.unsplash.com/photo-1595732194638-81889370ddb0?w=600&h=420&fit=crop&auto=format",
    tag: "Challenge",
  },
];

const CATEGORY_ICONS:Record<string,Component> = {
  "Island": Waves,
  "Volcano": Mountain,
  "Forest": TreePine,
  "Waterfall": Waves,
};

interface Tour {
  id:number,
  name:string,
  date:string,
  endDate:string,
  price:string,
  slots:number,
  totalSlots:number,
  location:string,
  difficulty:string,
  includes:string[],
  image:string
}

const TOURS:Tour[] = [
  {
    id: 1,
    name: "Raja Ampat Open Trip",
    date: "15 Juli 2025",
    endDate: "19 Juli 2025",
    price: "Rp 4.200.000",
    slots: 4,
    totalSlots: 12,
    location: "West Papua",
    difficulty: "Easy",
    includes: ["Boat", "Penginapan", "Makan", "Guide"],
    image: "https://images.unsplash.com/photo-1724258391590-6cfdc2d783b4?w=300&h=200&fit=crop&auto=format",
  },
  {
    id: 2,
    name: "Bromo Sunrise Trek",
    date: "20 Juli 2025",
    endDate: "22 Juli 2025",
    price: "Rp 1.850.000",
    slots: 8,
    totalSlots: 15,
    location: "East Java",
    difficulty: "Moderate",
    includes: ["Jeep", "Hotel", "Makan", "Guide"],
    image: "https://images.unsplash.com/photo-1505487985217-c1f95816212d?w=300&h=200&fit=crop&auto=format",
  },
  {
    id: 3,
    name: "Rinjani Summit Challenge",
    date: "2 Agustus 2025",
    endDate: "5 Agustus 2025",
    price: "Rp 2.950.000",
    slots: 0,
    totalSlots: 10,
    location: "Lombok",
    difficulty: "Hard",
    includes: ["Porter", "Camping", "Makan", "Guide"],
    image: "https://images.unsplash.com/photo-1595732194638-81889370ddb0?w=300&h=200&fit=crop&auto=format",
  },
  {
    id: 4,
    name: "Flores Overland Trip",
    date: "10 Agustus 2025",
    endDate: "13 Agustus 2025",
    price: "Rp 3.500.000",
    slots: 6,
    totalSlots: 10,
    location: "Flores, NTT",
    difficulty: "Moderate",
    includes: ["Transport", "Guesthouse", "Makan", "Guide"],
    image: "https://images.unsplash.com/photo-1591958192151-5e56166d7aee?w=300&h=200&fit=crop&auto=format",
  },
];
</script>

<template>
      <div class="min-h-screen max-w-7xl mx-auto bg-white text-gray-900 font-['Plus_Jakarta_Sans',sans-serif]">

      <!-- {/* NAVBAR */} -->
      <header :class="headerClass">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 flex items-center justify-between h-16 lg:h-18">
          <button
            class="flex items-center gap-2 group"
          >
            <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center">
              <Mountain class="w-4 h-4 text-white" />
            </div>
            <span class="font-['Fraunces',serif] text-lg font-bold tracking-tight text-gray-900">
              Open<span class="text-green-600">Trip</span>
            </span>
          </button>

          <!-- Desktop nav -->
          <nav class="hidden md:flex items-center gap-1">
    
              <button
                v-for="value in navButtonMenus"
                :class="navButtonClass(value.id)"
                @click="scrollTo(value.id)"
              >
                {{ value.text }}
              </button>

          </nav>

          <div class="hidden md:flex items-center gap-3">
            <button class="text-sm text-gray-600 hover:text-gray-900 font-medium px-3 py-2 transition-colors">
              Masuk
            </button>
            <button class="px-5 py-2 rounded-full bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition-colors">
              Daftar Sekarang
            </button>
          </div>

          <!-- Mobile toggle -->
          <button
            class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
          >
            {menuOpen ? <X class="w-5 h-5" /> : <Menu class="w-5 h-5" />}
          </button>
        </div>

        <!-- Mobile menu -->
        <!-- {menuOpen && (
          <div class="md:hidden bg-white border-t border-gray-100 px-5 pb-5">
            <div class="flex flex-col gap-1 pt-3">
              {NAV_LINKS.map(({ label, id }) => (
                <button
                  key={id}
                  onClick={() => scrollTo(id)}
                  class="text-left px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors font-medium"
                >
                  {label}
                </button>
              ))}
            </div>
            <button class="mt-3 w-full py-3 rounded-full bg-green-600 text-white font-semibold text-sm hover:bg-green-700 transition-colors">
              Daftar Sekarang
            </button>
          </div>
        )} -->
      </header>

      <!-- {/* HERO */} -->
      <section class="relative bg-white overflow-hidden pt-16">
        <!-- {/* Top area: search */} -->
        <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-14 pb-10 text-center">
          <h1 class="font-['Fraunces',serif] text-4xl lg:text-5xl font-bold text-gray-900 mb-2">
            Mau kemana?
          </h1>
          <p class="text-gray-400 text-sm mb-7">
            Labuan Bajo • Oarawan • Bromo
          </p>

          <!-- {/* Search bar */} -->
          <div class="max-w-xl mx-auto relative">
            <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-full px-5 py-3.5 shadow-md hover:shadow-lg transition-shadow">
              <Search class="w-4 h-4 text-gray-400 flex-shrink-0" />
              <input
                type="text"
                placeholder="Cari destinasi, aktivitas, atau tur..."
                class="flex-1 text-sm text-gray-700 placeholder-gray-400 bg-transparent outline-none"
              />
              <button class="flex-shrink-0 px-4 py-1.5 rounded-full bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition-colors">
                Cari
              </button>
            </div>
          </div>
        </div>

        <!-- {/* Activity cards carousel */} -->
        <div class="relative pb-16">
          <!-- {/* Fade edges */} -->
          <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-16 z-10 bg-gradient-to-r from-white to-transparent" >
          </div>
          <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-16 z-10 bg-gradient-to-l from-white to-transparent">
          </div>

          <div class="flex gap-4 overflow-x-auto scrollbar-hide px-8 lg:px-16 pb-4 snap-x snap-mandatory">
            <div
              v-for="v in ACTIVITY_CARDS"
              :class="cardClass"
            >
                  <!-- {/* Photo */} -->
                <img
                  :src="v.image"
                  :alt="v.name"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                />
                <!-- {/* Overlay gradient */} -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                </div>
                  <!-- {/* Top badges */} -->
                <div class="absolute top-3 left-3 right-3 flex items-center justify-between">
                  <span class="text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                    {{ v.badge }}
                  </span>
                  <span class="bg-black/40 backdrop-blur-sm text-white/70 text-xs px-2 py-0.5 rounded-full line-through">
                      {{ v.originalPrice }}
                  </span>
                </div>

                  <!-- {/* Bottom info */} -->
                <div class="absolute bottom-0 inset-x-0 p-4">
                  <div class="text-white font-['Fraunces',serif] font-bold text-xl lg:text-2xl mb-1 leading-tight">
                    {{ v.price }}
                  </div>
                  <h3 class="text-white font-semibold text-sm leading-snug mb-1.5">
                    {{ v.name }}
                  </h3>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1 text-white/70 text-xs">
                      <MapPin class="w-3 h-3" />
                      {{ v.location }}
                    </div>
                    <div class="flex items-center gap-1 text-white/70 text-xs">
                      <Star class="w-3 h-3 text-yellow-400 fill-yellow-400" />
                      <span class="text-white font-medium">{{ v.rating }}</span>
                      <span>({{ v.reviews }} ulasan)</span>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <!-- {/* Bottom cityscape silhouette */} -->
        <div class="w-full overflow-hidden leading-none">
          <svg
            viewBox="0 0 1440 80"
            xmlns="http://www.w3.org/2000/svg"
            class="w-full text-gray-100 fill-current"
            preserveAspectRatio="none"
          >
            <path d="M0,80 L0,60 L40,60 L40,40 L60,40 L60,50 L80,50 L80,30 L100,30 L100,50 L120,50 L120,20 L140,20 L140,50 L160,50 L160,35 L180,35 L180,55 L200,55 L200,25 L220,25 L220,55 L240,55 L240,45 L260,45 L260,60 L280,60 L280,38 L300,38 L300,58 L320,58 L320,30 L340,30 L340,55 L360,55 L360,42 L380,42 L380,62 L400,62 L400,32 L420,32 L420,52 L440,52 L440,22 L460,22 L460,52 L480,52 L480,40 L500,40 L500,60 L520,60 L520,28 L540,28 L540,58 L560,58 L560,44 L580,44 L580,64 L600,64 L600,34 L620,34 L620,54 L640,54 L640,24 L660,24 L660,54 L680,54 L680,42 L700,42 L700,62 L720,62 L720,36 L740,36 L740,56 L760,56 L760,46 L780,46 L780,26 L800,26 L800,56 L820,56 L820,38 L840,38 L840,58 L860,58 L860,48 L880,48 L880,68 L900,68 L900,30 L920,30 L920,60 L940,60 L940,40 L960,40 L960,20 L980,20 L980,50 L1000,50 L1000,35 L1020,35 L1020,55 L1040,55 L1040,42 L1060,42 L1060,62 L1080,62 L1080,32 L1100,32 L1100,52 L1120,52 L1120,22 L1140,22 L1140,52 L1160,52 L1160,40 L1180,40 L1180,60 L1200,60 L1200,50 L1220,50 L1220,30 L1240,30 L1240,50 L1260,50 L1260,38 L1280,38 L1280,58 L1300,58 L1300,45 L1320,45 L1320,65 L1340,65 L1340,55 L1360,55 L1360,35 L1380,35 L1380,60 L1400,60 L1400,40 L1440,40 L1440,80 Z" />
          </svg>
        </div>
      </section>

      <!-- {/* EXPLORE */} -->
      <section id="explore" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
          <!-- {/* Header */} -->
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
              <p class="text-green-600 text-sm font-semibold uppercase tracking-wider mb-2">Destinasi</p>
              <h2 class="font-['Fraunces',serif] text-4xl lg:text-5xl font-bold text-gray-900">
                Explore Destinasi
              </h2>
            </div>
            <!-- {/* Category filter */} -->
            <div class="flex flex-wrap gap-2">
                <button
                  :class="filterButtonClass"
                >
                  {cat}
                </button>
            </div>
          </div>

          <!-- {/* Grid */} -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              <article
                v-for="v in DESTINATIONS"
                class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer"
              >
                <div class="relative h-56 overflow-hidden bg-gray-100">
                  <img
                    :src="v.image"
                    :alt="v.name"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-green-600 text-white text-xs font-semibold">
                      {{ v.tag }}
                  </span>
                  <div class="absolute top-3 right-3 flex items-center gap-1 px-2.5 py-1 rounded-full bg-white shadow-sm">
                    <Star class="w-3 h-3 text-yellow-500 fill-yellow-500" />
                    <span class="text-gray-800 text-xs font-semibold">{{ v.rating }}</span>
                  </div>
                </div>

                <div class="p-4">
                  <div class="flex items-center gap-1 text-gray-400 text-xs mb-1.5">
                     <component
                        :is="CATEGORY_ICONS[v.category]"
                        class="w-3.5 h-3.5"
                      />
                    <span>{{ v.category }}</span>
                  </div>
                  <h3 class="font-['Fraunces',serif] text-xl font-semibold text-gray-900 mb-2">
                    {{ v.name }}
                  </h3>
                  <div class="flex items-center justify-between text-sm text-gray-500">
                    <div class="flex items-center gap-1">
                      <MapPin class="w-3.5 h-3.5" />
                      {{ v.location }}
                    </div>
                    <div class="flex items-center gap-1">
                      <Clock class="w-3.5 h-3.5" />
                      {{ v.duration }}
                    </div>
                  </div>
                </div>
              </article>
          </div>

          <div class="text-center mt-10">
            <button class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-gray-200 text-gray-700 text-sm font-medium hover:border-gray-400 transition-colors">
              Lihat Semua Destinasi <ChevronRight class="w-4 h-4" />
            </button>
          </div>
        </div>
      </section>

      <!-- {/* TOUR SCHEDULE */} -->
      <section id="schedule" class="py-20 lg:py-28 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
          <div class="mb-10">
            <p class="text-green-600 text-sm font-semibold uppercase tracking-wider mb-2">Keberangkatan</p>
            <h2 class="font-['Fraunces',serif] text-4xl lg:text-5xl font-bold text-gray-900 mb-3">
              Tour Schedule
            </h2>
            <p class="text-gray-500 max-w-lg">
              Jadwal keberangkatan tetap — bergabung sendiri atau bersama teman. Semua akomodasi sudah termasuk.
            </p>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <article
                  v-for="v in TOURS"
                  class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden"
                >
                  <div class="flex">
                    <!-- {/* Thumbnail */} -->
                    <div class="w-28 lg:w-36 flex-shrink-0 bg-gray-100 overflow-hidden">
                      <img
                        :src="v.image"
                        :alt="v.name"
                        class="w-full h-full object-cover"
                      />
                    </div>

                    <div class="flex-1 p-4 lg:p-5">
                      <div class="flex items-start justify-between gap-2 mb-2">
                        <div>
                          <h3 class="font-['Fraunces',serif] text-base lg:text-lg font-semibold text-gray-900 leading-snug">
                            {{ v.name }}
                          </h3>
                          <div class="flex items-center gap-1 text-gray-400 text-xs mt-0.5">
                            <MapPin class="w-3 h-3" />
                            {{ v.location }}
                          </div>
                        </div>
                        <span class='text-xs px-2 py-0.5 rounded-full font-medium flex-shrink-0'>
                          {{ v.difficulty }}
                        </span>
                      </div>

                      <div class="flex items-center gap-1 text-gray-500 text-xs mb-3">
                        <Calendar class="w-3.5 h-3.5" />
                        {{ v.date }} — {{ v.endDate }}
                      </div>

                      {/* Slots */}
                      <div class="mb-3">
                        <div class="flex justify-between text-xs mb-1">
                          <span class="text-gray-500 flex items-center gap-1">
                            <Users class="w-3 h-3" />
                            {full ? <span class="text-red-500 font-medium">Penuh</span> : <span>{tour.slots} slot tersisa</span>}
                          </span>
                          <span class="text-gray-400">{joined}/{{ v.totalSlots }}</span>
                        </div>
                        <div class="h-1.5 rounded-full bg-gray-100 overflow-hidden">
                          <div class="h-full rounded-full bg-green-500 transition-all">
                          </div>
                        </div>
                      </div>

                      <div class="flex items-center justify-between">
                        <div>
                          <span class="font-['Fraunces',serif] font-bold text-gray-900">{{ v.price }}</span>
                          <span class="text-gray-400 text-xs ml-1">/orang</span>
                        </div>
                        <button
                          :class="tripButtonClass"
                        >
                          {full ? "Waitlist" : "Daftar"}
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- {/* Includes */} -->
                  <div class="border-t border-gray-50 bg-gray-50 px-4 lg:px-5 py-2.5 flex flex-wrap gap-2">
                      <span
                        v-for="i in v.includes"
                        class="text-xs text-gray-500 px-2.5 py-1 bg-white rounded-full border border-gray-100"
                      >
                        {{ i }}
                      </span>
                  </div>
                </article>
      
          </div>

          <div class="text-center mt-8">
            <button class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-gray-200 text-gray-700 text-sm font-medium hover:border-gray-400 transition-colors">
              Jadwal Selengkapnya <ChevronRight class="w-4 h-4" />
            </button>
          </div>
        </div>
      </section>

      <!-- {/* ABOUT US */} -->
      <section id="about" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 lg:gap-20 items-center">
            <!-- {/* Images */} -->
            <div class="relative h-[420px] lg:h-[520px] order-2 lg:order-1">
              <div class="absolute top-0 left-0 w-[63%] h-[70%] rounded-2xl overflow-hidden bg-gray-100 shadow-md">
                <img
                  src="https://images.unsplash.com/photo-1593901138884-02ee723a96f7?w=500&h=600&fit=crop&auto=format"
                  alt="Lush Indonesian forest"
                  class="w-full h-full object-cover"
                />
              </div>
              <div class="absolute bottom-0 right-0 w-[55%] h-[58%] rounded-2xl overflow-hidden bg-gray-100 shadow-md">
                <img
                  src="https://images.unsplash.com/photo-1554931670-4ebfabf6e7a9?w=400&h=500&fit=crop&auto=format"
                  alt="Cascading waterfall"
                  class="w-full h-full object-cover"
                />
              </div>
              <!-- {/* Floating card */} -->
              <div class="absolute bottom-[36%] left-[54%] transform -translate-x-1/2 bg-white border border-gray-100 rounded-xl px-5 py-4 shadow-lg z-10 text-center w-32">
                <div class="font-['Fraunces',serif] text-3xl font-bold text-green-600">8+</div>
                <div class="text-gray-500 text-xs leading-tight mt-0.5">Tahun Berpengalaman</div>
              </div>
            </div>

            <!-- {/* Text */} -->
            <div class="order-1 lg:order-2">
              <p class="text-green-600 text-sm font-semibold uppercase tracking-wider mb-3">Tentang Kami</p>
              <h2 class="font-['Fraunces',serif] text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-5">
                Lahir dari Cinta
                <br />
                <span class="text-green-600">Alam Indonesia</span>
              </h2>
              <p class="text-gray-500 leading-relaxed mb-4">
                OpenTrip berdiri sejak 2016 oleh para pemandu dan petualang yang percaya bahwa pengalaman alam terbaik seharusnya dapat diakses semua orang — tanpa kerumitan perencanaan atau biaya solo yang mahal.
              </p>
              <p class="text-gray-500 leading-relaxed mb-8">
                Setiap rute kami survei langsung, setiap pemandu terlatih secara lokal, dan setiap itinerary dirancang untuk meminimalkan dampak lingkungan sambil memaksimalkan pengalaman. Kami bangga telah menghubungkan lebih dari 3.200 traveler dari seluruh dunia.
              </p>

              <div class="grid grid-cols-2 gap-3 mb-8">
                {[
                  { icon: <Mountain class="w-5 h-5 text-green-600" />, title: "Pemandu Lokal", desc: "Bersertifikat & berpengalaman" },
                  { icon: <Star class="w-5 h-5 text-green-600" />, title: "Rating 4.8", desc: "Dari ulasan terverifikasi" },
                  { icon: <Users class="w-5 h-5 text-green-600" />, title: "Grup Kecil", desc: "Maks. 12 peserta" },
                  { icon: <TreePine class="w-5 h-5 text-green-600" />, title: "Ramah Lingkungan", desc: "Leave No Trace" },
                ].map((item) => (
                  <div key={item.title} class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                    <div class="mb-2">{item.icon}</div>
                    <div class="text-gray-900 font-semibold text-sm">{item.title}</div>
                    <div class="text-gray-400 text-xs mt-0.5">{item.desc}</div>
                  </div>
                ))}
              </div>

              <button class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-green-600 text-white font-semibold hover:bg-green-700 transition-colors text-sm">
                Kenali Tim Kami <ArrowRight class="w-4 h-4" />
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- {/* CTA */} -->
      <section class="relative py-20 overflow-hidden bg-green-600">
        <div class="absolute inset-0 opacity-10">
          <img
            src="https://images.unsplash.com/photo-1604069871151-23761eebcb7d?w=1400&h=500&fit=crop&auto=format"
            alt=""
            class="w-full h-full object-cover"
          />
        </div>
        <div class="relative z-10 max-w-3xl mx-auto px-5 text-center">
          <h2 class="font-['Fraunces',serif] text-4xl lg:text-5xl font-bold text-white mb-4">
            Siap Memulai Petualangan?
          </h2>
          <p class="text-green-100 mb-8 text-lg">
            Cek jadwal keberangkatan terdekat dan amankan slot-mu sebelum penuh.
          </p>
          <div class="flex flex-wrap gap-3 justify-center">
            <button
              class="px-7 py-3 rounded-full bg-white text-green-700 font-semibold hover:bg-gray-50 transition-colors inline-flex items-center gap-2"
            >
              Cek Jadwal <ArrowRight class="w-4 h-4" />
            </button>
            <button class="px-7 py-3 rounded-full border border-white/40 text-white font-medium hover:bg-white/10 transition-colors">
              Hubungi Kami
            </button>
          </div>
        </div>
      </section>

      <!-- {/* FOOTER */} -->
      <footer class="bg-gray-900 text-white py-14">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
            <div class="md:col-span-2">
              <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center">
                  <Mountain class="w-4 h-4 text-white" />
                </div>
                <span class="font-['Fraunces',serif] text-lg font-bold">
                  Open<span class="text-green-400">Trip</span>
                </span>
              </div>
              <p class="text-gray-400 text-sm leading-relaxed max-w-xs mb-5">
                Menghubungkan para petualang dengan keindahan alam Indonesia sejak 2016.
              </p>
              <div class="flex gap-3">
                {[Instagram, Facebook].map((Icon, i) => (
                  <button
                    key={i}
                    class="w-9 h-9 rounded-full bg-gray-800 hover:bg-gray-700 flex items-center justify-center transition-colors"
                  >
                    <Icon class="w-4 h-4 text-gray-400" />
                  </button>
                ))}
              </div>
            </div>

            <div>
              <h4 class="font-semibold text-white text-sm mb-4">Menu</h4>
              <ul class="space-y-2">
                  <li key={id}>
                    <button
                      class="text-gray-400 text-sm hover:text-white transition-colors"
                    >
                      {label}
                    </button>
                  </li>
              </ul>
            </div>

            <div>
              <h4 class="font-semibold text-white text-sm mb-4">Kontak</h4>
              <ul class="space-y-3">
                <li class="flex items-center gap-2 text-gray-400 text-sm">
                  <Mail class="w-4 h-4" />
                  hello@opentrip.id
                </li>
                <li class="flex items-center gap-2 text-gray-400 text-sm">
                  <Phone class="w-4 h-4" />
                  +62 812 3456 7890
                </li>
                <li class="flex items-center gap-2 text-gray-400 text-sm">
                  <MapPin class="w-4 h-4" />
                  Jakarta, Indonesia
                </li>
              </ul>
            </div>
          </div>

          <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-gray-500 text-xs">
              &copy; {new Date().getFullYear()} OpenTrip Indonesia. All rights reserved.
            </p>
            <p class="text-gray-600 text-xs">Made with ❤️ for Indonesia</p>
          </div>
        </div>
      </footer>
    </div>
</template>