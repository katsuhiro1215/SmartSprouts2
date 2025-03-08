<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

// Props
const props = defineProps({
  buttonType: {
    type: String,
    default: 'default',
  },
  buttonActionType: {
    type: String,
    default: 'button',
  },
  size: {
    type: String,
    default: "base",
  },
  href: {
    type: String,
    default: null,
  },
});

//Color
const colors = {
  default: {
    class: 'text-white bg-black border border-transparent hover:bg-black/90 active:bg-black/90',
  },
  primary: {
    class:
      'text-white bg-blue-400 border border-transparent hover:bg-blue-400/90 active:bg-blue-400/90',
  },
  secondary: {
    class:
      'text-white bg-gray-400 border border-transparent hover:bg-gray-400/90 active:bg-gray-400/90',
  },
  danger: {
    class:
      'text-white bg-red-400 border border-transparent hover:bg-red-400/90 active:bg-red-400/90',
  },
  warning: {
    class:
      'text-white bg-yellow-400 border border-transparent hover:bg-yellow-400/90 active:bg-yellow-400/90',
  },
  success: {
    class:
      'text-white bg-green-400 border border-transparent hover:bg-green-400/90 active:bg-green-400/90',
  },
  info: {
    class:
      'text-white bg-sky-400 border border-transparent hover:bg-sky-400/90 active:bg-sky-400/90',
  },
  orange: {
    class:
      'text-white bg-orange-400 border border-transparent hover:bg-orange-400/90 active:bg-orange-400/90',
  },
  pink: {
    class:
      'text-white bg-pink-400 border border-transparent hover:bg-pink-400/90 active:bg-pink-400/90',
  },
  indigo: {
    class:
      'text-white bg-indigo-400 border border-transparent hover:bg-indigo-400/90 active:bg-indigo-400/90',
  },
  emerald: {
    class:
      'text-white bg-emerald-400 border border-transparent hover:bg-emerald-400/90 active:bg-emerald-400/90',
  },
  light: {
    class:
      'text-gray-900 bg-gray-100 border border-transparent hover:bg-gray-200 active:bg-gray-200',
  },
  dark: {
    class:
      'text-white bg-gray-800 border border-transparent hover:bg-gray-800/90 active:bg-gray-800/90',
  },
  ghost: {
    class:
      'text-gray-900 bg-transparent border border-transparent hover:bg-transparent hover:border-gray-100 active:bg-gray-100',
  },
};

// Size
const sizes = {
  xs: 'px-2.5 py-0.5 text-xs',
  sm: 'px-3 py-0.5 text-sm',
  base: 'px-4 py-1 text-sm',
  lg: 'px-4 py-2 text-base',
  xl: 'px-6 py-3 text-base',
};

const buttonClass = computed(() => colors[props.buttonType].class);
</script>

<template>
  <Link
    v-if="href"
    :href="href"
    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50 shadow h-9 px-4 py-2"
    :class="buttonClass"
    :type="buttonActionType"
    :size="sizes"
  >
    <slot></slot>
  </Link>

  <button
    v-else
    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50 shadow h-9 px-4 py-2"
    :class="buttonClass"
    :type="buttonActionType"
  >
    <slot></slot>
  </button>
</template>