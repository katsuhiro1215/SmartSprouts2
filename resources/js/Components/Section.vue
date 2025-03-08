<script setup>
import { defineProps, useSlots } from 'vue';

const props = defineProps({
  title: String,
  description: String,
  sectionClass: {
    type: String,
    default: 'w-full text-slate-900 bg-white dark:bg-slate-900 dark:text-slate-300 p-6 py-12',
  },
  containerClass: {
    type: String,
    default: 'max-w-screen-xl mx-auto flex flex-col space-y-4 p-6 py-12',
  },
  headerClass: {
    type: String,
    default: 'text-xl font-bold mb-3',
  },
  contentClass: {
    type: String,
    default: 'flex flex-col max-w-7xl mx-auto',
  },
});

const slots = useSlots();
</script>

<template>
  <section :class="sectionClass">
    <div :class="containerClass">
      <div v-if="slots.header || header" :class="headerClass">
        <slot name="header">
          <h2 v-if="title" class="text-2xl font-semibold leading-none tracking-tight">{{ title }}</h2>
        </slot>
      </div>
      <div :class="contentClass">
        <slot name="content">
          <p class="text-gray-700 dark:text-slate-300">No content provided.</p>
        </slot>
      </div>
    </div>
  </section>
</template>