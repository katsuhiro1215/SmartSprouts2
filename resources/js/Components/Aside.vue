<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  asideClass: {
    type: String,
    default: 'w-full text-slate-800 bg-slate-200 dark:bg-slate-900 dark:text-slate-300',
  },
  containerClass: {
    type: String,
    default: 'max-w-screen-xl mx-auto flex flex-col lg:flex-row justify-between gap-5 p-6 py-12',
  },
});

</script>

<template>
  <aside :class="asideClass">
    <div :class="containerClass">
      <slot />
    </div>
  </aside>
</template>