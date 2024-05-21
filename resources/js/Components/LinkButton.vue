<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
const props = defineProps({
  color: {
    type: String,
    default: 'default',
  },
})

const defineColor = computed(() => {
  if (props.color === 'info') {
    return 'inline-flex items-center px-4 py-2 bg-cyan-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
  } else if (props.color === 'warning') {
    return 'inline-flex items-center px-4 py-2 bg-yellow-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
  } else if (props.color === 'danger') {
    return 'inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
  } else if (props.color === 'default') {
    return 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
  } else {
    return
  }
})
</script>

<template>
  <Link href="#" :class="defineColor" preserve-scroll>
    <slot />
  </Link>
</template>
