<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  }
})

const classes = computed(() => 
  props.active ? "bg-slate-300 w-full inline-flex items-center px-6 p-3 rounded-md border-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-slate-900 dark:text-slate-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out" : "bg-slate-300 w-full inline-flex items-center px-6 p-3 rounded-md border-2 border-transparent text-sm font-medium leading-5 text-slate-500 dark:text-slate-900 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-700 focus:outline-none focus:text-slate-700 dark:focus:text-slate-300 focus:border-slate-300 dark:focus:border-slate-700 transition duration-150 ease-in-out"
);

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>