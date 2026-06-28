<script setup lang="ts">
import { ref, computed, type Component } from 'vue'
import HelloWorld from './components/HelloWorld.vue'
import TheWelcome from './components/TheWelcome.vue'
import Explore from './pages/Explore.vue'
import { RouterView } from 'vue-router'

interface Route {
  component: Component
  props?: Record<string, unknown>
}

// const routes: Record<string, Route> = {
//   '/': {
//     component:Explore,
//   },
// }


// const currentPath = ref<string>(window.location.hash)

// window.addEventListener('hashchange', () => {
//   currentPath.value = window.location.hash
// })

// const currentView = computed(() => {
//   return routes[currentPath.value.slice(1) || '/']
// })
</script>

<template>
  <router-view></router-view>
  <!-- <component :is="currentView?.component" v-bind="currentView?.props" /> -->
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
