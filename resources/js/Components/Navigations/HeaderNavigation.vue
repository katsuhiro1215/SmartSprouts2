<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  active: {
    type: Boolean,
  },
});

const classes = computed(() => props.active ? "" : "");
</script>

<template>
  <nav>
    <ul class="flex items-center gap-4">
      <li>
        <!-- <Link :href="route('welcome')" :active="route().current('welcome')">Link</Link> -->
        Link
      </li>
      <li>
        <!-- <Link :href="route('welcome')" :active="route().current('welcome')">Link</Link> -->
        Link
      </li>
      <li>
        <!-- <Link :href="route('welcome')" :active="route().current('welcome')">Link</Link> -->
        Link
      </li>
    </ul>
  </nav>
</template>