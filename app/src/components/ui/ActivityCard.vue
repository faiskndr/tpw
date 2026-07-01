<template>
    <div 
        class="relative h-[420px] overflow-hidden"
        @pointerdown="onPointerDown"
        @pointermove="onPointerMove"
        @pointerup="onPointerUp"
        @pointerleave="onPointerUp"
    >
        <div
            v-for="(v, i) in tourPackages"
            :key="v.id"
            :style="getCardStyle(i)"
            class="absolute left-1/2 top-0
                w-[740px] h-[380px]
                rounded-3xl overflow-hidden
                transition-all duration-500 ease-in-out"
        >
            <!-- Image -->
            <img
            :src="getTourPackageCoverImageUrl(v.package_images)"
            :alt="v.title"
            class="w-full h-full object-cover"
            />

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

            <!-- Top -->
            <div class="absolute top-4 left-4 right-4 flex justify-between">
            <span class="bg-yellow-400 text-black text-xs px-2 py-1 h-6 rounded-full">
                {{ v.type_formatted }}
            </span>

            <div class="text-right">
                <div class="text-white/60 line-through">
                {{ v.price_original }}
                </div>
                <div class="text-white font-bold text-3xl">
                {{ v.price }}
                </div>
            </div>
            </div>

            <!-- Bottom -->
            <div class="absolute bottom-5 left-5 right-5 text-white">
            <h2 class="text-4xl font-bold">
                {{ v.title }}
            </h2>

            <div class="mt-2 flex items-center gap-6">
                <div class="flex items-center gap-1">
                <MapPin class="w-4 h-4"/>
                {{ v.destination.name }}
                </div>

                <div class="flex items-center gap-1">
                <Star class="w-4 h-4 fill-yellow-400 text-yellow-400"/>
                {{ v.rating }} ({{ v.review_count }} Ulasan)
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import type { PackageImage, TourPackage } from '@/types/tourpackage';
import { MapPin, Star } from 'lucide-vue-next';
import { computed, ref } from 'vue';

const props = defineProps<{
  tourPackages: TourPackage[];
}>();

const activeIndex = ref(1)

function getTourPackageCoverImageUrl(p:PackageImage[]) :string {
  var imageUrl = ""
  for (let index = 0; index < p.length; index++) {
    if (p[index]?.is_cover == 1) {
      imageUrl = p[index]?.image_url ?? ""
      break
    }
  }
  return imageUrl
}

const getCardStyle = (index:number) => {
  const diff = index - activeIndex.value

  return {
    transform: `
      translateX(calc(-50% + ${diff * 280 + dragOffset.value}px))
      scale(${1 - Math.abs(diff) * 0.08})
    `,
    transition: isDragging.value
      ? 'none'
      : 'transform .4s ease',
    zIndex: 100 - Math.abs(diff),
  }
}

const dragOffset = computed(() => {
  if (!isDragging.value) return 0

  return currentX.value - startX.value
})

const startX = ref(0)
const currentX = ref(0)
const isDragging = ref(false)

const DRAG_THRESHOLD = 80

function onPointerDown(e: PointerEvent) {
  isDragging.value = true
  startX.value = e.clientX
  currentX.value = e.clientX

  // Prevent browser selecting text/images
  ;(e.target as HTMLElement).setPointerCapture(e.pointerId)
}

function onPointerMove(e: PointerEvent) {
  if (!isDragging.value) return

  currentX.value = e.clientX
}

function onPointerUp(e: PointerEvent) {
  if (!isDragging.value) return

  isDragging.value = false

  const distance = currentX.value - startX.value

  if (distance > DRAG_THRESHOLD) {
    prev()
  } else if (distance < -DRAG_THRESHOLD) {
    next()
  }
}


const next = () => {
  activeIndex.value =
    (activeIndex.value + 1) % props.tourPackages.length
}

const prev = () => {
  activeIndex.value =
    (activeIndex.value - 1 + props.tourPackages.length) %
    props.tourPackages.length
}
</script>